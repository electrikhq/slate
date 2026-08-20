#!/usr/bin/env node
/**
 * Read-only MCP server for Electrik Slate.
 * Fetches docs from slate.electrik.dev and Blade source from GitHub 3.x.
 */

import { McpServer } from '@modelcontextprotocol/sdk/server/mcp.js';
import { StdioServerTransport } from '@modelcontextprotocol/sdk/server/stdio.js';
import { z } from 'zod';

const DOCS_URL = (process.env.SLATE_DOCS_URL || 'https://slate.electrik.dev').replace(/\/$/, '');
const SOURCE_URL = (
  process.env.SLATE_SOURCE_URL ||
  'https://raw.githubusercontent.com/electrikhq/slate/3.x'
).replace(/\/$/, '');

const COMPONENTS = [
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

const BLOCKS = [
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

async function fetchText(url) {
  const response = await fetch(url, {
    headers: { 'User-Agent': 'electrik-slate-mcp/3.0.0-alpha.2' },
  });

  if (!response.ok) {
    throw new Error(`HTTP ${response.status} for ${url}`);
  }

  return response.text();
}

function textResult(text, isError = false) {
  return {
    content: [{ type: 'text', text }],
    isError,
  };
}

const server = new McpServer({
  name: 'electrik-slate',
  version: '3.0.0-alpha.2',
});

server.tool(
  'list_components',
  'List shipped Electrik Slate Blade components with docs URLs.',
  async () => {
    const lines = COMPONENTS.map(
      (slug) => `- ${slug}: ${DOCS_URL}/components/${slug}.md`
    );

    return textResult(
      [
        'Electrik Slate shipped components (3.x):',
        '',
        ...lines,
        '',
        `Browse UI: ${DOCS_URL}/components`,
      ].join('\n')
    );
  }
);

server.tool(
  'list_blocks',
  'List Slate docs-site blocks (copy-ready Blade sections).',
  async () => {
    const lines = BLOCKS.map(
      (block) => `- ${block.id} (${block.category}): ${DOCS_URL}/blocks/${block.id}`
    );

    return textResult(
      [
        'Slate blocks:',
        '',
        ...lines,
        '',
        `Gallery: ${DOCS_URL}/blocks`,
      ].join('\n')
    );
  }
);

server.tool(
  'get_component_docs',
  'Fetch markdown documentation for a Slate component (e.g. button, dialog, input).',
  {
    name: z
      .string()
      .describe('Component slug, e.g. button, alert-dialog, dark-mode-toggle'),
  },
  async ({ name }) => {
    const slug = name.trim().toLowerCase().replace(/^x-slate::/, '');

    if (!COMPONENTS.includes(slug)) {
      return textResult(
        `Unknown component "${name}". Use list_components to see shipped slugs.`,
        true
      );
    }

    try {
      const markdown = await fetchText(`${DOCS_URL}/components/${slug}.md`);
      return textResult(`# ${slug}\n\nSource: ${DOCS_URL}/components/${slug}.md\n\n${markdown}`);
    } catch (error) {
      return textResult(`Failed to fetch docs for ${slug}: ${error.message}`, true);
    }
  }
);

server.tool(
  'get_docs_page',
  'Fetch a docs markdown page by path (e.g. getting-started/installation, livewire, ai, philosophy).',
  {
    path: z
      .string()
      .describe('Docs path without leading docs/, e.g. getting-started/installation or design-tokens'),
  },
  async ({ path }) => {
    const clean = path
      .trim()
      .replace(/^\/+/, '')
      .replace(/^docs\//, '')
      .replace(/\.md$/, '');

    try {
      const markdown = await fetchText(`${DOCS_URL}/docs/${clean}.md`);
      return textResult(`Source: ${DOCS_URL}/docs/${clean}.md\n\n${markdown}`);
    } catch (error) {
      return textResult(`Failed to fetch docs page "${clean}": ${error.message}`, true);
    }
  }
);

server.tool(
  'get_component_source',
  'Fetch the primary Blade source for a Slate component from the 3.x GitHub branch.',
  {
    name: z
      .string()
      .describe('Component slug, e.g. button, dialog, toaster'),
  },
  async ({ name }) => {
    const slug = name.trim().toLowerCase().replace(/^x-slate::/, '');
    const url = `${SOURCE_URL}/resources/views/components/${slug}.blade.php`;

    try {
      const source = await fetchText(url);
      return textResult(
        [
          `Blade source for x-slate::${slug}`,
          `URL: ${url}`,
          'Related parts may live in sibling files (e.g. dialog-trigger.blade.php).',
          '',
          source,
        ].join('\n')
      );
    } catch (error) {
      return textResult(
        `Failed to fetch source for ${slug}: ${error.message}. Try list_components or check the slug.`,
        true
      );
    }
  }
);

server.tool(
  'get_llms_index',
  'Fetch https://slate.electrik.dev/llms.txt — the curated AI index for Slate.',
  async () => {
    try {
      const text = await fetchText(`${DOCS_URL}/llms.txt`);
      return textResult(text);
    } catch (error) {
      return textResult(`Failed to fetch llms.txt: ${error.message}`, true);
    }
  }
);

async function main() {
  const transport = new StdioServerTransport();
  await server.connect(transport);
}

main().catch((error) => {
  console.error(error);
  process.exit(1);
});
