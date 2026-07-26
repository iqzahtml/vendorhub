<?php

$currentPage = basename(
    $_SERVER['PHP_SELF']
);

?>

<nav class="navbar">

    <div class="nav-container">

        <a href="index.php"
           class="logo">

            Vendor<span>Hub</span>

        </a>

        <div class="nav-links">

            <a href="index.php"
               class="<?= $currentPage == 'index.php' ? 'active' : '' ?>">

                Home

            </a>

            <a href="product.php"
               class="<?= $currentPage == 'product.php' ? 'active' : '' ?>">

                Products

            </a>

            <a href="category.php"
               class="<?= $currentPage == 'category.php' ? 'active' : '' ?>">

                Categories

            </a>

            <a href="vendor.php"
               class="<?= $currentPage == 'vendor.php' ? 'active' : '' ?>">

                Vendors

            </a>

            <?php if (isset($_SESSION['user_id'])): ?>

                <a href="cart.php"
                   class="<?= $currentPage == 'cart.php' ? 'active' : '' ?>">

                    Cart

                </a>

                <a href="order.php"
                   class="<?= $currentPage == 'order.php' ? 'active' : '' ?>">

                    My Orders

                </a>

                <div class="nav-user">

                    <span class="user-name">

                        Hi,
                        <?= htmlspecialchars(
                            $_SESSION['name']
                        ) ?>

                    </span>

                    <a href="profile.php">

                        Profile

                    </a>

                    <a href="logout.php"
                       class="btn btn-outline">

                        Logout

                    </a>

                </div>

            <?php else: ?>

                <a href="#"
                   class="btn btn-outline"
                   onclick="openLoginModal(); return false;">

                    Login

                </a>

                <a href="register.php"
                   class="btn btn-primary">

                    Register

                </a>

            <?php endif; ?>

        </div>

        <button class="menu-toggle"
                onclick="toggleMenu()">

            ☰

        </button>

    </div>

</nav>

<?php if (!isset($_SESSION['user_id'])): ?>

    <?php include __DIR__ . "/login_modal.php"; ?>

<?php endif; ?>