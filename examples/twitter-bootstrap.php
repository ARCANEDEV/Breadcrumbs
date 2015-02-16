<?php

require __DIR__ . '/../vendor/autoload.php';

$bc = new \Arcanedev\Breadcrumbs\Breadcrumbs();

$bc->register('public', function($builder) {

    /** @var \Arcanedev\Breadcrumbs\Builder $builder */
    $builder->push('Home', '/');
});

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ARCANEDEV - Breadcrumbs</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body>
<?php echo $bc->render('public'); ?>
</body>
</html>