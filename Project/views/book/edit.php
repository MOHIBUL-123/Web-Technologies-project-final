<?php

$pageTitle = "Edit Book";

?>

<?php require_once __DIR__ .
'/../layouts/header.php'; ?>


<link rel="stylesheet"
      href="/Library-Management-System/Project/public/css/book.css">


<?php require_once __DIR__ .
'/../layouts/navbar.php'; ?>


<div class="container">

    <div class="form-card">

        <h1>Edit Book</h1>

        <form method="POST">


            <!-- GENRE -->

            <div class="form-group">

                <label>Genre</label>

                <select name="genre_id">

                    <option value="">
                        Select Genre
                    </option>

                    <?php foreach($genres as $genre): ?>

                        <option
                            value="<?= $genre['id'] ?>"

                            <?= (
                                ($_POST['genre_id'] ?? $book['genre_id'])
                                == $genre['id']
                            )
                            ? 'selected'
                            : ''
                            ?>
                        >

                            <?= $genre['name'] ?>

                        </option>

                    <?php endforeach; ?>

                </select>

                <?php if(isset($errors['genre_id'])): ?>

                    <p class="field-error">

                        <?= $errors['genre_id'] ?>

                    </p>

                <?php endif; ?>

            </div>


            <!-- TITLE -->

            <div class="form-group">

                <label>Title</label>

                <input
                    type="text"
                    name="title"
                    value="<?= $_POST['title'] ?? $book['title'] ?>"
                >

                <?php if(isset($errors['title'])): ?>

                    <p class="field-error">

                        <?= $errors['title'] ?>

                    </p>

                <?php endif; ?>

            </div>


            <!-- AUTHOR -->

            <div class="form-group">

                <label>Author</label>

                <input
                    type="text"
                    name="author"
                    value="<?= $_POST['author'] ?? $book['author'] ?>"
                >

                <?php if(isset($errors['author'])): ?>

                    <p class="field-error">

                        <?= $errors['author'] ?>

                    </p>

                <?php endif; ?>

            </div>


            <!-- ISBN -->

            <div class="form-group">

                <label>ISBN</label>

                <input
                    type="text"
                    name="isbn"
                    value="<?= $_POST['isbn'] ?? $book['isbn'] ?>"
                >

                <?php if(isset($errors['isbn'])): ?>

                    <p class="field-error">

                        <?= $errors['isbn'] ?>

                    </p>

                <?php endif; ?>

            </div>


            <!-- COPIES -->

            <div class="form-group">

                <label>Total Copies</label>

                <input
                    type="number"
                    name="total_copies"
                    value="<?= $_POST['total_copies'] ?? $book['total_copies'] ?>"
                >

                <?php if(isset($errors['total_copies'])): ?>

                    <p class="field-error">

                        <?= $errors['total_copies'] ?>

                    </p>

                <?php endif; ?>

            </div>


            <!-- SHELF -->

            <div class="form-group">

                <label>Shelf Location</label>

                <input
                    type="text"
                    name="shelf_location"
                    value="<?= $_POST['shelf_location'] ?? $book['shelf_location'] ?>"
                >

                <?php if(isset($errors['shelf_location'])): ?>

                    <p class="field-error">

                        <?= $errors['shelf_location'] ?>

                    </p>

                <?php endif; ?>

            </div>


            <!-- YEAR -->

            <div class="form-group">

                <label>Published Year</label>

                <input
                    type="number"
                    name="published_year"
                    min="1900"
                    max="<?= date('Y') ?>"
                    value="<?= $_POST['published_year'] ?? $book['published_year'] ?>"
                >

                <?php if(isset($errors['published_year'])): ?>

                    <p class="field-error">

                        <?= $errors['published_year'] ?>

                    </p>

                <?php endif; ?>

            </div>


            <button type="submit">

                Update Book

            </button>

        </form>


        <a class="back-btn"
           href="/Library-Management-System/Project/books">

            Back To Books

        </a>

    </div>

</div>


<script src="/Library-Management-System/Project/public/js/book.js"></script>

<?php require_once __DIR__ .
'/../layouts/footer.php'; ?>