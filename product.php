<?php

require_once "includes/header.php";

?>

<?php include "includes/navbar.php"; ?>

<?php

$search = "";
$category_id = "";
$vendor_id = "";

if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
}

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
}

if (isset($_GET['vendor_id'])) {
    $vendor_id = $_GET['vendor_id'];
}

/*
|--------------------------------------------------------------------------
| GET CATEGORIES
|--------------------------------------------------------------------------
*/

$categoryQuery = "
    SELECT
        category_id,
        category_name
    FROM categories
    ORDER BY category_name ASC
";

$categoryResult = mysqli_query(
    $conn,
    $categoryQuery
);

/*
|--------------------------------------------------------------------------
| GET VENDORS
|--------------------------------------------------------------------------
*/

$vendorQuery = "
    SELECT
        v.vendor_id,
        v.business_name
    FROM vendors v
    WHERE v.approval_status = 'Approved'
    ORDER BY v.business_name ASC
";

$vendorResult = mysqli_query(
    $conn,
    $vendorQuery
);

/*
|--------------------------------------------------------------------------
| GET PRODUCTS
|--------------------------------------------------------------------------
*/

$sql = "
    SELECT
        p.product_id,
        p.product_name,
        p.description,
        p.price,
        p.stock_quantity,
        p.image,

        v.vendor_id,
        v.business_name,

        c.category_id,
        c.category_name

    FROM products p

    INNER JOIN vendors v
        ON p.vendor_id = v.vendor_id

    INNER JOIN categories c
        ON p.category_id = c.category_id

    WHERE v.approval_status = 'Approved'
";

$params = [];
$types = "";

/*
|--------------------------------------------------------------------------
| SEARCH PRODUCT
|--------------------------------------------------------------------------
*/

if (!empty($search)) {

    $sql .= "
        AND p.product_name LIKE ?
    ";

    $params[] = "%" . $search . "%";

    $types .= "s";
}

/*
|--------------------------------------------------------------------------
| FILTER CATEGORY
|--------------------------------------------------------------------------
*/

if (!empty($category_id)) {

    $sql .= "
        AND p.category_id = ?
    ";

    $params[] = $category_id;

    $types .= "i";
}

/*
|--------------------------------------------------------------------------
| FILTER VENDOR
|--------------------------------------------------------------------------
*/

if (!empty($vendor_id)) {

    $sql .= "
        AND p.vendor_id = ?
    ";

    $params[] = $vendor_id;

    $types .= "i";
}

$sql .= "
    ORDER BY p.product_id DESC
";

$stmt = mysqli_prepare(
    $conn,
    $sql
);

if (!empty($params)) {

    mysqli_stmt_bind_param(
        $stmt,
        $types,
        ...$params
    );
}

mysqli_stmt_execute($stmt);

$productResult = mysqli_stmt_get_result($stmt);

?>

