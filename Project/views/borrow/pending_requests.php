<?php

$pageTitle = "Pending Borrow Requests";

?>

<?php require_once __DIR__ .
'/../layouts/header.php'; ?>


<link rel="stylesheet"
      href="/Library-Management-System/Project/public/css/borrow.css">


<?php require_once __DIR__ .
'/../layouts/navbar.php'; ?>


<div class="container">

    <div class="top-bar">

        <h1>Pending Borrow Requests</h1>

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


    <!-- REQUEST TABLE -->

    <table>

        <thead>

            <tr>

                <th>ID</th>

                <th>Member</th>

                <th>Book</th>

                <th>Borrow Date</th>

                <th>Due Date</th>

                <th>Status</th>

                <th>Actions</th>

            </tr>

        </thead>

        <tbody>

        <?php if(count($requests) > 0): ?>

            <?php foreach($requests as $request): ?>

                <tr id="request-row-<?= $request['id'] ?>">

                    <td>
                        <?= $request['id'] ?>
                    </td>

                    <td>
                        <?= $request['member_name'] ?>
                    </td>

                    <td>
                        <?= $request['book_title'] ?>
                    </td>

                    <td>
                        <?= $request['borrow_date'] ?>
                    </td>

                    <td>
                        <?= $request['due_date'] ?>
                    </td>

                    <td>

                        <span class="status pending">

                            Pending

                        </span>

                    </td>

                    <td>

                        <button
                            class="approve-btn"
                            data-id="<?= $request['id'] ?>"
                        >
                            Approve
                        </button>


                        <button
                            class="reject-btn"
                            data-id="<?= $request['id'] ?>"
                        >
                            Reject
                        </button>

                    </td>

                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>

                <td colspan="7">

                    No pending requests found.

                </td>

            </tr>

        <?php endif; ?>

        </tbody>

    </table>

</div>


<script src="/Library-Management-System/Project/public/js/borrow.js"></script>

<?php require_once __DIR__ .
'/../layouts/footer.php'; ?>