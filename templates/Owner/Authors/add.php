<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Author $author
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row container containerEditAuthor" style="margin-top: 10em;">
    <div class="column-responsive column-80">
        <div class="authors form content">
            <?= $this->Form->create($author) ?>
                <fieldset>
                    <legend><span style="color: #0091ea; font-weight: bold;"><?= __('Add Author') ?><span></legend>
                    <div class="mb-3"> <?php echo $this->Form->control('name', ['class' => 'form-control', 'label' => false, 'placeholder' => "Name of author" ]); ?> </div>
                    <div class="mb-3"> <?php echo $this->Form->control('about', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Type a short description']);?> </div>
                    <div class="mb-3"><?php echo $this->Form->control('user_id', ['id'=>"exampleFormControlSelect1", 'class' => 'form-control', 'label' => false]);?></div>
                </fieldset>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
