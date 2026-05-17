<?php

$pageTitle = "Edit Genre";

?>

<?php require_once __DIR__ .
'/../layouts/header.php'; ?>


<link rel="stylesheet"
      href="/project/Web-Technologies-project-final/Project/public/css/genre.css">


<?php require_once __DIR__ .
'/../layouts/navbar.php'; ?>


<div class="container">

    <div class="form-card">

        <h1>Edit Genre</h1>

        <form method="POST">

            

            <div class="form-group">

                <label>Genre Name</label>

                <input
                    type="text"
                    name="name"
                    value="<?= $_POST['name'] ?? $genre['name'] ?>"
                >

                <?php if(isset($errors['name'])): ?>

                    <p class="field-error">

                        <?= $errors['name'] ?>

                    </p>

                <?php endif; ?>

            </div>


            <button type="submit">

                Update Genre

            </button>

        </form>


        <a class="back-btn"
           href="/project/Web-Technologies-project-final/Project/genres">

            Back To Genres

        </a>

    </div>

</div>


<script src="/project/Web-Technologies-project-final/Project/public/js/genre.js"></script>

<?php require_once __DIR__ .
'/../layouts/footer.php'; ?>