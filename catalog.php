<?php

require_once "config.php";

include "includes/header.php";

include "includes/navbar.php";

$search = "";

if (
    isset(
        $_GET['search']
    )
) {

    $search =
        trim(
            $_GET['search']
        );

}

$sql = "

    SELECT

        p.product_id,
        p.product_name,
        p.description,
        p.price,
        p.stock_quantity,
        p.image,

        v.business_name,

        c.category_name

    FROM products p

    INNER JOIN vendors v

        ON p.vendor_id =
        v.vendor_id

    INNER JOIN categories c

        ON p.category_id =
        c.category_id

    WHERE v.approval_status =
        'Approved'

";

if (
    !empty(
        $search
    )
) {

    $safeSearch =
        mysqli_real_escape_string(
            $conn,
            $search
        );

    $sql .= "

        AND (

            p.product_name LIKE
            '%$safeSearch%'

            OR

            p.description LIKE
            '%$safeSearch%'

            OR

            c.category_name LIKE
            '%$safeSearch%'

        )

    ";

}

$sql .= "

    ORDER BY
    p.product_id DESC

";

$result =
    mysqli_query(
        $conn,
        $sql
    );

?>

<main class="catalog-page">

    <section class="page-header">

        <h1>

            Product Catalog

        </h1>

        <p>

            Discover products from VendorHub vendors.

        </p>

    </section>

    <section class="product-section">

        <div class="catalog-search">

            <form
                method="GET"
                action="catalog.php"
            >

                <input
                    type="text"
                    name="search"
                    placeholder="Search products..."
                    value="<?= htmlspecialchars($search) ?>"
                >

                <button
                    type="submit"
                    class="btn btn-primary"
                >

                    Search

                </button>

            </form>

        </div>

        <div class="product-grid">

            <?php if (
                mysqli_num_rows(
                    $result
                ) > 0
            ): ?>

                <?php while (
                    $product =
                    mysqli_fetch_assoc(
                        $result
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

                            <span
                                class="product-category"
                            >

                                <?= htmlspecialchars(
                                    $product[
                                        'category_name'
                                    ]
                                ) ?>

                            </span>

                            <h3>

                                <?= htmlspecialchars(
                                    $product[
                                        'product_name'
                                    ]
                                ) ?>

                            </h3>
                            <p>

                                Vendor:

                                <?= htmlspecialchars(
                                    $product[
                                        'business_name'
                                    ]
                                ) ?>

                            </p>

                            <strong
                                class="product-price"
                            >

                                RM

                                <?= number_format(
                                    $product[
                                        'price'
                                    ],
                                    2
                                ) ?>

                            </strong>

                            <a
                                href="product_details.php?id=<?= $product[
                                    'product_id'
                                ] ?>"
                                class="btn btn-primary"
                            >

                                View Details

                            </a>

                        </div>

                    </div>

                <?php endwhile; ?>

            <?php else: ?>

                <p>

                    No products found.

                </p>

            <?php endif; ?>

        </div>

    </section>

</main>

<?php

include "includes/footer.php";

?>