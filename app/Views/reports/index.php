<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">Reports & Analytics</h1>
        <p class="text-muted">Business intelligence and data insights for BS DIGIHUB</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-secondary btn-sm" onclick="refreshReports()">
            <i class="bi bi-arrow-clockwise"></i> Refresh
        </button>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="bi bi-download"></i> Export Reports
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= site_url('/reports/export/inventory') ?>">
                    <i class="bi bi-file-earmark-text"></i> Inventory Report
                </a></li>
                <li><a class="dropdown-item" href="<?= site_url('/reports/export/suppliers') ?>">
                    <i class="bi bi-file-earmark-text"></i> Suppliers Report
                </a></li>
                <li><a class="dropdown-item" href="<?= site_url('/reports/export/compatibility') ?>">
                    <i class="bi bi-file-earmark-text"></i> Compatibility Report
                </a></li>
            </ul>
        </div>
    </div>
</div>

<!-- Quick Stats Dashboard -->
<div class="row mb-5">
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card bg-gradient bg-primary text-white h-100">
            <div class="card-body d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="h2 mb-0" id="totalProducts">-</div>
                    <div class="small">Total Products</div>
                </div>
                <div class="ms-3">
                    <i class="bi bi-box-seam display-4"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card bg-gradient bg-success text-white h-100">
            <div class="card-body d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="h2 mb-0" id="totalSuppliers">-</div>
                    <div class="small">Active Suppliers</div>
                </div>
                <div class="ms-3">
                    <i class="bi bi-people display-4"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card bg-gradient bg-info text-white h-100">
            <div class="card-body d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="h2 mb-0" id="totalValue">$-</div>
                    <div class="small">Inventory Value</div>
                </div>
                <div class="ms-3">
                    <i class="bi bi-currency-dollar display-4"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card bg-gradient bg-warning text-white h-100">
            <div class="card-body d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="h2 mb-0" id="carModels">-</div>
                    <div class="small">Car Models</div>
                </div>
                <div class="ms-3">
                    <i class="bi bi-car-front display-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Report Categories -->
<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body text-center p-4">
                <div class="bg-primary bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center text-white mb-3"
                     style="width: 80px; height: 80px;">
                    <i class="bi bi-clipboard-data display-5"></i>
                </div>
                <h5 class="card-title">Inventory Report</h5>
                <p class="card-text text-muted">Comprehensive inventory analysis including stock levels, product values, category breakdown, and low stock alerts.</p>
                <div class="mt-auto">
                    <a href="<?= site_url('/reports/inventory') ?>" class="btn btn-primary">
                        <i class="bi bi-graph-up"></i> View Report
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 mb-4">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body text-center p-4">
                <div class="bg-success bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center text-white mb-3"
                     style="width: 80px; height: 80px;">
                    <i class="bi bi-building display-5"></i>
                </div>
                <h5 class="card-title">Suppliers Report</h5>
                <p class="card-text text-muted">Detailed supplier performance metrics, product contributions, contact information, and relationship management data.</p>
                <div class="mt-auto">
                    <a href="<?= site_url('/reports/suppliers') ?>" class="btn btn-success">
                        <i class="bi bi-people"></i> View Report
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 mb-4">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body text-center p-4">
                <div class="bg-info bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center text-white mb-3"
                     style="width: 80px; height: 80px;">
                    <i class="bi bi-diagram-3 display-5"></i>
                </div>
                <h5 class="card-title">Compatibility Report</h5>
                <p class="card-text text-muted">Vehicle compatibility analysis showing product coverage across different car models and identification of gaps.</p>
                <div class="mt-auto">
                    <a href="<?= site_url('/reports/compatibility') ?>" class="btn btn-info">
                        <i class="bi bi-car-front"></i> View Report
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Insights -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bi bi-exclamation-triangle text-warning"></i> Inventory Alerts
                </h6>
            </div>
            <div class="card-body">
                <div id="inventoryAlerts" class="list-group list-group-flush">
                    <div class="text-center py-3">
                        <div class="spinner-border spinner-border-sm" role="status"></div>
                        <span class="ms-2">Loading alerts...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bi bi-graph-up text-success"></i> Top Performing Categories
                </h6>
            </div>
            <div class="card-body">
                <div id="topCategories">
                    <div class="text-center py-3">
                        <div class="spinner-border spinner-border-sm" role="status"></div>
                        <span class="ms-2">Loading data...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart Section -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="bi bi-bar-chart"></i> Business Overview
                </h6>
            </div>
            <div class="card-body">
                <canvas id="businessChart" width="400" height="100"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
