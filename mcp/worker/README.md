# Electrik Slate — Cloudflare MCP Worker

Remote (Streamable HTTP) MCP server for [Electrik Slate](https://slate.electrik.dev).

Same tools as `@electrik/slate-mcp` (stdio / npm). Runs on Cloudflare Workers Free.

## Develop

```bash
cd mcp/worker
npm install
npm run dev
```

## Deploy

```bash
cd mcp/worker
npx wrangler deploy
```

Optional custom domain in the Cloudflare dashboard (e.g. `mcp.slate.electrik.dev`).

## Cursor

```json
{
  "mcpServers": {
    "slate": {
      "url": "https://electrik-slate-mcp.<your-subdomain>.workers.dev"
    }
  }
}
```

Local fallback:

```json
{
  "mcpServers": {
    "slate": {
      "command": "npx",
      "args": ["-y", "@electrik/slate-mcp"]
    }
  }
}
```
