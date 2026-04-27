<?php
session_start();
// Cek apakah sudah consent
$has_consent = isset($_COOKIE['consent_accepted']);
if ($has_consent && $_COOKIE['consent_accepted'] === '1') {
    // Load analytics jika sudah consent
    ?>
    <!-- Google Analytics (jika consent analytics true) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-XXXXXXXXXX');
    </script>
    
    <!-- Facebook Pixel (jika consent marketing true) -->
    <?php if (isset($_COOKIE['consent_categories'])): 
        $categories = json_decode($_COOKIE['consent_categories'], true);
        if ($categories['marketing'] ?? false): ?>
        <!-- Facebook Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', 'YOUR_FB_PIXEL_ID');
        fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=YOUR_FB_PIXEL_ID&ev=PageView&noscript=1"/></noscript>
    <?php endif; ?>
    <?php endif; ?>
    <?php
    return; // Keluar jika sudah consent
}
?>

<!-- Consent Banner -->
<div id="consentBanner" class="consent-banner">
    <div class="consent-content">
        <div class="consent-text">
            <h3>🍪 Kami menghormati privasi Anda!</h3>
            <p>
                Website ini menggunakan cookies untuk:<br>
                <strong>• Analytics:</strong> Memahami perilaku pengunjung<br>
                <strong>• Marketing:</strong> Iklan yang lebih relevan di Facebook/Google<br>
                <strong>• Functional:</strong> Chat, preferensi, pengalaman terbaik
            </p>
        </div>
        <div class="consent-buttons">
            <button class="btn-consent btn-accept" onclick="acceptAll()">
                ✅ Terima Semua
            </button>
            <a href="#" class="btn-consent btn-preferences" onclick="openPreferences();return false;">
                ⚙️ Pilih Saya
            </a>
        </div>
    </div>
</div>

<!-- Preferences Modal -->
<div id="preferencesModal" class="preferences-modal">
    <div class="preferences-content">
        <h3>⚙️ Atur Preferensi Cookies</h3>
        <p>Pilih kategori cookies yang ingin Anda izinkan:</p>
        
        <div class="toggle-group">
            <div class="toggle-item">
                <div>
                    <strong>Necessary</strong><br>
                    <small>Sesi, login, keamanan (selalu aktif)</small>
                </div>
                <div class="toggle-switch necessary active">
                    <div class="toggle-slider"></div>
                </div>
            </div>
            
            <div class="toggle-item">
                <div>
                    <strong>Analytics</strong><br>
                    <small>Google Analytics, statistik pengunjung</small>
                </div>
                <div class="toggle-switch analytics">
                    <div class="toggle-slider"></div>
                </div>
            </div>
            
            <div class="toggle-item">
                <div>
                    <strong>Marketing</strong><br>
                    <small>Facebook Pixel, iklan targeted</small>
                </div>
                <div class="toggle-switch marketing">
                    <div class="toggle-slider"></div>
                </div>
            </div>
            
            <div class="toggle-item">
                <div>
                    <strong>Functional</strong><br>
                    <small>Chat, wishlist, tema</small>
                </div>
                <div class="toggle-switch functional">
                    <div class="toggle-slider"></div>
                </div>
            </div>
        </div>
        
        <div style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 20px;">
            <button class="btn-consent btn-preferences" onclick="rejectAll()">❌ Tolak Semua</button>
            <button class="btn-consent btn-accept" onclick="savePreferences()">💾 Simpan Pilihan</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tampilkan banner jika belum consent
    if (!getCookie('consent_accepted')) {
        setTimeout(() => {
            document.getElementById('consentBanner').classList.add('show');
        }, 2000);
    }
});

let consentCategories = {
    necessary: true,
    analytics: false,
    marketing: false,
    functional: false
};

// Accept All
function acceptAll() {
    consentCategories = {
        necessary: true,
        analytics: true,
        marketing: true,
        functional: true
    };
    saveConsent();
}

// Open Preferences
function openPreferences() {
    document.getElementById('preferencesModal').style.display = 'flex';
    updateToggles();
}

// Update toggle UI
function updateToggles() {
    Object.keys(consentCategories).forEach(key => {
        const toggle = document.querySelector(`.toggle-switch.${key}`);
        if (consentCategories[key]) {
            toggle.classList.add('active');
        } else {
            toggle.classList.remove('active');
        }
    });
}

// Toggle click
document.querySelectorAll('.toggle-switch').forEach(toggle => {
    toggle.addEventListener('click', function() {
        const category = this.classList[1]; // analytics, marketing, etc
        consentCategories[category] = !consentCategories[category];
        updateToggles();
    });
});

// Reject All
function rejectAll() {
    consentCategories = { necessary: true, analytics: false, marketing: false, functional: false };
    saveConsent();
}

// Save Preferences
function savePreferences() {
    document.getElementById('preferencesModal').style.display = 'none';
    saveConsent();
}

// Save to server
function saveConsent() {
    fetch('/api/consent.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            consent_given: true,
            categories: consentCategories,
            session_id: '<?= session_id() ?>'
        })
    }).then(response => response.json()).then(data => {
        if (data.success) {
            document.getElementById('consentBanner').classList.remove('show');
            document.getElementById('consentBanner').style.display = 'none';
            
            // Load trackers berdasarkan consent
            if (consentCategories.analytics) loadAnalytics();
            if (consentCategories.marketing) loadMarketing();
        }
    });
}

// Load Google Analytics
function loadAnalytics() {
    const script = document.createElement('script');
    script.async = true;
    script.src = 'https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX';
    document.head.appendChild(script);
    
    window.dataLayer = window.dataLayer || [];
    window.gtag = function() { window.dataLayer.push(arguments); };
    gtag('js', new Date());
    gtag('config', 'G-XXXXXXXXXX');
}

// Load Facebook Pixel
function loadMarketing() {
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    
    fbq('init', 'YOUR_FB_PIXEL_ID');
    fbq('track', 'PageView');
}

// Utility
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
    return null;
}
</script>

<link rel="stylesheet" href="/assets/css/consent.css">