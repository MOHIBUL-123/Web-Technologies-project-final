<?php

require_once __DIR__ .
'/../../helpers/auth_helper.php';

auth_check('admin');

$pageTitle = "Users";

?>

<?php require_once __DIR__ .
'/../layouts/header.php'; ?>


<link rel="stylesheet"
      href="/project/Web-Technologies-project-final/Project/public/css/users.css">


<?php require_once __DIR__ .
'/../layouts/navbar.php'; ?>


<div class="users-container">

    <div class="top-bar">

        <h1>

            User Management

        </h1>

        <a href="/project/Web-Technologies-project-final/Project/users/create"
           class="add-btn">

            Create Librarian

        </a>

    </div>



    <table>

        <thead>

            <tr>

                <th>ID</th>

                <th>Name</th>

                <th>Email</th>

                <th>Phone</th>

                <th>Role</th>

                <th>Actions</th>

            </tr>

        </thead>


        <tbody>

            <?php foreach($users as $user): ?>

                <tr>

                    <td>

                        <?= $user['id'] ?>

                    </td>

                    <td>

                        <?= $user['name'] ?>

                    </td>

                    <td>

                        <?= $user['email'] ?>

                    </td>

                    <td>

                        <?= $user['phone'] ?>

                    </td>

                    <td>

                        <span class="role">

                            <?= $user['role'] ?>

                        </span>

                    </td>

                    <td class="actions">

                        <a href="/project/Web-Technologies-project-final/Project/users/edit?id=<?= $user['id'] ?>"
                           class="edit-btn">

                            Edit

                        </a>

<form method="POST"
      action="/project/Web-Technologies-project-final/Project/users/delete"

      onsubmit="
        return confirm(
            'Are you sure you want to delete this user?'
        );
      ">

    <input type="hidden"
           name="id"
           value="<?= $user['id'] ?>">


    <button type="submit"
            class="delete-btn">

        Delete

    </button>

</form>

                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</div>


<?php require_once __DIR__ .
'/../layouts/footer.php'; ?>