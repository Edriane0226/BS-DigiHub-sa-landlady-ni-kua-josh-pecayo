<?= $this->extend('layouts/main') ?><!doctype html>

<option value="">-- choose --</option>

<?= $this->section('content') ?><?php foreach($categories as $c): ?>

<!-- Page Header --><option value="<?= $c['id'] ?>" <?= $product['category_id']==$c['id']? 'selected':'' ?> ><?= esc($c['category_name']) ?></option>

<div class="d-flex justify-content-between align-items-center mb-4"><?php endforeach; ?>

    <div></select>

        <h1 class="h3 mb-0">Edit Product</h1></div>

        <p class="text-muted">Update product information and settings</p><div class="mb-3">

    </div><label class="form-label">Supplier</label>

    <div class="d-flex gap-2"><select name="supplier_id" class="form-select">

        <a href="<?= site_url('/products') ?>" class="btn btn-outline-secondary"><option value="">-- choose --</option>

            <i class="bi bi-arrow-left"></i> Back to Products<?php foreach($suppliers as $s): ?>

        </a><option value="<?= $s['id'] ?>" <?= $product['supplier_id']==$s['id']? 'selected':'' ?> ><?= esc($s['supplier_name']) ?></option>

        <button class="btn btn-outline-danger" data-confirm="Are you sure you want to delete this product?"><?php endforeach; ?>

            <i class="bi bi-trash"></i> Delete Product</select>

        </button></div>

    </div><div class="mb-3">

</div><label class="form-label">Type</label>

<select name="product_type" class="form-select">

<!-- Product Info Summary --><option value="digital" <?= $product['product_type']=='digital'? 'selected':'' ?>>Digital</option>

<div class="row mb-4"><option value="physical" <?= $product['product_type']=='physical'? 'selected':'' ?>>Physical</option>

    <div class="col-md-12"></select>

        <div class="card"></div>

            <div class="card-body"><div class="mb-3">

                <div class="row align-items-center"><label class="form-label">SKU</label>

                    <div class="col-md-2"><input type="text" name="sku" class="form-control" value="<?= esc($product['sku']) ?>">

                        <div class="bg-light rounded d-flex align-items-center justify-content-center" </div>

                             style="width: 80px; height: 80px;"><div class="mb-3">

                            <i class="bi bi-box display-4 text-muted"></i><label class="form-label">Price</label>

                        </div><input type="text" name="price" class="form-control" value="<?= esc($product['price']) ?>">

                    </div></div>

                    <div class="col-md-6"><div class="mb-3">

                        <h5 class="mb-1"><?= esc($product['product_name']) ?></h5><label class="form-label">Quantity</label>

                        <p class="text-muted mb-1">SKU: <code><?= esc($product['sku']) ?></code></p><input type="number" name="quantity" class="form-control" value="<?= esc($product['quantity']) ?>">

                        <div class="d-flex gap-2"></div>

                            <span class="badge <?= $product['product_type'] == 'digital' ? 'bg-success' : 'bg-warning' ?>"><div class="mb-3">

                                <?= ucfirst($product['product_type']) ?><label class="form-label">Description</label>

                            </span><textarea name="description" class="form-control"><?= esc($product['description']) ?></textarea>

                            <?php if ($product['quantity'] == 0): ?></div>

                                <span class="badge bg-danger">Out of Stock</span>

                            <?php elseif ($product['quantity'] <= 5): ?>

                                <span class="badge bg-warning">Low Stock</span><h5>Compatibility</h5>

                            <?php else: ?><div class="mb-3">

                                <span class="badge bg-success">In Stock</span><label class="form-label">Add compatible car models (hold Ctrl / Cmd to select multiple)</label>

                            <?php endif ?><select name="car_model_id[]" class="form-select" multiple>

                        </div><?php foreach($car_models as $cm): ?>

                    </div><option value="<?= $cm['id'] ?>"><?= esc($cm['brand'].' '.$cm['model'].' ('.$cm['year_start'].'-'.($cm['year_end']?:'present').')') ?></option>

                    <div class="col-md-4 text-end"><?php endforeach; ?>

                        <div class="h4 text-success mb-0">$<?= number_format($product['price'], 2) ?></div></select>

                        <div class="text-muted">Qty: <?= $product['quantity'] ?></div></div>

                    </div>

                </div>

            </div><h6>Existing Compatibility</h6>

        </div><ul>

    </div><?php foreach($compatibilities as $comp): ?>

</div><li>

<?= esc($comp['brand'].' '.$comp['car_model'].' ('.$comp['year_start'].'-'.($comp['year_end']?:'present').')') ?>

<!-- Edit Form --><a href="<?= site_url('/compatibility/remove/'.$comp['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Remove?')">Remove</a>

