<?php
$admin_name = htmlspecialchars($_SESSION['admin_name'] ?? 'Admin');
$admin_url  = defined('ADMIN_URL') ? ADMIN_URL : '/admin/';
$request_path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$current = preg_replace('#^admin/?#', '', $request_path);

function nav_active(string $page, string $current): string {
    return $page === $current ? ' nav-active' : '';
}
$page_title = "Dashboard";
?>

<!--
<!DOCTYPE html>
<html lang="id">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="<?= CSS_URL ?>bs533.min.css" rel="stylesheet">
  <link href="<?= CSS_URL ?>assets.css" rel="stylesheet">
  <link href="<?= CSS_URL ?>component.css" rel="stylesheet">
  <link href="<?= CSS_URL ?>style.css" rel="stylesheet">
  <style>
    #mobile-toggle {
      display: none;
    }

    .admin-container {
      display: flex;
      position: relative;
    }

    .mobile-header {
      display: flex;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      background: var(--blue-200);
      color: var(--blue-950);
      padding: 14px 20px;
      z-index: 3000;
      align-items: center;
      justify-content: space-between;
    }

    .mobile-menu-btn {
      background: none;
      border: none;
      font-size: 22px;
      color: var(--blue-950);
      cursor: pointer;
      padding: 6px 8px;
      border-radius: 8px;
      transition: color .2s;
    }

    .mobile-menu-btn:hover {
      color: var(--blue-800);
    }

    .mobile-title {
      font-size: 18px;
      font-weight: 700;
      color: var(--blue-950);
    }

    .mobile-header-user {
      font-size: .8rem;
      color: var(--blue-800);
    }

    .sidebar {
      width: 260px;
      background: var(--blue-100);
      position: fixed;
      height: 100vh;
      top: 56px;
      left: 0;
      transform: translateX(-100%);
      transition: transform .3s cubic-bezier(.4, 0, .2, 1);
      z-index: 2000;
    }

    #mobile-toggle:checked~.admin-container .sidebar {
      transform: translateX(0);
    }

    #mobile-toggle:checked~.admin-container::before {
      content: "";
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, .45);
      backdrop-filter: blur(3px);
      z-index: 1500;
    }

    .sidebar-header {
      padding: 20px;
      text-align: center;
      background: var(--blue-200);
      border-bottom: 1px solid var(--blue-300);
    }

    .logo {
      font-size: 20px;
      font-weight: 700;
      color: var(--blue-950);
      margin-bottom: 4px;
    }

    .sidebar-user {
      font-size: .78rem;
      color: var(--blue-800);
    }

    .sidebar-nav {
      padding: 12px 0;
    }

    .nav-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 13px 20px;
      color: var(--blue-950);
      text-decoration: none;
      border-left: 3px solid transparent;
      font-size: .88rem;
      transition: all .2s;
    }

    .nav-item i {
      width: 18px;
      text-align: center;
      font-size: .9rem;
    }

    .nav-item:hover,
    .nav-item.nav-active {
      background: var(--blue-200);
      color: var(--blue-800);
      border-left-color: var(--blue-700);
    }

    .nav-logout {
      margin-top: 8px;
      border-top: 1px solid var(--blue-200);
    }

    .nav-logout:hover {
      color: #c0392b;
      border-left-color: #c0392b;
    }

    .main-content {
      flex: 1;
      margin-top: 56px;
      padding: 20px;
    }

    /* ── Topbar ── */
    .topbar {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      background: var(--blue-100);
      border: 1px solid var(--blue-200);
      border-radius: 12px;
      padding: 12px 20px;
      margin-bottom: 20px;
    }

    .topbar-user {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: .88rem;
      color: var(--blue-950);
    }

    .topbar-avatar {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: var(--blue-300);
      color: var(--blue-950);
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: .9rem;
    }
  </style>
