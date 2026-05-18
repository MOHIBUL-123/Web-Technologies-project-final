<?php

require_once __DIR__ .
'/../../helpers/auth_helper.php';

?>
<nav class="navbar">

    

    <div class="logo">

        <a href="/project/Web-Technologies-project-final/Project/">

            Library Management System

        </a>

    </div>


    

    <div class="nav-links">


        

        <a href="/project/Web-Technologies-project-final/Project/books">

            Books

        </a>


        

        <?php if(!is_logged_in()): ?>

            <a href="/project/Web-Technologies-project-final/Project/login">

                Login

            </a>

            <a href="/project/Web-Technologies-project-final/Project/register">

                Register

            </a>

        <?php endif; ?>


        

        <?php if(has_role('member')): ?>

            <a href="/project/Web-Technologies-project-final/Project/member">

                Dashboard

            </a>
            <a href="/project/Web-Technologies-project-final/Project/my-books">

    My Books

</a>
<a href="/project/Web-Technologies-project-final/Project/my-fines">

    My Fines

</a>

            <a href="/project/Web-Technologies-project-final/Project/profile">

                Profile

            </a>

        <?php endif; ?>


        

        <?php if(has_role('librarian')): ?>

            <a href="/project/Web-Technologies-project-final/Project/librarian">

                Dashboard

            </a>

            <a href="/project/Web-Technologies-project-final/Project/genres">

                Genres

            </a>

            
            


        <?php endif; ?>


        

        <?php if(has_role('admin')): ?>

            <a href="/project/Web-Technologies-project-final/Project/admin">

                Dashboard

            </a>

            <a href="/project/Web-Technologies-project-final/Project/genres">

                Genres

            </a>
            <li>

    <a href="/project/Web-Technologies-project-final/Project/reports">

        Reports

    </a>

</li>

            

        <?php endif; ?>

        <?php if(has_role(['admin', 'librarian'])): ?>

    

    <a href="/project/Web-Technologies-project-final/Project/borrow-requests">
        Borrow Requests
    </a>

    <a href="/project/Web-Technologies-project-final/Project/active-loans">
        Active Loans
    </a>

    <a href="/project/Web-Technologies-project-final/Project/fine-dashboard">
        Fine Dashboard
    </a>

<?php endif; ?>


        

        <?php if(is_logged_in()): ?>

            <a href="/project/Web-Technologies-project-final/Project/logout">

                Logout

            </a>

        <?php endif; ?>

    </div>

</nav>
<?php require_once __DIR__ .
'/flash.php'; ?>