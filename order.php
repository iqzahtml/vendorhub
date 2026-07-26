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

$customer_id =
    $_SESSION[
        'user_id'
    ];

$sql = "

    SELECT

        order_id,
        order_date,
        total_amount,
        delivery_method,
        order_status

    FROM orders

    WHERE customer_id = ?

    ORDER BY order_date DESC

";

$stmt =
    mysqli_prepare(
        $conn,
        $sql
    );

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $customer_id
);

mysqli_stmt_execute(
    $stmt
);

$result =
    mysqli_stmt_get_result(
        $stmt
    );

?>

<main class="order-page">

    <section class="page-header">

        <div class="page-header-content">

            <h1>

                My Orders

            </h1>

            <p>

                Track your order history.

            </p>

        </div>

    </section>

    <section class="order-section">

        <?php if (
            mysqli_num_rows(
                $result
            ) > 0
        ): ?>

            <div
                class="order-table-wrapper"
            >

                <table
                    class="order-table"
                >

                    <thead>

                        <tr>

                            <th>

                                Order ID

                            </th>

                            <th>

                                Date

                            </th>

                            <th>

                                Total

                            </th>

                            <th>

                                Delivery

                            </th>

                            <th>

                                Status

                            </th>

                            <th>

                                Action

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php while (
                            $order =
                            mysqli_fetch_assoc(
                                $result
                            )
                        ): ?>

                            <tr>

                                <td>

                                    #

                                    <?= $order[
                                        'order_id'
                                    ] ?>

                                </td>

                                <td>

                                    <?= date(
                                        "d M Y",
                                        strtotime(
                                            $order[
                                                'order_date'
                                            ]
                                        )
                                    ) ?>

                                </td>

                                <td>

                                    RM

                                    <?= number_format(
                                        $order[
                                            'total_amount'
                                        ],
                                        2
                                    ) ?>

                                </td>

                                <td>

                                    <?= htmlspecialchars(
                                        $order[
                                            'delivery_method'
                                        ]
                                    ) ?>

                                </td>

                                <td>

                                    <span
                                        class="order-status"
                                    >

                                        <?= htmlspecialchars(
                                            $order[
                                                'order_status'
                                            ]
                                        ) ?>

                                    </span>

                                </td>

                                <td>

                                    <a
                                        href="order_details.php?id=<?= $order[
                                            'order_id'
                                        ] ?>"
                                        class="btn btn-primary"
                                    >

                                        View

                                    </a>

                                </td>

                            </tr>

                        <?php endwhile; ?>

                    </tbody>

                </table>

            </div>

        <?php else: ?>

            <div
                class="empty-products"
            >

                <div
                    class="empty-icon"
                >

                    📦

                </div>

                <h3>

                    No Orders Yet

                </h3>

                <a
                    href="catalog.php"
                    class="btn btn-primary"
                >

                    Start Shopping

                </a>

            </div>

        <?php endif; ?>

    </section>

</main>

<?php

include "includes/footer.php";

?>