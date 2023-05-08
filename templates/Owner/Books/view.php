<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book $book
 */
?>

<div class="container containerBook">
    <div class="card mb-3 text-dark bg-light">
    <div class="row g-0">
        <div class="col-md-6">
            <?= $this->Html->image($book->image, array('class' => 'bookImage','alt' => '')); ?>
        </div>
        <div class="col-md-6">
            <div class="card-body cardBody">
                <h5><?= h($book->title) ?></h5>
                <p class="card-text"><span><?= __('Price') ?></span> <?= h($book->price) ?><p>
                <p class="card-text"><span><?= __('Author') ?>:</span> <?= $book->has('author') ? $this->Html->link($book->author->name, ['controller' => 'Authors', 'action' => 'view', $book->author->id]) : '' ?><p>
                <p class="card-text"><span><?= __('Category') ?>:</span> <?= $book->has('category') ? $this->Html->link($book->category->name, ['controller' => 'Categories', 'action' => 'view', $book->category->id]) : '' ?><p>
                <p class="card-text"><span><?= __('Tag') ?>:</span> <?= $book->has('tag') ? $this->Html->link($book->tag->name, ['controller' => 'Tags', 'action' => 'view', $book->tag->id]) : '' ?><p>
                <p class="card-text">
                    <blockquote>
                        <?= $this->Text->autoParagraph(h($book->description)); ?>
                    </blockquote>
                </p>
                <p class="card-text"><small class="text-muted"><?= __('Last modified') ?>: <?= h($book->modified) ?></small></p>
            </div>
        </div>
    </div>
    </div>
</div>
