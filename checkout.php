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

$customer_id =
    $_SESSION[
        'user_id'
    ];

$totalAmount = 0;

$cartItems = [];

$productIds =
    array_keys(
        $_SESSION[
            'cart'
        ]
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
        $_SESSION[
            'cart'
        ][
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

<main class="checkout-page">

    <section class="page-header">

        <div class="page-header-content">

            <h1>

                Checkout

            </h1>

            <p>

                Complete your order details.

            </p>

        </div>

    </section>

    <section class="checkout-section">

        <div class="checkout-container">

            <form
                method="POST"
                action="payment.php"
                class="checkout-form"
            >

                <h2>

                    Delivery Information

                </h2>

                <div
                    class="form-group"
                >

                    <label
                        for="delivery_method"
                    >

                        Delivery Method

                    </label>

                    <select
                        name="delivery_method"
                        id="delivery_method"
                        required
                    >

                        <option
                            value=""
                        >

                            Select Delivery Method

                        </option>

                        <option
                            value="Pickup"
                        >

                            Pickup

                        </option>

                        <option
                            value="Postage"
                        >

                            Postage

                        </option>

                    </select>

                </div>

                <p
                    id="delivery-message"
                ></p>

                <input
                    type="hidden"
                    name="total_amount"
                    value="<?= $totalAmount ?>"
                >

                <button
                    type="submit"
                    class="btn btn-primary"
                >

                    Continue to Payment

                </button>

            </form>

            <div
                class="checkout-summary"
            >

                <h2>

                    Order Summary

                </h2>

                <?php foreach (
                    $cartItems
                    as $item
                ): ?>
                <div
                        class="summary-row"
                    >

                        <span>

                            <?= htmlspecialchars(
                                $item[
                                    'product_name'
                                ]
                            ) ?>

                            ×

                            <?= $item[
                                'quantity'
                            ] ?>

                        </span>

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

                <?php endforeach; ?>

                <hr>

                <div
                    class="summary-row"
                >

                    <strong>

                        Total

                    </strong>

                    <strong>

                        RM

                        <?= number_format(
                            $totalAmount,
                            2
                        ) ?>

                    </strong>

                </div>

            </div>

        </div>

    </section>

</main>

<script
    src="js/checkout.js"
></script>

<?php

include "includes/footer.php";

?>