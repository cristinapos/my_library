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
    <div class="container">
        <div class="row d-flex flex-row mt-5 mb-5">
            <div class="col-3">
                <?php echo $this->element('owner/sidebar');?>
            </div>
            <div class="col-1"></div>
            <div class="col-8">
                <?= $this->Flash->render() ?>
                <?php echo $this->fetch('content') ?>
            </div>
        </div>
    </div>
</body>
</html>
