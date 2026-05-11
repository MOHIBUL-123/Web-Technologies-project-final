<?php

require_once __DIR__ .
'/../../helpers/auth_helper.php';

auth_check('member');

$pageTitle = "Member Dashboard";

?>

<?php require_once __DIR__ .
'/../layouts/header.php'; ?>


<link rel="stylesheet"
      href="/Library-Management-System/Project/public/css/member.css">


<?php require_once __DIR__ .
'/../layouts/navbar.php'; ?>


<div class="dashboard-container">


    <!-- HEADER -->

    <div class="dashboard-header">

        <h1>

            Member Dashboard

        </h1>

        <p>

            Welcome,
            <?= $_SESSION['name'] ?>

        </p>


        <span class="role-badge">

            <?= $_SESSION['role'] ?>

        </span>

    </div>



    <!-- STATS -->

    <div class="stats-grid">


        <!-- ACTIVE LOANS -->

        <div class="stat-card">

            <div class="stat-number">

                <?= $activeLoans ?>

            </div>

            <div class="stat-title">

                Active Loans

            </div>

        </div>



        <!-- UPCOMING DUE -->

        <div class="stat-card">

            <div class="stat-number">

                <?= $upcomingDue ?>

            </div>

            <div class="stat-title">

                Upcoming Due Dates

            </div>

        </div>



        <!-- FINES -->

        <div class="stat-card">

            <div class="stat-number">

                <?= $outstandingFines ?>

            </div>

            <div class="stat-title">

                Outstanding Fines

            </div>

        </div>

    </div>



    <!-- ACTION BUTTONS -->

    <div class="dashboard-actions">

        <a href="/Library-Management-System/Project/profile">

            My Profile

        </a>


        <a href="/Library-Management-System/Project/my-books">

            My Books

        </a>


        <a href="/Library-Management-System/Project/logout">

            Logout

        </a>

    </div>

</div>


<?php require_once __DIR__ .
'/../layouts/footer.php'; ?>