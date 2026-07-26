<?php

require_once "config.php";

include "includes/header.php";
include "includes/navbar.php";

if (
    !isset($_SESSION['cart'])
) {

    $_SESSION['cart'] = [];

}


/*
|--------------------------------------------------------------------------
| ADD TO CART
|--------------------------------------------------------------------------
*/

if (
    isset($_POST['add_to_cart'])
) {

    $product_id =
        intval(
            $_POST['product_id']
        );

    $quantity =
        intval(
            $_POST['quantity']
        );

    if (
        $quantity < 1
    ) {

        $quantity = 1;

    }

    $sql = "

        SELECT

            product_id,
            product_name,
            price,
            stock_quantity,
            image

        FROM products

        WHERE product_id = ?

        LIMIT 1

    ";

    $stmt =
        mysqli_prepare(
            $conn,
            $sql
        );

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $product_id
    );

    mysqli_stmt_execute(
        $stmt
    );

    $result =
        mysqli_stmt_get_result(
            $stmt
        );

    $product =
        mysqli_fetch_assoc(
            $result
        );

    if (
        $product
    ) {

        if (
            $quantity >
            $product[
                'stock_quantity'
            ]
        ) {

            $quantity =
                $product[
                    'stock_quantity'
                ];

        }

        if (
            isset(
                $_SESSION[
                    'cart'
                ][
                    $product_id
                ]
            )
        ) {

            $_SESSION[
                'cart'
            ][
                $product_id
            ] +=
                $quantity;

        } else {

            $_SESSION[
                'cart'
            ][
                $product_id
            ] =
                $quantity;

        }

    }

    header(
        "Location: cart.php"
    );

    exit();

}


/*
|--------------------------------------------------------------------------
| UPDATE CART
|--------------------------------------------------------------------------
*/

if (
    isset(
        $_POST[
            'update_cart'
        ]
    )
) {

    foreach (
        $_POST[
            'quantity'
        ]
        as $product_id
        => $quantity
    ) {

        $product_id =
            intval(
                $product_id
            );

        $quantity =
            intval(
                $quantity
            );

        if (
            $quantity <= 0
        ) {

            unset(
                $_SESSION[
                    'cart'
                ][
                    $product_id
                ]
            );

        } else {

            $_SESSION[
                'cart'
            ][
                $product_id
            ] =
                $quantity;

        }

    }

    header(
        "Location: cart.php"
    );

    exit();

}


/*
|--------------------------------------------------------------------------
| REMOVE ITEM
|--------------------------------------------------------------------------
*/

if (
    isset(
        $_GET[
            'remove'
        ]
    )
) {

    $product_id =
        intval(
            $_GET[
                'remove'
            ]
        );

    unset(
        $_SESSION[
            'cart'
        ][
            $product_id
        ]
    );

    header(
        "Location: cart.php"
    );

    exit();

}


/*
|--------------------------------------------------------------------------
| CLEAR CART
|--------------------------------------------------------------------------
*/

if (
    isset(
        $_GET[
            'clear'
        ]
    )
) {

    $_SESSION[
        'cart'
    ] = [];

    header(
        "Location: cart.php"
    );

    exit();

}


/*
|--------------------------------------------------------------------------
| GET CART PRODUCTS
|--------------------------------------------------------------------------
*/

$cartItems = [];

$totalAmount = 0;
if (
    !empty(
        $_SESSION[
            'cart'
        ]
    )
) {

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

            p.product_id,
            p.product_name,
            p.price,
            p.stock_quantity,
            p.image,

            v.business_name

        FROM products p

        INNER JOIN vendors v

            ON p.vendor_id =
            v.vendor_id

        WHERE p.product_id

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

}

?>

