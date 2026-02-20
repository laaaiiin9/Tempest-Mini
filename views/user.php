<?php View::extend('layouts/default'); ?>

<?php View::section('content'); ?>

<h4><?= htmlspecialchars($user['first_name']) ?></h4>

<?php View::endSection(); ?>