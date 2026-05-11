<?php

$pageTitle = $book['title'];

?>

<?php require_once __DIR__ .
'/../layouts/header.php'; ?>


<link rel="stylesheet"
      href="/Library-Management-System/Project/public/css/book.css">


<?php require_once __DIR__ .
'/../layouts/navbar.php'; ?>


<div class="container">

    <div class="details-card">

        <h1>

            <?= $book['title'] ?>

        </h1>


        <p>

            <strong>Author:</strong>

            <?= $book['author'] ?>

        </p>


        <p>

            <strong>Genre:</strong>

            <?= $book['genre_name'] ?>

        </p>


        <p>

            <strong>ISBN:</strong>

            <?= $book['isbn'] ?>

        </p>


        <p>

            <strong>Shelf:</strong>

            <?= $book['shelf_location'] ?>

        </p>


        <p>

            <strong>Published Year:</strong>

            <?= $book['published_year'] ?>

        </p>


        <p>

            <strong>Total Copies:</strong>

            <?= $book['total_copies'] ?>

        </p>


        <p>

            <strong>Available Copies:</strong>

            <span
                id="availability-count"
            >
                <?= $book['available_copies'] ?>
            </span>

        </p>


        <!-- AVAILABILITY BADGE -->

        <div
            id="availability-badge"
            class="availability-badge
            <?= $book['available_copies'] > 0
                ? 'available'
                : 'unavailable'
            ?>"
        >

            <?= $book['available_copies'] > 0
                ? 'Available'
                : 'Unavailable'
            ?>

        </div>

    </div>

</div>


<script>

const BOOK_ID =
    <?= $book['id'] ?>;

</script>


<script src="/Library-Management-System/Project/public/js/book.js"></script>

<?php require_once __DIR__ .
'/../layouts/footer.php'; ?>