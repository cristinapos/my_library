<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book[]|\Cake\Collection\CollectionInterface $books
 */
?>
<?php
    $this->Paginator->setTemplates([
        'sort' => '<div class="link">{{text}}</div>'
    ]);
    $result = $this->Paginator->getTemplates('sort');
    ?>
<div class="books index content listBookContainer bg-dark">
<?= $this->Html->link(__('Add a book'), ['action' => 'add'], ['class' => 'btn btn-primary'])  ?>
    <h3 class="titleListBook"><?= __('List of Books') ?></h3>
    <div class="table-responsive listBooks">
        <table class="table align-middle tableHover" style="color: #e3f2fd;">
            <thead class="thead">
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('Title') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('Price') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('Category_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('Author_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('Tag_id') ?></th>
                    <th scope="col" class="th"><?= __('Image') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book) : ?>
                <tr class="hover">
                    <td scope="row"><?= h($book->title) ?></td>
                    <td scope="row"><?= h($book->price) ?></td>
                    <td scope="row"><?= $book->has('category') ? $this->Html->link($book->category->name, ['controller' => 'Categories', 'action' => 'view', $book->category->id], ['class' => 'link']) : '' ?></td>
                    <td scope="row"><?= $book->has('author') ? $this->Html->link($book->author->name, ['controller' => 'Authors', 'action' => 'view', $book->author->id], ['class' => 'link']) : '' ?></td>
                    <td scope="row"><?= $book->has('tag') ? $this->Html->link($book->tag->name, ['controller' => 'Tags', 'action' => 'view', $book->tag->id], ['class' => 'link']) : '' ?></td>
                    <td><?= $this->Html->image($book->image, array('class' => 'imageBook1','alt' => '')); ?></td>
                    <td scope="row" class="actions">
                    <?= $this->Html->link(__(''), ['action' => 'view', $book->id], ['class' => 'fa-solid fa-eye nav-link', 'style' => 'color: #81d4fa;']) ?>
                        <?= $this->Html->link(__(''), ['action' => 'edit', $book->id], ['class' => 'fa-solid fa-pen nav-link', 'style' => 'color: #81d4fa;']) ?>
                        <?= $this->Form->postLink(__(''), ['action' => 'delete', $book->id], ['class' => 'fa-solid fa-trash nav-link', 'style' => 'color: #81d4fa;'], ['confirm' => __('Are you sure you want to delete # {0}?', $book->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <nav class="paginator" aria-label="Page navigation example">
        </table>
        <div class="paginator paginate Page navigation example bg-dark">
            <?php echo $this->element('pagination');?>
        </div>

    </nav>
    </div>
</div>
