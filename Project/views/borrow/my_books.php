<?php

$pageTitle = "My Borrowed Books";

?>

<?php require_once __DIR__ .
'/../layouts/header.php'; ?>


<link rel="stylesheet"
      href="/Library-Management-System/Project/public/css/borrow.css">


<?php require_once __DIR__ .
'/../layouts/navbar.php'; ?>


<div class="container">

    <div class="top-bar">

        <h1>My Borrowed Books</h1>

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


    <!-- BORROW TABLE -->

    <table>

        <thead>

            <tr>

                <th>ID</th>

                <th>Title</th>

                <th>Author</th>

                <th>ISBN</th>

                <th>Borrow Date</th>

                <th>Due Date</th>

                <th>Status</th>
                <th>Actions</th>

            </tr>

        </thead>

        <tbody>

        <?php if(count($borrows) > 0): ?>

            <?php foreach($borrows as $borrow): ?>

                <tr>

                    <td>
                        <?= $borrow['id'] ?>
                    </td>

                    <td>
                        <?= $borrow['title'] ?>
                    </td>

                    <td>
                        <?= $borrow['author'] ?>
                    </td>

                    <td>
                        <?= $borrow['isbn'] ?>
                    </td>

                    <td>
                        <?= $borrow['borrow_date'] ?>
                    </td>

                    <td>
                        <?= $borrow['due_date'] ?>
                    </td>

                    <td>

    <span class="status <?= strtolower($borrow['status']) ?>">

        <?= $borrow['status'] ?>

    </span>

</td>


<td>

    <?php if($borrow['status'] === 'Pending'): ?>

        <span>

            Waiting Approval

        </span>

    <?php elseif($borrow['status'] === 'Active'): ?>

        <span>

            Borrowed

        </span>

    <?php else: ?>

        <span>

            Returned

        </span>

    <?php endif; ?>

</td>

                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>

                <td colspan="7">

                    No borrowed books found.

                </td>

            </tr>

        <?php endif; ?>

        </tbody>

    </table>

</div>


<script src="/Library-Management-System/Project/public/js/borrow.js"></script>

<?php require_once __DIR__ .
'/../layouts/footer.php'; ?>