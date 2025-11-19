<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">Edit Supplier</h1>
        <p class="text-muted">Update supplier information and settings</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= site_url('/suppliers') ?>" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back to Suppliers
        </a>
        <a href="<?= site_url('/suppliers/delete/'.$supplier['id']) ?>" 
           class="btn btn-outline-danger" 
           data-confirm="Are you sure you want to delete this supplier?">
            <i class="bi bi-trash"></i> Delete Supplier
        </a>
    </div>
</div>

<!-- Supplier Info Summary -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-1">
                        <div class="bg-primary bg-gradient rounded d-flex align-items-center justify-content-center text-white" 
                             style="width: 60px; height: 60px;">
                            <i class="bi bi-building display-6"></i>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <h5 class="mb-1"><?= esc($supplier['supplier_name']) ?></h5>
                        <p class="text-muted mb-1">Contact: <?= esc($supplier['contact_person']) ?></p>
                        <div class="d-flex gap-3 small">
                            <span><i class="bi bi-telephone text-success"></i> <?= esc($supplier['phone']) ?></span>
                            <span><i class="bi bi-envelope text-primary"></i> <?= esc($supplier['email']) ?></span>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="h4 text-primary mb-0"><?= count($products) ?></div>
                        <div class="text-muted">Products Supplied</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Form and Products -->
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="bi bi-pencil"></i> Edit Supplier Information
                </h6>
            </div>
            <div class="card-body">
                <?php if (session('errors')): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach (session('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>
                
                <form method="post" action="<?= site_url('/suppliers/update/'.$supplier['id']) ?>" id="editSupplierForm">
                    <?= csrf_field() ?>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="supplier_name" class="form-label required">Supplier Name</label>
                            <input type="text" 
                                   name="supplier_name" 
                                   id="supplier_name"
                                   class="form-control" 
                                   value="<?= esc($supplier['supplier_name']) ?>"
                                   required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="contact_person" class="form-label required">Contact Person</label>
                            <input type="text" 
                                   name="contact_person" 
                                   id="contact_person"
                                   class="form-control" 
                                   value="<?= esc($supplier['contact_person']) ?>"
                                   required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label required">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-telephone"></i>
                                </span>
                                <input type="tel" 
                                       name="phone" 
                                       id="phone"
                                       class="form-control" 
                                       value="<?= esc($supplier['phone']) ?>"
                                       required>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label required">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="email" 
                                       name="email" 
                                       id="email"
                                       class="form-control" 
                                       value="<?= esc($supplier['email']) ?>"
                                       required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="address" class="form-label required">Business Address</label>
                        <textarea name="address" 
                                  id="address"
                                  class="form-control" 
                                  rows="3"
                                  required><?= esc($supplier['address']) ?></textarea>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="d-flex gap-2 justify-content-end mt-4">
                        <a href="<?= site_url('/suppliers') ?>" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Update Supplier
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <!-- Products from this Supplier -->
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="bi bi-box-seam"></i> Supplied Products
                </h6>
            </div>
            <div class="card-body">
                <?php if (!empty($products)): ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($products as $product): ?>
                            <div class="list-group-item px-0 py-2 border-0">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 small fw-semibold"><?= esc($product['product_name']) ?></h6>
                                        <div class="small text-muted">
                                            SKU: <?= esc($product['sku']) ?>
                                        </div>
                                        <div class="small">
                                            <span class="badge bg-info"><?= esc($product['category_name'] ?? 'N/A') ?></span>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <div class="small fw-semibold text-success">$<?= number_format($product['price'], 2) ?></div>
                                        <div class="small text-muted">Qty: <?= $product['quantity'] ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="mt-3 pt-3 border-top">
                        <a href="<?= site_url('/products?supplier='.$supplier['id']) ?>" class="btn btn-sm btn-outline-primary w-100">
                            <i class="bi bi-eye"></i> View All Products
                        </a>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="bi bi-box-seam display-6 text-muted"></i>
                        <p class="mt-2 mb-0 small text-muted">No products from this supplier</p>
                        <a href="<?= site_url('/products/create?supplier='.$supplier['id']) ?>" class="btn btn-sm btn-primary mt-2">
                            <i class="bi bi-plus"></i> Add Product
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
.required::after {
    content: ' *';
    color: #dc3545;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('editSupplierForm');
    
    form.addEventListener('submit', function(e) {
        const phone = document.getElementById('phone').value.trim().replace(/[\s\-\(\)]/g, '');
        const email = document.getElementById('email').value.trim();
        
        if (phone.length < 10) {
            e.preventDefault();
            alert('Please enter a valid phone number with at least 10 digits');
            document.getElementById('phone').focus();
            return;
        }
        
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            e.preventDefault();
            alert('Please enter a valid email address');
            document.getElementById('email').focus();
            return;
        }
    });
});
</script>

<?= $this->endSection() ?>