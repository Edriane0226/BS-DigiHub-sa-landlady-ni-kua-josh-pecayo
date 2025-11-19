<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">Add Car Model</h1>
        <p class="text-muted">Add a new vehicle model to the compatibility database</p>
    </div>
    <a href="<?= site_url('/car-models') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Models
    </a>
</div>

<!-- Form Card -->
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-car-front"></i> Vehicle Information
                </h5>
            </div>
            <div class="card-body">
                <form method="post" action="<?= site_url('/car-models/store') ?>">
                    <?= csrf_field() ?>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="brand" class="form-label required">Brand</label>
                            <input type="text" 
                                   name="brand" 
                                   id="brand"
                                   class="form-control" 
                                   placeholder="e.g., Toyota, Honda, BMW"
                                   required>
                            <div class="form-text">Enter the vehicle manufacturer name</div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="model" class="form-label required">Model</label>
                            <input type="text" 
                                   name="model" 
                                   id="model"
                                   class="form-control" 
                                   placeholder="e.g., Camry, Civic, X5"
                                   required>
                            <div class="form-text">Enter the specific model name</div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="year_start" class="form-label required">Production Start Year</label>
                            <input type="number" 
                                   name="year_start" 
                                   id="year_start"
                                   class="form-control" 
                                   placeholder="<?= date('Y') - 10 ?>"
                                   min="1900" 
                                   max="<?= date('Y') + 1 ?>"
                                   required>
                            <div class="form-text">When did production start?</div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="year_end" class="form-label">Production End Year</label>
                            <input type="number" 
                                   name="year_end" 
                                   id="year_end"
                                   class="form-control" 
                                   placeholder="Leave empty if still in production"
                                   min="1900" 
                                   max="<?= date('Y') + 10 ?>">
                            <div class="form-text">Leave blank for current models</div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="d-flex gap-2 justify-content-end mt-4">
                        <a href="<?= site_url('/car-models') ?>" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Save Model
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Help Card -->
        <div class="card mt-4">
            <div class="card-body">
                <h6 class="card-title">
                    <i class="bi bi-info-circle text-info"></i> Tips for Adding Car Models
                </h6>
                <ul class="small mb-0">
                    <li>Use consistent brand names (e.g., always use "BMW" not "bmw" or "B.M.W")</li>
                    <li>Include generation information in model names when necessary (e.g., "Civic (10th Gen)")</li>
                    <li>For current production models, leave the end year empty</li>
                    <li>Double-check production years for accuracy</li>
                </ul>
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
    // Auto-suggest functionality could be added here
    const brandInput = document.getElementById('brand');
    const modelInput = document.getElementById('model');
    const yearStartInput = document.getElementById('year_start');
    const yearEndInput = document.getElementById('year_end');
    
    // Validate that end year is not before start year
    yearEndInput.addEventListener('change', function() {
        const startYear = parseInt(yearStartInput.value);
        const endYear = parseInt(this.value);
        
        if (endYear && startYear && endYear < startYear) {
            this.setCustomValidity('End year cannot be before start year');
        } else {
            this.setCustomValidity('');
        }
    });
    
    yearStartInput.addEventListener('change', function() {
        const startYear = parseInt(this.value);
        const endYear = parseInt(yearEndInput.value);
        
        if (endYear && startYear && endYear < startYear) {
            yearEndInput.setCustomValidity('End year cannot be before start year');
        } else {
            yearEndInput.setCustomValidity('');
        }
    });
});
</script>

<?= $this->endSection() ?>