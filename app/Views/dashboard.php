<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Dashboard Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">Dashboard</h1>
        <p class="text-muted">Overview of BS DIGIHUB store management</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-primary btn-sm" onclick="refreshDashboard()">
            <i class="bi bi-arrow-clockwise"></i> Refresh
        </button>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card bg-primary text-white h-100">
            <div class="card-body d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="h4 mb-0"><?= isset($stats['total_products']) ? $stats['total_products'] : '0' ?></div>
                    <div class="small">Total Products</div>
                </div>
                <div class="ms-3">
                    <i class="bi bi-box-seam display-6"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card bg-success text-white h-100">
            <div class="card-body d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="h4 mb-0"><?= isset($stats['total_car_models']) ? $stats['total_car_models'] : '0' ?></div>
                    <div class="small">Car Models</div>
                </div>
                <div class="ms-3">
                    <i class="bi bi-car-front display-6"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card bg-info text-white h-100">
            <div class="card-body d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="h4 mb-0"><?= isset($stats['total_suppliers']) ? $stats['total_suppliers'] : '0' ?></div>
                    <div class="small">Suppliers</div>
                </div>
                <div class="ms-3">
                    <i class="bi bi-people display-6"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card bg-warning text-white h-100">
            <div class="card-body d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="h4 mb-0"><?= isset($stats['low_stock_items']) ? $stats['low_stock_items'] : '0' ?></div>
                    <div class="small">Low Stock Alerts</div>
                </div>
                <div class="ms-3">
                    <i class="bi bi-exclamation-triangle display-6"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-lightning"></i> Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="<?= base_url('products/create') ?>" class="btn btn-primary w-100">
                            <i class="bi bi-plus-circle"></i>
                            <div class="mt-1">Add Product</div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="<?= base_url('car-models/create') ?>" class="btn btn-success w-100">
                            <i class="bi bi-car-front"></i>
                            <div class="mt-1">Add Car Model</div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="<?= base_url('suppliers/create') ?>" class="btn btn-info w-100">
                            <i class="bi bi-person-plus"></i>
                            <div class="mt-1">Add Supplier</div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="<?= base_url('reports') ?>" class="btn btn-warning w-100">
                            <i class="bi bi-graph-up"></i>
                            <div class="mt-1">View Reports</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity & Overview -->
<div class="row">
    <!-- Recent Products -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-clock-history"></i> Recent Products
                </h5>
                <a href="<?= base_url('products') ?>" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                <?php if (isset($recent_products) && !empty($recent_products)): ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($recent_products as $product): ?>
                            <div class="list-group-item px-0 py-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0"><?= esc($product['product_name']) ?></h6>
                                        <small class="text-muted"><?= esc($product['category_name'] ?? 'Uncategorized') ?></small>
                                    </div>
                                    <div class="text-end">
                                        <div class="badge bg-success">In Stock</div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                <?php else: ?>
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-box display-4"></i>
                        <p class="mt-2 mb-0">No products added yet</p>
                        <a href="<?= base_url('products/create') ?>" class="btn btn-sm btn-primary mt-2">Add First Product</a>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
    
    <!-- Recent Car Models -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-car-front"></i> Recent Car Models
                </h5>
                <a href="<?= base_url('car-models') ?>" class="btn btn-sm btn-outline-success">View All</a>
            </div>
            <div class="card-body">
                <?php if (isset($recent_car_models) && !empty($recent_car_models)): ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($recent_car_models as $model): ?>
                            <div class="list-group-item px-0 py-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0"><?= esc($model['brand']) ?> <?= esc($model['model']) ?></h6>
                                        <small class="text-muted"><?= $model['year_start'] ?>-<?= $model['year_end'] ?: 'Present' ?></small>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-info"><?= $model['id'] ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                <?php else: ?>
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-car-front display-4"></i>
                        <p class="mt-2 mb-0">No car models added yet</p>
                        <a href="<?= base_url('car-models/create') ?>" class="btn btn-sm btn-success mt-2">Add First Model</a>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>

<!-- System Status -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-speedometer2"></i> System Status
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-hdd text-success me-2"></i>
                            <div>
                                <div class="small text-muted">Database Status</div>
                                <div class="fw-semibold text-success">Connected</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-server text-success me-2"></i>
                            <div>
                                <div class="small text-muted">Server Status</div>
                                <div class="fw-semibold text-success">Online</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-shield-check text-success me-2"></i>
                            <div>
                                <div class="small text-muted">Security</div>
                                <div class="fw-semibold text-success">Protected</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function refreshDashboard() {
    location.reload();
}
</script>

<?= $this->endSection() ?>
