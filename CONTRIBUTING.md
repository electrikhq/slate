# Contributing to Slate UI Kit

Thank you for your interest in contributing to Slate UI Kit! This document provides guidelines and instructions for contributing.

## Code of Conduct

By participating in this project, you agree to abide by our [Code of Conduct](CODE_OF_CONDUCT.md).

## How Can I Contribute?

### Reporting Bugs

Before creating bug reports, please check the issue list as you might find out that you don't need to create one. When you are creating a bug report, please include as many details as possible:

- **Clear title and description**
- **Steps to reproduce** the issue
- **Expected behavior** vs **Actual behavior**
- **Screenshots** (if applicable)
- **Environment details**: PHP version, Laravel version, Slate version
- **Error messages** or stack traces

### Suggesting Enhancements

Enhancement suggestions are tracked as GitHub issues. When creating an enhancement suggestion, please include:

- **Clear title and description**
- **Use case**: Why is this enhancement useful?
- **Proposed solution** (if you have one)
- **Alternatives considered** (if any)

### Pull Requests

1. **Fork the repository** and create your branch from `2.x` (or `main` if applicable)
2. **Make your changes** following our coding standards
3. **Add tests** if applicable
4. **Update documentation** if needed
5. **Ensure all tests pass**
6. **Submit the pull request**

## Development Setup

### Prerequisites

- PHP 8.1 or higher
- Composer
- Node.js and npm (for asset compilation if needed)

### Installation

1. Clone the repository:
```bash
git clone https://github.com/electrikhq/slate.git
cd slate/slate
```

2. Install dependencies:
```bash
composer install
```

3. Run tests:
```bash
composer test
```

## Coding Standards

### PHP Code

- Follow [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standards
- Use meaningful variable and function names
- Add PHPDoc comments for classes and methods
- Keep functions focused and single-purpose

### Blade Templates

- Use consistent indentation (4 spaces)
- Keep components self-contained
- Use semantic HTML
- Ensure accessibility (WCAG 2.1 AA compliance)
- Add proper ARIA attributes where needed

### CSS/Tailwind

- Use Tailwind CSS utility classes
- Leverage CSS variables for theming
- Ensure dark mode support
- Keep styles scoped to components

## Component Development Guidelines

### Creating New Components

1. Create the Blade template in `resources/views/components/`
2. Register the component in `src/SlateServiceProvider.php`
3. Add tests in `tests/Unit/Components/`
4. Update documentation

### Component Structure

```blade
@props([
    'prop1' => 'default',
    'prop2' => null,
])

@php
    // Component logic
@endphp

<div {{ $attributes->merge(['class' => 'component-classes']) }}>
    {{ $slot }}
</div>
```

### Accessibility Requirements

- Use semantic HTML elements
- Include proper ARIA attributes
- Ensure keyboard navigation works
- Test with screen readers
- Maintain proper focus management

## Testing

### Running Tests

```bash
# Run all tests
composer test

# Run specific test file
vendor/bin/phpunit tests/Unit/Components/ButtonTest.php
```

### Writing Tests

- Write unit tests for component rendering
- Test different prop combinations
- Test accessibility attributes
- Test dark mode variants

## Documentation

### Updating Documentation

Documentation is maintained in a separate repository. For component documentation:

1. Update the component's usage examples
2. Document all props and their types
3. Include code examples
4. Add accessibility notes if applicable

## Commit Messages

We use [Conventional Commits](https://www.conventionalcommits.org/) format:

- `feat:` New feature
- `fix:` Bug fix
- `docs:` Documentation changes
- `style:` Code style changes (formatting, etc.)
- `refactor:` Code refactoring
- `test:` Adding or updating tests
- `chore:` Maintenance tasks

Example:
```
feat(button): add href support for link rendering
```

## Pull Request Process

1. **Update CHANGELOG.md** with your changes
2. **Ensure tests pass** and add new tests if needed
3. **Update documentation** if your change affects user-facing features
4. **Request review** from maintainers
5. **Address feedback** promptly

### PR Checklist

- [ ] Code follows the project's style guidelines
- [ ] Tests added/updated and passing
- [ ] Documentation updated
- [ ] CHANGELOG.md updated
- [ ] No breaking changes (or clearly documented if intentional)

## Questions?

If you have questions about contributing, feel free to:

- Open an issue with the `question` label
- Reach out to maintainers

Thank you for contributing to Slate UI Kit! 🎉
