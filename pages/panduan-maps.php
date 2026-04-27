<?php 
$page_title = 'Panduan Maps';
require '../includes/header.php'; 
?>

<div class="container">
   <head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
     <style>
        .app-container {
            display: flex;
            height: 100%;
        }

        /* FLOATING BUTTON */
        .floating-toggle {
            position: fixed;
            bottom: clamp(14px, 3.8vw, 26px);
            left: clamp(14px, 3.8vw, 26px);
            z-index: 1005;
            width: 56px;
            height: 56px;
            background: var(--blue-700);
            border: none;
            border-radius: 14px;
            color: var(--blue-50);
            font-size: 1.1rem;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
            transition: all 0.5s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        @media (min-width: 576px) { /* SM */
        .floating-toggle { left: clamp(20px, 4vw, 35px); }
        }
        @media (min-width: 768px) { /* MD - iPad */
            .floating-toggle { left: clamp(24px, 4.5vw, 45px); }
        }
        @media (min-width: 992px) { /* LG - Laptop */
            .floating-toggle { 
                left: clamp(65px, 6vw, 90px);
            }
        }
        @media (min-width: 1200px) { /* XL - Desktop */
            .floating-toggle { 
                left: clamp(120px, 8vw, 160px);
            }
        }
        .floating-toggle:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(59, 130, 246, 0.1);
        }

        .floating-toggle.open {
            background: var(--orange-600);
        }
        
        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            max-width: 400px;
            height: 100vh;
            background: var(--blue-50);
            backdrop-filter: blur(25px);
            padding: 0;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
            z-index: 1003;
            border: none;
           color: var(--blue-900);
            box-shadow: 4px 0 40px rgba(0,0,0,0.2);
        }

        .sidebar.hidden {
            left: -400px;
        }

        .sidebar-header {
            margin-bottom: 2rem;
            padding:6rem 1rem 1rem 1rem;
            position: sticky;
            top: 0;
            background: var(--blue-200);
            color: var(--blue-700);
            z-index: 1004;
        }

        .sidebar-title {
            font-size: 1.35rem;
            font-weight: 700;
            margin-bottom: 0.4rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            color: var(--blue-900);
        }

        .sidebar-count {
            background: #3b82f6;
            color: white;
            padding: 0.25rem 0.6rem;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .reset-btn {
            background: var(--blue-50);
            color: var(--blue-900);
            border: none;
            padding: 0.75rem 1.3rem;
            border-radius: 12px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            width: 100%;
            margin-top: 1rem;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            justify-content: center;
        }

        .reset-btn:hover {
            transform: translateY(-2px);
        }

        .tourism-list {
            display: flex;
            flex-direction: column;
            gap: 1.1rem;
            padding: 0.5rem 1rem 0.5rem 1rem;
            z-index: 1003;
        }

        .tourism-card {
            background: var(--blue-100);
            border: 1px solid var(--blue-200);
            border-radius: 12px;
            padding: 1.3rem 1.2rem;
            cursor: pointer;
            transition: all 0.25s ease;
            display: flex;
            gap: 1rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .tourism-card:hover {
            border-color: #3b82f6;
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.15);
            transform: translateX(4px);
        }

        .tourism-card.active {
            border-color: #3b82f6;
            background: linear-gradient(90deg, var(--blue-50) 0%, var(--blue-200) 100%);
        }

        .tourism-icon {
            width: 52px;
            height: 52px;
            background: var(--blue-200);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            color: var(--blue-800);
            flex-shrink: 0;
        }

        .tourism-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .tourism-name {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--blue-950);
        }

        .tourism-desc {
            color: var(--blue-900);
            font-size: 0.85rem;
            line-height: 1.3;
        }

        .tourism-meta {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            margin-top: 0.2rem;
        }

        .tourism-distance {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            background: var(--blue-50);
            color: var(--blue-900);
            border: none;
            padding: 0.35rem 0.85rem;
            border-radius: 10px;
            font-size: 0.8rem;
        }

        /* MAP */
        .map-container {
            flex: 1;
            height: 75vh;
        }

        #map {
            height: 100%;
            width: 100%;
            border-radius: 18px;
            border: 2px solid var(--blue-300);
            box-shadow: 0 5px 20px rgba(137,137,137, 0.5);
        }
        
    </style> 
    </head>
    
    <div class="app-container">
        
        <!-- FLOATING TOGGLE -->
        <button class="floating-toggle" onclick="toggleSidebar()" id="toggleBtn">
            <i class="fas fa-list"></i>
        </button>

        <!-- SIDEBAR PUTIH -->
        <div class="sidebar hidden" id="sidebar">
            <div class="sidebar-header">
                <div>
                    <div class="sidebar-title">
                        <i class="fas fa-location-dot"></i>
                        Destinasi Wisata
                        <span class="sidebar-count">5</span>
                    </div>
                </div>
                <button class="reset-btn" onclick="resetView()">
                    <i class="fas fa-home"></i> Kembali Pusat Kota
                </button>
            </div>
            
            <div class="tourism-list" id="tourismList"></div>
        </div>

        <!-- MAP -->
        <div class="map-container">
            <div id="map"></div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <script>
        const tourismData = [
            {
                name: "Kawah Putih", 
                desc: "Danau vulkanik dengan warna putih kehijauan yang memukau", 
                lat: -7.1194, lng: 107.6333, 
                icon: "fas fa-mountain-sun",
                distance: "45 km"
            },
            {
                name: "Farmhouse Lembang", 
                desc: "Wisata keluarga bertema Eropa dengan spot foto Instagramable", 
                lat: -6.8261, lng: 107.6147, 
                icon: "fas fa-camera-retro",
                distance: "22 km"
            },
            {
                name: "Tangkuban Perahu", 
                desc: "Gunung berapi aktif dengan kawah yang masih mengeluarkan asap", 
                lat: -6.7578, lng: 107.5904, 
                icon: "fas fa-fire",
                distance: "30 km"
            },
            {
                name: "Floating Market Lembang", 
                desc: "Pasar terapung dengan wahana perahu dan kuliner khas Sunda", 
                lat: -6.8292, lng: 107.6181, 
                icon: "fas fa-water",
                distance: "25 km"
            },
            {
                name: "Trans Studio Bandung", 
                desc: "Taman hiburan indoor terbesar di Asia Tenggara", 
                lat: -6.9258, lng: 107.6211, 
                icon: "fas fa-star",
                distance: "3 km"
            }
        ];

        let map;

        function initMap() {
            map = L.map('map').setView([-6.9175, 107.6191], 11);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

            tourismData.forEach((place, index) => {
                const marker = L.marker([place.lat, place.lng]).addTo(map);
                marker.bindPopup(`
                    <div style="text-align:center;padding:1.5rem;width:260px">
                        <div style="font-size:2.2rem;color:#3b82f6;margin-bottom:0.8rem">
                            <i class="${place.icon}"></i>
                        </div>
                        <div style="font-weight:700;font-size:1.2rem;color:#1e293b;margin-bottom:0.5rem">
                            ${place.name}
                        </div>
                        <div style="color:#64748b;font-size:0.95rem;margin-bottom:1rem;line-height:1.4">
                            ${place.desc}
                        </div>
                        <div style="color:#475569;font-weight:500;font-size:0.9rem">
                            📍 ${place.distance} dari pusat kota
                        </div>
                    </div>
                `);
            });
        }

        function generateCards() {
            const container = document.getElementById('tourismList');
            container.innerHTML = '';
            tourismData.forEach((place, index) => {
                const card = document.createElement('div');
                card.className = 'tourism-card';
                card.onclick = () => selectPlace(index);
                card.innerHTML = `
                    <div class="tourism-icon">
                        <i class="${place.icon}"></i>
                    </div>
                    <div class="tourism-content">
                        <div class="tourism-name">${place.name}</div>
                        <div class="tourism-desc">${place.desc}</div>
                        <div class="tourism-meta">
                            <div class="tourism-distance">
                                <i class="fas fa-road"></i> ${place.distance} dari pusat kota
                            </div>
                        </div>
                    </div>
                `;
                container.appendChild(card);
            });
        }

        function selectPlace(index) {
            document.querySelectorAll('.tourism-card').forEach((c, i) => 
                c.classList.toggle('active', i === index)
            );
            const place = tourismData[index];
            map.flyTo([place.lat, place.lng], 15, { duration: 1 });
        }

        function resetView() {
            map.flyTo([-6.9175, 107.6191], 11);
            document.querySelectorAll('.tourism-card').forEach(c => 
                c.classList.remove('active')
            );
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const btn = document.getElementById('toggleBtn');
            sidebar.classList.toggle('hidden');
            btn.classList.toggle('open');
            btn.innerHTML = sidebar.classList.contains('hidden') 
                ? '<i class="fas fa-list"></i>' 
                : '<i class="fas fa-times"></i>';
        }

        document.addEventListener('DOMContentLoaded', () => {
            initMap();
            generateCards();
        });
    </script>

</div>
<?php
require '../includes/footer.php';
?>