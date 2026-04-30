<!doctype html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Dashboard</title>
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
            rel="stylesheet"
        />
        <link href="https://ayokebandung.id/assets/css/glassmorphism-blue3.css"
        rel="stylesheet">
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
                padding: 16px 24px;
                z-index: 3000;
                align-items: center;
                justify-content: space-between;
            }
            .mobile-menu-btn {
                background: 0 0;
                border: 0;
                font-size: 24px;
                color: var(--blue-950);
                cursor: pointer;
                padding: 8px;
                border-radius: 8px;
                transition: all 0.2s ease;
            }
            .mobile-menu-btn:hover {
                color: var(--blue-800);
            }
            .mobile-title {
                font-size: 20px;
                font-weight: 700;
                color: var(--blue-950);
            }
            .sidebar {
                width: 280px;
                background: var(--blue-100);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                z-index: 2000;
                position: fixed;
                height: 100vh;
                left: 0;
                top: 70px;
                transform: translateX(-100%);
            }
            #mobile-toggle:checked ~ .admin-container .sidebar {
                transform: translateX(0);
            }
            #mobile-toggle:checked ~ .admin-container::before {
                content: "";
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1500;
                backdrop-filter: blur(4px);
            }
            .sidebar-header {
                padding: 24px;
                border-bottom: 1px solid var(--blue-200);
                background: var(--blue-200);
                color: var(--blue-950);
                text-align: center;
            }
            .logo {
                font-size: 24px;
                font-weight: 700;
                margin-bottom: 8px;
            }
            .sidebar-nav {
                padding: 20px 0;
            }
            .nav-item {
                display: block;
                padding: 16px 24px;
                color: var(--blue-950);
                text-decoration: none;
                transition: all 0.2s ease;
                border-left: 4px solid transparent;
            }
            .nav-item:hover {
                background: var(--blue-200);
                color: var(--blue-800);
                border-left-color: var(--blue-800);
            }
            .nav-item i {
                width: 20px;
                margin-right: 12px;
                text-align: center;
            }
            .main-content {
                flex: 1;
                padding: 24px;
                margin-top: 70px;
                transition: all 0.3s ease;
            }
            .mobile-header ~ .main-content {
                padding-top: 80px;
                padding-left: 24px;
                padding-right: 24px;
            }
            .header {
                background: var(--blue-100);
                border: 2px solid var(--blue-200);
                padding: 24px;
                border-radius: 16px;
                margin-bottom: 24px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            .header h1 {
                font-size: 28px;
                font-weight: 700;
                color: var(--blue-950);
            }
            .user-profile {
                display: flex;
                align-items: center;
                gap: 12px;
            }
            .avatar {
                width: 48px;
                height: 48px;
                border-radius: 50%;
                background: var(--blue-100);
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--blue-950);
                font-weight: 600;
                font-size: 16px;
            }
            .stats-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 24px;
                margin-bottom: 32px;
            }
            .stat-card {
                background: var(--blue-200);
                padding: 32px;
                border-radius: 20px;
                border: 2px solid var(--blue-300);
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }
            .stat-card::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 4px;
                background: var(--blue-300);
            }
            .stat-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
            }
            
            .stat-number {
                font-size: 36px;
                font-weight: 700;
                margin-bottom: 8px;
                color: var(--blue-900);
            }
            .stat-label {
                color: var(--blue-950);
                font-weight: 500;
            }
            
            .orders-section {
                background: rgba(255,255,255, 0.5);
                border-radius: 20px;
                overflow: hidden;
                margin-bottom: 24px;
            }
            .orders-header {
                padding: 24px 32px;
                background: linear-gradient(135deg, var(--blue-200),
                var(--blue-50));
                color: #fff;
                display: flex;
                flex-direction: column;
                gap: 16px;
            }
            .orders-header h3 {
                margin: 0;
            }
            
            .orders-grid {
                display: grid;
                gap: 20px;
                padding: 32px;
            }
            @media (min-width: 768px) {
                .orders-grid {
                    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
                }
            }
            .order-card {
                background: var(--blue-100);
                border: 1px solid var(--blue-200);
                border-radius: 16px;
                padding: 24px;
                transition: all 0.2s ease;
                display: flex;
                flex-direction: column;
                gap: 16px;
            }
            .order-card:hover {
                background: var(--blue-200);
                transform: translateY(-4px);
            }
            .order-header {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                gap: 16px;
            }
            .order-id {
                font-size: 18px;
                font-weight: 700;
                color: var(--p);
            }
            .order-status {
                padding: 6px 16px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 600;
                text-transform: uppercase;
            }
            
            .order-details {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 12px;
                font-size: 14px;
            }
            .detail-label {
                color: var(--blue-950);
                font-weight: 500;
            }
            .detail-value {
                font-weight: 600;
                color: var(--blue-900);
            }
            .order-actions {
                display: flex;
                gap: 8px;
                margin-top: auto;
            }
            .action-btn {
                padding: 10px 16px;
                border: 0;
                border-radius: 10px;
                font-size: 13px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.2s ease;
                text-decoration: none;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 6px;
                flex: 1;
            }
            .btn-edit {
                background: var(--blue-700);
                color: var(--blue-100);
            }
            .btn-delete {
                background: var(--orange-500);
                color: #fff;
            }
            .btn-view {
                background: var(--blue-400);
                color: #fff;
            }
            .action-btn:hover {
                transform: translateY(-2px);
            }
         
            @media (max-width: 1024px) {
                .mobile-header {
                    display: flex;
                }
                .main-content {
                    padding-top: 80px !important;
                }
            }
            @media (max-width: 768px) {
                .stats-grid,
                .quick-actions-grid {
                    grid-template-columns: 1fr;
                }
                
                .orders-grid {
                    grid-template-columns: 1fr;
                    padding: 24px 16px;
                }
                .order-details {
                    grid-template-columns: 1fr;
                }
                .order-actions {
                    flex-direction: column;
                }
            }
            @media (max-width: 480px) {
                .sidebar {
                    width: 90vw;
                }
                .main-content {
                    padding-left: 16px;
                    padding-right: 16px;
                }
                .orders-header {
                    padding: 20px 16px;
                }
            }
        </style>
    </head>
    <body>
        <input type="checkbox" id="mobile-toggle" />
        <div class="mobile-header">
            <label for="mobile-toggle" class="mobile-menu-btn"
                ><i class="fas fa-bars"></i
            ></label>
            <div class="mobile-title font-bold">
                DASHBOARD
            </div>
        </div>
        <div class="admin-container">
            <div class="sidebar">
                
                <nav class="sidebar-nav">
                    <a href="<?php echo ADMIN_URL; ?>" class="nav-item"
                        ><i class="fas fa-tachometer-alt"></i>dashBoard</a
                    >
                    <a href="<?php echo ADMIN_URL; ?>database_manager" class="nav-item"
                        ><i class="fas fa-database"></i>DB Manager</a
                    >
                    <a href="<?php echo ADMIN_URL; ?>newsletter" class="nav-item"
                        ><i class="fas fa-plane"></i>Newsletter</a
                    >
                    <a href="<?php echo ADMIN_URL; ?>pages" class="nav-item"
                        ><i class="fas fa-plane"></i>Pages Builder</a
                    >
                    <a href="<?php echo ADMIN_URL; ?>blog_manager" class="nav-item"
                        ><i class="fas fa-chart-line"></i>Blog Builder</a
                    >
                    <a href="<?php echo ADMIN_URL; ?>modal_manager" class="nav-item"
                        ><i class="fas fa-chart-line"></i>CMPT Manager</a
                    >
                    <a href="<?php echo ADMIN_URL; ?>setting" class="nav-item"
                        ><i class="fas fa-cog"></i>Settings</a
                    >
                    <a href="<?php echo ADMIN_URL; ?>logout" class="nav-item"
                        ><i class="fas fa-sign-out-alt"></i>Logout</a
                    >
                </nav>
            </div>
            <div class="main-content">
                <div class="header">
                    <div>
                        <span><i class="fas fa-user"></i> Logged as,
                        <strong>
                         <?php echo htmlspecialchars($_SESSION['admin_name']); ?>
                        </strong></span>
                    </div>
                </div>
            </div>
        </div>