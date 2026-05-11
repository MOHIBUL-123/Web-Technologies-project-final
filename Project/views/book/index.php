<?php

$pageTitle = "Books";

?>

<?php require_once __DIR__ .
'/../layouts/header.php'; ?>


<link rel="stylesheet"
      href="/Library-Management-System/Project/public/css/book.css">


<?php require_once __DIR__ .
'/../layouts/navbar.php'; ?>


<div class="container">

    <div class="top-bar">

        <h1>Books</h1>

        <?php if(has_role(['admin', 'librarian'])): ?>

            <a class="add-btn"
               href="/Library-Management-System/Project/books/create">

                Add Book

            </a>

        <?php endif; ?>

    </div>


    <!-- FLASH MESSAGE -->

    <?php if(isset($_SESSION['message'])): ?>

        <div class="message-box <?= $_SESSION['message_type'] ?>">

            <?= $_SESSION['message'] ?>

        </div>

        <?php
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
        ?>

    <?php endif; ?>
    <div class="search-box">

    <input
        type="text"
        id="search-input"
        placeholder="Search books..."
    >

</div>


    <!-- BOOK TABLE -->

    <table>

        <thead>

            <tr>

                <th>ID</th>

                <th>Title</th>

                <th>Author</th>

                <th>Genre</th>

                <th>ISBN</th>

                <th>Total</th>

                <th>Available</th>

                <th>Shelf</th>

                <th>Year</th>

                <?php if(
                    has_role(['admin', 'librarian']) ||
                    has_role('member')
                ): ?>

                    <th>Actions</th>

                <?php endif; ?>

            </tr>

        </thead>

        <tbody id="book-table-body">

        <?php foreach($books as $book): ?>

            <tr>

                <td>
                    <?= $book['id'] ?>
                </td>

               <td>

    <a href="/Library-Management-System/Project/books/details?id=<?= $book['id'] ?>">

        <?= $book['title'] ?>

    </a>

</td>

                <td>
                    <?= $book['author'] ?>
                </td>

                <td>
                    <?= $book['genre_name'] ?>
                </td>

                <td>
                    <?= $book['isbn'] ?>
                </td>

                <td>
                    <?= $book['total_copies'] ?>
                </td>

                <td>
                    <?= $book['available_copies'] ?>
                </td>

                <td>
                    <?= $book['shelf_location'] ?>
                </td>

                <td>
                    <?= $book['published_year'] ?>
                </td>


                <!-- ACTIONS -->

                <?php if(
                    has_role(['admin', 'librarian']) ||
                    has_role('member')
                ): ?>

                    <td>

                        <!-- MEMBER BORROW -->

                        <?php if(has_role('member')): ?>

                            <?php if($book['available_copies'] > 0): ?>

                                <form method="POST"
                                      action="/Library-Management-System/Project/borrow"
                                      class="borrow-form">

                                    <input
                                        type="hidden"
                                        name="book_id"
                                        value="<?= $book['id'] ?>"
                                    >

                                    <button
                                        type="submit"
                                        class="borrow-btn"
                                    >
                                        Borrow
                                    </button>

                                </form>

                            <?php else: ?>

                                <span class="out-stock">

                                    Unavailable

                                </span>

                            <?php endif; ?>

                        <?php endif; ?>


                        <!-- ADMIN / LIBRARIAN -->

                        <?php if(has_role(['admin', 'librarian'])): ?>

                            <a class="edit-btn"
                               href="/Library-Management-System/Project/books/edit?id=<?= $book['id'] ?>">

                                Edit

                            </a>


                            <form method="POST"
                                  action="/Library-Management-System/Project/books/delete"
                                  class="delete-form">

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= $book['id'] ?>"
                                >

                                <button
                                    type="submit"
                                    class="delete-btn"
                                >
                                    Delete
                                </button>

                            </form>

                        <?php endif; ?>

                    </td>

                <?php endif; ?>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>
<script>

    const currentUserRole =
        "<?= $_SESSION['role'] ?? '' ?>";

</script>

<script src="/Library-Management-System/Project/public/js/book.js"></script>

<?php require_once __DIR__ .
'/../layouts/footer.php'; ?>