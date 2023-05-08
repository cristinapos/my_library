<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Author $author
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row container containerEditAuthor" style="margin-top: 10em;">
    <div class="titleContainer">
                        <legend><span><?= __('Edit Author') ?><span></legend>
                        <aside class="column">
                            <div class="side-nav">
                                <?= $this->Form->postLink(
                                    __(''),
                                    ['action' => 'delete', $author->id],
                                    ['class' => 'nav-link fa-solid fa-trash'],
                                    ['confirm' => __('Are you sure you want to delete # {0}?', $author->id), 'class' => 'side-nav-item']
                                ) ?>
                            </div>
                        </aside>
                    </div>
    <div class="column-responsive column-80">
        <div class="authors form content">
            <?= $this->Form->create($author) ?>
                <fieldset>
                    <div class="mb-3"> <?php echo $this->Form->control('name', ['class' => 'form-control', 'label' => "Name:" ]); ?> </div>
                    <div class="mb-3"> <?php echo $this->Form->control('about', ['class' => 'form-control', 'label' => "About:"]);?> </div>
                </fieldset>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
