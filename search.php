<?php

require_once "config.php";

include "includes/header.php";

include "includes/navbar.php";

$keyword = "";

if (
    isset(
        $_GET['q']
    )
) {

    $keyword =
        trim(
            $_GET['q']
        );

}

$safeKeyword =
    mysqli_real_escape_string(
        $conn,
        $keyword
    );

$sql = "

    SELECT

        p.product_id,
        p.product_name,
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

    WHERE

        v.approval_status =
        'Approved'

    AND

        (

            p.product_name LIKE
            '%$safeKeyword%'

            OR

            p.description LIKE
            '%$safeKeyword%'

            OR

            c.category_name LIKE
            '%$safeKeyword%'

        )

";

$result =
    mysqli_query(
        $conn,
        $sql
    );

?>

<main class="search-page">

    <section class="page-header">

        <h1>

            Search Results

        </h1>

        <p>

            Results for:

            <strong>

                <?= htmlspecialchars($keyword) ?>

            </strong>

        </p>

    </section>

    <section class="product-section">

        <div class="product-grid">

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
                            >

                        <?php else: ?>

                            <div class="no-image">

                                🛍️

                            </div>

                        <?php endif; ?>

                    </div>

                    <div class="product-info">

                        <h3>

                            <?= htmlspecialchars(
                                $product[
                                    'product_name'
                                ]
                            ) ?>

                        </h3>

                        <p>

                            <?= htmlspecialchars(
                                $product[
                                    'business_name'
                                ]
                            ) ?>

                        </p>

                        <strong>

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

                            View Product

                        </a>

                    </div>

                </div>

            <?php endwhile; ?>

        </div>

    </section>

</main>

<?php

include "includes/footer.php";

?>