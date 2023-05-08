<?php
    use Cake\Core\Configure;
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= 'Administration Panel' ?>:
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(['style']) ?>
    <?= $this->Html->script(['bootstrap/js/bootstrap.bundle.min']);?>
    <?= $this->Html->script(['fontawesome/js/fontawesome.min']);?>
    <?= $this->Html->script(['jquery/jquery-v3.6.3.min']) ?>
    <?= $this->Html->script(['index']) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div class="container d-flex justify-content-center vh-100 align-items-center">
        <?= $this->Flash->render() ?>
        <?php echo $this->fetch('content') ?>
    </div>
</body>
</html>
