# @electrik/slate-mcp

Read-only [MCP](https://modelcontextprotocol.io/) server for [Electrik Slate](https://slate.electrik.dev).

Browsing and fetching only — it does **not** install Composer packages.

## Install

```bash
npm install -g @electrik/slate-mcp
# or
npx -y @electrik/slate-mcp
```

## Tools

| Tool | Purpose |
| --- | --- |
| `list_components` | Shipped component slugs + docs URLs |
| `list_blocks` | Docs-site blocks gallery |
| `get_component_docs` | Component markdown from slate.electrik.dev |
| `get_docs_page` | Docs markdown (`installation`, `livewire`, …) |
| `get_component_source` | Blade file from GitHub `3.x` |
| `get_llms_index` | Fetch `/llms.txt` |

## Cursor (`.cursor/mcp.json`)

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

Local checkout:

```bash
cd mcp && npm install && npm start
```

## Env

| Variable | Default | Purpose |
| --- | --- | --- |
| `SLATE_DOCS_URL` | `https://slate.electrik.dev` | Docs / markdown base |
| `SLATE_SOURCE_URL` | GitHub raw `3.x` | Blade source base |

## Docs

https://slate.electrik.dev/docs/ai
