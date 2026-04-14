<?php 
$page_title = "Search - MyApp";
require_once 'config/config.php';
require_once 'includes/header.php'; 
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <style>
    .search-box {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 15px;
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
      text-align: center;
      width: 100%;
      max-width: 720px;
      padding: 15px;
      margin: auto;
    }

    h1 {
      margin-bottom: 25px;
      font-size: 2.5em;
      font-weight: 800;
    }

    .search-input {
        width: 100%;
      padding: 15px;
      border: 3px solid #e9ecef;
      border-radius: 20px;
      font-size: 18px;
      outline: none;
      transition: all 0.3s;
    }

    .search-input:focus {
      border-color: #667eea;
      box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.2);
    }

    .typing {
      color: #666;
      font-style: italic;
      padding: 25px;
      text-align: center;
      font-size: 16px;
    }

    .result {
      background: #333;
      margin-bottom: 20px;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      transition: all 0.3s;
      cursor: pointer;
    }

    .result:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
    }

    .result-header {
      background: linear-gradient(135deg, var(--bs-primary) 0%, var(--md-primary-variant) 100%);
      color: white;
      padding: 25px 30px;
    }

    .result-title {
      font-size: 1.2em;
      font-weight: 700;
      margin: 0 0 5px 0;
    }

    .result-category {
      opacity: 0.9;
      font-size: 14px;
    }

    .result-body {
      padding: 25px 30px;
    }

    .result-snippet {
      color: #666;
      line-height: 1.6;
      margin: 0;
    }

    .highlight {
      background: yellow;
      padding: 4px 8px;
      border-radius: 6px;
      font-weight: 700;
      color: var(--bs-primary);
    }

    .no-results {
      text-align: center;
      padding: 80px 30px;
      color: #666;
    }

    .no-results i {
      font-size: 5rem;
      opacity: 0.4;
      display: block;
      margin-bottom: 25px;
    }

    .stats {
      padding: 20px 25px;
      border-radius: 16px;
      margin: 25px;
      font-size: 15px;
      display: none;
    }
  </style>
</head>

<body>
  <div class="menu-container mt-5">
      
    <div class="search-box">
      <h1>Telusuri</h1>
      <input type="text" class="search-input" id="searchInput" placeholder="Kamu ingin cari apa ?">
      <div id="typing" class="typing" style="display:none;">Mohon tunggu sebentar...</div>
    </div>

    <div id="stats" class="stats">
      <strong id="count">0</strong> hasil untuk <span id="query"></span>
    </div>

    <div id="results"></div>
    <div id="noResults" class="no-results" style="display:none;">
      <i class="fa-solid fa-magnifying-glass"></i>
      <h5>Hasil tidak ditemukan. Silahkan cari yang lainnya.</h5>
    </div>
  </div>

  <script>
    // DATA KONTEN
    const data = [{
        title: "Artikel terbaru",
        url: "/artikel-terbaru",
        category: "artikel",
        content: "artikel"
      },
      {
        title: "Budaya",
        url: "/budaya",
        category: "artikel",
        content: "budaya"
      },
      {
        title: "Informasi terkini",
        url: "/informasi-terkini",
        category: "Artikel",
        content: "Informasi terkini"
      },
      {
        title: "Kenapa harus bandung",
        url: "/kenapa-harus-bandung",
        category: "artikel",
        content: "kenapa harus bandung"
      },
      {
        title: "Kritik dan Saran",
        url: "/kritik-dan-saran",
        category: "Artikel",
        content: "Kritik dan Saran"
      },
      {
        title: "Kuliner",
        url: "/kuliner",
        category: "Artikel",
        content: "Kuliner"
      },
      {
        title: "Panduan Maps",
        url: "/panduan-maps",
        category: "Artikel",
        content: "Panduan maps"
      },
      {
        title: "Penginapan",
        url: "/penginapan",
        category: "Artikel",
        content: "Penginapan"
      },
      {
        title: "Privacy Policy",
        url: "/privacy-policy",
        category: "Artikel",
        content: "Privacy policy"
      },
      {
        title: "Sejarah",
        url: "/sejarah",
        category: "Artikel",
        content: "Sejarah"
      },
      {
        title: "",
        url: "/",
        category: "",
        content: ""
      },
      
    ];
    // ELEMENTS
    const input = document.getElementById('searchInput');
    const results = document.getElementById('results');
    const typing = document.getElementById('typing');
    const stats = document.getElementById('stats');
    const noResults = document.getElementById('noResults');
    const countEl = document.getElementById('count');
    const queryEl = document.getElementById('query');
    let timeout;
    input.addEventListener('input', function() {
      const q = this.value.trim().toLowerCase();
      clearTimeout(timeout);
      // RESET
      noResults.style.display = 'none';
      stats.style.display = 'none';
      typing.style.display = 'none';
      if (q.length < 2) {
        results.innerHTML = '';
        return;
      }
      typing.style.display = 'block';
      timeout = setTimeout(() => search(q), 200);
    });

    function search(query) {
      // SIMPLE FILTER + SORT
      const found = data
        .filter(item =>
          item.title.toLowerCase().includes(query) ||
          item.content.toLowerCase().includes(query)
        )
        .sort((a, b) =>
          (b.title.toLowerCase().includes(query) ? 1 : 0) -
          (a.title.toLowerCase().includes(query) ? 1 : 0)
        )
        .slice(0, 6);
      showResults(found, query);
    }

    function showResults(items, query) {
      typing.style.display = 'none';
      if (items.length === 0) {
        noResults.style.display = 'block';
        return;
      }
      // STATS
      countEl.textContent = items.length;
      queryEl.textContent = `"${query}"`;
      stats.style.display = 'block';
      // RENDER
      results.innerHTML = items.map(item => `
                <a href="${item.url}" style="color:inherit;text-decoration:none;">
                    <div class="result">
                        <div class="result-header">
                            <div class="result-title">${highlight(item.title, query)}</div>
                            <div class="result-category">${item.category}</div>
                        </div>
                        <div class="result-body">
                            <div class="result-snippet">${highlight(item.content.slice(0,80), query)}...</div>
                        </div>
                    </div>
                </a>
            `).join('');
    }
    // FIXED HIGHLIGHT (SAFE)
    function highlight(text, query) {
      if (!query) return text;
      // SPLIT & JOIN - NO REGEX ERROR!
      return text.split(query).join(`<span class="highlight">${query}</span>`);
    }
    input.focus();
  </script>
</body>

</html>

<?php 

/* Footer */

require_once 'includes/footer.php'; ?>