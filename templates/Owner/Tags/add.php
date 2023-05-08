<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Location $location
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row container containerEditAuthor">
    <div class="column-responsive column-80">
        <div class="locations form content">
            <?= $this->Form->create($tag) ?>
                <fieldset>
                    <legend><span style="color: #0091ea; font-weight: bold;"><?= __('Add a tag') ?></span></legend>
                    <div class="mb-3"><?php echo $this->Form->control('name', ['class' => 'form-control', 'label' => false, 'placeholder' => "Name of the tag" ]); ?></div>
                    <div class="mb-3"><?php echo $this->Form->control('description', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Type a short description about this tag']);?></div>
                </fieldset>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
