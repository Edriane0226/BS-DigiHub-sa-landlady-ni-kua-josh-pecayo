<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">Car Models</h1>
        <p class="text-muted">Manage vehicle compatibility database</p>
    </div>
    <a href="<?= site_url('/car-models/create') ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add New Model
    </a>
</div>

<!-- Models Table -->
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">
            <i class="bi bi-car-front"></i> Vehicle Models
        </h5>
    </div>
    <div class="card-body">
        <?php if (!empty($models)): ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="25%">Brand</th>
                            <th width="25%">Model</th>
                            <th width="25%">Production Years</th>
                            <th width="15%" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($models as $m): ?>
                        <tr>
                            <td>
                                <span class="badge bg-secondary"><?= $m['id'] ?></span>
                            </td>
                            <td>
                                <div class="fw-semibold"><?= esc($m['brand']) ?></div>
                            </td>
                            <td>
                                <div><?= esc($m['model']) ?></div>
                            </td>
                            <td>
                                <span class="badge bg-info">
                                    <?= $m['year_start'] ?> - <?= $m['year_end'] ?: 'Present' ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <button type="button" class="btn btn-outline-primary" title="View Details">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <a href="<?= site_url('/car-models/delete/'.$m['id']) ?>" 
                                       class="btn btn-outline-danger" 
                                       title="Delete"
                                       data-confirm="Are you sure you want to delete this car model?">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination could go here -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted small">
                    Showing <?= count($models) ?> models
                </div>
                <div>
                    <!-- Pagination controls would go here -->
                </div>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-car-front display-1 text-muted"></i>
                <h4 class="mt-3">No Car Models Found</h4>
                <p class="text-muted">Start building your vehicle compatibility database by adding car models.</p>
                <a href="<?= site_url('/car-models/create') ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Add Your First Model
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Quick Stats -->
<div class="row mt-4">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <i class="bi bi-car-front text-primary display-6"></i>
                <h4 class="mt-2"><?= count($models) ?></h4>
                <p class="text-muted small mb-0">Total Models</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <i class="bi bi-building text-success display-6"></i>
                <h4 class="mt-2"><?= count(array_unique(array_column($models, 'brand'))) ?></h4>
                <p class="text-muted small mb-0">Unique Brands</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <i class="bi bi-calendar text-info display-6"></i>
                <h4 class="mt-2"><?= count(array_filter($models, fn($m) => empty($m['year_end']))) ?></h4>
                <p class="text-muted small mb-0">Current Models</p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>