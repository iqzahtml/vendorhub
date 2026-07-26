<?php

require_once "includes/header.php";

?>

<?php include "includes/navbar.php"; ?>

<?php

$categorySql = "

    SELECT

        c.category_id,
        c.category_name,

        COUNT(p.product_id)
        AS total_products

    FROM categories c

    LEFT JOIN products p
        ON c.category_id =
        p.category_id

    GROUP BY

        c.category_id,
        c.category_name

    ORDER BY

        c.category_name ASC

";

$categoryResult = mysqli_query(
    $conn,
    $categorySql
);

?>

<main class="category-page">

    <section class="page-header">

        <div class="page-header-content">

            <h1>

                Product Categories

            </h1>

            <p>

                Explore products by category.

            </p>

        </div>

    </section>

    <section class="category-section">

        <?php if (
            mysqli_num_rows(
                $categoryResult
            ) > 0
        ): ?>

            <div class="category-grid">

                <?php while (
                    $category =
                    mysqli_fetch_assoc(
                        $categoryResult
                    )
                ): ?>

                    <a
                        href="product.php?category_id=<?= $category[
                            'category_id'
                        ] ?>"
                        class="category-card"
                    >

                        <div class="category-icon">

                            🛍️

                        </div>

                        <h2>

                            <?= htmlspecialchars(
                                $category[
                                    'category_name'
                                ]
                            ) ?>

                        </h2>

                        <p>

                            <?= $category[
                                'total_products'
                            ] ?>

                            product(s)

                        </p>

                        <span class="category-link">

                            Browse Products →

                        </span>

                    </a>

                <?php endwhile; ?>

            </div>

        <?php else: ?>

            <div class="empty-products">

                <div class="empty-icon">

                    📦

                </div>

                <h3>

                    No Categories Available

                </h3>

                <p>

                    Categories have not been added yet.

                </p>

            </div>

        <?php endif; ?>

    </section>

</main>

<?php include "includes/footer.php"; ?>