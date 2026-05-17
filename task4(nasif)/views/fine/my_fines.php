<?php

$pageTitle = "My Fines";

?>

<?php require_once __DIR__ .
'/../layouts/header.php'; ?>


<link rel="stylesheet"
      href="/project/Web-Technologies-project-final/Project/public/css/fine.css">


<?php require_once __DIR__ .
'/../layouts/navbar.php'; ?>


<div class="container">

    <h1>

        My Fines

    </h1>


    <!-- TOTAL BALANCE -->

    <div class="fine-summary">

        Total Outstanding Balance:

        <span>

            <?= $total ?> Tk

        </span>

    </div>


    <!-- FINES TABLE -->

    <table>

        <thead>

            <tr>

                <th>Book</th>

                <th>Due Date</th>

                <th>Return Date</th>

                <th>Days Overdue</th>

                <th>Amount</th>

                <th>Status</th>

            </tr>

        </thead>

        <tbody>

        <?php if(empty($fines)): ?>

            <tr>

                <td colspan="6">

                    No unpaid fines found

                </td>

            </tr>

        <?php endif; ?>


        <?php foreach($fines as $fine): ?>

            <tr>

                <td>

                    <?= $fine['title'] ?>

                </td>

                <td>

                    <?= $fine['due_date'] ?>

                </td>

                <td>

                    <?= $fine['return_date']
                        ?? 'Not Yet Returned'
                    ?>

                </td>

                <td>

                    <?= $fine['overdue_days'] ?>

                </td>

                <td>

                    <?= $fine['amount'] ?> Tk

                </td>

               <td class="unpaid">

    Unpaid

</td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>


<?php require_once __DIR__ .
'/../layouts/footer.php'; ?>