

<nav class="navbar navbar-dark navbar-expand-lg bg-dark d-flex justify-content-between">
    <div class="container">
        <?= $this->Html->link(__("My library"), ['controller' => 'Pages','action' => 'shop'], ['class' => 'navbar-brand navLogo']) ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <?= $this->Html->link(__(''), ['controller' => 'Pages','action' => 'favorites'], ['class' => 'fa-solid fa-heart nav-link']) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link(__(''), ['controller' => 'Carts','action' => 'index'], ['class' => 'fa-solid fa-cart-shopping nav-link']) ?>
                    <?php
                    // Get number of items in cart from session
                    $itemCount = $this->getRequest()->getSession()->read('Cart.itemCount');
                    if ($itemCount > 0) {
                        echo '<span class="badge badge-pill badge-secondary">' . $itemCount . '</span>';
                    }
                    ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link(__(''), ['controller' => 'Users', 'action' => 'login', 'prefix' => 'Owner', 'plugin' => null], ['class' => 'fa-solid fa-right-to-bracket nav-link']) ?>
                </li>
            </ul>
        </div>
    </div>
</nav>