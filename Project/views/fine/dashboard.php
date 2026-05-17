<?php

$pageTitle = "Fine Dashboard";

?>

<?php require_once __DIR__ .
'/../layouts/header.php'; ?>


<link rel="stylesheet"
      href="/project/Web-Technologies-project-final/Project/public/css/fine.css">


<?php require_once __DIR__ .
'/../layouts/navbar.php'; ?>


<div class="container">

    <h1>

        Fine Dashboard

    </h1>


    

    <form method="GET"
          class="search-form">

        <input
            type="text"
            name="search"
            placeholder="Search member..."
            value="<?= $_GET['search'] ?? '' ?>"
        >

        <button type="submit">

            Search

        </button>

    </form>


    

    <table>

        <thead>

            <tr>

                <th>ID</th>

                <th>Member</th>

                <th>Book</th>

                <th>Days Overdue</th>

                <th>Amount</th>

                <th>Action</th>

            </tr>

        </thead>

        <tbody id="fine-table-body">

        <?php if(empty($fines)): ?>

            <tr>

                <td colspan="6">

                    No unpaid fines found

                </td>

            </tr>

        <?php endif; ?>


        <?php foreach($fines as $fine): ?>

            <tr id="fine-row-<?= $fine['id'] ?>">

                <td>

                    <?= $fine['id'] ?>

                </td>

                <td>

                    <?= $fine['member_name'] ?>

                </td>

                <td>

                    <?= $fine['title'] ?>

                </td>

                <td>

                    <?= $fine['overdue_days'] ?>

                </td>

                <td>

                    <?= $fine['amount'] ?> Tk

                </td>

                <td>

                    <button
                        class="pay-btn"
                        data-id="<?= $fine['id'] ?>"
                    >

                        Mark As Paid

                    </button>

                </td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>


<script src="/project/Web-Technologies-project-final/Project/public/js/fine.js"></script>

<?php require_once __DIR__ .
'/../layouts/footer.php'; ?>