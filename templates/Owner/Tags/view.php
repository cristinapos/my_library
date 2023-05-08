<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Location $location
 */
?>
<div class="row container bg-dark containerAuthor" style="margin-top: 6em;">
    <div class="column-responsive column-80 containerAuthor">
        <div class="locations view content">
            <div class="book-title">
                <h3><?= h($tag->name) ?></h3>
                <aside class="column actions">
                    <div class="side-nav">
                        <?= $this->Html->link(__(''), ['action' => 'edit', $tag->id], ['class' => 'nav-link fa-solid fa-pen']) ?>
                        <?= $this->Form->postLink(__(''), ['action' => 'delete', $tag->id], ['class' => 'nav-link fa-solid fa-trash'], ['confirm' => __('Are you sure you want to delete # {0}?', $tag->id), 'class' => 'side-nav-item']) ?>
                    </div>
                </aside>
            </div>
            <div class="text">
                <strong><?= __('Description:') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($tag->description)); ?>
                </blockquote>
            </div>
            <table>
                <tr>
                    <th><?= __('Last modified:') ?> <span class="text-span"><?= h($tag->modified) ?></span></th>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Books') ?></h4>
                <?php if (!empty($tag->books)) : ?>
                <div class="table-responsive">
                        <?php foreach ($tag->books as $books) : ?>
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