</head>
<body>
  <input type="checkbox" id="mobile-toggle">
  <header class="mobile-header">
    <label for="mobile-toggle" class="mobile-menu-btn" aria-label="Toggle menu">
      <i class="fas fa-bars"></i>
    </label>
    <span class="mobile-title">DASHBOARD</span>
    <span class="mobile-header-user">
      <i class="fas fa-user-circle" style="margin-right:5px"></i><?= $admin_name ?>
    </span>
  </header>
  <div class="admin-container">
    <aside class="sidebar" role="navigation" aria-label="Sidebar">
      <div class="sidebar-header">
        <div class="logo"><i class="fas fa-shield-halved" style="margin-right:6px"></i>Admin</div>
        <small class="sidebar-user"><?= $admin_name ?></small>
      </div>
      <nav class="sidebar-nav">
        <a href="<?= $admin_url ?>" class="nav-item<?= nav_active('dashboard', $current) ?>"><i class="fas fa-gauge-high"></i>Dashboard</a>
        <a href="<?= $admin_url ?>database-manager" class="nav-item<?=
        nav_active('database-manager', $current) ?>"><i class="fas
        fa-database"></i>DB Manager</a>
        <a href="<?= $admin_url ?>newsletter" class="nav-item<?= nav_active('newsletter', $current) ?>"><i class="fas fa-envelope"></i>Newsletter</a>
        <a href="<?= $admin_url ?>pages" class="nav-item<?=
        nav_active('pages-builder', $current) ?>"><i class="fas
        fa-file-lines"></i>Pages Builder</a>
        <a href="<?= $admin_url ?>blog-manager" class="nav-item<?= nav_active('blog-manager', $current) ?>"><i class="fas fa-pen-to-square"></i>Blog Builder</a>
        <a href="<?= $admin_url ?>modal-manager" class="nav-item<?= nav_active('modal-manager', $current) ?>"><i class="fas fa-puzzle-piece"></i>CMPT Manager</a>
        <a href="<?= $admin_url ?>setting" class="nav-item<?= nav_active('setting', $current) ?>"><i class="fas fa-gear"></i>Settings</a>
        <a href="<?= $admin_url ?>logout" class="nav-item nav-logout"><i class="fas fa-right-from-bracket"></i>Logout</a>
      </nav>
    </aside>
  </div>
  <div class="main-content">
</html>
-->

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $page_title ?></title>

  <meta name="description" content="Admin Dashboard">
  <meta name="theme-color" content="#ffffff">
  <link rel="canonical" href="<?= BASE_URL ?>">
  <link rel="icon" href="<?= IMG_URL ?>favicon.ico" type="image/x-icon">
  
  <link rel="preload" as="font" href="<?= FONTS_URL ?>inter-v20-latin-regular.woff2" type="font/woff2" crossorigin>
  <link rel="preload" as="font" href="<?= FONTS_URL ?>inter-v20-latin-700.woff2" type="font/woff2" crossorigin>
  <link rel="preload" as="font" href="<?= FONTS_URL ?>inter-v20-latin-900.woff2" type="font/woff2" crossorigin>

  <link rel="stylesheet" href="<?= CSS_URL ?>bs533.min.css">
  <link rel="stylesheet" href="<?= CSS_URL ?>assets.css">
  
  <link rel="preload" as="style" href="<?= CSS_URL ?>component.css">
  <link rel="stylesheet" href="<?= CSS_URL ?>component.css" media="print" onload="this.media='all'">
  
  <link rel="preload" as="style" href="<?= CSS_URL ?>style.css">
  <link rel="stylesheet" href="<?= CSS_URL ?>style.css" media="print" onload="this.media='all'">
  
  <link rel="preload" as="style" href="<?= CSS_URL ?>fa651.all.min.css">
  <link rel="stylesheet" href="<?= CSS_URL ?>fa651.all.min.css" media="print" onload="this.media='all'">
  
  <noscript>
    <link rel="stylesheet" href="<?= CSS_URL ?>component.css">
    <link rel="stylesheet" href="<?= CSS_URL ?>style.css">
    <link rel="stylesheet" href="<?= CSS_URL ?>fa651.all.min.css">
  </noscript>

  <script src="<?= JS_URL ?>bs533.bundle.min.js" defer></script>
  <script src="<?= JS_URL ?>navbar.js" defer></script>
