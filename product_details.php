<?php

require_once "includes/header.php";

?>

<?php include "includes/navbar.php"; ?>

<?php

if (
    !isset($_GET['id']) ||
    !is_numeric($_GET['id'])
) {

    header(
        "Location: product.php"
    );

    exit();

}

$product_id = intval(
    $_GET['id']
);

/*
|--------------------------------------------------------------------------
| GET PRODUCT DETAILS
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
        v.business_address,
        v.category AS vendor_category,
        v.delivery_method,

        c.category_id,
        c.category_name

    FROM products p

    INNER JOIN vendors v
        ON p.vendor_id = v.vendor_id

    INNER JOIN categories c
        ON p.category_id = c.category_id

    WHERE p.product_id = ?

    AND v.approval_status = 'Approved'

    LIMIT 1
";

$stmt = mysqli_prepare(
    $conn,
    $sql
);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $product_id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result(
    $stmt
);

if (
    mysqli_num_rows(
        $result
    ) === 0
) {

    header(
        "Location: product.php"
    );

    exit();

}

$product = mysqli_fetch_assoc(
    $result
);

/*
|--------------------------------------------------------------------------
| GET REVIEWS
|--------------------------------------------------------------------------
*/

$reviewSql = "

    SELECT

        r.review_id,
        r.rating,
        r.review,
        r.review_date,

        u.name AS customer_name

    FROM reviews r

    INNER JOIN users u
        ON r.customer_id = u.user_id

    WHERE r.product_id = ?

    ORDER BY r.review_date DESC

";

$reviewStmt = mysqli_prepare(
    $conn,
    $reviewSql
);

mysqli_stmt_bind_param(
    $reviewStmt,
    "i",
    $product_id
);

mysqli_stmt_execute(
    $reviewStmt
);

$reviewResult = mysqli_stmt_get_result(
    $reviewStmt
);

/*
|--------------------------------------------------------------------------
| GET RATING
|--------------------------------------------------------------------------
*/

$ratingSql = "

    SELECT

        AVG(rating) AS average_rating,
        COUNT(review_id) AS total_reviews

    FROM reviews

    WHERE product_id = ?

";

$ratingStmt = mysqli_prepare(
    $conn,
    $ratingSql
);

mysqli_stmt_bind_param(
    $ratingStmt,
    "i",
    $product_id
);

mysqli_stmt_execute(
    $ratingStmt
);

$ratingResult = mysqli_stmt_get_result(
    $ratingStmt
);

$ratingData = mysqli_fetch_assoc(
    $ratingResult
);

$averageRating =
    $ratingData['average_rating'];

$totalReviews =
    $ratingData['total_reviews'];

?>

