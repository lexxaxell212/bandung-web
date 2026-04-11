<?php 
$page_title = "Panduan maps - MyApp";
require_once 'config/config.php';
require_once 'includes/header.php'; 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bandung Maps</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: #0f172a;
            height: 100vh;
            overflow: hidden;
        }

        .app-container {
            display: flex;
            height: 100vh;
        }

        /* HEADER */
        .header {
            position: fixed;
            top: 20px;
            left: 20px;
            background: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(59, 130, 246, 0.3);
            border-radius: 16px;
            padding: 12px 20px;
            z-index: 1004;
            color: #e2e8f0;
            font-size: 0.95rem;
            font-weight: 600;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        }

        /* FLOATING BUTTON */
        .floating-toggle {
            position: fixed;
            bottom: 25px;
            left: 25px;
            z-index: 1005;
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            border: none;
            border-radius: 14px;
            color: white;
            font-size: 1.1rem;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .floating-toggle:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(59, 130, 246, 0.5);
        }

        .floating-toggle.open {
            background: linear-gradient(135deg, #ef4444, #b91c1c);
        }

        /* SIDEBAR PUTIH */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 360px;
            height: 100vh;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(25px);
            padding: 2rem 1.5rem;
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 1003;
            border-right: 2px solid #e2e8f0;
            color: #1e293b;
            box-shadow: 4px 0 40px rgba(0,0,0,0.2);
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .sidebar-header {
            margin-bottom: 2rem;
            padding-bottom: 1.2rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .sidebar-title {
            font-size: 1.35rem;
            font-weight: 700;
            margin-bottom: 0.4rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            color: #1e293b;
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
            background: #f8fafc;
            color: #475569;
            border: 1px solid #e2e8f0;
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
            background: #f1f5f9;
            border-color: #cbd5e1;
            color: #334155;
            transform: translateY(-1px);
        }

        .tourism-list {
            display: flex;
            flex-direction: column;
            gap: 1.1rem;
        }

        .tourism-card {
            background: #ffffff;
            border: 1px solid #f1f5f9;
            border-radius: 16px;
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
            background: linear-gradient(90deg, #eff6ff 0%, #ffffff 100%);
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.2);
        }

        .tourism-icon {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            color: white;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .tourism-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .tourism-name {
            font-size: 1.05rem;
            font-weight: 600;
            color: #1e293b;
        }

        .tourism-desc {
            color: #64748b;
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
            background: #f8fafc;
            color: #475569;
            padding: 0.35rem 0.85rem;
            border-radius: 10px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        /* MAP */
        .map-container {
            flex: 1;
            height: 100vh;
        }

        #map {
            height: 100%;
            width: 100%;
        }

        /* Scrollbar Clean */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #f8fafc;
            border-radius: 6px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 6px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar { width: 100vw; }
        }
    </style>
</head>

<body>

<div class="page-container mt-5">
    
    <div class="app-container">
        <!-- HEADER 
        <div class="header">
            <i class="fas fa-map"></i> Bandung Wisata
        </div> -->

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

</body>

</html>


<?php 

/* Footer */

require_once 'includes/footer.php'; ?>

