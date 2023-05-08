<section class="containerLogin">
    <div class="users form text-center formBorderDiv">
        <?= $this->Form->create(null, ['class' => 'text-center border border-light p-5 loginForm']) ?>
        <p class="h4 mb-4 title">Reset Password</p>
        <fieldset>
            <div>
                <?= $this->Form->control('password', ['required' => true, 'label' => false, 'placeholder' => 'Password', 'class' => 'form-control password mb-4', 'id' => 'defaultLoginFormPassword', 'type' => 'password']) ?>
            </div>
        </fieldset>

        <?= $this->Form->submit(__('Reset'), ['class' => 'btn btn-info btn-block my-4 buttonOne', 'type' => 'submit']); ?>
        <?= $this->Form->end() ?>
    </div>
</section>