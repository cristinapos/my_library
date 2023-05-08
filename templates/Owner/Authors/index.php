<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Author[]|\Cake\Collection\CollectionInterface $authors
 */
?>
<?php
    $this->Paginator->setTemplates([
        'sort' => '<div class="link">{{text}}</div>'
    ]);
    $result = $this->Paginator->getTemplates('sort');
    ?>
<div class="authors index content bg-dark containerAuthors">
    <h3 style="padding:1.5em 0 1.5em 0;"><span style="color: #0091ea; font-weight: bold;"><?= __('Authors') ?></span></h3>
    <div class="table-responsive">
        <table class="tableAuthor">
            <thead>
                <tr>
                    <th scope="row" ><?= $this->Paginator->sort('id') ?></th>
                    <th scope="row"><?= $this->Paginator->sort('name', '<div class="link" style="color: #bdbdbd; text-decoration: none;" >Name</div>', ['escape' => false]) ?></th>
                    <th class="actions th" scope="row"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($authors as $author) : ?>
                <tr>
                    <td class="id"><?= $this->Number->format($author->id) ?></td>
                    <td class="name"><?= h($author->name) ?></td>
                    <td class="actions td">
                        <?= $this->Html->link(__(''), ['action' => 'view', $author->id], ['class' => 'fa-solid fa-eye nav-link', 'style' => 'color: #81d4fa;' ]) ?>
                        <?= $this->Html->link(__(''), ['action' => 'edit', $author->id], ['class' => 'fa-solid fa-pen nav-link', 'style' => 'color: #81d4fa;']) ?>
                        <?= $this->Form->postLink(__(''), ['action' => 'delete', $author->id], ['class' => 'fa-solid fa-trash nav-link', 'style' => 'color: #81d4fa;'], ['confirm' => __('Are you sure you want to delete # {0}?', $author->id)]) ?>
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
