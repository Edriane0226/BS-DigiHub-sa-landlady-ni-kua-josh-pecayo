<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">Supplier Details</h1>
        <p class="text-muted">Complete supplier information and product listing</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= site_url('/suppliers') ?>" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back to Suppliers
        </a>
        <a href="<?= site_url('/suppliers/edit/'.$supplier['id']) ?>" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Edit Supplier
        </a>
    </div>
</div>

<!-- Supplier Information Card -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-building"></i> Supplier Information
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Company Name:</strong>
                            </div>
                            <div class="col-sm-8">
                                <?= esc($supplier['supplier_name']) ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Contact Person:</strong>
                            </div>
                            <div class="col-sm-8">
                                <?= esc($supplier['contact_person']) ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Phone:</strong>
                            </div>
                            <div class="col-sm-8">
                                <a href="tel:<?= esc($supplier['phone']) ?>" class="text-decoration-none">
                                    <i class="bi bi-telephone text-success"></i> <?= esc($supplier['phone']) ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Email:</strong>
                            </div>
                            <div class="col-sm-8">
                                <a href="mailto:<?= esc($supplier['email']) ?>" class="text-decoration-none">
                                    <i class="bi bi-envelope text-primary"></i> <?= esc($supplier['email']) ?>
                                </a>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Address:</strong>
                            </div>
                            <div class="col-sm-8">
                                <i class="bi bi-geo-alt text-info"></i> <?= nl2br(esc($supplier['address'])) ?>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <strong>Status:</strong>
                            </div>
                            <div class="col-sm-8">
                                <?php if (count($products) > 0): ?>
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle"></i> Active Supplier
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-warning">
                                        <i class="bi bi-pause-circle"></i> Inactive
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Row -->
<div class="row mb-4">
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card text-center bg-primary text-white">
            <div class="card-body">
                <i class="bi bi-box-seam display-4 mb-2"></i>
                <h4><?= count($products) ?></h4>
                <p class="mb-0">Total Products</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card text-center bg-success text-white">
            <div class="card-body">
                <i class="bi bi-currency-dollar display-4 mb-2"></i>
                <h4>$<?= number_format(array_sum(array_column($products, 'price')), 2) ?></h4>
                <p class="mb-0">Total Value</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card text-center bg-info text-white">
            <div class="card-body">
                <i class="bi bi-boxes display-4 mb-2"></i>
                <h4><?= array_sum(array_column($products, 'quantity')) ?></h4>
                <p class="mb-0">Total Quantity</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card text-center bg-warning text-white">
            <div class="card-body">
                <i class="bi bi-tags display-4 mb-2"></i>
                <h4><?= count(array_unique(array_column($products, 'category_name'))) ?></h4>
                <p class="mb-0">Categories</p>
            </div>
        </div>
    </div>
</div>

<!-- Products Table -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">
            <i class="bi bi-list-ul"></i> Products from this Supplier
        </h5>
        <a href="<?= site_url('/products/create?supplier='.$supplier['id']) ?>" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-circle"></i> Add Product
        </a>
    </div>
    <div class="card-body p-0">
        <?php if (!empty($products)): ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>SKU</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Value</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($products as $product): ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-2">
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                             style="width: 35px; height: 35px;">
                                            <i class="bi bi-box text-muted"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="fw-semibold"><?= esc($product['product_name']) ?></div>
                                        <div class="small text-muted"><?= ucfirst($product['product_type']) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info">
                                    <?= esc($product['category_name'] ?? 'N/A') ?>
                                </span>
                            </td>
                            <td>
                                <code class="text-dark"><?= esc($product['sku']) ?></code>
                            </td>
                            <td>
                                <span class="fw-semibold text-success">$<?= number_format($product['price'], 2) ?></span>
                            </td>
                            <td>
                                <?php if ($product['quantity'] == 0): ?>
                                    <span class="badge bg-danger">Out of Stock</span>
                                <?php elseif ($product['quantity'] <= 5): ?>
                                    <span class="badge bg-warning"><?= $product['quantity'] ?></span>
                                <?php else: ?>
                                    <span class="badge bg-success"><?= $product['quantity'] ?></span>
                                <?php endif ?>
                            </td>
                            <td>
                                <span class="fw-semibold">$<?= number_format($product['price'] * $product['quantity'], 2) ?></span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="<?= site_url('/products/edit/'.$product['id']) ?>" 
                                       class="btn btn-outline-warning" 
                                       title="Edit Product">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="<?= site_url('/products/delete/'.$product['id']) ?>" 
                                       class="btn btn-outline-danger" 
                                       title="Delete Product"
                                       data-confirm="Are you sure you want to delete this product?">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-box-seam display-1 text-muted"></i>
                <h4 class="mt-3">No Products Found</h4>
                <p class="text-muted">This supplier doesn't have any products yet.</p>
                <a href="<?= site_url('/products/create?supplier='.$supplier['id']) ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Add First Product
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>