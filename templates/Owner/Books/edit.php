<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book $book
 * @var string[]|\Cake\Collection\CollectionInterface $categories
 * @var string[]|\Cake\Collection\CollectionInterface $authors
 * @var string[]|\Cake\Collection\CollectionInterface $locations
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>

<div class="row container containerEditAuthor">
    <div class="titleContainer">
        <legend><span><?= __('Edit Book') ?></span></legend>
        <aside class="column aside">
        <div class="side-nav">
            <?= $this->Form->postLink(
                __(''),
                ['action' => 'delete', $book->id],
                ['class' => 'nav-link fa-solid fa-trash'],
                ['confirm' => __('Are you sure you want to delete # {0}?', $book->id), 'class' => 'side-nav-item']
            ) ?>
        </div>
    </aside>
    </div>
    <div class="column-responsive column-80">
        <div class="books form content">
            <?= $this->Form->create($book, ['type' => 'file', 'class' => 'form-card']) ?>
                <fieldset>
                    <div class="mb-3"><div class="mb-3"><?php echo $this->Form->control('title', ['class' => 'form-control', 'label' => false, 'placeholder' => "Title" ]);?></div><div>
                    <div class="mb-3"><div class="mb-3"><?php echo $this->Form->control('description', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Type a short description']);?></div><div>
                    <div class="mb-3"><div class="mb-3"><?php echo $this->Form->control('category_id', ['id'=>"exampleFormControlSelect1", 'class' => 'form-select', 'label' => false]);?></div><div>
                    <div class="mb-3"><div class="mb-3"><?php echo $this->Form->control('author_id', ['id'=>"exampleFormControlSelect1", 'class' => 'form-select', 'label' => false]);?></div><div>
                    <div class="mb-3"><div class="mb-3"><?php echo $this->Form->control('tag_id', ['id'=>"exampleFormControlSelect1", 'class' => 'form-select', 'label' => false]);?></div><div>
                    <div class="mb-3"><?php echo $this->Form->control('price', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Price']);?></div>
                    <div class="mb-3"><div class="mb-3"><?php echo $this->Form->control('image', ['type' => 'file', 'class' => 'form-control', 'label' => false]);?></div><div>
                </fieldset>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>