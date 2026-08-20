/**
 * Cloudflare Worker — remote Electrik Slate MCP (stateless Streamable HTTP).
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
      description: 'List Slate docs-site blocks (copy-ready Blade sections).',
      inputSchema: z.object({}),
    },
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

    if (request.method === 'GET' && (url.pathname === '/' || url.pathname === '')) {
      return Response.json({
        name: 'electrik-slate',
        version: VERSION,
        mcp: 'Connect Cursor (or any MCP client) to this Worker URL via Streamable HTTP.',
        docs: 'https://slate.electrik.dev/docs/ai',
        local: 'npx -y @electrik/slate-mcp',
      });
    }

    // Factory must close over env — do not reuse one global server instance.
    return createMcpHandler(() => createServer(env))(request, env, ctx);
  },
};
