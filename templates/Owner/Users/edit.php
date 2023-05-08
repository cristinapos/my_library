<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row container containerEditAuthor">
<div class="titleContainer">
    <legend><span><legend><?= __('Edit profile') ?></legend></span></legend>
        <aside class="column">
            <div class="side-nav">
            <?= $this->Form->postLink(
                __(''),
                ['action' => 'delete', $user->id],
                ['class' => 'nav-link fa-solid fa-trash'],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']
            ) ?>
             </div>
        </aside>
</div>
<div class="image"><?= $this->Html->image($this->request->getAttribute('identity')->get("image") != '' ? $this->request->getAttribute('identity')->get("image") : 'default.jpg', ['alt' => 'CakePHP', 'class' => 'imageProfile']) ;?></div>
    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($user, ['type' => 'file']) ?>
            <fieldset>
                <div class="mb-3"><?php echo $this->Form->control('username', ['class' => 'form-control', 'label' => false, 'placeholder' => 'Username', 'type' => 'text']);?></div>
                <div class="mb-3"><?php echo $this->Form->control('email', ['required' => true, 'class' => 'form-control', 'label' => false, 'placeholder' => 'E-mail', 'id' => 'defaultLoginFormEmail', 'type' => 'email']);?></div>
                <div class="mb-3"><?php echo $this->Form->control('password', ['required' => true, 'label' => false, 'placeholder' => 'Password', 'class' => 'form-control password', 'id' => 'defaultLoginFormPassword', 'type' => 'password']);?></div>
                <div class="mb-3"><?php echo $this->Form->control('image', ['type' => 'file', 'label' => false, 'class' => 'form-control']);?></div>
            </fieldset>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-primary']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
