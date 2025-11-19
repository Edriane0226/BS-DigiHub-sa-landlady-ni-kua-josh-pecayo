<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">Add Supplier</h1>
        <p class="text-muted">Add a new supplier to your network</p>
    </div>
    <a href="<?= site_url('/suppliers') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Suppliers
    </a>
</div>

<!-- Form Card -->
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-building"></i> Supplier Information
                </h5>
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
                
                <form method="post" action="<?= site_url('/suppliers/store') ?>" id="supplierForm">
                    <?= csrf_field() ?>
                    
                    <div class="row">
                        <!-- Company Information -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Company Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="supplier_name" class="form-label required">Supplier Name</label>
                                        <input type="text" 
                                               name="supplier_name" 
                                               id="supplier_name"
                                               class="form-control" 
                                               value="<?= old('supplier_name') ?>"
                                               placeholder="Enter company name"
                                               required>
                                        <div class="form-text">Full company or business name</div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="contact_person" class="form-label required">Contact Person</label>
                                        <input type="text" 
                                               name="contact_person" 
                                               id="contact_person"
                                               class="form-control" 
                                               value="<?= old('contact_person') ?>"
                                               placeholder="Primary contact name"
                                               required>
                                        <div class="form-text">Main point of contact</div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="address" class="form-label required">Business Address</label>
                                        <textarea name="address" 
                                                  id="address"
                                                  class="form-control" 
                                                  rows="3"
                                                  placeholder="Complete business address including city, state, zip code"
                                                  required><?= old('address') ?></textarea>
                                        <div class="form-text">Full physical address for shipping/billing</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Contact Information -->
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Contact Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label required">Phone Number</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-telephone"></i>
                                            </span>
                                            <input type="tel" 
                                                   name="phone" 
                                                   id="phone"
                                                   class="form-control" 
                                                   value="<?= old('phone') ?>"
                                                   placeholder="+1 (555) 123-4567"
                                                   required>
                                        </div>
                                        <div class="form-text">Primary business phone number</div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="email" class="form-label required">Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-envelope"></i>
                                            </span>
                                            <input type="email" 
                                                   name="email" 
                                                   id="email"
                                                   class="form-control" 
                                                   value="<?= old('email') ?>"
                                                   placeholder="contact@company.com"
                                                   required>
                                        </div>
                                        <div class="form-text">Primary business email</div>
                                    </div>
                                    
                                    <!-- Validation Status -->
                                    <div class="mt-4">
                                        <h6 class="small text-muted mb-2">Contact Validation</h6>
                                        <div class="d-flex gap-3">
                                            <div>
                                                <small class="text-muted">Phone:</small>
                                                <div id="phoneValidation">
                                                    <span class="badge bg-secondary">Not Set</span>
                                                </div>
                                            </div>
                                            <div>
                                                <small class="text-muted">Email:</small>
                                                <div id="emailValidation">
                                                    <span class="badge bg-secondary">Not Set</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="d-flex gap-2 justify-content-end mt-4">
                        <a href="<?= site_url('/suppliers') ?>" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Save Supplier
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Help Section -->
        <div class="card mt-4">
            <div class="card-body">
                <h6 class="card-title">
                    <i class="bi bi-info-circle text-info"></i> Tips for Adding Suppliers
                </h6>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="small mb-0">
                            <li>Use the complete legal business name for the supplier</li>
                            <li>Ensure contact information is current and verified</li>
                            <li>Include area codes and country codes for international suppliers</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="small mb-0">
                            <li>Double-check email addresses to avoid communication issues</li>
                            <li>Include complete addresses for accurate shipping and billing</li>
                            <li>Keep supplier information updated regularly</li>
                        </ul>
                    </div>
                </div>
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
    const phoneInput = document.getElementById('phone');
    const emailInput = document.getElementById('email');
    
    // Phone validation
    function validatePhone() {
        const phone = phoneInput.value.trim();
        const validationElement = document.getElementById('phoneValidation');
        
        if (!phone) {
            validationElement.innerHTML = '<span class="badge bg-secondary">Not Set</span>';
        } else if (phone.length < 10) {
            validationElement.innerHTML = '<span class="badge bg-danger">Too Short</span>';
        } else if (!/^[\+]?[1-9][\d]{0,15}$/.test(phone.replace(/[\s\-\(\)]/g, ''))) {
            validationElement.innerHTML = '<span class="badge bg-warning">Invalid Format</span>';
        } else {
            validationElement.innerHTML = '<span class="badge bg-success">Valid</span>';
        }
    }
    
    // Email validation
    function validateEmail() {
        const email = emailInput.value.trim();
        const validationElement = document.getElementById('emailValidation');
        
        if (!email) {
            validationElement.innerHTML = '<span class="badge bg-secondary">Not Set</span>';
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            validationElement.innerHTML = '<span class="badge bg-danger">Invalid Format</span>';
        } else {
            validationElement.innerHTML = '<span class="badge bg-success">Valid</span>';
        }
    }
    
    // Event listeners
    phoneInput.addEventListener('input', validatePhone);
    emailInput.addEventListener('input', validateEmail);
    
    // Form validation
    document.getElementById('supplierForm').addEventListener('submit', function(e) {
        const phone = phoneInput.value.trim().replace(/[\s\-\(\)]/g, '');
        const email = emailInput.value.trim();
        
        if (phone.length < 10) {
            e.preventDefault();
            alert('Please enter a valid phone number with at least 10 digits');
            phoneInput.focus();
            return;
        }
        
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            e.preventDefault();
            alert('Please enter a valid email address');
            emailInput.focus();
            return;
        }
    });
    
    // Initialize validation
    validatePhone();
    validateEmail();
});
</script>

<?= $this->endSection() ?>