# Security Policy

## Supported Versions

We actively support the following versions of Slate UI Kit with security updates:

| Version | Supported          |
| ------- | ------------------ |
| 3.x     | :white_check_mark: |
| 2.x     | :white_check_mark: |
| 1.x     | :x:                |
| < 1.0   | :x:                |

## Reporting a Vulnerability

We take security vulnerabilities seriously.

### 1. Do not open a public issue

Please do not report security vulnerabilities through public GitHub issues.

### 2. Email us directly

Send an email to **hello@electrik.dev** with:

- Type of issue
- Affected files or components
- Branch, tag, or commit reference
- Steps to reproduce
- Proof of concept if available
- Impact assessment

### 3. What to expect

- Initial response within 48 hours
- Status updates while the issue is investigated
- Notification when a fix is available

### 4. Disclosure

- We will credit reporters unless anonymity is requested
- Public disclosure happens after a fix is available when possible

## Security Best Practices

When using Slate:

1. Keep Slate and Laravel dependencies updated
2. Validate and sanitize user input before rendering it in Blade
3. Use Laravel CSRF protection in forms
4. Serve production apps over HTTPS
5. Follow Laravel security recommendations

## Known Considerations

- Blade escapes output by default; only use unescaped rendering for trusted content
- Interactive components may rely on Alpine.js; keep CSP requirements in mind
- Form components should be paired with server-side validation

## Security Updates

Security fixes will be released as patch or minor versions depending on severity and will be documented in [CHANGELOG.md](CHANGELOG.md).

Thank you for helping keep Slate and its users safe.
