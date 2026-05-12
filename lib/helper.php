<?php
// Set cookies
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        "cookie_httponly" => true,
        "cookie_secure"   => isset($_SERVER["HTTPS"]),
        "cookie_samesite" => "Lax",
    ]);
}

// CSRF token
function generate_csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function regenerate_csrf_token(): void {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function verify_csrf_token(string $token): bool {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

function validate_csrf(): void {
    if (
        !isset($_POST['csrf_token'], $_SESSION['csrf_token']) ||
        !hash_equals((string)$_SESSION['csrf_token'], (string)$_POST['csrf_token'])
    ) {
        http_response_code(403);
        die('Invalid CSRF token. Silakan refresh halaman dan coba lagi.');
    }
}

// Safe HTML
function safe_html($value): string {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

// Safe include
function safe_include($file_path, $fallback_title = "Konten")
{
  if (!file_exists($file_path)) {
    echo fallback_card($fallback_title);
    return;
  }
  ob_start();
  try {
    include $file_path;
    ob_end_flush();
  } catch (Throwable $e) {
    ob_end_clean();
    echo fallback_card($fallback_title);
  }
}

function fallback_card($title = "Konten")
{
  return '
    <div class="container py-6">
      <div class="row mx-auto">
        <div class="col-12">
            <div class="card card-glass">
                <div class="card-body text-center py-5">
                    <i class="fas fa-circle-notch fa-spin fa-1x text-muted mb-3"></i>
                    <h5 class="text-muted mb-1">' .
    htmlspecialchars($title) .
    '</h5>
                    <p class="text-muted small mb-0">Sedang dalam perbaikan.</p>
                </div>
            </div>
        </div>
      </div>
    </div>';
}
