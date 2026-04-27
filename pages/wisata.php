<?php 
$page_title = 'Wisata';
require '../includes/header.php'; 
?>

<div class="container">
   <style>
     .badge-price {
       color: var(--blue-700);
     }
   </style>
      <!-- Container -->
      <div class="container">

        <!-- Hero Section -->
        <section class="text-center rounded-4 overflow-hidden py-6 position-relative">
          <div class="row align-items-center">
            <div class="col-lg-8 mx-auto">
              <h1 class="display-4 font-bold mb-6 mt-6">
                <i class="fas fa-mountain-sun me-3"></i>
                Wisata Bandung
              </h1>
              <p class="mb-6 mt-6">
                Temukan destinasi wisata alam, kuliner, dan budaya terbaik di Kota Kembang
              </p>
              
          </div>
        </section>

        <!-- Filter Categories -->
        <div class="d-flex flex-wrap gap-2 justify-content-center mb-6 mt-6 p-3">
          <button class="btn btn-outline-primary rounded-pill px-4 py-2 font-semibold category-btn active" data-category="all">
            <i class="fas fa-th me-2"></i>Semua
          </button>
          <button class="btn btn-outline-primary rounded-pill px-4 py-2 font-semibold category-btn" data-category="alam">
            <i class="fas fa-mountain me-2"></i>Alam
          </button>
          <button class="btn btn-outline-primary rounded-pill px-4 py-2 font-semibold category-btn" data-category="kuliner">
            <i class="fas fa-utensils me-2"></i>Kuliner
          </button>
          <button class="btn btn-outline-primary rounded-pill px-4 py-2 font-semibold category-btn" data-category="outdoor">
            <i class="fas fa-compass me-2"></i>Outdoor
          </button>
          <button class="btn btn-outline-primary rounded-pill px-4 py-2 font-semibold category-btn" data-category="indoor">
            <i class="fas fa-building me-2"></i>Indoor
          </button>
        </div>

        <!-- Wisata Cards Grid -->
        <div class="row g-4 mb-5" id="wisata-grid">
          <!-- Farmhouse Lembang -->
          <div class="col-xl-3 col-lg-4 col-md-6 wisata-item" data-category="alam outdoor">
            <div class="glass glass-hover h-100 rounded-4 overflow-hidden">
              <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400&h=220&fit=crop" class="card-img-top" alt="Farmhouse Lembang">
              <div class="card-body p-6">
                <h5 class="text-secondary card-title font-bold mb-2">Farmhouse Susu Lembang</h5>
                
                <p class="card-text text-muted mb-5">
                  Foto Instagramable • Susu segar • Area bermain anak
                </p>
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <span class="badge-price font-bold fs-6">Rp 30.000
                  </span>
                  <div class="text-muted">
                    <i class="fas fa-map-marker-alt me-1"></i>Lembang
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Floating Market -->
          <div class="col-xl-3 col-lg-4 col-md-6 wisata-item" data-category="kuliner outdoor">
            <div class="glass glass-hover h-100 rounded-4 overflow-hidden">
              <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=400&h=220&fit=crop" class="card-img-top" alt="Floating Market">
              <div class="card-body p-4">
                <h5 class="text-secondary card-title font-bold mb-2">Floating Market Lembang</h5>
                <p class="card-text text-muted mb-5">
                  Perahu • Kuliner nusantara • Live music
                </p>
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <span class="badge-price font-bold fs-6">Rp 30.000+</span>
                  <div class="text-muted">
                    <i class="fas fa-map-marker-alt me-1"></i>Lembang
                  </div>
                </div>
              </div>
            </div>
          </div>

          
        </div>
      </div>
    
    <script>
      // Category filter
      document.querySelectorAll('.category-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        // 1. HAPUS SEMUA active class DULU
        document.querySelectorAll('.category-btn').forEach(b => {
            b.classList.remove('category-active');
            b.classList.remove('active');  // ← Tambah ini!
        });
        
        // 2. Tambah active KE BUTTON YANG DICLICK
        this.classList.add('category-active', 'active');
        
        // 3. Filter cards
        const category = this.dataset.category;
        document.querySelectorAll('.wisata-item').forEach(item => {
            if (category === 'all' || item.dataset.category.includes(category)) {
                item.style.display = 'block';
                item.classList.add('animate__animated', 'animate__fadeIn');
            } else {
                item.style.display = 'none';
            }
        });
    });
});
    </script>
     </div>
</div>
<?php
require '../includes/footer.php';
?>