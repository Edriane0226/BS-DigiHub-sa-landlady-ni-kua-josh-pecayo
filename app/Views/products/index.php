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
        <a href="<?= site_url('/products/stock-in') ?>" class="btn btn-success">
            <i class="bi bi-box-arrow-in-right"></i> Stock In
        </a>
        <a href="<?= site_url('/products/stock-out') ?>" class="btn btn-danger">
            <i class="bi bi-box-arrow-right"></i> Stock Out
        </a>
    </div>
</div>

<!-- Products Summary Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card bg-primary text-white">
            <div class="card-body d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="h4 mb-0"><?= $stats['total'] ?></div>
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
                    <div class="h4 mb-0"><?= $stats['in_stock'] ?></div>
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
                    <div class="h4 mb-0"><?= $stats['low_stock'] ?></div>
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
                    <div class="h4 mb-0"><?= $stats['out_of_stock'] ?></div>
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
                    <input type="text" class="form-control" placeholder="Search by name, SKU..." 
                           id="searchInput" name="search" value="<?= isset($filters['search']) ? esc($filters['search']) : '' ?>">
                    <button class="btn btn-outline-secondary" type="button" onclick="performSearch()">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-2">
                <label class="form-label small">Category</label>
                <select class="form-select" id="categoryFilter" name="category">
                    <option value="">All Categories</option>
                    <?php if (isset($categories)): ?>
                        <?php foreach($categories as $category): ?>
                            <option value="<?= $category['id'] ?>" <?= isset($filters['category']) && $filters['category'] == $category['id'] ? 'selected' : '' ?>>
                                <?= esc($category['category_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small">Type</label>
                <select class="form-select" id="typeFilter" name="type">
                    <option value="">All Types</option>
                    <option value="digital" <?= isset($filters['type']) && $filters['type'] == 'digital' ? 'selected' : '' ?>>Digital</option>
                    <option value="physical" <?= isset($filters['type']) && $filters['type'] == 'physical' ? 'selected' : '' ?>>Physical</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small">Stock Status</label>
                <select class="form-select" id="stockFilter" name="stock">
                    <option value="">All Stock</option>
                    <option value="in-stock" <?= isset($filters['stock']) && $filters['stock'] == 'in-stock' ? 'selected' : '' ?>>In Stock</option>
                    <option value="low-stock" <?= isset($filters['stock']) && $filters['stock'] == 'low-stock' ? 'selected' : '' ?>>Low Stock</option>
                    <option value="out-of-stock" <?= isset($filters['stock']) && $filters['stock'] == 'out-of-stock' ? 'selected' : '' ?>>Out of Stock</option>
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
                                <span class="fw-semibold text-success">₱<?= number_format($p['price'], 2) ?></span>
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
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="card-footer bg-light border-top">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="text-muted small d-flex align-items-center">
                            <i class="bi bi-info-circle me-1"></i>
                            Showing <span class="fw-semibold mx-1"><?= count($products) ?></span> products
                            <?php if (isset($pager) && $pager->getPageCount() > 1): ?>
                                <span class="badge bg-primary ms-2">
                                    Page <?= $pager->getCurrentPage() ?> of <?= $pager->getPageCount() ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?php if (isset($pager) && $pager->getPageCount() > 1): ?>
                            <div class="d-flex justify-content-end">
                                <?= $pager->links() ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Pagination Info -->
                <?php if (isset($pager) && $pager->getPageCount() > 1): ?>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="progress" style="height: 3px;">
                                <div class="progress-bar bg-primary" 
                                     style="width: <?= round(($pager->getCurrentPage() / $pager->getPageCount()) * 100) ?>%">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
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
    window.location.href = '<?= base_url('products') ?>';
}

function performSearch() {
    applyFilters();
}

function applyFilters() {
    const params = new URLSearchParams();
    
    const search = document.getElementById('searchInput').value.trim();
    const category = document.getElementById('categoryFilter').value;
    const type = document.getElementById('typeFilter').value;
    const stock = document.getElementById('stockFilter').value;
    
    if (search) params.set('search', search);
    if (category) params.set('category', category);
    if (type) params.set('type', type);
    if (stock) params.set('stock', stock);
    
    const url = '<?= base_url('products') ?>' + (params.toString() ? '?' + params.toString() : '');
    window.location.href = url;
}

// Auto-apply filters when dropdowns change
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Add event listeners for filter changes
    document.getElementById('categoryFilter').addEventListener('change', applyFilters);
    document.getElementById('typeFilter').addEventListener('change', applyFilters);
    document.getElementById('stockFilter').addEventListener('change', applyFilters);
    
    // Search on Enter key
    document.getElementById('searchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            performSearch();
        }
    });
    
    // Add hover animations to pagination links
    const pageLinks = document.querySelectorAll('.pagination .page-link');
    pageLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            if (!this.closest('.page-item').classList.contains('disabled') && 
                !this.closest('.page-item').classList.contains('active')) {
                this.style.transform = 'translateY(-1px)';
                this.style.boxShadow = '0 4px 8px rgba(0,123,255,0.2)';
                this.style.transition = 'all 0.2s ease';
            }
        });
        
        link.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
        });
    });
});
</script>

<?= $this->endSection() ?>