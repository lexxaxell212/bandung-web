<?php 
$page_title = 'Tentang';
require '../includes/header.php'; 
?>
<div class="container">
    <style>
        .{
            transition: all 0.25s ease;
            cursor: pointer;
        }
        
        .color-swatch:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 12px 30px rgba(0,0,0,0.15) !important;
        }
        
    </style>
<!-- Container Utama -->
<div class="container-fluid px-lg-4 px-md-3 mb-6">
    
    <!-- Hero Section -->
    <section class="text-center py-10">
        <div class="container mb-6">
            <h1 class="display-3 fw-bold mb-4">
                Tentang
            </h1>
            <p class="mb-4 opacity-95">
                Dokumentasi website
            </p>
        </div>
    </section>

    <!-- Info Cards Grid -->
    <div class="row g-4 mb-5">
        <div class="col-lg-3 col-md-6">
            <div class="glass glass-hover h-100 rounded-3 border-0 shadow-sm">
                <div class="text-center p-4">
                    <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3 mx-auto" style="width: 70px; height: 70px;">
                        <i class="fas fa-font fa-2x text-white"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Typography</h5>
                    <ul class="list-unstyled text-muted small">
                        <li><i class="fas fa-check text-success me-2"></i>Oxygen Font Family</li>
                        <li><i class="fas fa-check text-success me-2"></i>Responsive Scale</li>
                        <li><i class="fas fa-check text-success me-2"></i>5 Weights</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="glass h-100 glass-hover rounded-3 border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="bg-info rounded-circle d-inline-flex align-items-center justify-content-center mb-3 mx-auto" style="width: 70px; height: 70px;">
                        <i class="fas fa-palette fa-2x text-white"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Colors</h5>
                    <ul class="list-unstyled text-muted small">
                        <li><i class="fas fa-check text-success me-2"></i>Blue 50-900</li>
                        <li><i class="fas fa-check text-success me-2"></i>Semantic Palette</li>
                        <li><i class="fas fa-check text-success me-2"></i>Neutral Grays</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="glass h-100 glass-hover rounded-3 border-0 shadow-sm">
                <div class="text-center p-4">
                    <div class="bg-success bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3 mx-auto" style="width: 70px; height: 70px;">
                        <i class="fas fa-mobile-alt fa-2x text-white"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Responsive</h5>
                    <ul class="list-unstyled text-muted small">
                        <li><i class="fas fa-check text-success me-2"></i>CSS Grid + Flexbox</li>
                        <li><i class="fas fa-check text-success me-2"></i>Mobile First</li>
                        <li><i class="fas fa-check text-success me-2"></i>Container Queries</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="glass h-100 glass-hover rounded-3 border-0 shadow-sm">
                <div class="text-center p-4">
                    <div class="bg-warning bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3 mx-auto" style="width: 70px; height: 70px;">
                        <i class="fas fa-bolt fa-2x text-white"></i>
                    </div>
                    <h5 class="fw-bold  mb-3">Performance</h5>
                    <ul class="list-unstyled text-muted small">
                        <li><i class="fas fa-check text-success me-2"></i>12KB Bundle</li>
                        <li><i class="fas fa-check text-success me-2"></i>600ms Load</li>
                        <li><i class="fas fa-check text-success me-2"></i>CLS = 0</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Color Palette -->
    <section class="mt-6 rounded-4 p-5 mb-5 shadow-lg">
        <div class="text-center mb-5 py-6">
            <h2 class="display-5 fw-bold text-primary mb-3 py-6">
                <i class="fas fa-palette me-3"></i>Color Palette
            </h2>
            <p class="text-muted">Bootstrap 5.3</p>
        </div>
        <div class="row g-3 justify-content-center">
            <div class="col-sm-6 col-lg-3">
                <div class="glass rounded-3 p-4 text-white text-center" style="background: var(--blue-900);">
                    <div class="h6 mb-0 fw-bold">#1e3a8a</div>
                    <p class="opacity-75" style="color:var(--blue-100);">Blue 900</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="glass rounded-3 p-4 text-white text-center" style="background: var(--blue-700);">
                    <div class="h6 mb-0 fw-bold">#1d4ed8</div>
                    <p class="opacity-75" style="color:var(--blue-300);">Blue 700</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="glass rounded-3 p-4 text-center" style="background: var(--blue-500);">
                    <div class=" h6 mb-0 fw-bold" style="color:var(--blue-300);">#3b82f6</div>
                    <p class="opacity-75">Blue 500</p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="glass rounded-3 p-4 text-center" style="background: var(--blue-100); color: var(--blue-700);">
                    <div class="h6 mb-0 fw-bold">#dbeafe</div>
                    <p class="opacity-75" style="color:var(--blue-900);">Blue 100</p>
                </div>
            </div>
        </div>
    </section>
</div>

</div>
<?php
require '../includes/footer.php';
?>