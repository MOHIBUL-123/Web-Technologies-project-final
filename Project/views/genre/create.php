<?php

$pageTitle = "Create Genre";

?>

<?php require_once __DIR__ .
'/../layouts/header.php'; ?>


<link rel="stylesheet"
      href="/Library-Management-System/Project/public/css/genre.css">


<?php require_once __DIR__ .
'/../layouts/navbar.php'; ?>


<div class="container">

    <div class="form-card">

        <h1>Create Genre</h1>

        <form method="POST">

            <!-- Genre Name -->

            <div class="form-group">

                <label>Genre Name</label>

                <input
                    type="text"
                    name="name"
                    value="<?= $_POST['name'] ?? '' ?>"
                >

                <?php if(isset($errors['name'])): ?>

                    <p class="field-error">

                        <?= $errors['name'] ?>

                    </p>

                <?php endif; ?>

            </div>


            <button type="submit">

                Create Genre

            </button>

        </form>


        <a class="back-btn"
           href="/Library-Management-System/Project/genres">

            Back To Genres

        </a>

    </div>

</div>
<script src="/Library-Management-System/Project/public/js/genre.js"></script>
<?php require_once __DIR__ .
'/../layouts/footer.php'; ?>