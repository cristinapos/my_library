
<?php if (!empty($cartItems)) {?>
    <table>
        <tr>
            <th>Book Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        <?php foreach ($cartItems as $book) : ?>
            <tr data-book='<?= $book['book']->id ?>'>
                <td><?= $book['book']->title ?></td>
                <td>
                    <?= $this->Form->create(null, ['url' => ['controller' => 'Carts', 'action' => 'update']]) ?>
                    <?= $this->Form->hidden('id', ['value' => $book['book']->id]) ?>
                    <?= $this->Form->secure(); ?>
                    <?= $this->Form->control('quantity', ['type' => 'number', 'min' => 1, 'max' => 10, 'value' => $book['quantity'], 'label' => false]) ?>
                    <?= $this->Form->end() ?>
                </td>
                <td>
                    <?= $book['quantity'] * $book['book']->price ?>
                </td>
                <td>
                    <?= $this->Form->postLink(__(''), ['controller' => 'Carts', 'action' => 'remove', $book['book']->id], ['confirm' => 'Are you sure you want to remove this item from your cart?', 'class' => 'fa-solid fa-trash nav-link']) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="2"><?= __('Total price'); ?></td>
            <td><?= $totalPrice; ?></td>
        </tr>
    </table>
    <?= $this->Html->link(__("Go to checkout"), ['controller' => 'Orders','action' => 'checkout'], ['class' => 'btn btn-primary']) ?>
<?php } else { ?>
    <div><?= __('The cart is empty') ?></div>
    <?= $this->Html->link(__("Go to the shop"), ['controller' => 'Pages','action' => 'shop'], ['class' => 'btn btn-primary']) ?>
<?php } ?>