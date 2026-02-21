<?php View::extend('layouts/default'); ?>

<?php View::section('content'); ?>

<form action="" method="POST">

    <input type="email" placeholder="email">
    <input type="password" placeholder="password">

    <button type="submit">Submit</button>

</form>

<?php View::endSection(); ?>