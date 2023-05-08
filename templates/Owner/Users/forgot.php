<section class="containerLogin">
    <div class="users form text-center formBorderDiv">
        <?= $this->Form->create(null, ['class' => 'text-center border border-light p-5 loginForm']) ?>
        <p class="h4 mb-4 title">Please enter your email</p>
        <fieldset>
            <div class="input">
                <?= $this->Form->control('email', ['required' => true, 'class' => 'form-control mb-4', 'label' => false, 'placeholder' => 'E-mail', 'id' => 'defaultLoginFormEmail', 'type' => 'email']) ?>
            </div>
        </fieldset>
        <?= $this->Form->submit(__('Login'), ['class' => 'btn btn-info btn-block my-4 buttonOne', 'type' => 'submit']); ?>
        <?= $this->Form->end() ?>
    </div>
</section>