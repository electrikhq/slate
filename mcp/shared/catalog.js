/**
 * Shared Slate MCP catalog + fetch helpers (stdio npm package + Cloudflare Worker).
 */

export const VERSION = '3.0.0-alpha.4';

export const DEFAULT_DOCS_URL = 'https://slate.electrik.dev';
export const DEFAULT_SOURCE_URL =
  'https://raw.githubusercontent.com/electrikhq/slate/3.x';

export const COMPONENTS = [
  'button', 'badge', 'card', 'alert', 'separator', 'avatar', 'skeleton', 'dialog',
  'tabs', 'spinner', 'breadcrumb', 'progress', 'kbd', 'aspect-ratio', 'tooltip',
  'collapsible', 'accordion', 'popover', 'toggle', 'toggle-group', 'empty', 'slider',
  'pagination', 'table', 'hover-card', 'alert-dialog', 'sheet', 'scroll-area',
  'button-group', 'dropdown-menu', 'input', 'textarea', 'select', 'checkbox',
  'switch', 'radio', 'field', 'dark-mode-toggle', 'radio-group', 'file-input',
  'form', 'rating', 'timeline', 'stepper', 'marquee', 'drawer', 'carousel',
  'resizable', 'context-menu', 'command', 'combobox', 'calendar', 'menubar',
  'navigation-menu', 'sidebar', 'app-shell', 'chart', 'spotlight', 'toast',
];

export const BLOCKS = [
  { id: 'login', title: 'Login', category: 'Auth' },
  { id: 'register', title: 'Register', category: 'Auth' },
  { id: 'settings', title: 'Settings', category: 'Application' },
  { id: 'app-shell', title: 'App shell', category: 'Application' },
  { id: 'empty-state', title: 'Empty state', category: 'Application' },
  { id: 'pricing', title: 'Pricing', category: 'Marketing' },
  { id: 'form-validation', title: 'Form validation', category: 'Forms' },
  { id: 'toast-action', title: 'Toast action', category: 'Feedback' },
  { id: 'hero', title: 'Hero', category: 'Marketing' },
];

export function resolveDocsUrl(override) {
  return String(override || DEFAULT_DOCS_URL).replace(/\/$/, '');
}

export function resolveSourceUrl(override) {
  return String(override || DEFAULT_SOURCE_URL).replace(/\/$/, '');
}

export async function fetchText(url, userAgent = `electrik-slate-mcp/${VERSION}`) {
  const response = await fetch(url, {
    headers: { 'User-Agent': userAgent },
  });

  if (!response.ok) {
    throw new Error(`HTTP ${response.status} for ${url}`);
  }

  return response.text();
}

export function textResult(text, isError = false) {
  return {
    content: [{ type: 'text', text }],
    isError,
  };
}

export function normalizeComponentSlug(name) {
  return String(name || '')
    .trim()
    .toLowerCase()
    .replace(/^x-slate::/, '');
}

export function normalizeDocsPath(path) {
  return String(path || '')
    .trim()
    .replace(/^\/+/, '')
    .replace(/^docs\//, '')
    .replace(/\.md$/, '');
}
