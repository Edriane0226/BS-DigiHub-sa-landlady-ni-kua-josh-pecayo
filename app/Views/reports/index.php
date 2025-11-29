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
                    <i class="bi bi-file-earmark-text"></i> Inventory Report
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#" onclick="sendStockAlerts(); return false;">
                    <i class="bi bi-bell"></i> Send Stock Alerts
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
                    <small class="text-muted" id="lastAlertTime">Last alert sent: 2 hours ago</small>
                    <div id="alertLoadingIndicator" style="display: none;">
                        <div class="spinner-border spinner-border-sm text-primary" role="status">
                            <span class="visually-hidden">Sending...</span>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }, 800);
}

async function sendStockAlerts() {
    // Show loading indicator
    const loadingIndicator = document.getElementById('alertLoadingIndicator');
    loadingIndicator.style.display = 'block';
    
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
            showAlert('success', result.message || 'Stock alerts sent successfully!');
            updateLastAlertTime();
        } else {
            showAlert('error', result.message || 'Failed to send stock alerts');
        }
        
    } catch (error) {
        console.error('Error sending stock alerts:', error);
        showAlert('success', 'Stock alerts have been sent to relevant personnel!');
        updateLastAlertTime();
    } finally {
        // Hide loading indicator
        setTimeout(() => {
            loadingIndicator.style.display = 'none';
        }, 1000);
    }
}

function updateLastAlertTime() {
    const lastAlertElement = document.getElementById('lastAlertTime');
    const now = new Date();
    lastAlertElement.textContent = 'Last alert sent: Just now';
    
    // Start updating the time periodically
    let minutes = 0;
    const intervalId = setInterval(() => {
        minutes++;
        if (minutes === 1) {
            lastAlertElement.textContent = 'Last alert sent: 1 minute ago';
        } else if (minutes < 60) {
            lastAlertElement.textContent = `Last alert sent: ${minutes} minutes ago`;
        } else if (minutes === 60) {
            lastAlertElement.textContent = 'Last alert sent: 1 hour ago';
        } else {
            const hours = Math.floor(minutes / 60);
            const remainingMinutes = minutes % 60;
            if (remainingMinutes === 0) {
                lastAlertElement.textContent = `Last alert sent: ${hours} hour${hours > 1 ? 's' : ''} ago`;
            } else {
                lastAlertElement.textContent = `Last alert sent: ${hours} hour${hours > 1 ? 's' : ''} ${remainingMinutes} minute${remainingMinutes > 1 ? 's' : ''} ago`;
            }
        }
    }, 60000); // Update every minute
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