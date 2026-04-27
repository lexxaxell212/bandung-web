<?php 
$page_title = 'Kenapa harus Bandung';
require '../includes/header.php'; 
?>

<div class="container">
<style>
      .bdg-reason-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      }
      .bdg-reason-card:hover {
        transform: translateY(-12px) !important;
      }
      .bdg-reason-image {
        height: 180px;
        object-fit: cover;
        border-radius: 16px 16px 0 0;
        transition: transform 0.3s ease;
      }
      .bdg-reason-card:hover .bdg-reason-image {
        transform: scale(1.05);
      }
      .bdg-reason-card:hover .bdg-reason-number {
        opacity: 0;
      }
      .bdg-reason-number {
        background: var(--blue-700);
        color: var(--blue-100);
        padding: 6px 11px;
        border-radius: 50%;
        transition: all 0.5s ease-in-out;
        opacity: 1;
        z-index: 1;
      }
      .bdg-cta {
        background: var(--blue-200);
        padding: 60px 12px;
        border-radius: 18px !important;
        box-shadow: 0 5px 12px rgba(126,127,127, 0.1);
      }
    </style>
    <div class="container px-4 px-lg-5">
      <section class="text-center mb-5">
        <div class="shadow-lg border-0 rounded-4 overflow-hidden">
          <img src="https://asset.kompas.com/crops/C9ZPsnX6Z3zXGwjO98AZlxUSsfc=/0x0:640x427/1200x800/data/photo/2024/05/14/6642ea1cd3515.jpg"
          class="card-img-top img-fluid" alt="Pemandangan Kota Bandung" style="height: 350px; object-fit: cover;">
        </div>
      </section>
      <section class="text-center mb-5">
        <h1 class="display-4 text-primary mb-5">Kenapa Harus Bandung?</h1>
        <p>
          "Kota Kembang yang menyimpan pesona tak terbatas."
        </p>
      </section>
      <!-- GRID -->
      <section class="row g-5 py-10">
        <div class="col-lg-6 col-xl-4">
          <div class="glass glass-hover bdg-reason-card h-100">
            <div>
              <span class="position-absolute top-0 end-0 bdg-reason-number fs-6 font-bold mt-3 me-3">01</span>
              <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
              alt="Lembang" class="bdg-reason-image w-100 mb-4">
              <div class="p-4">
                <h3 class="h5 font-bold mb-3">Alam yang Memesona</h3>
                <p>
                  Lembang, Ciwidey, Kawah Putih - panorama pegunungan yang bikin hati adem.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xl-4">
          <div class="glass glass-hover bdg-reason-card h-100">
            <div>
              <span class="position-absolute top-0 end-0 bdg-reason-number fs-6 font-bold mt-3 me-3">02</span>
              <img src="https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
              alt="Kuliner" class="bdg-reason-image w-100 mb-4">
              <div class="p-4">
                <h3 class="h5 font-bold mb-3">Kuliner Juara</h3>
                <p>
                  Sate maranggi, nasi timbel, seblak, cireng - setiap sudut penuh kelezatan khas Sunda.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xl-4">
          <div class="glass glass-hover bdg-reason-card h-100">
            <div>
              <span class="position-absolute top-0 end-0 bdg-reason-number fs-6 font-bold mt-3 me-3">03</span>
              <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
              alt="Shopping" class="bdg-reason-image w-100 mb-4">
              <div class="p-4">
                <h3 class="h5 font-bold mb-3">Factory Outlet</h3>
                <p>
                  Rumah Mode, Heritage, Distro Dago - belanja fashion branded harga pabrik.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xl-4">
          <div class="glass glass-hover bdg-reason-card h-100">
            <div>
              <span class="position-absolute top-0 end-0 bdg-reason-number fs-6 font-bold mt-3 me-3">04</span>
              <img src="https://images.unsplash.com/photo-1512568400610-42fe290ca098?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
              alt="Kafe" class="bdg-reason-image w-100 mb-4">
              <div class="p-4">
                <h3 class="h5 font-bold mb-3">Kafe Aesthetic</h3>
                <p>
                  Ribuan kafe instagramable dengan view pegunungan dan arsitektur unik.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xl-4">
          <div class="glass glass-hover bdg-reason-card h-100">
            <div>
              <span class="position-absolute top-0 end-0 bdg-reason-number fs-6 font-bold mt-3 me-3">05</span>
              <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
              alt="Arsitektur" class="bdg-reason-image w-100 mb-4">
              <div class="p-4">
                <h3 class="h5 font-bold mb-3">Arsitektur Kolonial</h3>
                <p>
                  Gedung Sate, Braga, Asia Afrika - jejak sejarah yang masih terjaga sempurna.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xl-4">
          <div class="glass glass-hover bdg-reason-card h-100">
            <div>
              <span class="position-absolute top-0 end-0 bdg-reason-number fs-6 font-bold mt-3 me-3">06</span>
              <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
              alt="Seni" class="bdg-reason-image w-100 mb-4">
              <div class="p-4">
                <h3 class="h5 font-bold mb-3">Seni & Budaya</h3>
                <p>
                  Museum, galeri seni, komunitas kreatif yang terus berinovasi.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-xl-8 mx-auto">
          <div class="glass glass-hover bdg-reason-card h-100">
            <div>
              <span class="position-absolute top-0 end-0 bdg-reason-number fs-6 font-bold mt-3 me-3">07</span>
              <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
              alt="Alam" class="bdg-reason-image w-100 mb-4">
              <div class="p-4">
                <h3 class="h5 font-bold mb-3">Home Sweet Home</h3>
                <p>
                  Suasana sejuk, ramah tamah, dan kangen yang bikin ingin balik lagi.
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="text-center bdg-cta mb-5">
        <h2 class="display-4 font-bold mb-4">Siap Petualangan ke Bandung?</h2>
        <p class="mb-5">
          Jadwal akhir pekan sudah penuh? Booking sekarang sebelum ketinggalan!
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
          <a href="#" class="btn btn-primary">
            <i class="fas fa-plane me-2"></i>Pesan Tiket
          </a>
          <a href="#" class="btn btn-outline-primary">
            <i class="fas fa-hotel me-2"></i>Cari Hotel
          </a>
        </div>
      </section>
    </div>

</div>
<?php
require '../includes/footer.php';
?>