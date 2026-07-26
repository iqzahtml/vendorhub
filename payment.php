<?php

require_once "config.php";

include "includes/header.php";
include "includes/navbar.php";

if (
    !isset(
        $_SESSION[
            'user_id'
        ]
    )
) {

    header(
        "Location: login.php"
    );

    exit();

}

if (
    empty(
        $_SESSION[
            'cart'
        ]
    )
) {

    header(
        "Location: cart.php"
    );

    exit();

}

$delivery_method =
    $_POST[
        'delivery_method'
    ]
    ?? "";

if (
    $delivery_method !==
    "Pickup"
    &&
    $delivery_method !==
    "Postage"
) {

    header(
        "Location: checkout.php"
    );

    exit();

}

$customer_id =
    $_SESSION[
        'user_id'
    ];

$cart =
    $_SESSION[
        'cart'
    ];

$totalAmount = 0;

$cartItems = [];

$productIds =
    array_keys(
        $cart
    );

$placeholders =
    implode(
        ",",
        array_fill(
            0,
            count(
                $productIds
            ),
            "?"
        )
    );

$types =
    str_repeat(
        "i",
        count(
            $productIds
        )
    );

$sql = "

    SELECT

        product_id,
        product_name,
        price,
        stock_quantity

    FROM products

    WHERE product_id

    IN ($placeholders)

";

$stmt =
    mysqli_prepare(
        $conn,
        $sql
    );

mysqli_stmt_bind_param(
    $stmt,
    $types,
    ...$productIds
);

mysqli_stmt_execute(
    $stmt
);

$result =
    mysqli_stmt_get_result(
        $stmt
    );

while (
    $product =
    mysqli_fetch_assoc(
        $result
    )
) {

    $product_id =
        $product[
            'product_id'
        ];

    $quantity =
        $cart[
            $product_id
        ];

    $subtotal =
        $product[
            'price'
        ] *
        $quantity;

    $product[
        'quantity'
    ] =
        $quantity;

    $product[
        'subtotal'
    ] =
        $subtotal;

    $totalAmount +=
        $subtotal;

    $cartItems[] =
        $product;

}

?>

<main class="payment-page">

    <section class="page-header">

        <div class="page-header-content">

            <h1>

                Payment

            </h1>

            <p>

                Select your payment method.

            </p>

        </div>

    </section>

    <section class="payment-section">

        <div class="payment-container">

            <form
                method="POST"
                action="payment.php"
                class="payment-form"
            >

                <input
                    type="hidden"
                    name="delivery_method"
                    value="<?= htmlspecialchars(
                        $delivery_method
                    ) ?>"
                >

                <h2>

                    Payment Method

                </h2>

                <div
                    class="form-group"
                >

                    <label
                        for="payment_method"
                    >

                        Select Payment Method

                    </label>

                    <select
                        name="payment_method"
                        id="payment_method"
                        required
                    >

                        <option
                            value=""
                        >

                            Select Payment

                        </option>

                        <option
                            value="FPX"
                        >

                            FPX

                        </option>

                        <option
                            value="Credit Card"
                        >

                            Credit Card

                        </option>

                        <option
                            value="Debit Card"
                        >

                            Debit Card

                        </option>

                        <option
                            value="Cash"
                        >

                            Cash
                            </option>

                    </select>

                </div>

                <p
                    id="payment-info"
                ></p>

                <button
                    type="submit"
                    name="place_order"
                    class="btn btn-primary"
                >

                    Place Order

                </button>

            </form>

            <div
                class="payment-summary"
            >

                <h2>

                    Order Total

                </h2>

                <h3>

                    RM

                    <?= number_format(
                        $totalAmount,
                        2
                    ) ?>

                </h3>

                <p>

                    Delivery:

                    <?= htmlspecialchars(
                        $delivery_method
                    ) ?>

                </p>

            </div>

        </div>

    </section>

</main>

<?php

