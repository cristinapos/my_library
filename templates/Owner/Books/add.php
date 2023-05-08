

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book $book
 * @var \Cake\Collection\CollectionInterface|string[] $categories
 * @var \Cake\Collection\CollectionInterface|string[] $authors
 * @var \Cake\Collection\CollectionInterface|string[] $locations
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row container containerEditAuthor">
    <div class="column-responsive column-80">
        <div class="books form content">
            <?= $this->Form->create($book, ['type' => 'file', 'class' => 'form-card']) ?>
                <fieldset>
                    <legend><span style="color: #0091ea; font-weight: bold;"><?= __('Add a book') ?><span></legend>
                    <div class="mb-3"><?php echo $this->Form->control('title', ['class' => 'form-control', 'label' => false, 'placeholder' => "Title" ]); ?></div>
                    <div class="mb-3"><?php echo $this->Form->control('description', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Type a short description']); ?></div>
                    <div class="mb-3"><?php echo $this->Form->control('category_id', ['id'=>"exampleFormControlSelect1", 'class' => 'form-select', 'label' => false]); ?></div>
                    <div class="mb-3"><?php echo $this->Form->control('author_id', ['id'=>"exampleFormControlSelect1", 'class' => 'form-select', 'label' => false]); ?></div>
                    <div class="mb-3"><?php echo $this->Form->control('tag_id', ['id'=>"exampleFormControlSelect1", 'class' => 'form-select', 'label' => false]); ?></div>
                    <div class="mb-3"><?php echo $this->Form->control('price', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Price']);?></div>
                    <div class="mb-3"><?php echo $this->Form->control('image', ['type' => 'file', 'class' => 'form-control', 'label' => false]); ?></div>
                </fieldset>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <?= $this->Form->button(__('Add'), ['class' => 'btn btn-primary']) ?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>