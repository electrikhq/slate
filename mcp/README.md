# @electrik/slate-mcp

Read-only [MCP](https://modelcontextprotocol.io/) server for [Electrik Slate](https://slate.electrik.dev).

Browsing and fetching only — it does **not** install Composer packages.

## Tools

| Tool | Purpose |
| --- | --- |
| `list_components` | Shipped component slugs + docs URLs |
| `list_blocks` | Docs-site blocks gallery |
| `get_component_docs` | Component markdown from slate.electrik.dev |
| `get_docs_page` | Docs markdown (`installation`, `livewire`, …) |
| `get_component_source` | Blade file from GitHub `3.x` |
| `get_llms_index` | Fetch `/llms.txt` |

## Run

```bash
cd mcp
npm install
npm start
```

### Cursor (`.cursor/mcp.json`)

From a clone of this repo:

```json
{
  "mcpServers": {
    "slate": {
      "command": "npx",
      "args": ["-y", "tsx", "mcp/src/index.js"],
      "cwd": "/absolute/path/to/slate"
    }
  }
}
```

Or after `npm install` in `mcp/`:

```json
{
  "mcpServers": {
    "slate": {
      "command": "node",
      "args": ["/absolute/path/to/slate/mcp/src/index.js"]
    }
  }
}
```

With Composer path/vendor install (after `npm install` inside `vendor/electrik/slate/mcp`):

```json
{
  "mcpServers": {
    "slate": {
      "command": "node",
      "args": ["./vendor/electrik/slate/mcp/src/index.js"]
    }
  }
}
```

## Env

| Variable | Default |
| --- | --- |
| `SLATE_DOCS_URL` | `https://slate.electrik.dev` |
| `SLATE_SOURCE_URL` | `https://raw.githubusercontent.com/electrikhq/slate/3.x` |

## Docs

https://slate.electrik.dev/docs/ai
