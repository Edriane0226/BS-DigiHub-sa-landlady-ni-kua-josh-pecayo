<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">Products</h1>
        <p class="text-muted">Manage your automotive parts inventory</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-secondary btn-sm" onclick="refreshProducts()">
            <i class="bi bi-arrow-clockwise"></i> Refresh
        </button>
        <a href="<?= site_url('/products/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Product
        </a>
    </div>
</div>

<!-- Products Summary Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card bg-primary text-white">
            <div class="card-body d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="h4 mb-0"><?= count($products) ?></div>
                    <div class="small">Total Products</div>
                </div>
                <div class="ms-3">
                    <i class="bi bi-box-seam display-6"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card bg-success text-white">
            <div class="card-body d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="h4 mb-0"><?= count(array_filter($products, fn($p) => $p['quantity'] > 0)) ?></div>
                    <div class="small">In Stock</div>
                </div>
                <div class="ms-3">
                    <i class="bi bi-check-circle display-6"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card bg-warning text-white">
            <div class="card-body d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="h4 mb-0"><?= count(array_filter($products, fn($p) => $p['quantity'] <= 5 && $p['quantity'] > 0)) ?></div>
                    <div class="small">Low Stock</div>
                </div>
                <div class="ms-3">
                    <i class="bi bi-exclamation-triangle display-6"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card bg-danger text-white">
            <div class="card-body d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="h4 mb-0"><?= count(array_filter($products, fn($p) => $p['quantity'] == 0)) ?></div>
                    <div class="small">Out of Stock</div>
                </div>
                <div class="ms-3">
                    <i class="bi bi-x-circle display-6"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter Bar -->
<div class="card mb-4">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label small">Search Products</label>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search by name, SKU..." id="searchInput">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-2">
                <label class="form-label small">Category</label>
                <select class="form-select" id="categoryFilter">
                    <option value="">All Categories</option>
                    <!-- Categories would be populated here -->
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small">Type</label>
                <select class="form-select" id="typeFilter">
                    <option value="">All Types</option>
                    <option value="digital">Digital</option>
                    <option value="physical">Physical</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small">Stock Status</label>
                <select class="form-select" id="stockFilter">
                    <option value="">All Stock</option>
                    <option value="in-stock">In Stock</option>
                    <option value="low-stock">Low Stock</option>
                    <option value="out-of-stock">Out of Stock</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-outline-secondary w-100" onclick="clearFilters()">
                    <i class="bi bi-x-circle"></i> Clear
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Products Table -->
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">
            <i class="bi bi-list-ul"></i> Product Inventory
        </h5>
    </div>
    <div class="card-body p-0">
        <?php if (!empty($products)): ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th width="8%">ID</th>
                            <th width="25%">Product Details</th>
                            <th width="15%">Category</th>
                            <th width="10%">Type</th>
                            <th width="12%">SKU</th>
                            <th width="10%">Price</th>
                            <th width="8%">Stock</th>
                            <th width="12%" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($products as $p): ?>
                        <tr>
                            <td>
                                <span class="badge bg-secondary"><?= $p['id'] ?></span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                             style="width: 40px; height: 40px;">
                                            <i class="bi bi-box text-muted"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="fw-semibold"><?= esc($p['product_name']) ?></div>
                                        <?php if (!empty($p['description'])): ?>
                                            <div class="small text-muted"><?= substr(esc($p['description']), 0, 50) ?>...</div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info">
                                    <?= esc($p['category_name'] ?? 'N/A') ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge <?= $p['product_type'] == 'digital' ? 'bg-success' : 'bg-warning' ?>">
                                    <i class="bi bi-<?= $p['product_type'] == 'digital' ? 'cloud' : 'box' ?>"></i>
                                    <?= ucfirst(esc($p['product_type'])) ?>
                                </span>
                            </td>
                            <td>
                                <code class="text-dark"><?= esc($p['sku']) ?></code>
                            </td>
                            <td>
                                <span class="fw-semibold text-success">$<?= number_format($p['price'], 2) ?></span>
                            </td>
                            <td>
                                <?php if ($p['quantity'] == 0): ?>
                                    <span class="badge bg-danger">Out of Stock</span>
                                <?php elseif ($p['quantity'] <= 5): ?>
                                    <span class="badge bg-warning"><?= $p['quantity'] ?> Low</span>
                                <?php else: ?>
                                    <span class="badge bg-success"><?= $p['quantity'] ?></span>
                                <?php endif ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <button type="button" class="btn btn-outline-primary" title="View Details">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <a href="<?= site_url('/products/edit/'.$p['id']) ?>" 
                                       class="btn btn-outline-warning" 
                                       title="Edit Product">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="<?= site_url('/products/delete/'.$p['id']) ?>" 
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
            
            <!-- Pagination -->
            <div class="card-footer bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Showing <?= count($products) ?> products
                    </div>
                    <div>
                        <!-- Pagination controls would go here -->
                        <nav aria-label="Products pagination">
                            <ul class="pagination pagination-sm mb-0">
                                <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                </li>
                                <li class="page-item active">
                                    <span class="page-link">1</span>
                                </li>
                                <li class="page-item disabled">
                                    <span class="page-link">Next</span>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-box-seam display-1 text-muted"></i>
                <h4 class="mt-3">No Products Found</h4>
                <p class="text-muted">Start building your inventory by adding products.</p>
                <a href="<?= site_url('/products/create') ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Add Your First Product
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
function refreshProducts() {
    location.reload();
}

function clearFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('categoryFilter').value = '';
    document.getElementById('typeFilter').value = '';
    document.getElementById('stockFilter').value = '';
}

// Simple search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const productName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        const sku = row.querySelector('code').textContent.toLowerCase();
        
        if (productName.includes(searchTerm) || sku.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>

<?= $this->endSection() ?>