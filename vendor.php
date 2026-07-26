<?php

require_once "includes/header.php";

?>

<?php include "includes/navbar.php"; ?>

<?php

/*
|--------------------------------------------------------------------------
| SINGLE VENDOR PAGE
|--------------------------------------------------------------------------
*/

if (
    isset($_GET['id']) &&
    is_numeric($_GET['id'])
) {

    $vendor_id = intval(
        $_GET['id']
    );

    /*
    |--------------------------------------------------------------------------
    | GET VENDOR
    |--------------------------------------------------------------------------
    */

    $vendorSql = "

        SELECT

            v.vendor_id,
            v.business_name,
            v.business_address,
            v.category,
            v.delivery_method,
            v.approval_status

        FROM vendors v

        WHERE v.vendor_id = ?

        AND v.approval_status = 'Approved'

        LIMIT 1

    ";

    $vendorStmt = mysqli_prepare(
        $conn,
        $vendorSql
    );

    mysqli_stmt_bind_param(
        $vendorStmt,
        "i",
        $vendor_id
    );

    mysqli_stmt_execute(
        $vendorStmt
    );

    $vendorResult =
        mysqli_stmt_get_result(
            $vendorStmt
        );

    if (
        mysqli_num_rows(
            $vendorResult
        ) === 0
    ) {

        header(
            "Location: vendor.php"
        );

        exit();

    }

    $vendor =
        mysqli_fetch_assoc(
            $vendorResult
        );

    /*
    |--------------------------------------------------------------------------
    | GET VENDOR PRODUCTS
    |--------------------------------------------------------------------------
    */

    $productSql = "

        SELECT

            p.product_id,
            p.product_name,
            p.description,
            p.price,
            p.stock_quantity,
            p.image,

            c.category_name

        FROM products p

        INNER JOIN categories c

            ON p.category_id =
            c.category_id

        WHERE p.vendor_id = ?

        ORDER BY p.product_id DESC

    ";

    $productStmt = mysqli_prepare(
        $conn,
        $productSql
    );

    mysqli_stmt_bind_param(
        $productStmt,
        "i",
        $vendor_id
    );

    mysqli_stmt_execute(
        $productStmt
    );

    $productResult =
        mysqli_stmt_get_result(
            $productStmt
        );

    ?>

    <main class="vendor-page">

        <section class="vendor-profile-header">

            <div class="vendor-profile-icon">

                🏪

            </div>

            <div>

                <h1>

                    <?= htmlspecialchars(
                        $vendor[
                            'business_name'
                        ]
                    ) ?>

                </h1>

                <?php if (
                    !empty(
                        $vendor[
                            'business_address'
                        ]
                    )
                ): ?>

                    <p>

                        📍

                        <?= nl2br(
                            htmlspecialchars(
                                $vendor[
                                    'business_address'
                                ]
                            )
                        ) ?>

                    </p>

                <?php endif; ?>

                <p>

                    🚚 Delivery Method:

                    <?= htmlspecialchars(
                        $vendor[
                            'delivery_method'
                        ]
                    ) ?>

                </p>

            </div>

        </section>

        <section class="vendor-products-section">

            <div class="section-title">

                <h2>

                    Products from this Vendor

                </h2>

                <p>

                    Browse products sold by

                    <?= htmlspecialchars(
                        $vendor[
                            'business_name'
                        ]
                        ) ?>

                </p>

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
                                        $product[
                                            'image'
                                        ]
                                    )
                                ): ?>

                                    <img
                                        src="uploads/products/<?= htmlspecialchars(
                                            $product[
                                                'image'
                                            ]
                                        ) ?>"
                                        alt="<?= htmlspecialchars(
                                            $product[
                                                'product_name'
                                            ]
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

                                <p
                                    class="product-description"
                                >

                                    <?= htmlspecialchars(
                                        substr(
                                            $product[
                                                'description'
                                            ],
                                            0,
                                            100
                                        )
                                    ) ?>

                                </p>

                                <div
                                    class="product-bottom"
                                >

                                    <span
                                        class="product-price"
                                    >

                                        RM
                                        <?= number_format(
                                            $product[
                                                'price'
                                            ],
                                            2
                                        ) ?>

                                    </span>

                                    <?php if (
                                        $product[
                                            'stock_quantity'
                                            ] > 0
                                    ): ?>

                                        <span
                                            class="stock available"
                                        >

                                            In Stock

                                        </span>

                                    <?php else: ?>

                                        <span
                                            class="stock unavailable"
                                        >

                                            Out of Stock

                                        </span>

                                    <?php endif; ?>

                                </div>

                                <a
                                    href="product_details.php?id=<?= $product[
                                        'product_id'
                                    ] ?>"
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

                        📦

                    </div>

                    <h3>

                        No Products Available

                    </h3>

                    <p>

                        This vendor has not added
                        any products yet.

                    </p>

                </div>

            <?php endif; ?>

        </section>

    </main>

