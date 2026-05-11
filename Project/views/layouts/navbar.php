<?php

require_once __DIR__ .
'/../../helpers/auth_helper.php';

?>
<nav class="navbar">

    <!-- LOGO -->

    <div class="logo">

        <a href="/Library-Management-System/Project/">

            Library Management System

        </a>

    </div>


    <!-- NAV LINKS -->

    <div class="nav-links">


        <!-- PUBLIC BOOKS -->

        <a href="/Library-Management-System/Project/books">

            Books

        </a>


        <!-- GUEST -->

        <?php if(!is_logged_in()): ?>

            <a href="/Library-Management-System/Project/login">

                Login

            </a>

            <a href="/Library-Management-System/Project/register">

                Register

            </a>

        <?php endif; ?>


        <!-- MEMBER -->

        <?php if(has_role('member')): ?>

            <a href="/Library-Management-System/Project/member">

                Dashboard

            </a>
            <a href="/Library-Management-System/Project/my-books">

    My Books

</a>
<a href="/Library-Management-System/Project/my-fines">

    My Fines

</a>

            <a href="/Library-Management-System/Project/profile">

                Profile

            </a>

        <?php endif; ?>


        <!-- LIBRARIAN -->

        <?php if(has_role('librarian')): ?>

            <a href="/Library-Management-System/Project/librarian">

                Dashboard

            </a>

            <a href="/Library-Management-System/Project/genres">

                Genres

            </a>

            <!-- <a href="/Library-Management-System/Project/books">

                Books

            </a> -->
            <!-- <a href="/Library-Management-System/Project/borrow-requests">

    Borrow Requests

</a> -->
<!-- <a href="/Library-Management-System/Project/active-loans">

    Active Loans

</a> -->

        <?php endif; ?>


        <!-- ADMIN -->

        <?php if(has_role('admin')): ?>

            <a href="/Library-Management-System/Project/admin">

                Dashboard

            </a>

            <a href="/Library-Management-System/Project/genres">

                Genres

            </a>
            <li>

    <a href="/Library-Management-System/Project/reports">

        Reports

    </a>

</li>

            <!-- <a href="/Library-Management-System/Project/books">

                Books

            </a> -->

        <?php endif; ?>

        <?php if(has_role(['admin', 'librarian'])): ?>

    <!-- <a href="/Library-Management-System/Project/books">
        Books
    </a> -->

    <a href="/Library-Management-System/Project/borrow-requests">
        Borrow Requests
    </a>

    <a href="/Library-Management-System/Project/active-loans">
        Active Loans
    </a>

    <a href="/Library-Management-System/Project/fine-dashboard">
        Fine Dashboard
    </a>

<?php endif; ?>


        <!-- LOGOUT -->

        <?php if(is_logged_in()): ?>

            <a href="/Library-Management-System/Project/logout">

                Logout

            </a>

        <?php endif; ?>

    </div>

</nav>
<?php require_once __DIR__ .
'/flash.php'; ?>