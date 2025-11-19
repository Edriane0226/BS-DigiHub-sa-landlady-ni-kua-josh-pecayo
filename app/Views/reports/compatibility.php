<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Compatibility Report - BS DIGIHUB<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .report-header {
        background: linear-gradient(135deg, #6f42c1 0%, #007bff 100%);
        color: white;
        padding: 30px 0;
        margin-bottom: 30px;
    }
    
    .report-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border-left: 4px solid #6f42c1;
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
    
    .compatibility-table {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .compatibility-score {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        color: white;
    }
    
    .score-high {
        background: #28a745;
    }
    
    .score-medium {
        background: #ffc107;
        color: #212529;
    }
    
    .score-low {
        background: #dc3545;
    }
    
    .chart-container {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }
    
    .brand-badge {
        background: #17a2b8;
        color: white;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 500;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Report Header -->
<div class="report-header text-center">
    <div class="container">
        <h1 class="mb-2"><i class="fas fa-puzzle-piece me-2"></i>Compatibility Report</h1>
        <p class="mb-0">Product and vehicle compatibility analysis</p>
    </div>
</div>

<div class="container-fluid">
    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card report-card">
                <div class="card-body d-flex align-items-center">
                    <div class="metric-icon bg-primary me-3">
                        <i class="fas fa-link"></i>
                    </div>
                    <div>
                        <h6 class="card-title text-muted mb-1">Total Compatibilities</h6>
                        <h3 class="mb-0"><?= $totalCompatibilities ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card report-card">
                <div class="card-body d-flex align-items-center">
                    <div class="metric-icon bg-success me-3">
                        <i class="fas fa-car"></i>
                    </div>
                    <div>
                        <h6 class="card-title text-muted mb-1">Car Models Covered</h6>
                        <h3 class="mb-0"><?= $totalCarModels ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card report-card">
                <div class="card-body d-flex align-items-center">
                    <div class="metric-icon bg-warning me-3">
                        <i class="fas fa-percentage"></i>
                    </div>
                    <div>
                        <h6 class="card-title text-muted mb-1">Compatibility Rate</h6>
                        <h3 class="mb-0"><?= number_format($compatibilityRate ?? 0, 1) ?>%</h3>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card report-card">
                <div class="card-body d-flex align-items-center">
                    <div class="metric-icon bg-info me-3">
                        <i class="fas fa-cog"></i>
                    </div>
                    <div>
                        <h6 class="card-title text-muted mb-1">Compatible Products</h6>
                        <h3 class="mb-0"><?= $compatibleProducts ?? 0 ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Charts Row -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="chart-container">
                <h5 class="mb-3"><i class="fas fa-chart-pie me-2"></i>Compatibility by Car Brand</h5>
                <canvas id="compatibilityByBrandChart" height="300"></canvas>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="chart-container">
                <h5 class="mb-3"><i class="fas fa-chart-line me-2"></i>Compatibility Trends</h5>
                <canvas id="compatibilityTrendsChart" height="300"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Compatibility Matrix -->
    <div class="card compatibility-table mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-table me-2"></i>Product Compatibility Matrix</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Compatible Models</th>
                            <th>Compatibility Score</th>
                            <th>Year Range</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($compatibilityMatrix) && !empty($compatibilityMatrix)): ?>
                            <?php foreach ($compatibilityMatrix as $item): ?>
                                <tr>
                                    <td>
                                        <strong><?= esc($item['product_name']) ?></strong>
                                        <br><small class="text-muted"><?= esc($item['product_code']) ?></small>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary"><?= esc($item['category_name']) ?></span>
                                    </td>
                                    <td>
                                        <?php if (!empty($item['compatible_models'])): ?>
                                            <?php foreach (explode(',', $item['compatible_models']) as $model): ?>
                                                <span class="brand-badge me-1"><?= esc(trim($model)) ?></span>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <span class="text-muted">No compatibility data</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php 
                                        $score = $item['compatibility_score'] ?? 0;
                                        $scoreClass = 'score-low';
                                        if ($score >= 80) $scoreClass = 'score-high';
                                        elseif ($score >= 60) $scoreClass = 'score-medium';
                                        ?>
                                        <span class="compatibility-score <?= $scoreClass ?>">
                                            <?= $score ?>%
                                        </span>
                                    </td>
                                    <td>
                                        <?php if (!empty($item['year_from']) || !empty($item['year_to'])): ?>
                                            <?= $item['year_from'] ?? 'N/A' ?> - <?= $item['year_to'] ?? 'Present' ?>
                                        <?php else: ?>
                                            <span class="text-muted">Not specified</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="<?= base_url('products/view/' . $item['product_id']) ?>" 
                                               class="btn btn-outline-primary btn-sm" title="View Product">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?= base_url('products/compatibility/' . $item['product_id']) ?>" 
                                               class="btn btn-outline-secondary btn-sm" title="Edit Compatibility">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="fas fa-info-circle text-muted me-2"></i>
                                    No compatibility data found.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Analysis Section -->
    <div class="row">
        <div class="col-md-4">
            <div class="card report-card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-thumbs-up me-2"></i>Most Compatible Products</h5>
                </div>
                <div class="card-body">
                    <?php if (isset($mostCompatibleProducts) && !empty($mostCompatibleProducts)): ?>
                        <?php foreach ($mostCompatibleProducts as $index => $product): ?>
                            <div class="d-flex justify-content-between align-items-center py-2 <?= $index < count($mostCompatibleProducts) - 1 ? 'border-bottom' : '' ?>">
                                <div>
                                    <strong><?= esc($product['name']) ?></strong>
                                    <br><small class="text-muted"><?= esc($product['category']) ?></small>
                                </div>
                                <div class="text-end">
                                    <span class="compatibility-score score-high">
                                        <?= $product['compatibility_score'] ?? 0 ?>%
                                    </span>
                                    <br><small class="text-muted"><?= $product['model_count'] ?? 0 ?> models</small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted text-center mb-0">No compatibility data available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card report-card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Limited Compatibility</h5>
                </div>
                <div class="card-body">
                    <?php if (isset($limitedCompatibilityProducts) && !empty($limitedCompatibilityProducts)): ?>
                        <?php foreach ($limitedCompatibilityProducts as $index => $product): ?>
                            <div class="d-flex justify-content-between align-items-center py-2 <?= $index < count($limitedCompatibilityProducts) - 1 ? 'border-bottom' : '' ?>">
                                <div>
                                    <strong><?= esc($product['name']) ?></strong>
                                    <br><small class="text-muted"><?= esc($product['category']) ?></small>
                                </div>
                                <div class="text-end">
                                    <span class="compatibility-score score-low">
                                        <?= $product['compatibility_score'] ?? 0 ?>%
                                    </span>
                                    <br><small class="text-muted"><?= $product['model_count'] ?? 0 ?> models</small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center text-success">
                            <i class="fas fa-check-circle fa-2x mb-2"></i>
                            <p class="mb-0">All products have good compatibility!</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card report-card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-car me-2"></i>Popular Car Models</h5>
                </div>
                <div class="card-body">
                    <?php if (isset($popularCarModels) && !empty($popularCarModels)): ?>
                        <?php foreach ($popularCarModels as $index => $model): ?>
                            <div class="d-flex justify-content-between align-items-center py-2 <?= $index < count($popularCarModels) - 1 ? 'border-bottom' : '' ?>">
                                <div>
                                    <strong><?= esc($model['brand']) ?> <?= esc($model['model']) ?></strong>
                                    <br><small class="text-muted"><?= esc($model['year']) ?></small>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-info"><?= $model['product_count'] ?? 0 ?></span>
                                    <br><small class="text-muted">products</small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted text-center mb-0">No car model data available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recommendations -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card report-card">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0"><i class="fas fa-lightbulb me-2"></i>Compatibility Recommendations</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-success"><i class="fas fa-plus-circle me-2"></i>Opportunities</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-arrow-right text-primary me-2"></i>
                                    Expand compatibility for products with low coverage
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-arrow-right text-primary me-2"></i>
                                    Focus on popular car models with limited product options
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-arrow-right text-primary me-2"></i>
                                    Update year ranges for newer vehicle models
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-arrow-right text-primary me-2"></i>
                                    Add compatibility data for products missing information
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-warning"><i class="fas fa-exclamation-circle me-2"></i>Action Items</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-check text-warning me-2"></i>
                                    Review products with compatibility score below 60%
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-warning me-2"></i>
                                    Verify compatibility data accuracy for top-selling items
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-warning me-2"></i>
                                    Update vehicle year ranges quarterly
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-warning me-2"></i>
                                    Standardize compatibility data entry procedures
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Export Options -->
    <div class="row mt-4 mb-4">
        <div class="col-12 text-center">
            <div class="btn-group">
                <a href="<?= base_url('reports/compatibility?export=pdf') ?>" class="btn btn-danger">
                    <i class="fas fa-file-pdf me-2"></i>Export PDF
                </a>
                <a href="<?= base_url('reports/compatibility?export=excel') ?>" class="btn btn-success">
                    <i class="fas fa-file-excel me-2"></i>Export Excel
                </a>
                <a href="<?= base_url('reports/compatibility?export=csv') ?>" class="btn btn-info">
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
// Compatibility by Brand Chart
const compatibilityByBrandCtx = document.getElementById('compatibilityByBrandChart').getContext('2d');
new Chart(compatibilityByBrandCtx, {
    type: 'pie',
    data: {
        labels: [
            <?php if (isset($brandCompatibility)): ?>
                <?php foreach ($brandCompatibility as $brand): ?>
                    '<?= addslashes(esc($brand['brand'])) ?>',
                <?php endforeach; ?>
            <?php endif; ?>
        ],
        datasets: [{
            data: [
                <?php if (isset($brandCompatibility)): ?>
                    <?php foreach ($brandCompatibility as $brand): ?>
                        <?= $brand['count'] ?? 0 ?>,
                    <?php endforeach; ?>
                <?php endif; ?>
            ],
            backgroundColor: [
                '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', 
                '#9966FF', '#FF9F40', '#FF6384', '#C9CBCF'
            ],
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

// Compatibility Trends Chart
const compatibilityTrendsCtx = document.getElementById('compatibilityTrendsChart').getContext('2d');
new Chart(compatibilityTrendsCtx, {
    type: 'line',
    data: {
        labels: ['2018', '2019', '2020', '2021', '2022', '2023', '2024'],
        datasets: [{
            label: 'Compatibility Entries',
            data: [
                <?php if (isset($compatibilityTrends)): ?>
                    <?php foreach ($compatibilityTrends as $trend): ?>
                        <?= $trend['count'] ?? 0 ?>,
                    <?php endforeach; ?>
                <?php else: ?>
                    0, 5, 12, 25, 45, 78, <?= $totalCompatibilities ?? 0 ?>
                <?php endif; ?>
            ],
            borderColor: '#6f42c1',
            backgroundColor: 'rgba(111, 66, 193, 0.1)',
            tension: 0.4,
            fill: true
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
            }
        }
    }
});
</script>
<?= $this->endSection() ?>