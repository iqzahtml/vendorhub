<?php

require_once "config.php";

include "includes/header.php";
include "includes/navbar.php";

if (
    !isset(
        $_GET[
            'id'
        ]
    )
) {

    header(
        "Location: order.php"
    );

    exit();

}

$order_id =
    intval(
        $_GET[
            'id'
        ]
    );

$customer_id =
    $_SESSION[
        'user_id'
    ];


/*
|--------------------------------------------------------------------------
| GET ORDER
|--------------------------------------------------------------------------
*/

$orderSql = "

    SELECT

        o.order_id,
        o.order_date,
        o.total_amount,
        o.delivery_method,
        o.order_status,

        p.payment_method,
        p.payment_status,
        p.payment_date

    FROM orders o

    LEFT JOIN payments p

        ON o.order_id =
        p.order_id

    WHERE

        o.order_id = ?

    AND

        o.customer_id = ?

    LIMIT 1

";

$orderStmt =
    mysqli_prepare(
        $conn,
        $orderSql
    );

mysqli_stmt_bind_param(
    $orderStmt,
    "ii",
    $order_id,
    $customer_id
);

mysqli_stmt_execute(
    $orderStmt
);

$orderResult =
    mysqli_stmt_get_result(
        $orderStmt
    );

$order =
    mysqli_fetch_assoc(
        $orderResult
    );

if (
    !$order
) {

    header(
        "Location: order.php"
    );

    exit();

}


/*
|--------------------------------------------------------------------------
| GET ORDER DETAILS
|--------------------------------------------------------------------------
*/

$detailSql = "

    SELECT

        od.product_id,
        od.quantity,
        od.unit_price,
        od.subtotal,

        p.product_name,
        p.image

    FROM order_details od

    INNER JOIN products p

        ON od.product_id =
        p.product_id

    WHERE od.order_id = ?

";

$detailStmt =
    mysqli_prepare(
        $conn,
        $detailSql
    );

mysqli_stmt_bind_param(
    $detailStmt,
    "i",
    $order_id
);

mysqli_stmt_execute(
    $detailStmt
);

$detailResult =
    mysqli_stmt_get_result(
        $detailStmt
    );

?>

<main class="order-details-page">

    <section class="page-header">

        <div class="page-header-content">

            <h1>

                Order #

                <?= $order[
                    'order_id'
                ] ?>

            </h1>

            <p>

                Order details and payment information.

            </p>

        </div>

    </section>

    <section class="order-details-section">

        <div
            class="order-information"
        >

            <div>

                <strong>

                    Order Date

                </strong>

                <p>

                    <?= date(
                        "d M Y H:i",
                        strtotime(
                            $order[
                                'order_date'
                            ]
                        )
                    ) ?>

                </p>

            </div>

            <div>

                <strong>

                    Status

                </strong>

                <p>

                    <?= htmlspecialchars(
                        $order[
                            'order_status'
                        ]
                    ) ?>

                </p>

            </div>

            <div>

                <strong>

                    Delivery

                </strong>

                <p>

                    <?= htmlspecialchars(
                        $order[
                            'delivery_method'
                        ]
                    ) ?>

                </p>

            </div>

            <div>

                <strong>

                    Payment

                </strong>

                <p>

                    <?= htmlspecialchars(
                        $order[
                            'payment_method'
                        ]
                    ) ?>

                    -

                    <?= htmlspecialchars(
                        $order[
                            'payment_status'
                        ]
                    ) ?>

                </p>

            </div>

        </div>

        <div
            class="order-items"
        >

            <h2>

                Order Items

            </h2>

            <?php while (
                $item =
                mysqli_fetch_assoc(
                    $detailResult
                )
            ): ?>

                <div
                    class="order-item"
                >

                    <div>

                        <h3>

                            <?= htmlspecialchars(
                                $item[
                                    'product_name'
                                ]
                            ) ?>

                        </h3>

                        <p>

                            Quantity:

                            <?= $item[
                                'quantity'
                            ] ?>

                        </p>

                    </div>

                    <strong>

                        RM

                        <?= number_format(
                            $item[
                                'subtotal'
                            ],
                            2
                        ) ?>

                    </strong>

                </div>

            <?php endwhile; ?>

        </div>

        <div
            class="order-total"
        >

            <strong>

                Total Amount

            </strong>

            <strong>

                RM

                <?= number_format(
                    $order[
                        'total_amount'
                    ],
                    2
                ) ?>

            </strong>

        </div>

        <a
            href="order.php"
            class="btn btn-outline"
        >

            Back to Orders

        </a>

    </section>

</main>

<?php

include "includes/footer.php";

?>