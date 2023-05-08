<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tag[]|\Cake\Collection\CollectionInterface $tags
 */
?>
<?php
    $this->Paginator->setTemplates([
        'sort' => '<div class="link">{{text}}</div>'
    ]);
    $result = $this->Paginator->getTemplates('sort');
    ?>
<div class="locations index content bg-dark containerAuthors">
<?= $this->Html->link(__('Add a tag'), ['action' => 'add'], ['class' => 'btn btn-primary'])  ?>
<h3 style="padding:1.5em 0 1.5em 0;"><span style="color: #0091ea; font-weight: bold;"><?= __('Tags') ?></span></h3>
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
                <?php foreach ($tags as $tag) : ?>
                <tr>
                    <td class="id"><?= $this->Number->format($tag->id) ?></td>
                    <td class="name"><?= h($tag->name) ?></td>
                    <td class="actions td">
                        <?= $this->Html->link(__(''), ['action' => 'view', $tag->id], ['class' => 'fa-solid fa-eye nav-link', 'style' => 'color: #81d4fa;' ]) ?>
                        <?= $this->Html->link(__(''), ['action' => 'edit', $tag->id], ['class' => 'fa-solid fa-pen nav-link', 'style' => 'color: #81d4fa;']) ?>
                        <?= $this->Form->postLink(__(''), ['action' => 'delete', $tag->id], ['class' => 'fa-solid fa-trash nav-link', 'style' => 'color: #81d4fa;'], ['confirm' => __('Are you sure you want to delete # {0}?', $tag->id)]) ?>
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
