<?php View::extend('layouts/default'); ?>

<?php View::section('content'); ?>
<section class="mx-auto w-full max-w-3xl">
    <div class="rounded-xl border border-slate-800 bg-[#151515] p-5 shadow-lg sm:p-8">
        <h1 class="text-2xl font-semibold text-white sm:text-3xl">Create Account</h1>
        <p class="mt-2 text-sm text-slate-400">Fill in your details to register.</p>

        <form action="/register" method="POST" class="mt-6 space-y-5">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label for="first_name" class="mb-2 block text-sm font-medium text-slate-200">First Name</label>
                    <input id="first_name" name="first_name" type="text" placeholder="John"
                        class="w-full rounded-md border border-slate-700 bg-[#111111] px-3 py-2.5 text-sm text-slate-100 placeholder:text-slate-500 focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-400/30"
                        required>
                </div>

                <div>
                    <label for="last_name" class="mb-2 block text-sm font-medium text-slate-200">Last Name</label>
                    <input id="last_name" name="last_name" type="text" placeholder="Doe"
                        class="w-full rounded-md border border-slate-700 bg-[#111111] px-3 py-2.5 text-sm text-slate-100 placeholder:text-slate-500 focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-400/30"
                        required>
                </div>
            </div>

            <div>
                <label for="email" class="mb-2 block text-sm font-medium text-slate-200">Email</label>
                <input id="email" name="email" type="email" placeholder="you@example.com"
                    class="w-full rounded-md border border-slate-700 bg-[#111111] px-3 py-2.5 text-sm text-slate-100 placeholder:text-slate-500 focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-400/30"
                    required>
            </div>

            <div>
                <label for="password" class="mb-2 block text-sm font-medium text-slate-200">Password</label>
                <input id="password" name="password" type="password" placeholder="Create a strong password"
                    class="w-full rounded-md border border-slate-700 bg-[#111111] px-3 py-2.5 text-sm text-slate-100 placeholder:text-slate-500 focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-400/30"
                    required>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label for="age" class="mb-2 block text-sm font-medium text-slate-200">Age</label>
                    <input id="age" name="age" type="number" min="1" max="150" placeholder="25"
                        class="w-full rounded-md border border-slate-700 bg-[#111111] px-3 py-2.5 text-sm text-slate-100 placeholder:text-slate-500 focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-400/30"
                        required>
                </div>

                <div>
                    <label for="city" class="mb-2 block text-sm font-medium text-slate-200">City</label>
                    <input id="city" name="city" type="text" placeholder="New York"
                        class="w-full rounded-md border border-slate-700 bg-[#111111] px-3 py-2.5 text-sm text-slate-100 placeholder:text-slate-500 focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-400/30"
                        required>
                </div>
            </div>

            <button type="submit"
                class="inline-flex w-full items-center justify-center rounded-md bg-cyan-500 px-4 py-2.5 text-sm font-semibold text-slate-950 transition hover:bg-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-300/60 sm:w-auto hover:cursor-pointer">
                Create Account
            </button>
        </form>
    </div>
</section>
<?php View::endSection(); ?>
