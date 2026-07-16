<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<style>
    .site-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 40px;
        background-color: #ffffff;
        border-bottom: 1px solid #eee;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    }
    .nav-left {
        display: flex;
        align-items: center;
        gap: 30px;
    }
    .brand-logo {
        font-family: 'Georgia', serif;
        font-size: 22px;
        letter-spacing: 2px;
        text-transform: uppercase;
        text-decoration: none;
        color: #111;
        font-weight: bold;
        margin-right: 20px;
    }
    .nav-links {
        display: flex;
        gap: 20px;
    }
    .nav-links a {
        text-decoration: none;
        color: #555;
        font-size: 14px;
        font-weight: 500;
    }
    .nav-links a:hover {
        color: #000;
    }
    .nav-right {
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .search-container {
        position: relative;
        display: flex;
        align-items: center;
    }
    .search-input {
        padding: 8px 12px 8px 32px;
        border: 1px solid #ccc;
        font-size: 13px;
        outline: none;
        width: 200px;
    }
    .search-icon {
        position: absolute;
        left: 10px;
        color: #888;
        font-size: 14px;
    }
    .btn-nav {
        text-decoration: none;
        font-size: 14px;
        color: #111;
        font-weight: 600;
    }
    .btn-signup-nav {
        background: #222;
        color: #fff !important;
        padding: 8px 16px;
        border-radius: 2px;
    }
    .btn-signup-nav:hover {
        background: #000;
    }
</style>

<header class="site-header">
    <div class="nav-left">
        <a href="index.php" class="brand-logo">Hochipo Hub</a>
        <nav class="nav-links">
            <a href="index.php">Home</a>
            <a href="catalog.php">Catalog</a>
            <a href="location.php">Location</a>
        </nav>
    </div>

    <div class="nav-right">
        <div class="search-container">
            <span class="search-icon">🔍</span>
            <input type="text" placeholder="Search products..." class="search-input">
        </div>

        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="<?php 
                echo ($_SESSION['role'] === 'admin') ? 'admin_dashboard.php' : (($_SESSION['role'] === 'vendor') ? 'vendor_dashboard.php' : 'index.php'); 
            ?>" class="btn-nav">Dashboard (<?= htmlspecialchars($_SESSION['name']) ?>)</a>
            <a href="logout.php" class="btn-nav" style="color: #b91c1c;">Sign Out</a>
        <?php else: ?>
            <!-- Tukar ke pautan url terus ke page signup -->
            <a href="signup.php" class="btn-nav btn-signup-nav">Sign Up</a>
        <?php endif; ?>

        <a href="cart.php" class="btn-nav" style="font-size: 18px;">🛒</a>
    </div>
</header>