<ul class="navbar-nav aside-bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= BASE_URL . '/'?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">dm - system</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <?php if($cuser_type === 'admin'): ?>    
        <div class="sidebar-heading">
            Admin
        </div>
    <?php endif; ?>
    <li class="nav-item <?php if($page ==='dashboard'){echo 'active';}?>">
        <a class="nav-link" href="<?= BASE_URL . '/dashboard'?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item <?php if($page ==='document'){echo 'active';}?>">
        <a class="nav-link" href="<?= BASE_URL . '/document'?>">
            <i class="fas fa-fw fa-folder"></i>
            <span>Documents</span>
        </a>
    </li>
    
    <?php 
        if ($cuser_type === 'admin') { ?>
            <li class="nav-item <?php if($page ==='category'){echo 'active';}?>">
                <a class="nav-link" href="<?= BASE_URL . '/category'?>">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Category</span>
                </a>
            </li>
            <li class="nav-item <?php if($page ==='users'){echo 'active';}?>">
                <a class="nav-link" href="<?= BASE_URL . '/users'?>">
                    <i class="fas fa-fw fa-user-plus"></i>
                    <span>Users</span>
                </a>
            </li>
        <?php } ?>
    
    <li class="nav-item <?php if($page ==='trash'){echo 'active';}?>">
        <a class="nav-link" href="<?= BASE_URL . '/trash'?>">
            <i class="fas fa-fw fa-trash"></i>
            <span>Recycle Bin</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= BASE_URL . '/core/logout'?>">
            <i class="fas fa-sign-out-alt fa-sm fa-fw"></i>
            <span>Logout</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>