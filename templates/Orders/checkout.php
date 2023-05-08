<div class="row mt-5">
    <div class="col-8">
        <?= $this->Form->create(null, ['url' => ['controller' => 'Orders', 'action' => 'placeOrder']]) ?>
        <?= $this->Form->control('user_id', ['label' => false, 'class' => 'form-control', 'type' => 'hidden', 'value' => $user->id ?? '']) ?>
        <div class="form-group">
            <?= $this->Form->control('first_name', ['label' => 'First Name', 'class' => 'form-control', 'value' => $user->first_name ?? '']) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('last_name', ['label' => 'Last Name', 'class' => 'form-control', 'value' => $user->last_name ?? '']) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('email', ['label' => 'Email', 'class' => 'form-control', 'value' => $user->email ?? '']) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('country', [
                'type' => 'select',
                'label' => 'Country',
                'class' => 'form-control',
                'options' => ['Romania' => 'Romania'],
            ]) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('county', [
                'type' => 'select',
                'label' => 'County',
                'empty' => __('Select the county'),
                'class' => 'form-control',
                'error' => __('You must specify the county'),
                'options' => $counties,
                'value' => $county->name ?? ''
            ]) ?>
        </div>
        <div class="form-group">
            <?=
                $this->Form->control('city', [
                    'label' => __('City'),
                    'id' => 'city',
                    'type' => 'select',
                    'empty' => __('Select the county first'),
                    'class' => 'form-control',
                    'error' => __('You must specify the city'),
                    'value' => $user->city ?? ''
                ]);
            ?>
        </div>
        <div class="form-group">
            <?= $this->Form->control('street', ['label' => 'Street', 'class' => 'form-control', 'value' => $user->street ?? '']) ?>
        </div>
        <?php if (!$user) {?>
            <div class="form-group">
                <div><?= __('Do you want to create a account?') ?></div>
                <?= $this->Form->checkbox('create_account', ['label' => 'Create Account', 'class' => 'form-check-input', 'id' => 'create-account-checkbox']) ?>
            </div>
            <div id="account-details" class="d-none">
                <div class="form-group">
                    <?= $this->Form->control('password', ['label' => 'Password', 'class' => 'form-control']) ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('password_match', ['label' => 'Confirm Password', 'class' => 'form-control']) ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('username', ['label' => 'Username', 'class' => 'form-control']) ?>
                </div>
            </div>
        <?php } ?>
        <?= $this->Form->button(__('Place Order'), ['class' => 'btn btn-primary']) ?>
        <?= $this->Form->end() ?>
    </div>
    <div class="pl-3 col-4">
        <h2>Order Summary</h2>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $book): ?>
                    <tr>
                        <td><?= $book['book']->title ?></td>
                        <td><?= $book['quantity'] ?></td>
                        <td><?= $book['book']->price ?></td>
                        <td><?= $book['book']->price * $book['quantity'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Total:</td>
                    <td><?= $cart['total'] ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>