<?php

} else {

    /*
    |--------------------------------------------------------------------------
    | ALL VENDORS PAGE
    |--------------------------------------------------------------------------
    */

    $vendorSql = "

        SELECT

            v.vendor_id,
            v.business_name,
            v.business_address,
            v.category,
            v.delivery_method,

            COUNT(
                p.product_id
            ) AS total_products

        FROM vendors v

        LEFT JOIN products p

            ON v.vendor_id =
            p.vendor_id

        WHERE v.approval_status =
            'Approved'

        GROUP BY

            v.vendor_id,
            v.business_name,
            v.business_address,
            v.category,
            v.delivery_method

        ORDER BY

            v.business_name ASC

    ";

    $vendorResult = mysqli_query(
        $conn,
        $vendorSql
    );

    ?>

    <main class="vendor-page">

        <section class="page-header">

            <div class="page-header-content">

                <h1>

                    Our Vendors

                </h1>

                <p>

                    Discover businesses and products
                    available on VendorHub.

                </p>

            </div>

        </section>

        <section class="vendor-section">

            <?php if (
                mysqli_num_rows(
                    $vendorResult
                ) > 0
            ): ?>

                <div class="vendor-grid">

                    <?php while (
                        $vendor =
                        mysqli_fetch_assoc(
                            $vendorResult
                        )
                    ): ?>

                        <div class="vendor-card">

                            <div
                                class="vendor-card-icon"
                            >

                                🏪

                            </div>

                            <h2>

                                <?= htmlspecialchars(
                                    $vendor[
                                        'business_name'
                                    ]
                                ) ?>

                            </h2>
                            <?php if (
                                !empty(
                                    $vendor[
                                        'category'
                                    ]
                                )
                            ): ?>

                                <span
                                    class="vendor-category"
                                >

                                    <?= htmlspecialchars(
                                        $vendor[
                                            'category'
                                        ]
                                    ) ?>

                                </span>

                            <?php endif; ?>

                            <?php if (
                                !empty(
                                    $vendor[
                                        'business_address'
                                    ]
                                )
                            ): ?>

                                <p>

                                    📍

                                    <?= htmlspecialchars(
                                        $vendor[
                                            'business_address'
                                        ]
                                    ) ?>

                                </p>

                            <?php endif; ?>

                            <div
                                class="vendor-card-details"
                            >

                                <span>

                                    📦

                                    <?= $vendor[
                                        'total_products'
                                    ] ?>

                                    product(s)

                                </span>

                                <span>

                                    🚚

                                    <?= htmlspecialchars(
                                        $vendor[
                                            'delivery_method'
                                        ]
                                    ) ?>

                                </span>

                            </div>

                            <a
                                href="vendor.php?id=<?= $vendor[
                                    'vendor_id'
                                ] ?>"
                                class="btn btn-primary"
                            >

                                View Vendor

                            </a>

                        </div>

                    <?php endwhile; ?>

                </div>

            <?php else: ?>

                <div class="empty-products">

                    <div class="empty-icon">

                        🏪

                    </div>

                    <h3>

                        No Vendors Available

                    </h3>

                    <p>

                        There are currently no approved
                        vendors.

                    </p>

                </div>

            <?php endif; ?>

        </section>

    </main>

<?php

}

?>

<?php include "includes/footer.php"; ?>