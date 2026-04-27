<?php 
$page_title = 'Kuliner';
require '../includes/header.php'; 
?>

<div class="container">
<style>
        .card-glass img {
            height: 250px;
            object-fit: cover;
        }
    </style>
        <!-- Kuliner Section -->
        <section id="kuliner" class="py-5">
            <div class="container py-6">
                <!-- Section Title -->
                <div class="row justify-content-center py-6">
                    <div class="py-6 col-lg-8 text-center">
                        <h2 class="display-4 font-bold mb-6">
                            Kuliner Khas Bandung
                        </h2>
                    </div>
                </div>

                <!-- Kuliner Grid -->
                <div class="row g-4 py-6">
                  
                    <!-- Card 1: Seblak -->
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="card card-glass h-100">
                            <img src="https://images.unsplash.com/photo-1579586140626-7173086fc5eb?w=400&h=250&fit=crop" 
                                 class="card-img-top" alt="Seblak">
                            <div class="card-body mb-5">
                                <h5 class="card-title font-semibold">Seblak</h5>
                                <p class="card-text mb-4">
                                    Mie kenyal dengan kuah pedas gurih, topping kerupuk, sosis, dan telur. 
                                    Sensasi pedas yang bikin nagih!
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 6: Mie Kocok -->
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="card card-glass h-100">
                            <img src="https://images.unsplash.com/photo-1542994893-e18a11c44d8f?w=400&h=250&fit=crop" 
                                 class="card-img-top" alt="Mie Kocok">
                            <div class="card-body mb-5">
                                <h5 class="card-title font-semibold">Mie Kocok</h5>
                                <p class="card-text mb-4">
                                    Mie dengan kuah kaldu sapi kental, kikil, dan bakso. 
                                    Hangat dan mengenyangkan!
                                </p>
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