<main class="cart-page">

    <section class="page-header">

        <div class="page-header-content">

            <h1>

                Shopping Cart

            </h1>

            <p>

                Review your selected products.

            </p>

        </div>

    </section>

    <section class="cart-section">

        <?php if (
            !empty(
                $cartItems
            )
        ): ?>

            <form
                method="POST"
                action="cart.php"
            >

                <div class="cart-container">

                    <div class="cart-items">

                        <?php foreach (
                            $cartItems
                            as $item
                        ): ?>

                            <div
                                class="cart-item"
                            >

                                <div
                                    class="cart-item-image"
                                >

                                    <?php if (
                                        !empty(
                                            $item[
                                                'image'
                                            ]
                                        )
                                    ): ?>

                                        <img
                                            src="uploads/products/<?= htmlspecialchars(
                                                $item[
                                                    'image'
                                                ]
                                            ) ?>"
                                        >

                                    <?php else: ?>

                                        <div
                                            class="no-image"
                                        >

                                            🛍️

                                        </div>

                                    <?php endif; ?>

                                </div>

                                <div
                                    class="cart-item-info"
                                    >

                                    <h3>

                                        <?= htmlspecialchars(
                                            $item[
                                                'product_name'
                                            ]
                                        ) ?>

                                    </h3>

                                    <p>

                                        Vendor:

                                        <?= htmlspecialchars(
                                            $item[
                                                'business_name'
                                            ]
                                        ) ?>

                                    </p>

                                    <p>

                                        RM

                                        <?= number_format(
                                            $item[
                                                'price'
                                            ],
                                            2
                                        ) ?>

                                    </p>

                                </div>

                                <div
                                    class="cart-quantity-section"
                                >

                                    <label>

                                        Quantity

                                    </label>

                                    <input
                                        type="number"
                                        name="quantity[<?= $item[
                                            'product_id'
                                        ] ?>]"
                                        value="<?= $item[
                                            'quantity'
                                        ] ?>"
                                        min="1"
                                        max="<?= $item[
                                            'stock_quantity'
                                        ] ?>"
                                        class="cart-quantity"
                                    >

                                </div>

                                <div
                                    class="cart-subtotal"
                                >

                                    RM

                                    <?= number_format(
                                        $item[
                                            'subtotal'
                                        ],
                                        2
                                    ) ?>

                                </div>

                                <a
                                    href="cart.php?remove=<?= $item[
                                        'product_id'
                                    ] ?>"
                                    class="remove-cart-item"
                                >

                                    Remove

                                </a>

                            </div>

                        <?php endforeach; ?>

                    </div>

                    <div
                        class="cart-summary"
                    >

                        <h2>

                            Order Summary

                        </h2>

                        <div
                            class="summary-row"
                        >

                            <span>

                                Subtotal

                            </span>

                            <strong>

                                RM

                                <?= number_format(
                                    $totalAmount,
                                    2
                                ) ?>

                            </strong>

                        </div>

                        <div
                        class="summary-row"
                        >

                            <span>

                                Total

                            </span>

                            <strong>

                                RM

                                <?= number_format(
                                    $totalAmount,
                                    2
                                ) ?>

                            </strong>

                        </div>

                        <button
                            type="submit"
                            name="update_cart"
                            class="btn btn-outline"
                        >

                            Update Cart

                        </button>

                        <a
                            href="checkout.php"
                            class="btn btn-primary"
                        >

                            Proceed to Checkout

                        </a>

                        <a
                            href="cart.php?clear=1"
                            class="clear-cart"
                        >

                            Clear Cart

                        </a>

                    </div>

                </div>

            </form>

        <?php else: ?>

            <div
                class="empty-products"
            >

                <div
                    class="empty-icon"
                >

                    🛒

                </div>

                <h3>

                    Your Cart is Empty

                </h3>

                <p>

                    Add some products to your cart first.

                </p>

                <a
                    href="catalog.php"
                    class="btn btn-primary"
                >

                    Browse Products

                </a>

            </div>

        <?php endif; ?>

    </section>

</main>

<script
    src="js/cart.js"
></script>

<?php

include "includes/footer.php";

?>