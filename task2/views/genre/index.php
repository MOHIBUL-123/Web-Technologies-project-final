<?php

$pageTitle = "Genres";

?>

<?php require_once __DIR__ .
'/../layouts/header.php'; ?>


<link rel="stylesheet"
      href="/project/Web-Technologies-project-final/Project/public/css/genre.css">


<?php require_once __DIR__ .
'/../layouts/navbar.php'; ?>


<div class="container">

    <div class="top-bar">

        <h1>Genres</h1>

        <a class="add-btn"
           href="/project/Web-Technologies-project-final/Project/genres/create">

            Add Genre

        </a>

    </div>


    

    <?php if(isset($_SESSION['message'])): ?>

        <div class="message-box <?= $_SESSION['message_type'] ?>">

            <?= $_SESSION['message'] ?>

        </div>

        <?php
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
        ?>

    <?php endif; ?>


    

    <table>

        <thead>

            <tr>

                <th>ID</th>

                <th>Name</th>
                <th>Actions</th>

            </tr>

        </thead>

        <tbody>

        <?php foreach($genres as $genre): ?>

            <tr>

                <td>
                    <?= $genre['id'] ?>
                </td>

                <td>
                    <?= $genre['name'] ?>
                </td>
                <td>

    <a class="edit-btn"
       href="/project/Web-Technologies-project-final/Project/genres/edit?id=<?= $genre['id'] ?>">

        Edit

    </a>
     <form method="POST"
          action="/project/Web-Technologies-project-final/Project/genres/delete"
          class="delete-form">

        <input
            type="hidden"
            name="id"
            value="<?= $genre['id'] ?>"
        >

        <button
            type="submit"
            class="delete-btn"
        >
            Delete
        </button>

    </form>

</td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>
<script src="/project/Web-Technologies-project-final/Project/public/js/genre.js"></script>
<?php require_once __DIR__ .
'/../layouts/footer.php'; ?>