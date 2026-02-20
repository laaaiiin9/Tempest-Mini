<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars(Config::get('app.app_name')); ?> - <?= htmlspecialchars($error_code) ?></title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-h-screen bg-black text-slate-100 antialiased">
    <main class="flex min-h-screen items-center justify-center px-4">
        <?= $content ?>
    </main>
</body>

</html>