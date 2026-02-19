<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars(Config::get('app.app_name')); ?> - 404</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-h-screen bg-black text-slate-100 antialiased">
    <main class="flex min-h-screen items-center justify-center px-4">
        <section class="w-full max-w-2xl rounded-2xl border border-slate-800 bg-slate-950/70 p-8 shadow-2xl">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-amber-400">Page Not Found</p>
            <h1 class="mt-3 text-4xl font-bold tracking-tight text-white sm:text-5xl">404</h1>
            <p class="mt-4 text-base text-slate-300">The page you are looking for does not exist or has been moved.</p>

            <?php if (!empty($errMsg)): ?>
                <div class="mt-6 rounded-lg border border-slate-800 bg-black/60 p-4 text-sm leading-6 text-slate-200">
                    <?= nl2br(htmlspecialchars((string) $errMsg)); ?>
                </div>
            <?php endif; ?>

            <a href="/" class="mt-8 inline-flex rounded-md bg-amber-500 px-4 py-2 text-sm font-semibold text-slate-950 transition hover:bg-amber-400">
                Back to Home
            </a>
        </section>
    </main>
</body>

</html>
