<section class="w-full max-w-2xl rounded-2xl border border-slate-800 bg-slate-950/70 p-8 shadow-2xl">
    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-red-400">Server Error</p>
    <h1 class="mt-3 text-4xl font-bold tracking-tight text-white sm:text-5xl">500</h1>
    <p class="mt-4 text-base text-slate-300">Something went wrong while processing your request.</p>

    <?php if (!empty($error_msg)): ?>
        <div class="mt-6 rounded-lg border border-slate-800 bg-black/60 p-4 text-sm leading-6 text-slate-200">
            <?= nl2br(htmlspecialchars((string) $error_msg)); ?>
        </div>
    <?php endif; ?>

    <a href="/"
        class="mt-8 inline-flex rounded-md bg-red-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-400">
        Back to Home
    </a>
</section>