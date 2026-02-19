<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars(Config::get('app.app_name')) ?> Admin - <?= htmlspecialchars($title ?? ''); ?></title>
</head>
<body>
    <?= $content; ?>
</body>
</html>