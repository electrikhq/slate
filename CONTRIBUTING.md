# Contributing to Slate UI Kit

Thank you for your interest in contributing to Slate UI Kit.

## Code of Conduct

By participating in this project, you agree to abide by our [Code of Conduct](CODE_OF_CONDUCT.md).

## Branch Strategy

- `3.x` is the active rebuild line
- `2.x` remains the previous stable line

For new work on the rebuilt system, branch from `3.x`.

## How Can I Contribute?

### Reporting Bugs

Before opening a bug report, search existing issues first. Include:

- A clear title and description
- Steps to reproduce
- Expected vs actual behavior
- Screenshots when helpful
- PHP, Laravel, and Slate versions
- Error messages or stack traces

### Suggesting Enhancements

Enhancement requests should explain:

- The problem or use case
- Why the change matters
- A proposed solution if you have one
- Alternatives considered

### Pull Requests

1. Fork the repository
2. Create a branch from `3.x`
3. Make focused changes
4. Update docs and changelog when user-facing behavior changes
5. Open a pull request with a clear summary

## Development Setup

### Prerequisites

- PHP 8.3+
- Composer
- A Laravel app for visual verification is recommended

### Local Development

1. Clone the repository:

```bash
git clone https://github.com/electrikhq/slate.git
cd slate
```

2. Link the package into a Laravel app with a Composer path repository
3. Import `resources/css/slate.css` into the consumer app's CSS
4. Build assets and verify components in a sandbox page

## Coding Standards

### PHP

- Follow PSR-12
- Keep service provider and package code minimal
- Prefer anonymous Blade components over PHP component classes

### Blade

- Use `$attributes->merge()` correctly so consumer classes append rather than get stripped
- Keep components static unless interactivity is intentionally required
- Preserve accessibility semantics and validation wiring
- Match existing naming, spacing, and token usage

### CSS / Tailwind

- Use Slate-owned CSS variables
- Preserve dark mode behavior
- Avoid hardcoded colors when a token exists
- Keep visual language aligned with the target shadcn-inspired design system

## Component Guidelines

When adding or updating a component:

1. Create the Blade file in `resources/views/components/`
2. Reuse existing field, token, and validation patterns where applicable
3. Support dark mode and RTL where relevant
4. Add or update sandbox examples if you maintain a local consumer app
5. Document props and usage in README or docs when the API is user-facing

## Commit Messages

We prefer concise, meaningful commit messages. Conventional Commits are welcome:

- `feat:` new feature
- `fix:` bug fix
- `docs:` documentation only
- `refactor:` code change that neither fixes a bug nor adds a feature
- `chore:` maintenance

Example:

```text
feat(input): add rounded prop for per-instance radius control
```

## Pull Request Checklist

- [ ] Changes are scoped and focused
- [ ] README, docs, or changelog updated when needed
- [ ] Accessibility and validation behavior considered
- [ ] Dark mode and RTL checked when relevant
- [ ] No unrelated refactors included

## Questions

Open a GitHub Discussion or an issue with the `question` label if you are unsure about direction before starting larger work.

Thank you for helping improve Slate.
