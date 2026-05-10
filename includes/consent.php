<?php
$consent_accepted = ($_COOKIE["consent_accepted"] ?? "0") === "1";
$categories = json_decode($_COOKIE["consent_categories"] ?? '{}', true);

if ($consent_accepted): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= G_TAG_ID ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date()); gtag('config', '<?= G_TAG_ID ?>');
    </script>

    <?php if ($categories['marketing'] ?? false): ?>
        <script>
            !function(f,b,e,v,n,t,s){/* Script FB Pixel Standard */}...
            fbq('init', '<?= FB_PIXEL_ID ?>'); fbq('track', 'PageView');
        </script>
    <?php endif; ?>
<?php endif; ?>

<?php if (!$consent_accepted): ?>
<div id="consentBanner" class="consent-banner show">
    <h5>Privasi Akang & Teteh</h5>
    <p>Bantu Yara ningkatin ayokebandung.id lewat cookies ya!</p>
    <button onclick="saveConsent(true)">Terima Semua</button>
    <button onclick="openPreferences()">Atur Sendiri</button>
</div>
<?php endif; ?>

<div id="prefModal" style="display:none;" class="modal">
    <h3>Preferensi Cookies</h3>
    <label><input type="checkbox" id="check_analytics"> Analytics</label><br>
    <label><input type="checkbox" id="check_marketing"> Marketing</label><br>
    <button onclick="saveConsent(false)">Simpan</button>
</div>

<script>
function saveConsent(all = true) {
    const cats = {
        necessary: true,
        analytics: all || document.getElementById('check_analytics').checked,
        marketing: all || document.getElementById('check_marketing').checked
    };

    fetch('/api/consent.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ categories: cats })
    }).then(() => location.reload());
}

function openPreferences() {
    document.getElementById('prefModal').style.display = 'block';
}
</script>
