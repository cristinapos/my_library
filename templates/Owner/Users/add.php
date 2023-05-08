<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<section class="containerLogin">
        <div class="users form content text-center formBorderDiv">
            <?= $this->Form->create($user, ['enctype' => 'multipart/form-data', 'class' => 'text-center border border-light p-5 loginForm']) ?>
            <p class="h4 mb-4 title">Register</p>
            <fieldset>
                <?php
                    echo $this->Form->control('username', array('class' => 'form-control mb-4', 'required' => true, 'label' => false, 'placeholder' => 'Username', 'error' => sprintf(__('Please fill in a valid %s'), __('username'))));
                    echo $this->Form->control('email', array('class' => 'form-control mb-4', 'required' => true, 'label' => false, 'placeholder' => 'E-mail', 'type' => 'email', 'error' => sprintf(__('Please fill in a valid %s'), __('email'))));
                    echo $this->Form->control('password', ['type' => 'password', 'class' => 'form-control mb-4', 'label' => false, 'required' => 'required', 'placeholder' => 'Password']);
                    echo $this->Form->control('password_match', ['required' => 'required', 'label' => false, 'class' => 'form-control mb-4', 'type' => 'password', 'placeholder' => 'Confirm password']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-info btn-block my-4 buttonOne', 'type' => 'submit']) ?>
            <?= $this->Form->end() ?>
        </div>
    </section>
