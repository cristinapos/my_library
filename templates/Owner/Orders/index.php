<table>
    <thead>
        <tr>
            <th><?= __('ID') ?></th>
            <th><?= __('User') ?></th>
            <th><?= __('Total') ?></th>
            <th><?= __('Created') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($orders as $order): ?>
        <tr>
            <td><?= h($order->id) ?></td>
            <td><?= h($order->user_id) ?></td>
            <td><?= h($order->total) ?></td>
            <td><?= h($order->created) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $order->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $order->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $order->id], ['confirm' => __('Are you sure you want to delete # {0}?', $order->id)]) ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
