<?php

require_once __DIR__ .
'/../../helpers/auth_helper.php';

auth_check('admin');

$pageTitle = "Create Librarian";

?>

<?php require_once __DIR__ .
'/../layouts/header.php'; ?>


<link rel="stylesheet"
      href="/Library-Management-System/Project/public/css/create-user.css">


<?php require_once __DIR__ .
'/../layouts/navbar.php'; ?>


<div class="create-user-container">

    <div class="form-card">

        <h1>

            Create Librarian

        </h1>
        <?php require_once __DIR__ .
'/../layouts/error.php'; ?>


        <form method="POST"
              action="/Library-Management-System/Project/users/store">


            <!-- NAME -->

            <div class="form-group">

                <label>

                    Name

                </label>

               <input type="text"
       name="name"

       value="<?= $_SESSION['old']['name'] ?? '' ?>"

       required>

 </div>

            <!-- EMAIL -->

            <div class="form-group">

                <label>

                    Email

                </label>

              <input type="email"
       name="email"

       value="<?= $_SESSION['old']['email'] ?? '' ?>"

       required>
            </div>



            <!-- PHONE -->

            <div class="form-group">

                <label>

                    Phone

                </label>

                <<input type="text"
       name="phone"

       value="<?= $_SESSION['old']['phone'] ?? '' ?>"

       required>

            </div>



            <!-- PASSWORD -->

            <div class="form-group">

                <label>

                    Password

                </label>

                <input type="password"
                       name="password"
                       required>

            </div>



            <!-- BUTTON -->

            <button type="submit">

                Create Librarian

            </button>

        </form>

    </div>

</div>


<?php require_once __DIR__ .
'/../layouts/footer.php'; ?>