<main class="product-page">

    <section class="page-header">

        <div class="page-header-content">

            <h1>
                Explore Products
            </h1>

            <p>
                Discover products from different vendors
                on VendorHub.
            </p>

        </div>

    </section>

    <section class="product-section">

        <div class="product-layout">

            <!-- FILTER SIDEBAR -->

            <aside class="filter-sidebar">

                <h3>
                    Filter Products
                </h3>

                <form method="GET"
                      action="product.php">

                    <div class="filter-group">

                        <label for="search">

                            Search Product

                        </label>

                        <input
                            type="text"
                            id="search"
                            name="search"
                            placeholder="Search products..."
                            value="<?= htmlspecialchars($search) ?>"
                        >

                    </div>

                    <div class="filter-group">

                        <label for="category_id">

                            Category

                        </label>

                        <select
                            name="category_id"
                            id="category_id"
                        >

                            <option value="">

                                All Categories

                            </option>

                            <?php while (
                                $category =
                                mysqli_fetch_assoc(
                                    $categoryResult
                                )
                            ): ?>

                                <option
                                    value="<?= $category['category_id'] ?>"
                                    <?= $category_id ==
                                        $category['category_id']
                                        ? 'selected'
                                        : ''
                                    ?>
                                >

                                    <?= htmlspecialchars(
                                        $category['category_name']
                                    ) ?>

                                </option>

                            <?php endwhile; ?>

                        </select>

                    </div>

                    <div class="filter-group">

                        <label for="vendor_id">

                            Vendor

                        </label>

                        <select
                            name="vendor_id"
                            id="vendor_id"
                        >

                            <option value="">

                                All Vendors

                            </option>

                            <?php while (
                                $vendor =
                                mysqli_fetch_assoc(
                                    $vendorResult
                                )
                            ): ?>

                                <option
                                    value="<?= $vendor['vendor_id'] ?>"
                                    <?= $vendor_id ==
                                        $vendor['vendor_id']
                                        ? 'selected'
                                        : ''
                                    ?>
                                >

                                    <?= htmlspecialchars(
                                        $vendor['business_name']
                                    ) ?>

                                </option>

                            <?php endwhile; ?>

                        </select>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary filter-button"
                    >

                        Apply Filter

                    </button>

                    <a
                        href="product.php"
                        class="clear-filter"
                    >

                        Clear Filter

                    </a>

                </form>

            </aside>

            <!-- PRODUCTS -->

            <div class="products-container">

                <div class="products-topbar">

                    <h2>
                        Available Products
                    </h2>

                    <span>

                        <?= mysqli_num_rows(
                            $productResult
                        ) ?>

                        product(s) found

                    </span>

                </div>

                <?php if (
                    mysqli_num_rows(
                        $productResult
                    ) > 0
                ): ?>
                <div class="product-grid">

                        <?php while (
                            $product =
                            mysqli_fetch_assoc(
                                $productResult
                            )
                        ): ?>

                            <div class="product-card">

                                <div class="product-image">

                                    <?php if (
                                        !empty(
                                            $product['image']
                                        )
                                    ): ?>

                                        <img
                                            src="uploads/products/<?= htmlspecialchars(
                                                $product['image']
                                            ) ?>"
                                            alt="<?= htmlspecialchars(
                                                $product['product_name']
                                            ) ?>"
                                        >

                                    <?php else: ?>

                                        <div class="no-image">

                                            🛍️

                                        </div>

                                    <?php endif; ?>

                                </div>

                                <div class="product-info">

                                    <span class="product-category">

                                        <?= htmlspecialchars(
                                            $product['category_name']
                                        ) ?>

                                    </span>

                                    <h3>

                                        <?= htmlspecialchars(
                                            $product['product_name']
                                        ) ?>

                                    </h3>

                                    <p class="vendor-name">

                                        Sold by:

                                        <strong>

                                            <?= htmlspecialchars(
                                                $product['business_name']
                                            ) ?>

                                        </strong>

                                    </p>

                                    <p class="product-description">

                                        <?= htmlspecialchars(
                                            substr(
                                                $product['description'],
                                                0,
                                                100
                                            )
                                        ) ?>

                                        <?php if (
                                            strlen(
                                                $product['description']
                                            ) > 100
                                        ): ?>

                                            ...

                                        <?php endif; ?>

                                    </p>

                                    <div class="product-bottom">

                                        <span class="product-price">

                                            RM
                                            <?= number_format(
                                                $product['price'],
                                                2
                                            ) ?>

                                        </span>

                                        <?php if (
                                            $product['stock_quantity']
                                            > 0
                                        ): ?>

                                            <span
                                            class="stock available"
                                            >

                                                <?= $product[
                                                    'stock_quantity'
                                                ] ?>

                                                in stock

                                            </span>

                                        <?php else: ?>

                                            <span
                                                class="stock unavailable"
                                            >

                                                Out of stock

                                            </span>

                                        <?php endif; ?>

                                    </div>

                                    <a
                                        href="product_details.php?id=<?= $product['product_id'] ?>"
                                        class="btn btn-primary product-button"
                                    >

                                        View Details

                                    </a>

                                </div>

                            </div>

                        <?php endwhile; ?>

                    </div>

                <?php else: ?>

                    <div class="empty-products">

                        <div class="empty-icon">

                            🔍

                        </div>

                        <h3>

                            No Products Found

                        </h3>

                        <p>

                            Try changing your search
                            or filter options.

                        </p>

                        <a
                            href="product.php"
                            class="btn btn-primary"
                        >

                            View All Products

                        </a>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </section>

</main>

<?php include "includes/footer.php"; ?>
