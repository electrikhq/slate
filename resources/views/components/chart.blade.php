{{-- chart.blade.php --}}
@props([
    'type' => 'line', // line, bar, area, pie, doughnut
    'height' => 'h-[300px]',
    'data' => null, // JSON string or array
    'options' => null, // JSON string or array for Chart.js options
])

@php
    $chartId = $attributes->get('id', 'chart-' . uniqid());
    
    // Ensure data has proper structure for Chart.js
    $defaultData = ['labels' => [], 'datasets' => []];
    $chartDataArray = is_array($data) ? $data : (is_string($data) ? json_decode($data, true) : ($data ?? $defaultData));
    $chartOptionsArray = is_array($options) ? $options : (is_string($options) ? json_decode($options, true) : ($options ?? []));
    
    // Encode JSON - Blade's {{ }} will escape for HTML attributes
    $chartDataJson = json_encode($chartDataArray, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP);
    $chartOptionsJson = json_encode($chartOptionsArray, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP);
@endphp

<div
    data-chart-data="{{ $chartDataJson }}"
    data-chart-options="{{ $chartOptionsJson }}"
    x-data="{
        chart: null,
        type: '{{ $type }}',
        get data() {
            try {
                return JSON.parse(this.$el.getAttribute('data-chart-data'));
            } catch (e) {
                console.error('Error parsing chart data:', e);
                return { labels: [], datasets: [] };
            }
        },
        get options() {
            try {
                return JSON.parse(this.$el.getAttribute('data-chart-options'));
            } catch (e) {
                console.error('Error parsing chart options:', e);
                return {};
            }
        },
        init() {
            // Wait for Chart.js to be available
            if (typeof Chart !== 'undefined') {
                this.$nextTick(() => {
                    this.initChart();
                });
            } else {
                // Try to load Chart.js if not available
                this.loadChartJS().then(() => {
                    this.$nextTick(() => {
                        this.initChart();
                    });
                }).catch((error) => {
                    console.error('Failed to load Chart.js:', error);
                });
            }
        },
        async loadChartJS() {
            return new Promise((resolve, reject) => {
                if (typeof Chart !== 'undefined') {
                    resolve();
                    return;
                }
                
                const script = document.createElement('script');
                script.src = 'https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js';
                script.onload = () => resolve();
                script.onerror = () => reject(new Error('Failed to load Chart.js'));
                document.head.appendChild(script);
            });
        },
        initChart() {
            if (!this.$refs.canvas) {
                console.error('Canvas element not found');
                return;
            }
            
            const ctx = this.$refs.canvas.getContext('2d');
            if (!ctx) {
                console.error('Could not get 2d context from canvas');
                return;
            }
            
            // Destroy existing chart if it exists
            if (this.chart) {
                this.chart.destroy();
            }
            
            const defaultOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true,
                    }
                }
            };
            
            // Ensure data has proper structure
            const chartData = this.data && typeof this.data === 'object' ? this.data : { labels: [], datasets: [] };
            const chartOptions = this.options && typeof this.options === 'object' ? this.options : {};
            
            const mergedOptions = { ...defaultOptions, ...chartOptions };
            
            try {
                this.chart = new Chart(ctx, {
                    type: this.type,
                    data: chartData,
                    options: mergedOptions
                });
            } catch (error) {
                console.error('Error initializing chart:', error);
            }
        },
        updateChart(newData, newOptions) {
            if (this.chart) {
                this.chart.data = newData;
                if (newOptions) {
                    this.chart.options = { ...this.chart.options, ...newOptions };
                }
                this.chart.update();
            }
        }
    }"
    x-ref="chartContainer"
    wire:ignore
    {{ $attributes->merge(['class' => 'relative w-full ' . $height]) }}
>
    <canvas x-ref="canvas" class="w-full h-full"></canvas>
    {{ $slot }}
</div>

