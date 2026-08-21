# Electrik Slate — Cloudflare Worker MCP

Dedicated **Workers** deploy (not Pages). Same tools as `@electrik/slate-mcp`.

## CI/CD

Workflow: `slate.electrik.dev` → **Deploy Slate MCP Worker**  
Secrets: `CLOUDFLARE_API_TOKEN` + `CLOUDFLARE_ACCOUNT_ID`.

### API token permissions

| Scope | Permission |
| --- | --- |
| Account | **Workers Scripts — Edit** |
| Account | **Account Settings — Read** |
| Zone (`electrik.dev`) | **DNS — Edit** (for `mcp.slate.electrik.dev` via Wrangler `custom_domain`) |

Custom domain is declared in `wrangler.jsonc` and applied on deploy — no dashboard step.

## Cursor

```json
{
  "mcpServers": {
    "slate": {
      "url": "https://mcp.slate.electrik.dev"
    }
  }
}
```

## Local fallback

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