if (
    isset(
        $_POST[
            'place_order'
        ]
    )
) {

    $payment_method =
        $_POST[
            'payment_method'
        ];

    mysqli_begin_transaction(
        $conn
    );

    try {

        /*
        |--------------------------------------------------------------------------
        | CREATE ORDER
        |--------------------------------------------------------------------------
        */

        $orderSql = "

            INSERT INTO orders

            (

                customer_id,
                total_amount,
                delivery_method

            )

            VALUES (?, ?, ?)

        ";

        $orderStmt =
            mysqli_prepare(
                $conn,
                $orderSql
            );

        mysqli_stmt_bind_param(
            $orderStmt,
            "ids",
            $customer_id,
            $totalAmount,
            $delivery_method
        );

        mysqli_stmt_execute(
            $orderStmt
        );

        $order_id =
            mysqli_insert_id(
                $conn
            );

        /*
        |--------------------------------------------------------------------------
        | CREATE ORDER DETAILS
        |--------------------------------------------------------------------------
        */

        foreach (
            $cartItems
            as $item
        ) {

            if (
                $item[
                    'quantity'
                ]
                >
                $item[
                    'stock_quantity'
                ]
            ) {

                throw new Exception(
                    "Insufficient stock."
                );

            }

            $detailSql = "

                INSERT INTO order_details

                (

                    order_id,
                    product_id,
                    quantity,
                    unit_price,
                    subtotal

                )

                VALUES (?, ?, ?, ?, ?)

            ";

            $detailStmt =
                mysqli_prepare(
                    $conn,
                    $detailSql
                );

            mysqli_stmt_bind_param(
                $detailStmt,
                "iiidd",
                $order_id,
                $item[
                    'product_id'
                ],
                $item[
                    'quantity'
                ],
                $item[
                    'price'
                ],
                $item[
                    'subtotal'
                ]
            );

            mysqli_stmt_execute(
                $detailStmt
            );

            /*
            |--------------------------------------------------------------------------
            | UPDATE STOCK
            |--------------------------------------------------------------------------
            */

            $updateStockSql = "

                UPDATE products

                SET stock_quantity =
                    stock_quantity - ?

                WHERE product_id = ?

            ";
            $stockStmt =
                mysqli_prepare(
                    $conn,
                    $updateStockSql
                );

            mysqli_stmt_bind_param(
                $stockStmt,
                "ii",
                $item[
                    'quantity'
                ],
                $item[
                    'product_id'
                ]
            );

            mysqli_stmt_execute(
                $stockStmt
            );

        }

        /*
        |--------------------------------------------------------------------------
        | CREATE PAYMENT
        |--------------------------------------------------------------------------
        */

        $paymentStatus =
            "Paid";

        $paymentDate =
            date(
                "Y-m-d H:i:s"
            );

        $paymentSql = "

            INSERT INTO payments

            (

                order_id,
                payment_method,
                payment_status,
                payment_date,
                amount

            )

            VALUES (?, ?, ?, ?, ?)

        ";

        $paymentStmt =
            mysqli_prepare(
                $conn,
                $paymentSql
            );

        mysqli_stmt_bind_param(
            $paymentStmt,
            "isssd",
            $order_id,
            $payment_method,
            $paymentStatus,
            $paymentDate,
            $totalAmount
        );

        mysqli_stmt_execute(
            $paymentStmt
        );

        mysqli_commit(
            $conn
        );

        $_SESSION[
            'cart'
        ] = [];

        header(
            "Location: order_details.php?id="
            . $order_id
        );

        exit();

    } catch (
        Exception $e
    ) {

        mysqli_rollback(
            $conn
        );

        echo "

            <script>

                alert(
                    'Order failed: "
                    . $e->getMessage()
                    . "'
                );

                window.location.href =
                    'cart.php';

            </script>

        ";

    }

}

?>

<script
    src="js/checkout.js"
></script>

<?php

include "includes/footer.php";

?>