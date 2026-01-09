{{-- file-input.blade.php --}}
@props([
    'accept' => null,
    'multiple' => false,
    'disabled' => false,
    'required' => false,
    'name' => null,
    'id' => 'file-input-' . uniqid(),
    'label' => null,
    'help' => null,
    'errorMessage' => null,
])

<div
    x-data="{
        files: [],
        isDragging: false,
        handleFiles(fileList) {
            this.files = Array.from(fileList || []);
        },
        handleDrop(e) {
            e.preventDefault();
            this.isDragging = false;
            if (e.dataTransfer.files.length > 0) {
                this.handleFiles(e.dataTransfer.files);
                if (this.$refs.input) {
                    this.$refs.input.files = e.dataTransfer.files;
                }
            }
        },
        handleDragOver(e) {
            e.preventDefault();
            this.isDragging = true;
        },
        handleDragLeave() {
            this.isDragging = false;
        },
        removeFile(index) {
            this.files.splice(index, 1);
            if (this.$refs.input) {
                const dt = new DataTransfer();
                this.files.forEach(file => dt.items.add(file));
                this.$refs.input.files = dt.files;
            }
        }
    }"
    @drop.prevent="handleDrop($event)"
    @dragover.prevent="handleDragOver($event)"
    @dragleave.prevent="handleDragLeave()"
    class="w-full"
>
    @if($label && $id)
        <x-slate::label 
            :for="$id" 
            :required="$required" 
            class="mb-1"
        >
            {{ $label }}
        </x-slate::label>
    @endif
    
    <div
        :class="isDragging ? 'border-primary bg-primary/5' : 'border-input'"
        class="relative flex flex-col items-center justify-center rounded-lg border-2 border-dashed bg-background p-6 transition-colors hover:bg-accent/50"
    >
        <input
            type="file"
            x-ref="input"
            @change="handleFiles($event.target.files)"
            @if($name) name="{{ $name }}" @endif
            @if($id) id="{{ $id }}" @endif
            @if($accept) accept="{{ $accept }}" @endif
            @if($multiple) multiple @endif
            @if($disabled) disabled @endif
            @if($required) required @endif
            class="absolute inset-0 h-full w-full cursor-pointer opacity-0"
            {{ $attributes->except(['name', 'id', 'accept', 'multiple', 'disabled', 'required', 'label', 'help', 'errorMessage']) }}
        />
        
        <div class="flex flex-col items-center justify-center text-center">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="mb-2 h-8 w-8 text-muted-foreground"
            >
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                <polyline points="17 8 12 3 7 8" />
                <line x1="12" y1="3" x2="12" y2="15" />
            </svg>
            <p class="text-sm font-medium text-foreground">
                <span class="text-primary hover:underline">Click to upload</span>
                or drag and drop
            </p>
            <p class="text-xs text-muted-foreground mt-1">
                @if($accept)
                    {{ $accept }}
                @else
                    Any file type
                @endif
            </p>
        </div>
    </div>
    
    <template x-if="files.length > 0">
        <div class="mt-4 space-y-2">
            <template x-for="(file, index) in files" :key="index">
                <div class="flex items-center justify-between rounded-md border border-border bg-background p-2">
                    <div class="flex items-center space-x-2 flex-1 min-w-0">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="h-4 w-4 shrink-0 text-muted-foreground"
                        >
                            <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" />
                            <polyline points="14 2 14 8 20 8" />
                        </svg>
                        <span class="text-sm text-foreground truncate" x-text="file.name"></span>
                        <span class="text-xs text-muted-foreground" x-text="'(' + (file.size / 1024).toFixed(1) + ' KB)'"></span>
                    </div>
                    <button
                        type="button"
                        @click="removeFile(index)"
                        class="ml-2 rounded-sm p-1 text-muted-foreground hover:text-foreground focus:outline-none focus:ring-2 focus:ring-ring"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M18 6L6 18M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </template>
        </div>
    </template>
    
    @if($help && $id)
        <p id="{{ $id }}-help" class="mt-1 text-sm text-muted-foreground">
            {{ $help }}
        </p>
    @endif
    
    @if($errorMessage && $id)
        <p id="{{ $id }}-error" class="mt-1 text-sm text-danger">
            {{ $errorMessage }}
        </p>
    @endif
</div>


