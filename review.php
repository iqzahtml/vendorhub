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

$product_id =
    intval(
        $_GET[
            'product_id'
        ]
        ?? 0
    );


/*
|--------------------------------------------------------------------------
| SUBMIT REVIEW
|--------------------------------------------------------------------------
*/

if (
    isset(
        $_POST[
            'submit_review'
        ]
    )
) {

    $rating =
        intval(
            $_POST[
                'rating'
            ]
        );

    $review =
        trim(
            $_POST[
                'review'
            ]
        );

    if (
        $rating < 1
        ||
        $rating > 5
    ) {

        echo "

            <script>

                alert(
                    'Rating must be between 1 and 5.'
                );

            </script>

        ";

    } else {

        $checkSql = "

            SELECT

                od.product_id

            FROM orders o

            INNER JOIN order_details od

                ON o.order_id =
                od.order_id

            WHERE

                o.customer_id = ?

            AND

                od.product_id = ?

            AND

                o.order_status =
                'Completed'

            LIMIT 1

        ";

        $checkStmt =
            mysqli_prepare(
                $conn,
                $checkSql
            );

        mysqli_stmt_bind_param(
            $checkStmt,
            "ii",
            $customer_id,
            $product_id
        );

        mysqli_stmt_execute(
            $checkStmt
        );

        $checkResult =
            mysqli_stmt_get_result(
                $checkStmt
            );

        if (
            mysqli_num_rows(
                $checkResult
            ) === 0
        ) {

            echo "

                <script>

                    alert(
                        'You can only review products you purchased.'
                    );

                </script>

            ";

        } else {

            $insertSql = "

                INSERT INTO reviews

                (

                    customer_id,
                    product_id,
                    rating,
                    review

                )

                VALUES (?, ?, ?, ?)

            ";

            $insertStmt =
                mysqli_prepare(
                    $conn,
                    $insertSql
                );

            mysqli_stmt_bind_param(
                $insertStmt,
                "iiis",
                $customer_id,
                $product_id,
                $rating,
                $review
            );

            mysqli_stmt_execute(
                $insertStmt
            );

            header(
                "Location: product_details.php?id="
                . $product_id
            );

            exit();

        }

    }

}

?>

<main class="review-page">

    <section class="page-header">

        <div class="page-header-content">

            <h1>

                Write a Review

            </h1>

            <p>

                Share your experience with this product.

            </p>

        </div>

    </section>

    <section class="review-section">

        <form
            method="POST"
            class="review-form"
        >

            <div
                class="form-group"
            >

                <label
                    for="rating"
                >

                    Rating

                </label>

                <select
                    name="rating"
                    id="rating"
                    required
                >

                    <option
                        value=""
                    >

                        Select Rating

                    </option>

                    <option
                    value="5"
                    >

                        5 - Excellent

                    </option>

                    <option
                        value="4"
                    >

                        4 - Good

                    </option>

                    <option
                        value="3"
                    >

                        3 - Average

                    </option>

                    <option
                        value="2"
                    >

                        2 - Poor

                    </option>

                    <option
                        value="1"
                    >

                        1 - Very Poor

                    </option>

                </select>

            </div>

            <div
                class="form-group"
            >

                <label
                    for="review"
                >

                    Review

                </label>

                <textarea
                    name="review"
                    id="review"
                    rows="6"
                    required
                ></textarea>

            </div>

            <button
                type="submit"
                name="submit_review"
                class="btn btn-primary"
            >

                Submit Review

            </button>

        </form>

    </section>

</main>

<?php

include "includes/footer.php";

?>