<?php 
$page_title = 'Penginapan';
require '../includes/header.php'; 
?>

<div class="container">
<style>
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .card-body {
            padding: 1.5rem;
        }
    </style>

    <!-- Hero Section -->
    <section class="py-10">
        <div class="container">
            <div class="row align-items-center">
                <div class="mx-auto col-lg-6 text-center p-3">
                    <h1 class="display-4 font-bold mb-4">Hotel dan Penginapan <b>Rekomendasi</b></h1>
                    <p class="mb-4">Temukan Hotel dan penginapan terbaik untukmu di Bandung</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Rooms Section -->
    <section class="section-padding">
        <div class="container">
            <div class="row g-4">
              
                <div class="col-lg-4 col-md-6">
                    <div class="glass glass-hover h-100">
                        <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=500&h=300&fit=crop" class="card-img-top" alt="Deluxe Room">
                        <div class="card-body d-flex flex-column">
                            <h5 class="text-primary">Deluxe Room</h5>
                            <p class="card-text">Kamar nyaman dengan pemandangan kota, AC, TV, dan kamar mandi dalam.</p>
                            <div class="mt-auto">
                                <p class="text-primary font-bold">Rp 750.000
                               <small class="text-muted">/ malam</small>
                               </p>
                                <a href="#" class="btn btn-primary mt-5 w-100">Pesan Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
</div>
<?php
require '../includes/footer.php';
?>