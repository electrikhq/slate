<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Slate form matrix</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-background text-foreground min-h-screen antialiased">
    <div class="mx-auto flex w-full max-w-xl flex-col gap-8 p-6">
        <h1 class="text-2xl font-semibold tracking-tight">Form matrix</h1>

        <x-slate::input
            label="Email"
            type="email"
            name="email"
            description="We will never share your email."
            errorMessage="Please enter a valid email address."
            aria-invalid="true"
        />

        <x-slate::textarea
            label="Bio"
            name="bio"
            description="A short introduction."
            errorMessage="Bio is required."
            aria-invalid="true"
        />

        <x-slate::select
            label="Plan"
            name="plan"
            description="You can change this later."
            errorMessage="Choose a plan."
            aria-invalid="true"
        >
            <option value="">Select…</option>
            <option value="starter">Starter</option>
            <option value="pro">Pro</option>
        </x-slate::select>

        <x-slate::checkbox
            label="Product updates"
            name="marketing"
            description="Occasional release notes."
            errorMessage="Confirm your preference."
            aria-invalid="true"
        />

        <x-slate::switch
            label="Airplane mode"
            name="airplane"
            description="Disable radios while flying."
            errorMessage="Unable to save preference."
            aria-invalid="true"
        />

        <x-slate::file-input
            label="Avatar"
            name="avatar"
            description="PNG or JPG up to 2MB."
            errorMessage="Upload a valid image."
            aria-invalid="true"
        />
    </div>
</body>
</html>