</head>
<body>
<nav class="navbar">
  <div class="container">
    <a class="navbar-brand" aria-label="Admin Dashboard" href="<?= BASE_URL
    ?>/admin/">
      Dashboard
    </a>
    <div class="nav-desktop" id="navbarNav">
      <ul class="nav-desktop-list">
        <li class="nav-desktop-item nav-desktop-dropdown">
          <button class="nav-desktop-link nav-dd-trigger" aria-expanded="false">
            <i class="fa-solid fa-grip" aria-hidden="true"></i>
            Pintasan
            <i class="fa-solid fa-chevron-down nav-dd-chevron" aria-hidden="true"></i>
          </button>
          <div class="nav-dd-panel">
            <a class="nav-dd-item" href="#"><i class="fa-solid fa-landmark"></i></a>
            <a class="nav-dd-item" href="#"><i class="fa-solid fa-broom-ball"></i></a>
            <a class="nav-dd-item" href="#"><i class="fa-solid fa-bowl-rice"></i></a>
            <a class="nav-dd-item" href="#"><i class="fa-solid fa-bus"></i></a>
            <a class="nav-dd-item" href="#"><i class="fa-solid fa-map-location-dot"></i></a>
            <a class="nav-dd-item" href="#"><i class="fa-solid fa-hotel"></i></a>
          </div>
        </li>
        <li class="nav-desktop-item">
          <a class="nav-desktop-link" href="#">
            <i class="fa-solid fa-newspaper" aria-hidden="true"></i>Dashboard
          </a>
        </li>
        <li class="nav-desktop-item">
          <a class="nav-desktop-link" href="<?= ADMIN_VIEW_PATH
          ?>blog-manager.php">
            <i class="fa-solid fa-book" aria-hidden="true"></i>blog-manager
          </a>
        </li>
        <li class="nav-desktop-item">
          <a class="nav-desktop-link" href="<?= ADMIN_VIEW_PATH
          ?>pages/index.php">
            <i class="fa-solid fa-location-dot" aria-hidden="true"></i>Pages
            Builder
          </a>
        </li>
        <li class="nav-desktop-item">
          <a class="nav-desktop-link" href="<?= ADMIN_VIEW_PATH
          ?>modal-manager.php">
            <i class="fa-solid fa-envelope" aria-hidden="true"></i>CMPT MANAGER
          </a>
        </li>
        <li class="nav-desktop-item">
          <a class="nav-desktop-link" href="<?= ADMIN_VIEW_PATH
          ?>setting.php">
            <i class="fa-solid fa-envelope" aria-hidden="true"></i>Setting
          </a>
        </li>
        <li class="nav-desktop-item">
          <a class="nav-desktop-link" href="<?= ADMIN_VIEW_PATH
          ?>database-manager.php">
            <i class="fa-solid fa-envelope" aria-hidden="true"></i>Database
            Manager
          </a>
        </li>
        <li class="nav-desktop-item">
          <a class="nav-desktop-link" href="<?= ADMIN_VIEW_PATH
          ?>newsletter.php">
            <i class="fa-solid fa-envelope" aria-hidden="true"></i>Newsletter
          </a>
        </li>
        <li class="nav-desktop-item">
          <a class="nav-desktop-link" href="<?= ADMIN_VIEW_PATH
          ?>logout.php">
            <i class="fa-solid fa-envelope" aria-hidden="true"></i>Logout
          </a>
        </li>

      </ul>
    </div>
    <div class="navbar-actions">
      <button class="dm-btn" id="dmToggle" aria-label="Toggle dark mode"
        onclick="toggleDark(this)">
        <div class="dm-icon">
          <svg class="dm-svg" viewBox="0 0 20 20" fill="none"
               stroke="currentColor" stroke-width="1.8">
            <circle class="sun-core" cx="10" cy="10" r="4"/>
            <line class="sun-ray" x1="10" y1="1"   x2="10" y2="3"/>
            <line class="sun-ray" x1="10" y1="17"  x2="10" y2="19"/>
            <line class="sun-ray" x1="1"  y1="10"  x2="3"  y2="10"/>
            <line class="sun-ray" x1="17" y1="10"  x2="19" y2="10"/>
            <line class="sun-ray" x1="3.2"  y1="3.2"  x2="4.6"  y2="4.6"/>
            <line class="sun-ray" x1="15.4" y1="15.4" x2="16.8" y2="16.8"/>
            <line class="sun-ray" x1="15.4" y1="4.6"  x2="16.8" y2="3.2"/>
            <line class="sun-ray" x1="3.2"  y1="16.8" x2="4.6"  y2="15.4"/>
          </svg>
          <svg class="dm-svg" viewBox="0 0 20 20" fill="none"
               stroke="currentColor" stroke-width="1.8">
            <path class="moon-path" stroke-linecap="round" stroke-linejoin="round"
                  d="M17 12.5A7 7 0 0 1 9 4.5a7 7 0 1 0 8 8z"/>
            <circle class="star star-1" cx="15" cy="4"  r="0.8" fill="currentColor" stroke="none"/>
            <circle class="star star-2" cx="17" cy="7"  r="0.5" fill="currentColor" stroke="none"/>
            <circle class="star star-3" cx="13" cy="2"  r="0.5" fill="currentColor" stroke="none"/>
          </svg>
        </div>
      </button>
      <button class="navbar-toggler" type="button" id="navbarToggler" aria-label="Toggle Menu">
        <span class="hamburger-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
               stroke-width="2.2" stroke-linecap="round">
            <line class="h-top" x1="3" y1="6"  x2="21" y2="6"/>
            <line class="h-mid" x1="3" y1="12" x2="21" y2="12"/>
            <line class="h-bot" x1="3" y1="18" x2="21" y2="18"/>
          </svg>
        </span>
      </button>
    </div>
  </div>
