<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category[]|\Cake\Collection\CollectionInterface $categories
 */
?>
<?php
    $this->Paginator->setTemplates([
        'sort' => '<div class="link">{{text}}</div>'
    ]);
    $result = $this->Paginator->getTemplates('sort');
    ?>
<div class="categories index content bg-dark containerAuthors">
<?= $this->Html->link(__('Add a category'), ['action' => 'add'], ['class' => 'btn btn-primary'])  ?>
<h3 style="padding:1.5em 0 1.5em 0;"><span style="color: #0091ea; font-weight: bold;"><?= __('Categories') ?></span></h3>
    <div class="table-responsive">
        <table class="tableAuthor">
            <thead>
                <tr>
                    <th scope="row" ><?= $this->Paginator->sort('id') ?></th>
                    <th scope="row"><?= $this->Paginator->sort('name') ?></th>
                    <th class="actions th" scope="row"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category) : ?>
                <tr>
                    <td class="id"><?= $this->Number->format($category->id) ?></td>
                    <td class="name"><?= h($category->name) ?></td>
                    <td class="actions td">
                        <?= $this->Html->link(__(''), ['action' => 'view', $category->id], ['class' => 'fa-solid fa-eye nav-link', 'style' => 'color: #81d4fa;' ]) ?>
                        <?= $this->Html->link(__(''), ['action' => 'edit', $category->id], ['class' => 'fa-solid fa-pen nav-link', 'style' => 'color: #81d4fa;']) ?>
                        <?= $this->Form->postLink(__(''), ['action' => 'delete', $category->id], ['class' => 'fa-solid fa-trash nav-link', 'style' => 'color: #81d4fa;'], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator paginate Page navigation example">
        <?php echo $this->element('pagination');?>
    </div>
</div>
