<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
?>
<div class="row container bg-dark containerAuthor">
    <div class="column-responsive column-80 containerAuthor">
        <div class="categories view content">
            <div class="book-title">
                <h3><?= h($category->name) ?></h3>
                <aside class="column actions">
                    <div class="side-nav">
                        <?= $this->Html->link(__(''), ['action' => 'edit', $category->id], ['class' => 'nav-link fa-solid fa-pen']) ?>
                        <?= $this->Form->postLink(__(''), ['action' => 'delete', $category->id], ['class' => 'nav-link fa-solid fa-trash'], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id), 'class' => 'side-nav-item']) ?>
                    </div>
                </aside>
            </div>
            <div class="text">
                <strong><?= __('Description:') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($category->description)); ?>
                </blockquote>
            </div>
            <table>
                <tr>
                    <th><?= __('Last modified:') ?> <span class="text-span"> <?= h($category->modified) ?></span></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Books') ?></h4>
                <?php if (!empty($category->books)) : ?>
                <div class="table-responsive">
                    <table>
                        <?php foreach ($category->books as $books) : ?>
                        <tr>
                            <td><?= h($books->title) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