</nav>
<div class="menu-overlay" id="menuOverlay"></div>
<div class="navbar-collapse" id="navbarNav-mobile">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mb-2" href="#" role="button" data-bs-toggle="dropdown">
            <i class="fa-solid fa-grip"></i> Pintasan
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-landmark me-2"></i></a></li>
            
          </ul>
        </li>
         <li class="nav-desktop-item">
          <a class="nav-desktop-link" href="#">
            <i class="fa-solid fa-newspaper" aria-hidden="true"></i>Dashboard
          </a>
        </li>
        <li class="nav-desktop-item">
          <a class="nav-desktop-link" href="<?= ADMIN_VIEW_PATH
          ?>blog-manager.php">
            <i class="fa-solid fa-book" aria-hidden="true"></i>blog-manager
          </a>
        </li>
        <li class="nav-desktop-item">
          <a class="nav-desktop-link" href="<?= ADMIN_VIEW_PATH
          ?>pages/index.php">
            <i class="fa-solid fa-location-dot" aria-hidden="true"></i>Pages
            Builder
          </a>
        </li>
        <li class="nav-desktop-item">
          <a class="nav-desktop-link" href="<?= ADMIN_VIEW_PATH
          ?>modal-manager.php">
            <i class="fa-solid fa-envelope" aria-hidden="true"></i>CMPT MANAGER
          </a>
        </li>
        <li class="nav-desktop-item">
          <a class="nav-desktop-link" href="<?= ADMIN_VIEW_PATH
          ?>setting.php">
            <i class="fa-solid fa-envelope" aria-hidden="true"></i>Setting
          </a>
        </li>
        <li class="nav-desktop-item">
          <a class="nav-desktop-link" href="<?= ADMIN_VIEW_PATH
          ?>database-manager.php">
            <i class="fa-solid fa-envelope" aria-hidden="true"></i>Database
            Manager
          </a>
        </li>
        <li class="nav-desktop-item">
          <a class="nav-desktop-link" href="<?= ADMIN_VIEW_PATH
          ?>newsletter.php">
            <i class="fa-solid fa-envelope" aria-hidden="true"></i>Newsletter
          </a>
        </li>
        <li class="nav-desktop-item">
          <a class="nav-desktop-link" href="<?= ADMIN_VIEW_PATH
          ?>logout.php">
            <i class="fa-solid fa-envelope" aria-hidden="true"></i>Logout
          </a>
        </li>
          <div>
          <small>
             Logged as, <strong><?= $admin_name?></strong>
          </small>
          </div>
      </ul>
    </div>
<button id="scrollTopBtn" class="scroll-top-btn" aria-label="Scroll to top">↑</button>
<div class="main-content">