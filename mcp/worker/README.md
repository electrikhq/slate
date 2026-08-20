# Electrik Slate — Cloudflare Worker MCP

Dedicated **Workers** deploy (not Pages). Same tools as `@electrik/slate-mcp`.

## CI/CD

Workflow: `slate.electrik.dev` → **Deploy Slate MCP Worker**  
Uses secrets `CLOUDFLARE_API_TOKEN` + `CLOUDFLARE_ACCOUNT_ID`.

### API token permissions (required)

On the Cloudflare API token used in GitHub:

| Scope | Permission |
| --- | --- |
| Account | **Workers Scripts — Edit** |
| Account | **Account Settings — Read** |
| User | **User Details — Read** (recommended) |

After changing the token in the Cloudflare dashboard, **re-paste the token value** into GitHub → `electrikhq/slate.electrik.dev` → Settings → Secrets → `CLOUDFLARE_API_TOKEN` (dashboard edits do not update GitHub).

### First-time: enable `workers.dev`

In Cloudflare Dashboard → **Workers & Pages** → set up your account’s `*.workers.dev` subdomain once (required for the public Worker URL).

## Cursor

```json
{
  "mcpServers": {
    "slate": {
      "url": "https://electrik-slate-mcp.quick-brown-fox.workers.dev"
    }
  }
}
```

Optional later: attach custom domain `mcp.slate.electrik.dev` in the Worker settings (needs Zone DNS / Workers Routes on that zone).

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
