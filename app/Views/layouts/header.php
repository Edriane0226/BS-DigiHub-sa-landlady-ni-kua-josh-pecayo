<?php
$currentPage = uri_string();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand fw-bold" href="<?= base_url() ?>">
            <i class="bi bi-shop"></i>
            BS DIGIHUB
        </a>
        
        <!-- Toggle button for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Navigation links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?= $currentPage === '' ? 'active' : '' ?>" href="<?= base_url() ?>">
                        <i class="bi bi-house"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= str_contains($currentPage, 'dashboard') ? 'active' : '' ?>" href="<?= base_url('dashboard') ?>">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= str_contains($currentPage, 'car-models') || str_contains($currentPage, 'products') ? 'active' : '' ?>" 
                       href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-gear"></i> Manage
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= base_url('car-models') ?>">
                            <i class="bi bi-car-front"></i> Car Models
                        </a></li>
                        <li><a class="dropdown-item" href="<?= base_url('products') ?>">
                            <i class="bi bi-box"></i> Products
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">
                            <i class="bi bi-people"></i> Suppliers
                        </a></li>
                    </ul>
                </li>
            </ul>
            
            <!-- Search bar -->
            <form class="d-flex me-3" role="search">
                <input class="form-control form-control-sm" type="search" placeholder="Search products...">
                <button class="btn btn-outline-light btn-sm" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>
            
            <!-- User menu -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i> Admin
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">
                            <i class="bi bi-person"></i> Profile
                        </a></li>
                        <li><a class="dropdown-item" href="#">
                            <i class="bi bi-gear"></i> Settings
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>