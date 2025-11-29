<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">Reports</h1>
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
                    </i> Inventory Report
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" onclick="sendStockAlerts()"">
                    Send Stock Alerts
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Quick Stats Dashboard -->
<div class="row mb-5">
    <div class="col-lg-4 col-md-6 mb-3">
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
    
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="card bg-gradient bg-info text-white h-100">
            <div class="card-body d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="h2 mb-0" id="totalValue">₱-</div>
                    <div class="small">Inventory Value</div>
                </div>
                <div class="ms-3">
                    <i class="bi bi-cash-coin display-4"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="card bg-gradient bg-success text-white h-100">
            <div class="card-body d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="h2 mb-0" id="totalSales">₱-</div>
                    <div class="small">Total Sales</div>
                </div>
                <div class="ms-3">
                    <i class="bi bi-graph-up display-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>
    
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-exclamation-triangle text-warning"></i> Inventory Alerts & Notifications
                </h5>
            </div>
            <div class="card-body">
                <div id="inventoryAlerts" class="list-group list-group-flush">
                    <div class="text-center py-4">
                        <div class="spinner-border spinner-border-sm" role="status"></div>
                        <span class="ms-2">Loading inventory alerts...</span>
                    </div>
                </div>
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
});

async function loadDashboardData() {
    try {
        // Simulate API calls with actual data fetching
        // In a real implementation, these would be AJAX calls to your backend
        
        // Mock data for demonstration
        setTimeout(() => {
            document.getElementById('totalProducts').textContent = '127';
            document.getElementById('totalValue').textContent = '₱45,230';
            document.getElementById('totalSales').textContent = '₱128,450';
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
            <div class="list-group-item border-0 pt-3">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">Last alert sent: 2 hours ago</small>
                </div>
            </div>
        `;
    }, 800);
}

async function sendStockAlerts() {
    const alertBtn = document.getElementById('alertBtn');
    const originalText = alertBtn.innerHTML;
    
    // Show loading state
    alertBtn.disabled = true;
    alertBtn.innerHTML = '<i class="spinner-border spinner-border-sm me-2"></i>Sending...';
    
    try {
        const response = await fetch('<?= site_url('/reports/send-alerts') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            // Show success message
            showAlert('success', result.message);
            
            // Update the alert display
            setTimeout(() => {
                loadInventoryAlerts();
            }, 1000);
        } else {
            showAlert('error', result.message || 'Failed to send stock alerts');
        }
        
    } catch (error) {
        console.error('Error sending stock alerts:', error);
        showAlert('error', 'Network error occurred while sending alerts');
    } finally {
        // Reset button
        alertBtn.disabled = false;
        alertBtn.innerHTML = originalText;
    }
}

function showAlert(type, message) {
    // Create alert element
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show position-fixed`;
    alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 1050; min-width: 300px;';
    alertDiv.innerHTML = `
        <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-triangle'}"></i>
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    // Add to page
    document.body.appendChild(alertDiv);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.remove();
        }
    }, 5000);
}
</script>

<?= $this->endSection() ?>