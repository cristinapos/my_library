<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row container containerEditAuthor">
    <div class="column-responsive column-80">
        <div class="categories form content">
            <?= $this->Form->create($category) ?>
                <fieldset>
                    <legend><span style="color: #0091ea; font-weight: bold;"><?= __('Add Category') ?></span></legend>
                    <div class="mb-3"> <?php echo $this->Form->control('name', ['class' => 'form-control', 'label' => false, 'placeholder' => "Name of category" ]); ?> </div>
                    <div class="mb-3"> <?php echo $this->Form->control('description', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Type a short description about this category']);?> </div>
                </fieldset>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
