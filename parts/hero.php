<div id="hero-website" class="hero-land-container position-relative">
  <div class="hero-land-slide active" style="background: linear-gradient(135deg, rgba(15,23,42,0.85) 0%, rgba(30,41,59,0.9) 50%, rgba(51,65,85,0.95) 100%), url('https://ayokebandung.id/assets/images/wisata.webp') center/cover;">
    <div class="hero-land-content">
      <div class="text-center">
        <span class="text-hero font-bold mb-6 hero-land-title">WISATA</span>
        <p class="hero-land-desc fs-4 mt-6 text-white mb-6">Eksplorasi destinasi ikonik Bandung dengan layanan premium dan kenyamanan tak tertandingi.</p>
        <a href="#kenapaharusbandung" class="mt-6">
          <button class="hero-land-btn-link btn btn-accent btn-md">MULAI JELAJAHI
            <i class="fas fa-angle-right"></i>
          </button>
        </a>
      </div>
    </div>
  </div>
  <div class="hero-land-slide" style="background: linear-gradient(135deg, rgba(15,23,42,0.85) 0%, rgba(30,41,59,0.9) 50%, rgba(51,65,85,0.95) 100%), url('https://ayokebandung.id/assets/images/kuliner.webp') center/cover;">
    <div class="hero-land-content">
      <div class="text-center text-white">
        <span class="text-hero font-bold mb-6 hero-land-title">KULINER</span>
        <p class="hero-land-desc fs-4 mt-6 text-white mb-6">Manjakan lidah dengan cita rasa autentik dan pengalaman bersantap kelas dunia di Bandung.</p>
        <a href="#kenapaharusbandung" class="mt-6">
          <button class="hero-land-btn-link btn btn-accent btn-md">MULAI JELAJAHI
            <i class="fas fa-angle-right"></i>
          </button>
        </a>
      </div>
    </div>
  </div>
  <div class="hero-land-slide" style="background: linear-gradient(135deg, rgba(15,23,42,0.85) 0%, rgba(30,41,59,0.9) 50%, rgba(51,65,85,0.95) 100%), url('https://ayokebandung.id/assets/images/hotel.webp') center/cover;">
    <div class="hero-land-content">
      <div class="text-center text-white">
        <span class="text-hero font-bold mb-6 hero-land-title">HOTEL</span>
        <p class="hero-land-desc fs-4 mt-6 text-white mb-6">Temukan kemewahan menginap terbaik di lokasi strategis untuk istirahat Anda yang sempurna.</p>
        <a href="#kenapaharusbandung" class="mt-6">
          <button class="hero-land-btn-link btn btn-accent btn-md">MULAI JELAJAHI
            <i class="fas fa-angle-right"></i>
          </button>
        </a>
      </div>
    </div>
  </div>
  <div class="position-absolute bottom-0 start-50 translate-middle-x mb-4 d-flex gap-2 pb-3">
    <div class="hero-land-indicator active" onclick="heroLandGoTo(0)"></div>
      <div class="hero-land-indicator" onclick="heroLandGoTo(1)"></div>
      <div class="hero-land-indicator" onclick="heroLandGoTo(2)"></div>
    </div>
</div>
<style>
.hero-land-container {width: 100vw;height: calc(100vh - var(--navbar-height));}@media (min-width:1100px){.hero-land-container{height:70vh}}.hero-land-slide{height:100%;background-size:cover;background-position:center;transition:opacity .7s;opacity:0;position:absolute;top:0;left:0;width:100%}.hero-land-slide.active{opacity:1}.hero-land-desc{opacity:0;transform:translateY(20px);transition:.6s;text-shadow:0 2px 6px rgba(50,50,80,.5)}.hero-land-title{text-shadow:0 2px 6px rgba(50,50,80,.2)}.hero-land-slide.active .hero-land-desc{opacity:1;transform:translateY(0)}.hero-land-content{position:absolute;top:70%;left:50%;transform:translate(-50%,-50%);width:90%;max-width:800px}.hero-land-nav{position:absolute;top:50%;transform:translateY(-50%);background:rgba(255,255,255,.2);border:none;color:#fff;width:50px;height:50px;border-radius:50%;z-index:20;backdrop-filter:blur(10px)}.hero-land-prev{left:30px}.hero-land-next{right:30px}.hero-land-indicator{width:8px;height:8px;border-radius:50%;background:rgba(255,255,255,.5);transition:.3s;cursor:pointer}.hero-land-indicator.active{background:#fff;transform:scale(1.05)}.hero-land-btn-link{display:inline-block;text-decoration:none}
</style>