function refreshReports() {
    location.reload();
}

// Load dashboard data
document.addEventListener('DOMContentLoaded', function() {
    loadDashboardData();
    loadInventoryAlerts();
    loadTopCategories();
    initializeChart();
});

async function loadDashboardData() {
    try {
        // Simulate API calls with actual data fetching
        // In a real implementation, these would be AJAX calls to your backend
        
        // Mock data for demonstration
        setTimeout(() => {
            document.getElementById('totalProducts').textContent = '127';
            document.getElementById('totalSuppliers').textContent = '23';
            document.getElementById('totalValue').textContent = '$45,230';
            document.getElementById('carModels').textContent = '89';
        }, 500);
        
    } catch (error) {
        console.error('Error loading dashboard data:', error);
    }
}

function loadInventoryAlerts() {
    setTimeout(() => {
        const alertsContainer = document.getElementById('inventoryAlerts');
        alertsContainer.innerHTML = `
            <div class="list-group-item d-flex justify-content-between align-items-center border-0">
                <div>
                    <i class="bi bi-exclamation-circle text-danger me-2"></i>
                    <strong>5 items</strong> are out of stock
                </div>
                <span class="badge bg-danger">Critical</span>
            </div>
            <div class="list-group-item d-flex justify-content-between align-items-center border-0">
                <div>
                    <i class="bi bi-exclamation-triangle text-warning me-2"></i>
                    <strong>12 items</strong> have low stock
                </div>
                <span class="badge bg-warning">Warning</span>
            </div>
            <div class="list-group-item d-flex justify-content-between align-items-center border-0">
                <div>
                    <i class="bi bi-info-circle text-info me-2"></i>
                    <strong>110 items</strong> are well stocked
                </div>
                <span class="badge bg-success">Good</span>
            </div>
        `;
    }, 800);
}

function loadTopCategories() {
    setTimeout(() => {
        const categoriesContainer = document.getElementById('topCategories');
        categoriesContainer.innerHTML = `
            <div class="row small">
                <div class="col-6 mb-2">
                    <div class="d-flex justify-content-between">
                        <span>Brake Parts</span>
                        <strong>$12,450</strong>
                    </div>
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-success" style="width: 85%"></div>
                    </div>
                </div>
                <div class="col-6 mb-2">
                    <div class="d-flex justify-content-between">
                        <span>Engine Parts</span>
                        <strong>$8,920</strong>
                    </div>
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-info" style="width: 65%"></div>
                    </div>
                </div>
                <div class="col-6 mb-2">
                    <div class="d-flex justify-content-between">
                        <span>Filters</span>
                        <strong>$6,780</strong>
                    </div>
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-warning" style="width: 45%"></div>
                    </div>
                </div>
                <div class="col-6 mb-2">
                    <div class="d-flex justify-content-between">
                        <span>Electronics</span>
                        <strong>$4,320</strong>
                    </div>
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-primary" style="width: 30%"></div>
                    </div>
                </div>
            </div>
        `;
    }, 1200);
}

function initializeChart() {
    // Simple chart using Chart.js would go here
    // For now, we'll just show a placeholder
    setTimeout(() => {
        const canvas = document.getElementById('businessChart');
        const ctx = canvas.getContext('2d');
        
        // Simple bar chart representation
        ctx.fillStyle = '#0d6efd';
        ctx.fillRect(50, 50, 30, 100);
        ctx.fillRect(100, 80, 30, 70);
        ctx.fillRect(150, 30, 30, 120);
        ctx.fillRect(200, 70, 30, 80);
        ctx.fillRect(250, 40, 30, 110);
        
        ctx.fillStyle = '#333';
        ctx.font = '12px Arial';
        ctx.textAlign = 'center';
        ctx.fillText('Products', 65, 170);
        ctx.fillText('Suppliers', 115, 170);
        ctx.fillText('Revenue', 165, 170);
        ctx.fillText('Orders', 215, 170);
        ctx.fillText('Growth', 265, 170);
    }, 1500);
}
</script>

<?= $this->endSection() ?>