<?php
$lib_path = dirname(__DIR__) . '/lib/functions.php';
if (!file_exists($lib_path)) die('lib/functions.php missing: ' . $lib_path);
require_once $lib_path;
autoload_core();
session_start();
if (isset($_SESSION['admin_id'])) {
    header('Location: dashboard');
    exit;
}
// Proses login
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'])) {
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$_POST['username']]);
    $admin = $stmt->fetch();
    
    if($admin && password_verify($_POST['password'], $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['name'] ?? $admin['username'];
        
        // JANGAN REDIRECT DISINI - BIARKAN JAVASCRIPT HANDLE
        $login_success = true;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://ayokebandung.id/assets/css/glassmorphism-blue.css" rel="stylesheet">
  <style>
    body {
      background: #070707;
      color: var(--blue-100);
    }
    .login-card { 
      margin: auto;
      transform: translateY(50%);
      background: var(--blue-950);
      border-radius: 0.5rem;
      max-width: 420px;
      padding: 3rem 2.5rem;
      transition: all 0.3s ease;
    }
    
    .login-header h1 { 
      background: linear-gradient(135deg, var(--orange-500), var(--blue-500)); 
      -webkit-background-clip: text; 
      -webkit-text-fill-color: transparent; 
      background-clip: text;
      font-weight: 700;
      font-size: 2.5rem;
      line-height: 5rem;
      margin-bottom: 0.5rem;
    }
    
    .btn-login { 
      background: linear-gradient(135deg, var(--orange-500), var(--blue-500)); 
      border: none !important; 
      color: var(--blue-50);
      border-radius: 1rem; 
      padding: 0.875rem 2rem; 
      font-size: 1.1rem; 
      font-weight: 600; 
      width: 100%;
      transition: all 0.3s ease;
    }
    .btn-login:hover { transform: translateY(-2px); box-shadow: 0 1rem 2rem rgba(102,126,234,0.4) !important; }
    
    /* Form styling minimal */
    .form-control:focus { border-color: #667eea; box-shadow: 0 0 0 0.2rem rgba(102,126,234,0.25); }
    .input-group-text { background: #f8f9fa; border-right: none; }
    .form-control { border-left: none; }
    
    /* Redirect overlay minimal */
    #redirectOverlay {
    background: #070707;
    color: var(--blue-50);
      position: fixed; top: 0; left: 0; width: 100%; height: 100%;
      display: none; align-items: center; justify-content: center;
      z-index: 9999; flex-direction: column;
    }
    .success-icon { font-size: 5rem; color: white; animation: bounce 0.8s ease-out; margin-bottom: 1rem; }
    .countdown-number { font-size: 3rem; font-weight: 800; color: rgba(255,255,255,0.9); animation: pulse 1s infinite; }
    
    @keyframes bounce { 0%{transform:scale(0.3);opacity:0;} 50%{transform:scale(1.05);} 100%{transform:scale(1);opacity:1;} }
    @keyframes pulse { 0%,100%{transform:scale(1);} 50%{transform:scale(1.1);} }
    
    @media (max-width: 576px) { .login-card { margin: 1rem; padding: 2rem 1.5rem; } }
  </style>
</head>
<body>
  <!-- Redirect Overlay -->
  <div id="redirectOverlay">
    <div class="text-center">
      <div class="success-icon"><i class="fas fa-check-circle"></i></div>
      <div class="countdown-text text-white font-semibold fs-5 mb-2">Login Berhasil!</div>
      <div class="countdown-text text-white-50 fs-6 mb-1">Redirect dalam</div>
      <div class="countdown-number" id="countdown">2</div>
    </div>
  </div>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="login-card">
          <!-- Header -->
          <div class="login-header text-center mb-4">
            <h1>Admin Login</h1>
            <p class="mb-0 text-muted font-medium">Masukkan kredensial Anda</p>
          </div>

          <!-- Error Alert -->
          <?php if(isset($error)): ?>
            <div class="alert alert-danger d-flex align-items-center mb-4">
              <i class="fas fa-exclamation-triangle me-2"></i>
              <?= htmlspecialchars($error) ?>
            </div>
          <?php endif; ?>

          <!-- Form (FUNGSI SAMA) -->
          <form method="POST" id="loginForm">
            <div class="input-group mb-4">
              <span class="input-group-text"><i class="fas fa-user text-muted"></i></span>
              <input type="text" class="form-control" name="username" placeholder="Username" 
                     value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>" 
                     required autofocus>
            </div>

            <div class="input-group mb-4">
              <span class="input-group-text"><i class="fas fa-lock text-muted"></i></span>
              <input type="password" class="form-control" name="password" placeholder="Password" id="passwordField" required>
              <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                <i class="fas fa-eye"></i>
              </button>
            </div>

            <button type="submit" class="btn btn-login mb-3" id="loginBtn">
              <i class="fas fa-sign-in-alt me-2"></i>Masuk
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
    // Password toggle
    document.getElementById('togglePassword').onclick = function() {
      const pwd = document.getElementById('passwordField');
      const icon = this.querySelector('i');
      pwd.type = pwd.type === 'password' ? 'text' : 'password';
      icon.className = icon.className.includes('fa-eye') ? 'fas fa-eye-slash' : 'fas fa-eye';
    };

    // Form submit
    document.getElementById('loginForm').onsubmit = function() {
      const btn = document.getElementById('loginBtn');
      const overlay = document.getElementById('redirectOverlay');
      const countdown = document.getElementById('countdown');
      
      btn.disabled = true;
      btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengautentikasi...';
      
      setTimeout(() => {
        overlay.style.display = 'flex';
        let count = 2;
        const timer = setInterval(() => {
          countdown.textContent = count--;
          if (count < 0) {
            clearInterval(timer);
            window.location.href = 'dashboard';
          }
        }, 500);
      }, 500);
    };

    document.addEventListener('keydown', e => {
      if (e.key === 'Enter') document.getElementById('loginForm').dispatchEvent(new Event('submit'));
    });

    <?php if (isset($login_success)): ?>
    document.getElementById('loginForm').dispatchEvent(new Event('submit'));
    <?php endif; ?>
  </script>
</body>
</html>