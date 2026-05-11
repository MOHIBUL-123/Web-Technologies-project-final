<?php

$pageTitle = "Active Loans";

?>

<?php require_once __DIR__ .
'/../layouts/header.php'; ?>


<link rel="stylesheet"
      href="/Library-Management-System/Project/public/css/borrow.css">


<?php require_once __DIR__ .
'/../layouts/navbar.php'; ?>


<div class="container">

    <div class="top-bar">

        <h1>

            Active Loans

        </h1>

    </div>


    <!-- ========================= -->
    <!-- AJAX SEARCH -->
    <!-- ========================= -->

    <div class="search-form">

        <input
            type="text"

            id="searchInput"

            name="search"

            placeholder="Search member or book..."

            value="<?= htmlspecialchars($search) ?>"
        >

    </div>


    <!-- ========================= -->
    <!-- FLASH MESSAGE -->
    <!-- ========================= -->

    <?php if(isset($_SESSION['message'])): ?>

        <div class="message-box <?= $_SESSION['message_type'] ?>">

            <?= $_SESSION['message'] ?>

        </div>

        <?php

            unset($_SESSION['message']);

            unset($_SESSION['message_type']);

        ?>

    <?php endif; ?>


    <!-- ========================= -->
    <!-- ACTIVE LOANS TABLE -->
    <!-- ========================= -->

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


        <tbody id="loan-table-body">

        <?php if(count($loans) > 0): ?>

            <?php foreach($loans as $loan): ?>

                <tr>

                    <td>

                        <?= $loan['id'] ?>

                    </td>

                    <td>

                        <?= $loan['member_name'] ?>

                    </td>

                    <td>

                        <?= $loan['book_title'] ?>

                    </td>

                    <td>

                        <?= $loan['borrow_date'] ?>

                    </td>

                    <td>

                        <?= $loan['due_date'] ?>

                    </td>

                    <td>

                        <span class="status active">

                            Active

                        </span>

                    </td>

                    <td>

                        <form method="POST"
                              action="/Library-Management-System/Project/return-book"

                              class="return-form">

                            <input
                                type="hidden"

                                name="borrow_id"

                                value="<?= $loan['id'] ?>"
                            >

                            <button
                                type="submit"

                                class="return-btn"
                            >

                                Process Return

                            </button>

                        </form>

                    </td>

                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>

                <td colspan="7">

                    No active loans found.

                </td>

            </tr>

        <?php endif; ?>

        </tbody>

    </table>

</div>


<script src="/Library-Management-System/Project/public/js/borrow.js"></script>


<?php require_once __DIR__ .
'/../layouts/footer.php'; ?>