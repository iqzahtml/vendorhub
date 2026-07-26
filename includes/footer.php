<nav class="navbar">

    <a href="index.php" class="logo">
        Vendor<span>Hub</span>
    </a>

    <div class="nav-links">

        <a href="index.php">Home</a>

        <a href="product.php">Products</a>

        <a href="category.php">Categories</a>

        <a href="vendor.php">Vendors</a>

        <?php if (isset($_SESSION['user_id'])): ?>

            <a href="cart.php">Cart</a>

            <a href="order.php">My Orders</a>

            <a href="profile.php">
                <?= htmlspecialchars($_SESSION['name']) ?>
            </a>

            <a href="logout.php" class="btn btn-outline">
                Logout
            </a>

        <?php else: ?>

            <a href="login.php" class="btn btn-primary">
                Login
            </a>

            <a href="register.php" class="btn btn-secondary">
                Register
            </a>

        <?php endif; ?>

    </div>

</nav>