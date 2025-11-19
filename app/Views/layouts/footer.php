<!-- Footer -->
<footer class="bg-dark text-light mt-5">
    <div class="container py-4">
        <div class="row">
            <!-- Company Info -->
            <div class="col-md-4 mb-3">
                <h5 class="text-primary">BS DIGIHUB</h5>
                <p class="small">Your trusted partner for automotive parts and accessories. Quality products, competitive prices, and excellent customer service.</p>
                <div class="d-flex gap-2">
                    <a href="#" class="text-light"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="col-md-4 mb-3">
                <h6>Quick Links</h6>
                <ul class="list-unstyled">
                    <li><a href="<?= base_url() ?>" class="text-light text-decoration-none small">Home</a></li>
                    <li><a href="<?= base_url('dashboard') ?>" class="text-light text-decoration-none small">Dashboard</a></li>
                    <li><a href="<?= base_url('products') ?>" class="text-light text-decoration-none small">Products</a></li>
                    <li><a href="<?= base_url('car-models') ?>" class="text-light text-decoration-none small">Car Models</a></li>
                </ul>
            </div>
            
            <!-- Contact Info -->
            <div class="col-md-4 mb-3">
                <h6>Contact Information</h6>
                <div class="small">
                    <div class="mb-1">
                        <i class="bi bi-envelope"></i>
                        <a href="mailto:info@bsdigihub.com" class="text-light text-decoration-none">info@bsdigihub.com</a>
                    </div>
                    <div class="mb-1">
                        <i class="bi bi-telephone"></i>
                        <span>+1 (555) 123-4567</span>
                    </div>
                    <div>
                        <i class="bi bi-geo-alt"></i>
                        <span>123 Business Ave, Tech City, TC 12345</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Copyright -->
        <hr class="border-secondary">
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="small mb-0">&copy; <?= date('Y') ?> BS DIGIHUB. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <span class="small text-muted">Powered by CodeIgniter 4</span>
            </div>
        </div>
    </div>
</footer>