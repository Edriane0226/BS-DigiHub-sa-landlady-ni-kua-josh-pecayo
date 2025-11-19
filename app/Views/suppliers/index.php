<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">Suppliers</h1>
        <p class="text-muted">Manage your supplier network and relationships</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-secondary btn-sm" onclick="refreshSuppliers()">
            <i class="bi bi-arrow-clockwise"></i> Refresh
        </button>
        <a href="<?= site_url('/suppliers/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Supplier
        </a>
    </div>
</div>

<!-- Suppliers Summary Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card bg-primary text-white">
            <div class="card-body d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="h4 mb-0"><?= count($suppliers) ?></div>
                    <div class="small">Total Suppliers</div>
                </div>
                <div class="ms-3">
                    <i class="bi bi-people display-6"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card bg-success text-white">
            <div class="card-body d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="h4 mb-0"><?= count(array_filter($suppliers, fn($s) => $s['product_count'] > 0)) ?></div>
                    <div class="small">Active Suppliers</div>
                </div>
                <div class="ms-3">
                    <i class="bi bi-check-circle display-6"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card bg-info text-white">
            <div class="card-body d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="h4 mb-0"><?= array_sum(array_column($suppliers, 'product_count')) ?></div>
                    <div class="small">Total Products</div>
                </div>
                <div class="ms-3">
                    <i class="bi bi-box-seam display-6"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card bg-warning text-white">
            <div class="card-body d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="h4 mb-0"><?= count(array_filter($suppliers, fn($s) => $s['product_count'] == 0)) ?></div>
                    <div class="small">Inactive Suppliers</div>
                </div>
                <div class="ms-3">
                    <i class="bi bi-exclamation-triangle display-6"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter Bar -->
<div class="card mb-4">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label small">Search Suppliers</label>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search by name, contact, email..." id="searchInput">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label small">Status</label>
                <select class="form-select" id="statusFilter">
                    <option value="">All Suppliers</option>
                    <option value="active">Active (with products)</option>
                    <option value="inactive">Inactive (no products)</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button class="btn btn-outline-secondary w-100" onclick="clearFilters()">
                    <i class="bi bi-x-circle"></i> Clear Filters
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Suppliers Table -->
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">
            <i class="bi bi-list-ul"></i> Supplier Directory
        </h5>
    </div>
    <div class="card-body p-0">
        <?php if (!empty($suppliers)): ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="20%">Supplier Details</th>
                            <th width="20%">Contact Information</th>
                            <th width="25%">Address</th>
                            <th width="10%">Products</th>
                            <th width="10%">Status</th>
                            <th width="10%" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($suppliers as $supplier): ?>
                        <tr data-supplier-status="<?= $supplier['product_count'] > 0 ? 'active' : 'inactive' ?>">
                            <td>
                                <span class="badge bg-secondary"><?= $supplier['id'] ?></span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                             style="width: 45px; height: 45px;">
                                            <i class="bi bi-building text-primary"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="fw-semibold"><?= esc($supplier['supplier_name']) ?></div>
                                        <div class="small text-muted">Contact: <?= esc($supplier['contact_person']) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="small">
                                    <div class="mb-1">
                                        <i class="bi bi-telephone text-success me-1"></i>
                                        <a href="tel:<?= esc($supplier['phone']) ?>" class="text-decoration-none">
                                            <?= esc($supplier['phone']) ?>
                                        </a>
                                    </div>
                                    <div>
                                        <i class="bi bi-envelope text-primary me-1"></i>
                                        <a href="mailto:<?= esc($supplier['email']) ?>" class="text-decoration-none">
                                            <?= esc($supplier['email']) ?>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="small text-muted">
                                    <i class="bi bi-geo-alt me-1"></i>
                                    <?= esc($supplier['address']) ?>
                                </div>
                            </td>
                            <td class="text-center">
                                <?php if ($supplier['product_count'] > 0): ?>
                                    <span class="badge bg-success"><?= $supplier['product_count'] ?> Products</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">No Products</span>
                                <?php endif ?>
                            </td>
                            <td>
                                <?php if ($supplier['product_count'] > 0): ?>
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle"></i> Active
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-warning">
                                        <i class="bi bi-pause-circle"></i> Inactive
                                    </span>
                                <?php endif ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="<?= site_url('/suppliers/view/'.$supplier['id']) ?>" 
                                       class="btn btn-outline-primary" 
                                       title="View Details">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="<?= site_url('/suppliers/edit/'.$supplier['id']) ?>" 
                                       class="btn btn-outline-warning" 
                                       title="Edit Supplier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="<?= site_url('/suppliers/delete/'.$supplier['id']) ?>" 
                                       class="btn btn-outline-danger" 
                                       title="Delete Supplier"
                                       data-confirm="Are you sure you want to delete this supplier?">
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
                        Showing <?= count($suppliers) ?> suppliers
                    </div>
                    <div>
                        <!-- Pagination controls would go here -->
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-people display-1 text-muted"></i>
                <h4 class="mt-3">No Suppliers Found</h4>
                <p class="text-muted">Start building your supplier network by adding your first supplier.</p>
                <a href="<?= site_url('/suppliers/create') ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Add Your First Supplier
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
function refreshSuppliers() {
    location.reload();
}

function clearFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('statusFilter').value = '';
    
    // Show all rows
    const rows = document.querySelectorAll('tbody tr');
    rows.forEach(row => row.style.display = '');
}

// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    filterSuppliers();
});

document.getElementById('statusFilter').addEventListener('change', function() {
    filterSuppliers();
});

function filterSuppliers() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const statusFilter = document.getElementById('statusFilter').value;
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const supplierName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        const contactInfo = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
        const supplierStatus = row.getAttribute('data-supplier-status');
        
        let showRow = true;
        
        // Text search
        if (searchTerm && !supplierName.includes(searchTerm) && !contactInfo.includes(searchTerm)) {
            showRow = false;
        }
        
        // Status filter
        if (statusFilter && supplierStatus !== statusFilter) {
            showRow = false;
        }
        
        row.style.display = showRow ? '' : 'none';
    });
}
</script>

<?= $this->endSection() ?>