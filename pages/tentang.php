<?php 
$page_title = 'Tentang';
require '../includes/header.php'; 
?>
<div class="container py-5">
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
    
    <!-- Hero Section -->
    <section id="tentang" class="text-center">
        <div class="container mb-6">
            <h1 class="mb-6">
                Tentang
            </h1>
            <p class="mb-6">
                Dokumentasi website
            </p>
        </div>
    </section>

    <!-- Info Cards Grid -->
    <div class="row g-4 mb-5">
        <div class="col-lg-3 col-md-6">
            <div class="glass glass-hover h-100 rounded-3 border-0 shadow-sm">
                
            </div>
        </div>

    </div>

</div>
<?php
require '../includes/footer.php';
?>