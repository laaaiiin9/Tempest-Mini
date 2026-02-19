<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars(Config::get('app.app_name')) ?> - <?= htmlspecialchars($title ?? ''); ?></title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-h-screen bg-[#0f0f0f] text-slate-100 antialiased">
    <header class="sticky top-0 z-50 border-b border-[#242424] bg-[#141414] backdrop-blur">
        <nav class="mx-auto flex w-full max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <a href="/" class="text-lg font-semibold tracking-tight text-white">
                <?= htmlspecialchars(Config::get('app.app_name')) ?>
            </a>

            <button id="menu-button" type="button"
                class="inline-flex items-center justify-center rounded-md border border-slate-700 p-2 text-slate-200 hover:bg-slate-800 md:hidden"
                aria-controls="mobile-menu" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>

            <div class="hidden items-center gap-1 md:flex">
                <a href="/"
                    class="rounded-md px-3 py-2 text-sm font-medium text-slate-200 hover:bg-slate-800 hover:text-white">Home</a>
                <a href="/users"
                    class="rounded-md px-3 py-2 text-sm font-medium text-slate-200 hover:bg-slate-800 hover:text-white">Users</a>
                <a href="/admin"
                    class="rounded-md px-3 py-2 text-sm font-medium text-slate-200 hover:bg-slate-800 hover:text-white">Admin</a>
                <a href="/login"
                    class="rounded-md px-3 py-2 text-sm font-medium text-slate-200 hover:bg-slate-800 hover:text-white">Login</a>
                <a href="/register"
                    class="ml-1 rounded-md bg-cyan-500 px-3 py-2 text-sm font-semibold text-slate-950 hover:bg-cyan-400">Register</a>
            </div>
        </nav>

        <div id="mobile-menu" class="hidden border-t border-slate-800/80 px-4 pb-4 md:hidden">
            <div class="flex flex-col gap-1 pt-3">
                <a href="/"
                    class="rounded-md px-3 py-2 text-sm font-medium text-slate-200 hover:bg-slate-800 hover:text-white">Home</a>
                <a href="/users"
                    class="rounded-md px-3 py-2 text-sm font-medium text-slate-200 hover:bg-slate-800 hover:text-white">Users</a>
                <a href="/admin"
                    class="rounded-md px-3 py-2 text-sm font-medium text-slate-200 hover:bg-slate-800 hover:text-white">Admin</a>
                <a href="/login"
                    class="rounded-md px-3 py-2 text-sm font-medium text-slate-200 hover:bg-slate-800 hover:text-white">Login</a>
                <a href="/register"
                    class="mt-1 rounded-md bg-cyan-500 px-3 py-2 text-sm font-semibold text-slate-950 hover:bg-cyan-400">Register</a>
            </div>
        </div>
    </header>

    <main class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <?= $content; ?>
    </main>

    <script>
        const menuButton = document.getElementById('menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (menuButton && mobileMenu) {
            menuButton.addEventListener('click', () => {
                const isHidden = mobileMenu.classList.toggle('hidden');
                menuButton.setAttribute('aria-expanded', String(!isHidden));
            });
        }
    </script>
</body>

</html>