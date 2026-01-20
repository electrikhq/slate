# Security Policy

## Supported Versions

We actively support the following versions of Slate UI Kit with security updates:

| Version | Supported          |
| ------- | ------------------ |
| 2.x     | :white_check_mark: |
| 1.x     | :x:                |
| < 1.0   | :x:                |

## Reporting a Vulnerability

We take security vulnerabilities seriously. If you discover a security vulnerability, please follow these steps:

### 1. **Do NOT** open a public issue

Please do not report security vulnerabilities through public GitHub issues.

### 2. Email us directly

Send an email to **hello@neerajkumar.name** with the following information:

- **Type of issue** (e.g., XSS, CSRF, SQL injection, etc.)
- **Full paths of source file(s) related to the vulnerability**
- **The location of the affected source code** (tag/branch/commit or direct URL)
- **Step-by-step instructions to reproduce the issue**
- **Proof-of-concept or exploit code** (if possible)
- **Impact of the issue**, including how an attacker might exploit the issue

### 3. What to expect

- **Initial Response**: We'll acknowledge receipt of your report within 48 hours
- **Status Updates**: We'll provide updates on the progress of fixing the vulnerability
- **Resolution**: We'll notify you when the vulnerability is fixed and a release is available

### 4. Disclosure Policy

- We will credit you in the security advisory and release notes (unless you prefer to remain anonymous)
- We will not disclose the vulnerability publicly until a fix is available
- We aim to resolve critical vulnerabilities within 7 days
- We aim to resolve high-severity vulnerabilities within 30 days

## Security Best Practices

When using Slate UI Kit:

1. **Keep dependencies updated**: Regularly update Slate and its dependencies
2. **Review component usage**: Ensure you're using components as intended
3. **Sanitize user input**: Always sanitize and validate user input before passing to components
4. **Use HTTPS**: Always use HTTPS in production
5. **Follow Laravel security practices**: Follow Laravel's security recommendations

## Known Security Considerations

### XSS Prevention

Slate components use Laravel's Blade templating engine, which automatically escapes output. However, when using `{!! !!}` syntax, ensure you trust the content being rendered.

### CSRF Protection

For forms using Slate components, ensure you include Laravel's CSRF token:

```blade
<form method="POST" action="/submit">
    @csrf
    <x-slate::input name="email" />
    <x-slate::button type="submit">Submit</x-slate::button>
</form>
```

### Content Security Policy

If you're using a Content Security Policy (CSP), ensure it allows:
- Inline styles (if using Tailwind's JIT mode)
- Alpine.js inline event handlers (if using Alpine.js components)

## Security Updates

Security updates will be released as:
- **Patch versions** (e.g., 2.1.0 → 2.1.1) for critical security fixes
- **Minor versions** (e.g., 2.1.0 → 2.2.0) for security improvements

All security updates will be documented in the [CHANGELOG.md](CHANGELOG.md).

## Thank You

Thank you for helping keep Slate UI Kit and its users safe! 🙏