<div class="row"></li>

    <div class="col-lg-10"><?php endforeach; ?>

        <form method="post" action="<?= site_url('/products/update/'.$product['id']) ?>" id="editProductForm"></ul>

            <?= csrf_field() ?>

            

            <div class="row"><button class="btn btn-primary">Save</button>

                <!-- Basic Information --><a href="<?= site_url('/products') ?>" class="btn btn-secondary">Cancel</a>

                <div class="col-md-8"></form>

                    <div class="card mb-4"></div>

                        <div class="card-header"></body>

                            <h6 class="mb-0"></html>
                                <i class="bi bi-pencil"></i> Edit Product Information
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="product_name" class="form-label required">Product Name</label>
                                <input type="text" 
                                       name="product_name" 
                                       id="product_name"
                                       class="form-control" 
                                       value="<?= esc($product['product_name']) ?>"
                                       required>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="sku" class="form-label required">SKU</label>
                                    <input type="text" 
                                           name="sku" 
                                           id="sku"
                                           class="form-control" 
                                           value="<?= esc($product['sku']) ?>"
                                           required>
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="price" class="form-label required">Price ($)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" 
                                               name="price" 
                                               id="price"
                                               class="form-control" 
                                               value="<?= esc($product['price']) ?>"
                                               step="0.01"
                                               min="0"
                                               required>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="quantity" class="form-label required">Quantity</label>
                                    <input type="number" 
                                           name="quantity" 
                                           id="quantity"
                                           class="form-control" 
                                           value="<?= esc($product['quantity']) ?>"
                                           min="0"
                                           required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" 
                                          id="description"
                                          class="form-control" 
                                          rows="4"><?= esc($product['description']) ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Compatibility Section -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="bi bi-car-front"></i> Vehicle Compatibility
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="car_model_id" class="form-label">Add Compatible Car Models</label>
                                <select name="car_model_id[]" 
                                        id="car_model_id"
                                        class="form-select" 
                                        multiple 
                                        size="6">
                                    <?php if (isset($car_models)): ?>
                                        <?php foreach($car_models as $cm): ?>
                                        <option value="<?= $cm['id'] ?>">
                                            <?= esc($cm['brand'].' '.$cm['model'].' ('.$cm['year_start'].'-'.($cm['year_end']?:'present').')') ?>
                                        </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <div class="form-text">Hold Ctrl/Cmd to select multiple models</div>
                            </div>
                            
                            <?php if (isset($compatibilities) && !empty($compatibilities)): ?>
                                <div class="mt-3">
                                    <h6>Current Compatibility</h6>
                                    <div class="list-group">
                                        <?php foreach($compatibilities as $comp): ?>
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="bi bi-car-front text-success me-2"></i>
                                                <?= esc($comp['brand'].' '.$comp['car_model'].' ('.$comp['year_start'].'-'.($comp['year_end']?:'present').')') ?>
                                            </div>
                                            <a href="<?= site_url('/compatibility/remove/'.$comp['id']) ?>" 
                                               class="btn btn-sm btn-outline-danger"
                                               data-confirm="Remove this compatibility?">
                                                <i class="bi bi-x"></i>
                                            </a>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="text-center py-3 text-muted">
                                    <i class="bi bi-car-front display-6"></i>
                                    <p class="mt-2 mb-0">No vehicle compatibility set</p>
                                    <small>Select car models above to add compatibility</small>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Classification & Status -->
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="mb-0">Classification</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" id="category_id" class="form-select">
                                    <option value="">-- Select Category --</option>
                                    <?php if (isset($categories)): ?>
                                        <?php foreach($categories as $c): ?>
                                        <option value="<?= $c['id'] ?>" 
                                                <?= $product['category_id'] == $c['id'] ? 'selected' : '' ?>>
                                            <?= esc($c['category_name']) ?>
                                        </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="supplier_id" class="form-label">Supplier</label>
                                <select name="supplier_id" id="supplier_id" class="form-select">
                                    <option value="">-- Select Supplier --</option>
                                    <?php if (isset($suppliers)): ?>
                                        <?php foreach($suppliers as $s): ?>
                                        <option value="<?= $s['id'] ?>" 
                                                <?= $product['supplier_id'] == $s['id'] ? 'selected' : '' ?>>
                                            <?= esc($s['supplier_name']) ?>
                                        </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="product_type" class="form-label">Product Type</label>
                                <select name="product_type" id="product_type" class="form-select">
                                    <option value="physical" <?= $product['product_type'] == 'physical' ? 'selected' : '' ?>>
                                        Physical Product
                                    </option>
                                    <option value="digital" <?= $product['product_type'] == 'digital' ? 'selected' : '' ?>>
                                        Digital Product
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product Metrics -->
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Product Metrics</h6>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6 border-end">
                                    <div class="h5 mb-0" id="totalValue">$<?= number_format($product['price'] * $product['quantity'], 2) ?></div>
                                    <small class="text-muted">Total Value</small>
                                </div>
                                <div class="col-6">
                                    <div class="h5 mb-0"><?= isset($compatibilities) ? count($compatibilities) : 0 ?></div>
                                    <small class="text-muted">Compatible Models</small>
                                </div>
                            </div>
                            <hr>
                            <div class="small text-muted">
                                <div class="d-flex justify-content-between">
                                    <span>Created:</span>
                                    <span><?= isset($product['created_at']) ? date('M d, Y', strtotime($product['created_at'])) : 'N/A' ?></span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Updated:</span>
                                    <span><?= isset($product['updated_at']) ? date('M d, Y', strtotime($product['updated_at'])) : 'N/A' ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="d-flex gap-2 justify-content-end mt-4">
                <a href="<?= site_url('/products') ?>" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Update Product
                </button>
            </div>
        </form>
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
    const quantityInput = document.getElementById('quantity');
    const priceInput = document.getElementById('price');
    
    function updateTotalValue() {
        const quantity = parseInt(quantityInput.value) || 0;
        const price = parseFloat(priceInput.value) || 0;
        const total = quantity * price;
        
        document.getElementById('totalValue').textContent = '$' + total.toFixed(2);
    }
    
    quantityInput.addEventListener('input', updateTotalValue);
    priceInput.addEventListener('input', updateTotalValue);
});
</script>

<?= $this->endSection() ?>