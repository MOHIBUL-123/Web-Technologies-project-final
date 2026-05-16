<?php

require_once __DIR__ .
'/../../helpers/auth_helper.php';

auth_check('admin');

$pageTitle = "Admin Dashboard";

?>

<?php require_once __DIR__ .
'/../layouts/header.php'; ?>


<link rel="stylesheet"
      href="/project/Web-Technologies-project-final/Project/public/css/admin.css">


<?php require_once __DIR__ .
'/../layouts/navbar.php'; ?>


<div class="container">

    <h1>Admin Dashboard</h1>

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


    <!-- GENRES -->

    <a href="/project/Web-Technologies-project-final/Project/genres"
       class="dashboard-link">

        <div class="card">

            <h2>

                Genres

            </h2>

            <p>

                Manage genres

            </p>

        </div>

    </a>



    <!-- BOOKS -->

    <a href="/project/Web-Technologies-project-final/Project/books"
       class="dashboard-link">

        <div class="card">

            <h2>

                Books

            </h2>

            <p>

                Manage books

            </p>

        </div>

    </a>



    <!-- USERS -->

    <a href="/project/Web-Technologies-project-final/Project/users"
       class="dashboard-link">

        <div class="card">

            <h2>

                Users

            </h2>

            <p>

                Manage members & librarians

            </p>

        </div>

    </a>

</div>

</div>


<script src="/project/Web-Technologies-project-final/Project/public/js/admin.js"></script>

<?php require_once __DIR__ .
'/../layouts/footer.php'; ?>