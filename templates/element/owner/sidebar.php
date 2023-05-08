<?php if ($auth_user) {?>
    <?php if ($auth_user->get('group_id') == 1) { ?>
        <ul class="navbar-nav bg-gradient-sidebar sidebar sidebar-dark accordion" id="accordionSidebar">

            <div class="sidebar_padding_top_opened" id="sidebarTopPadding">
                <li class="nav-item active">
                    <?php echo $this->Html->link('<i class="fas fa-list-alt"></i> <span>'.__('Overview').'</span>', ['controller' => 'users', 'action' => 'index'], ['class' => 'nav-link', 'escape' => false]);?>
                </li>

                <hr class="sidebar-divider">

                <!-- Users management -->
                <li class="nav-item">
                    <?php echo $this->Html->link('<i class="fas fa-users"></i> <span>'.__('Account management').'</span>', '', ['class' => 'nav-link collapsed', 'escape' => false, 'data-bs-toggle' => 'collapse', 'data-bs-target' => '#collapseUsersManagement', 'aria-expanded' => 'true', 'aria-controls' => 'collapseTwo']);?>
                    <div id="collapseUsersManagement" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner d-flex flex-column">
                            <?php echo $this->Html->link(__('Edit my account'), ['controller' => 'users', 'action' => 'edit'], ['class' => 'collapse-item text-decoration-none']);?>
                        </div>
                    </div>
                </li>

                <!-- ContentManagement -->
                <li class="nav-item">
                    <?php echo $this->Html->link('<i class="fas fa-file"></i> <span>'.__('Content Management').'</span>', '', ['class' => 'nav-link collapsed', 'escape' => false, 'data-bs-toggle' => 'collapse', 'data-bs-target' => '#collapseContentManagement', 'aria-expanded' => 'true', 'aria-controls' => 'collapseContentManagement']);?>
                    <div id="collapseContentManagement" class="collapse" aria-labelledby="headingContentManagement" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner d-flex flex-column">
                            <?php echo $this->Html->link(__('Books'), ['controller' => 'books', 'action' => 'index'], ['class' => 'collapse-item text-decoration-none']);?>
                            <?php echo $this->Html->link(__('Categories'), ['controller' => 'categories', 'action' => 'index'], ['class' => 'collapse-item text-decoration-none']);?>
                            <?php echo $this->Html->link(__('Tags'), ['controller' => 'tags', 'action' => 'index'], ['class' => 'collapse-item text-decoration-none']);?>
                            <?php echo $this->Html->link(__('Orders'), ['controller' => 'orders', 'action' => 'index'], ['class' => 'collapse-item text-decoration-none']);?>
                        </div>
                    </div>
                </li>



                <hr class="sidebar-divider">

                <!-- Log out -->
                <li class="nav-item">
                    <?php echo $this->Html->link(__('Sign out'), ['controller' => 'users', 'action' => 'logout'], ['class' => 'nav-link fas fa-sign-out-alt ']);?>
                </li>
            </div>

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
    <?php } else { ?>
        <ul class="navbar-nav bg-gradient-sidebar sidebar sidebar-dark accordion" id="accordionSidebar">
            <div class="sidebar_padding_top_opened" id="sidebarTopPadding">
                <li class="nav-item active">
                    <?php echo $this->Html->link('<i class="fas fa-list-alt"></i> <span>'.__('Overview').'</span>', ['controller' => 'users', 'action' => 'index'], ['class' => 'nav-link', 'escape' => false]);?>
                </li>

                <hr class="sidebar-divider">

                <!-- Users management -->
                <li class="nav-item">
                    <?php echo $this->Html->link('<i class="fas fa-users"></i> <span>'.__('Account management').'</span>', '', ['class' => 'nav-link collapsed', 'escape' => false, 'data-bs-toggle' => 'collapse', 'data-bs-target' => '#collapseUsersManagement', 'aria-expanded' => 'true', 'aria-controls' => 'collapseTwo']);?>
                    <div id="collapseUsersManagement" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner d-flex flex-column">
                            <?php echo $this->Html->link(__('Edit my account'), ['controller' => 'users', 'action' => 'edit'], ['class' => 'collapse-item text-decoration-none']);?>
                        </div>
                    </div>
                </li>

                <!-- OrdersManagement -->
                <li class="nav-item">
                    <?php echo $this->Html->link('<i class="fas fa-file"></i> <span>'.__('Content Management').'</span>', '', ['class' => 'nav-link collapsed', 'escape' => false, 'data-bs-toggle' => 'collapse', 'data-bs-target' => '#collapseContentManagement', 'aria-expanded' => 'true', 'aria-controls' => 'collapseContentManagement']);?>
                    <div id="collapseContentManagement" class="collapse" aria-labelledby="headingContentManagement" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner d-flex flex-column">
                            <?php echo $this->Html->link(__('Orders'), ['controller' => 'orders', 'action' => 'index'], ['class' => 'collapse-item text-decoration-none']);?>
                        </div>
                    </div>
                </li>



                <hr class="sidebar-divider">

                <!-- Log out -->
                <li class="nav-item">
                    <?php echo $this->Html->link(__('Sign out'), ['controller' => 'users', 'action' => 'logout'], ['class' => 'nav-link fas fa-sign-out-alt ']);?>
                </li>
            </div>

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            </ul>
    <?php } ?>
<?php } ?>