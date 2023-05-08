<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book[]|\Cake\Collection\CollectionInterface $books
 */
?>
<div class="row d-flex flex-row mt-5">
        <?php foreach ($books as $book) : ?>
            <div class="col-4">
                <div class="card d-flex flex-column align-items-center">
                    <div class="card-img-top"><?= $this->Html->image($book->image, array('class' => 'w-100','alt' => '')); ?></div>
                    <div class="card-body">
                        <h5><?= $this->Html->link(__($book->title), ['action' => 'view/'. $book->id], ['class' => 'card-title text-capitalize']) ?><h3>
                        <p class="card-text"><?= __('Author') . ': ' . $book->author->name ?></p>
                        <p class="card-text"><?= __('Tag') . ': ' .$book->tag->name ?></p>
                        <p class="card-text"><?= __('Category') . ': ' .$book->category->name ?></p>
                        <p class="card-text"><?= __('Price') . ': ' .$book->price ?></p>
                    </div>
                    <?php if ($book->stock == 0) { ?>
                        <div class="low_stock_overlay"><?php echo __('No stock');?></div>
                    <?php } else { ?>
                        <div class="add-to-cart w-100">
                            <?= $this->Form->create(null, ['url' => ['controller' => 'Carts', 'action' => 'add', $book->id], 'class' => 'd-flex justify-content-end']); ?>
                            <?= $this->Form->hidden('book_id', ['value' => $book->id]); ?>
                            <?= $this->Form->control('quantity', ['type' => 'number', 'min' => 1, 'max' => $book->stock, 'step' => 1, 'value' => 1, 'label' => false, 'class' => 'form-control', 'div' => ['class' => 'w-50']]); ?>
                            <?= $this->Form->button('Add to cart', ['class' => 'btn btn-primary w-50']); ?>
                            <?= $this->Form->end(); ?>
                        </div>

                    <?php } ?>
                </div>
            </div>
        <?php endforeach; ?>
</div>