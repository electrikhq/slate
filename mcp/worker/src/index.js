/**
 * Cloudflare Worker — Electrik Slate remote MCP (stateless Streamable HTTP).
 */

import { McpServer } from '@modelcontextprotocol/server';
import { createMcpHandler } from 'agents/mcp/server';
import { z } from 'zod';
import {
  BLOCKS,
  COMPONENTS,
  VERSION,
  fetchText,
  normalizeComponentSlug,
  normalizeDocsPath,
  resolveComponentSourceSlug,
  resolveDocsUrl,
  resolveSourceUrl,
  textResult,
} from '../../shared/catalog.js';

function createServer(env = {}) {
  const DOCS_URL = resolveDocsUrl(env.SLATE_DOCS_URL);
  const SOURCE_URL = resolveSourceUrl(env.SLATE_SOURCE_URL);

  const server = new McpServer({
    name: 'electrik-slate',
    version: VERSION,
  });

  server.registerTool(
    'list_components',
    {
      description: 'List shipped Electrik Slate Blade components with docs URLs.',
      inputSchema: z.object({}),
    },
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

  server.registerTool(
    'list_blocks',
    {
      description: 'List electrik/slate-blocks (curated Blade sections on the docs gallery).',
      inputSchema: z.object({}),
    },
    async () => {
      const lines = BLOCKS.map(
        (block) => `- ${block.id} (${block.category}): ${DOCS_URL}/blocks/${block.id}`
      );

      return textResult(
        [
          'electrik/slate-blocks (install via Composer):',
          '',
          ...lines,
          '',
          `Gallery: ${DOCS_URL}/blocks`,
          `Docs: ${DOCS_URL}/docs/blocks`,
        ].join('\n')
      );
    }
  );

  server.registerTool(
    'get_component_docs',
    {
      description:
        'Fetch markdown documentation for a Slate component (e.g. button, dialog, input).',
      inputSchema: z.object({
        name: z
          .string()
          .describe('Component slug, e.g. button, alert-dialog, dark-mode-toggle'),
      }),
    },
    async ({ name }) => {
      const slug = normalizeComponentSlug(name);

      if (!COMPONENTS.includes(slug)) {
        return textResult(
          `Unknown component "${name}". Use list_components to see shipped slugs.`,
          true
        );
      }

      try {
        const markdown = await fetchText(`${DOCS_URL}/components/${slug}.md`);
        return textResult(
          `# ${slug}\n\nSource: ${DOCS_URL}/components/${slug}.md\n\n${markdown}`
        );
      } catch (error) {
        return textResult(`Failed to fetch docs for ${slug}: ${error.message}`, true);
      }
    }
  );

  server.registerTool(
    'get_docs_page',
    {
      description:
        'Fetch a docs markdown page by path (e.g. getting-started/installation, livewire, ai).',
      inputSchema: z.object({
        path: z
          .string()
          .describe(
            'Docs path without leading docs/, e.g. getting-started/installation or design-tokens'
          ),
      }),
    },
    async ({ path }) => {
      const clean = normalizeDocsPath(path);

      try {
        const markdown = await fetchText(`${DOCS_URL}/docs/${clean}.md`);
        return textResult(`Source: ${DOCS_URL}/docs/${clean}.md\n\n${markdown}`);
      } catch (error) {
        return textResult(`Failed to fetch docs page "${clean}": ${error.message}`, true);
      }
    }
  );

  server.registerTool(
    'get_component_source',
    {
      description:
        'Fetch the primary Blade source for a Slate component from the 3.x GitHub branch.',
      inputSchema: z.object({
        name: z.string().describe('Component slug, e.g. button, dialog, toaster'),
      }),
    },
    async ({ name }) => {
      const slug = normalizeComponentSlug(name);
      const fileSlug = resolveComponentSourceSlug(slug);
      const url = `${SOURCE_URL}/resources/views/components/${fileSlug}.blade.php`;

      try {
        const source = await fetchText(url);
        return textResult(
          [
            `Blade source for x-slate::${slug}${fileSlug !== slug ? ` (file: ${fileSlug}.blade.php)` : ''}`,
            `URL: ${url}`,
            'Related parts may live in sibling files (e.g. dialog-trigger.blade.php). Use toast for the toast part; toaster mounts the stack.',
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

  server.registerTool(
    'get_llms_index',
    {
      description:
        'Fetch https://slate.electrik.dev/llms.txt — the curated AI index for Slate.',
      inputSchema: z.object({}),
    },
    async () => {
      try {
        const text = await fetchText(`${DOCS_URL}/llms.txt`);
        return textResult(text);
      } catch (error) {
        return textResult(`Failed to fetch llms.txt: ${error.message}`, true);
      }
    }
  );

  return server;
}

export default {
  fetch(request, env, ctx) {
    const url = new URL(request.url);
    const path = url.pathname === '' ? '/' : url.pathname;

    // Human-friendly discovery for browsers; MCP clients use POST (Streamable HTTP).
    if (request.method === 'GET' && path === '/') {
      return Response.json({
        name: 'electrik-slate',
        version: VERSION,
        transport: 'streamable-http',
        endpoint: '/',
        docs: 'https://slate.electrik.dev/docs/ai',
        local: 'npx -y @electrik/slate-mcp',
      });
    }

    // agents/mcp defaults to `/mcp`; Cursor + our docs use the Worker origin (`/`).
    const handleMcp = createMcpHandler(() => createServer(env), {
      route: '/',
    });

    // Alias Cloudflare Agents' default path so /mcp keeps working.
    if (path === '/mcp') {
      const aliased = new URL(request.url);
      aliased.pathname = '/';
      return handleMcp(new Request(aliased, request), env, ctx);
    }

    return handleMcp(request, env, ctx);
  },
};
