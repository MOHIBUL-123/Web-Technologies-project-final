<?php

require_once __DIR__ .
'/../../helpers/auth_helper.php';

auth_check('admin');

$pageTitle = "Edit User";

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

            Edit User

        </h1>


        <form method="POST"
              action="/Library-Management-System/Project/users/update">


            <!-- USER ID -->

            <input type="hidden"
                   name="id"
                   value="<?= $user['id'] ?>">


            <!-- NAME -->

            <div class="form-group">

                <label>

                    Name

                </label>

                <input type="text"
                       name="name"
                       value="<?= $user['name'] ?>"
                       required>

            </div>



            <!-- EMAIL -->

            <div class="form-group">

                <label>

                    Email

                </label>

                <input type="email"
                       name="email"
                       value="<?= $user['email'] ?>"
                       required>

            </div>



            <!-- PHONE -->

            <div class="form-group">

                <label>

                    Phone

                </label>

                <input type="text"
                       name="phone"
                       value="<?= $user['phone'] ?>"
                       required>

            </div>



            <!-- ROLE -->

            <div class="form-group">

                <label>

                    Role

                </label>

                <select name="role"
                        required>

                    <option value="member"
                        <?= $user['role'] == 'member' ? 'selected' : '' ?>>

                        Member

                    </option>


                    <option value="librarian"
                        <?= $user['role'] == 'librarian' ? 'selected' : '' ?>>

                        Librarian

                    </option>


                    <option value="admin"
                        <?= $user['role'] == 'admin' ? 'selected' : '' ?>>

                        Admin

                    </option>

                </select>

            </div>



            <!-- BUTTON -->

            <button type="submit">

                Update User

            </button>

        </form>

    </div>

</div>


<?php require_once __DIR__ .
'/../layouts/footer.php'; ?>