<!-- in /templates/Users/login.php -->
<section class="containerLogin w-50">
    <div class="users form text-center formBorderDiv">
        <?= $this->Form->create(null, ['class' => 'text-center border border-light p-5 loginForm']) ?>
        <p class="h4 mb-4 title">Sign in</p>
        <fieldset>
            <div class="input">
                <?= $this->Form->control('email', ['required' => true, 'class' => 'form-control mb-4', 'label' => false, 'placeholder' => 'E-mail', 'id' => 'defaultLoginFormEmail', 'type' => 'email']) ?>
            </div>
            <div>
                <?= $this->Form->control('password', ['required' => true, 'label' => false, 'placeholder' => 'Password', 'class' => 'form-control password mb-4', 'id' => 'defaultLoginFormPassword', 'type' => 'password']) ?>
            </div>
            <div class="d-flex justify-content-around">
                <div>
                    <div class="custom-control custom-checkbox flex">
                        <?= $this->Form->control('remember_me', ['type'=> 'checkbox', 'class' => 'custom-control-input', 'id' => 'defaultLoginFormRemember', 'label' => false])?>
                        <label class="custom-control-label" for="defaultLoginFormRemember"> Remember me </label>
                    </div>
                </div>
                <div>
                    <p>
                        <?= $this->Html->link("Forgot password?", ['action' => 'forgot']) ?>
                    </p>
                </div>
            </div>
        </fieldset>

        <?= $this->Form->submit(__('Login'), ['class' => 'btn btn-info btn-block my-4 buttonOne', 'type' => 'submit']); ?>
        <p>Not a member?
            <?= $this->Html->link("Register", ['action' => 'add']) ?>
        </p>
        <?= $this->Form->end() ?>
    </div>
</section>