<main class="product-details-page">

    <section class="product-details-section">

        <div class="product-details-container">

            <!-- PRODUCT IMAGE -->

            <div class="details-image">

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

                    <div class="details-no-image">

                        🛍️

                    </div>

                <?php endif; ?>

            </div>

            <!-- PRODUCT INFORMATION -->

            <div class="details-info">

                <span class="details-category">

                    <?= htmlspecialchars(
                        $product['category_name']
                    ) ?>

                </span>

                <h1>

                    <?= htmlspecialchars(
                        $product['product_name']
                    ) ?>
                    </h1>

                <div class="rating-summary">

                    <span class="stars">

                        <?php

                        $roundedRating =
                            round(
                                $averageRating
                            );

                        for (
                            $i = 1;
                            $i <= 5;
                            $i++
                        ):

                        ?>

                            <?php if (
                                $i <=
                                $roundedRating
                            ): ?>

                                ★

                            <?php else: ?>

                                ☆

                            <?php endif; ?>

                        <?php endfor; ?>

                    </span>

                    <span>

                        <?= $averageRating
                            ? number_format(
                                $averageRating,
                                1
                            )
                            : "No rating"
                        ?>

                        (

                        <?= $totalReviews ?>

                        reviews)

                    </span>

                </div>

                <div class="details-price">

                    RM
                    <?= number_format(
                        $product['price'],
                        2
                    ) ?>

                </div>

                <div class="details-description">

                    <h3>

                        Product Description

                    </h3>

                    <p>

                        <?= nl2br(
                            htmlspecialchars(
                                $product[
                                    'description'
                                ]
                            )
                        ) ?>

                    </p>

                </div>

                <div class="details-stock">

                    <?php if (
                        $product[
                            'stock_quantity'
                        ] > 0
                    ): ?>

                        <span
                            class="stock available"
                        >

                            ✓

                            <?= $product[
                                'stock_quantity'
                            ] ?>

                            item(s) available

                        </span>

                    <?php else: ?>

                        <span
                            class="stock unavailable"
                        >

                            ✕ Out of Stock

                        </span>

                    <?php endif; ?>

                </div>

                <?php if (
                    $product[
                        'stock_quantity'
                    ] > 0
                ): ?>

                    <form
                        action="cart.php"
                        method="POST"
                        class="add-cart-form"
                    >

                        <input
                            type="hidden"
                            name="product_id"
                            value="<?= $product[
                                'product_id'
                            ] ?>"
                        >

                        <label
                            for="quantity"
                        >

                            Quantity

                        </label>

                        <input
                            type="number"
                            id="quantity"
                            name="quantity"
                            value="1"
                            min="1"
                            max="<?= $product[
                                'stock_quantity'
                            ] ?>"
                            class="quantity-input"
                            >

                        <button
                            type="submit"
                            name="add_to_cart"
                            class="btn btn-primary"
                        >

                            Add to Cart

                        </button>

                    </form>

                <?php else: ?>

                    <button
                        class="btn btn-outline"
                        disabled
                    >

                        Out of Stock

                    </button>

                <?php endif; ?>

            </div>

        </div>

    </section>

    <!-- VENDOR INFORMATION -->

    <section class="vendor-information-section">

        <div class="vendor-information">

            <h2>

                About the Vendor

            </h2>

            <div class="vendor-info-content">

                <div>

                    <h3>

                        <?= htmlspecialchars(
                            $product[
                                'business_name'
                            ]
                        ) ?>

                    </h3>

                    <?php if (
                        !empty(
                            $product[
                                'business_address'
                            ]
                        )
                    ): ?>

                        <p>

                            📍

                            <?= nl2br(
                                htmlspecialchars(
                                    $product[
                                        'business_address'
                                    ]
                                )
                            ) ?>

                        </p>

                    <?php endif; ?>

                    <p>

                        🚚 Delivery:

                        <?= htmlspecialchars(
                            $product[
                                'delivery_method'
                            ]
                        ) ?>

                    </p>

                </div>

                <a
                    href="vendor.php?id=<?= $product[
                        'vendor_id'
                    ] ?>"
                    class="btn btn-outline"
                >

                    View Vendor

                </a>

            </div>

        </div>

    </section>

    <!-- REVIEWS -->

    <section class="reviews-section">

        <div class="reviews-container">

            <h2>

                Customer Reviews

            </h2>

            <?php if (
                mysqli_num_rows(
                    $reviewResult
                ) > 0
            ): ?>

                <?php while (
                    $review =
                    mysqli_fetch_assoc(
                        $reviewResult
                    )
                ): ?>

                    <div class="review-card">

                        <div class="review-header">

                            <strong>

                                <?= htmlspecialchars(
                                    $review[
                                        'customer_name'
                                    ]
                                ) ?>

                            </strong>

                            <span>

                                <?= date(
                                    "d M Y",
                                    strtotime(
                                        $review[
                                            'review_date'
                                        ]
                                    )
                                ) ?>

                            </span>

                        </div>

                        <div class="review-stars">

                            <?php

                            for (
                                $i = 1;
                                $i <= 5;
                                $i++
                            ):
                            ?>

                                <?php if (
                                    $i <=
                                    $review[
                                        'rating'
                                    ]
                                ): ?>

                                    ★

                                <?php else: ?>

                                    ☆

                                <?php endif; ?>

                            <?php endfor; ?>

                        </div>

                        <p>

                            <?= nl2br(
                                htmlspecialchars(
                                    $review[
                                        'review'
                                    ]
                                )
                            ) ?>

                        </p>

                    </div>

                <?php endwhile; ?>

            <?php else: ?>

                <div class="empty-reviews">

                    <p>

                        No reviews yet.

                    </p>

                </div>

            <?php endif; ?>

        </div>

    </section>

</main>

<?php include "includes/footer.php"; ?>