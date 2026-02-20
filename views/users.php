<?php View::extend('layouts/default'); ?>

<?php View::section('content'); ?>

<?php
$rows = count($users ?? []);
?>

<section class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-white">Users</h1>
            <p class="mt-1 text-sm text-slate-400">Total records:
                <?= (int) $rows ?>
            </p>
        </div>
        <a href="/user/add"
            class="rounded-md bg-cyan-500 px-4 py-2 text-sm font-semibold text-slate-950 hover:bg-cyan-400">
            Add User
        </a>
    </div>

    <div class="overflow-hidden rounded-xl border border-slate-800 bg-slate-900/60">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-800 text-sm">
                <thead class="bg-slate-900">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-200">ID</th>
                        <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-200">First Name</th>
                        <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-200">Last Name</th>
                        <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-200">Email</th>
                        <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-200">Age</th>
                        <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-200">City</th>
                        <th scope="col" class="px-4 py-3 text-left font-semibold text-slate-200">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    <?php if ($rows === 0): ?>
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-slate-400">No users found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($users as $user): ?>
                            <tr class="hover:bg-slate-800/50">
                                <td class="whitespace-nowrap px-4 py-3 text-slate-300">
                                    <?= htmlspecialchars((string) ($user['id'] ?? '-')) ?>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-slate-100">
                                    <?= htmlspecialchars((string) ($user['first_name'] ?? '-')) ?>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-slate-100">
                                    <?= htmlspecialchars((string) ($user['last_name'] ?? '-')) ?>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-slate-300">
                                    <?= htmlspecialchars((string) ($user['email'] ?? '-')) ?>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-slate-300">
                                    <?= htmlspecialchars((string) ($user['age'] ?? '-')) ?>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-slate-300">
                                    <?= htmlspecialchars((string) ($user['city'] ?? '-')) ?>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3">
                                    <?php $userId = $user['id'] ?? null; ?>
                                    <?php if ($userId): ?>
                                        <a href="/user/<?= urlencode((string) $userId) ?>"
                                            class="inline-flex rounded-md border border-slate-700 px-3 py-1.5 text-xs font-medium text-slate-200 hover:bg-slate-800">View</a>
                                    <?php else: ?>
                                        <span class="text-xs text-slate-500">N/A</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>


<?php View::endSection(); ?>