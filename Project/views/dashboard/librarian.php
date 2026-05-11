<?php

require_once __DIR__ .
'/../../helpers/auth_helper.php';

auth_check('librarian');

$pageTitle = "Librarian Dashboard";

?>

<?php require_once __DIR__ .
'/../layouts/header.php'; ?>


<link rel="stylesheet"
      href="/Library-Management-System/Project/public/css/librarian.css">


<?php require_once __DIR__ .
'/../layouts/navbar.php'; ?>


<div class="container">

    <h1>Librarian Dashboard</h1>

    <h3>
        Welcome,
        <?= $_SESSION['name'] ?>
    </h3>

    <p class="role">

        Role:
        <?= $_SESSION['role'] ?>

    </p>


    <!-- ========================= -->
    <!-- QUICK ACTIONS -->
    <!-- ========================= -->

    <div class="dashboard-cards">

        <a class="card"
           href="/Library-Management-System/Project/genres">

            <h2>Genres</h2>

            <p>
                Manage genres
            </p>

        </a>


        <a class="card"
           href="/Library-Management-System/Project/books">

            <h2>Books</h2>

            <p>
                Manage books
            </p>

        </a>

    </div>

</div>


<script src="/Library-Management-System/Project/public/js/librarian.js"></script>

<?php require_once __DIR__ .
'/../layouts/footer.php'; ?>