<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Suppliers Report - BS DIGIHUB<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .report-header {
        background: linear-gradient(135deg, #17a2b8 0%, #007bff 100%);
        color: white;
        padding: 30px 0;
        margin-bottom: 30px;
    }
    
    .report-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border-left: 4px solid #17a2b8;
    }
    
    .report-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }
    
    .metric-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
    }
    
    .supplier-table {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .status-active {
        background: #28a745;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }
    
    .status-inactive {
        background: #dc3545;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }
    
    .rating-stars {
        color: #ffc107;
    }
    
    .chart-container {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Report Header -->
<div class="report-header text-center">
    <div class="container">
        <h1 class="mb-2"><i class="fas fa-truck me-2"></i>Suppliers Report</h1>
        <p class="mb-0">Comprehensive analysis of supplier performance and metrics</p>
    </div>
</div>

<div class="container-fluid">
    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card report-card">
                <div class="card-body d-flex align-items-center">
                    <div class="metric-icon bg-primary me-3">
                        <i class="fas fa-truck"></i>
                    </div>
                    <div>
                        <h6 class="card-title text-muted mb-1">Total Suppliers</h6>
                        <h3 class="mb-0"><?= $totalSuppliers ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card report-card">
                <div class="card-body d-flex align-items-center">
                    <div class="metric-icon bg-success me-3">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <h6 class="card-title text-muted mb-1">Active Suppliers</h6>
                        <h3 class="mb-0"><?= $activeSuppliers ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card report-card">
                <div class="card-body d-flex align-items-center">
                    <div class="metric-icon bg-warning me-3">
                        <i class="fas fa-star"></i>
                    </div>
                    <div>
                        <h6 class="card-title text-muted mb-1">Average Rating</h6>
                        <h3 class="mb-0"><?= number_format($averageRating ?? 0, 1) ?></h3>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card report-card">
                <div class="card-body d-flex align-items-center">
                    <div class="metric-icon bg-info me-3">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div>
                        <h6 class="card-title text-muted mb-1">Total Products</h6>
                        <h3 class="mb-0"><?= $totalProducts ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Charts Row -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="chart-container">
                <h5 class="mb-3"><i class="fas fa-chart-doughnut me-2"></i>Suppliers by Status</h5>
                <canvas id="suppliersStatusChart" height="300"></canvas>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="chart-container">
                <h5 class="mb-3"><i class="fas fa-chart-bar me-2"></i>Products per Supplier</h5>
                <canvas id="productsPerSupplierChart" height="300"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Detailed Suppliers Table -->
    <div class="card supplier-table">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-table me-2"></i>Detailed Suppliers List</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Supplier Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Products</th>
                            <th>Rating</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($suppliers) && !empty($suppliers)): ?>
                            <?php foreach ($suppliers as $supplier): ?>
                                <tr>
                                    <td>
                                        <strong><?= esc($supplier['name']) ?></strong>
                                        <?php if (!empty($supplier['code'])): ?>
                                            <br><small class="text-muted"><?= esc($supplier['code']) ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?= esc($supplier['contact_person'] ?? '-') ?>
                                        <?php if (!empty($supplier['phone'])): ?>
                                            <br><small class="text-muted"><?= esc($supplier['phone']) ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($supplier['email'])): ?>
                                            <a href="mailto:<?= esc($supplier['email']) ?>"><?= esc($supplier['email']) ?></a>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-info"><?= $supplier['product_count'] ?? 0 ?></span>
                                    </td>
                                    <td>
                                        <div class="rating-stars">
                                            <?php 
                                            $rating = $supplier['rating'] ?? 0;
                                            for ($i = 1; $i <= 5; $i++): 
                                            ?>
                                                <i class="fas fa-star<?= $i <= $rating ? '' : '-o' ?>"></i>
                                            <?php endfor; ?>
                                        </div>
                                        <small class="text-muted"><?= number_format($rating, 1) ?></small>
                                    </td>
                                    <td>
                                        <span class="status-<?= $supplier['status'] === 'active' ? 'active' : 'inactive' ?>">
                                            <?= ucfirst($supplier['status'] ?? 'inactive') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="<?= base_url('suppliers/view/' . $supplier['id']) ?>" 
                                               class="btn btn-outline-primary btn-sm" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?= base_url('suppliers/edit/' . $supplier['id']) ?>" 
                                               class="btn btn-outline-secondary btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <i class="fas fa-info-circle text-muted me-2"></i>
                                    No suppliers found.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Performance Analysis -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card report-card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-trophy me-2"></i>Top Performing Suppliers</h5>
                </div>
                <div class="card-body">
                    <?php if (isset($topSuppliers) && !empty($topSuppliers)): ?>
                        <?php foreach ($topSuppliers as $index => $supplier): ?>
                            <div class="d-flex justify-content-between align-items-center py-2 <?= $index < count($topSuppliers) - 1 ? 'border-bottom' : '' ?>">
                                <div>
                                    <strong><?= esc($supplier['name']) ?></strong>
                                    <br><small class="text-muted"><?= $supplier['product_count'] ?? 0 ?> products</small>
                                </div>
                                <div class="text-end">
                                    <div class="rating-stars">
                                        <?php 
                                        $rating = $supplier['rating'] ?? 0;
                                        for ($i = 1; $i <= 5; $i++): 
                                        ?>
                                            <i class="fas fa-star<?= $i <= $rating ? '' : '-o' ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <small class="text-muted"><?= number_format($rating, 1) ?></small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted text-center mb-0">No supplier data available for analysis.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card report-card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Suppliers Requiring Attention</h5>
                </div>
                <div class="card-body">
                    <?php if (isset($lowPerformingSuppliers) && !empty($lowPerformingSuppliers)): ?>
                        <?php foreach ($lowPerformingSuppliers as $index => $supplier): ?>
                            <div class="d-flex justify-content-between align-items-center py-2 <?= $index < count($lowPerformingSuppliers) - 1 ? 'border-bottom' : '' ?>">
                                <div>
                                    <strong><?= esc($supplier['name']) ?></strong>
                                    <br><small class="text-muted">
                                        <?php if ($supplier['status'] !== 'active'): ?>
                                            Inactive status
                                        <?php elseif (($supplier['rating'] ?? 0) < 3): ?>
                                            Low rating: <?= number_format($supplier['rating'] ?? 0, 1) ?>
                                        <?php else: ?>
                                            Needs review
                                        <?php endif; ?>
                                    </small>
                                </div>
                                <div>
                                    <a href="<?= base_url('suppliers/edit/' . $supplier['id']) ?>" 
                                       class="btn btn-outline-warning btn-sm">
                                        <i class="fas fa-edit"></i> Review
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center text-success">
                            <i class="fas fa-check-circle fa-3x mb-3"></i>
                            <p class="mb-0">All suppliers are performing well!</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Export Options -->
    <div class="row mt-4 mb-4">
        <div class="col-12 text-center">
            <div class="btn-group">
                <a href="<?= base_url('reports/suppliers?export=pdf') ?>" class="btn btn-danger">
                    <i class="fas fa-file-pdf me-2"></i>Export PDF
                </a>
                <a href="<?= base_url('reports/suppliers?export=excel') ?>" class="btn btn-success">
                    <i class="fas fa-file-excel me-2"></i>Export Excel
                </a>
                <a href="<?= base_url('reports/suppliers?export=csv') ?>" class="btn btn-info">
                    <i class="fas fa-file-csv me-2"></i>Export CSV
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Suppliers Status Chart
const suppliersStatusCtx = document.getElementById('suppliersStatusChart').getContext('2d');
new Chart(suppliersStatusCtx, {
    type: 'doughnut',
    data: {
        labels: ['Active', 'Inactive'],
        datasets: [{
            data: [<?= $activeSuppliers ?? 0 ?>, <?= ($totalSuppliers ?? 0) - ($activeSuppliers ?? 0) ?>],
            backgroundColor: ['#28a745', '#dc3545'],
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 20,
                    usePointStyle: true
                }
            }
        }
    }
});

// Products per Supplier Chart
const productsPerSupplierCtx = document.getElementById('productsPerSupplierChart').getContext('2d');
new Chart(productsPerSupplierCtx, {
    type: 'bar',
    data: {
        labels: [
            <?php if (isset($suppliers)): ?>
                <?php foreach (array_slice($suppliers, 0, 10) as $supplier): ?>
                    '<?= addslashes(esc($supplier['name'])) ?>',
                <?php endforeach; ?>
            <?php endif; ?>
        ],
        datasets: [{
            label: 'Products Count',
            data: [
                <?php if (isset($suppliers)): ?>
                    <?php foreach (array_slice($suppliers, 0, 10) as $supplier): ?>
                        <?= $supplier['product_count'] ?? 0 ?>,
                    <?php endforeach; ?>
                <?php endif; ?>
            ],
            backgroundColor: 'rgba(23, 162, 184, 0.8)',
            borderColor: 'rgba(23, 162, 184, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            },
            x: {
                ticks: {
                    maxRotation: 45,
                    minRotation: 45
                }
            }
        }
    }
});
</script>
<?= $this->endSection() ?>