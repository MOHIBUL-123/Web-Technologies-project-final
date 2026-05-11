<?php

require_once __DIR__ .
'/../../helpers/auth_helper.php';

auth_check('admin');

$pageTitle = "Reports";

?>

<?php require_once __DIR__ .
'/../layouts/header.php'; ?>


<link rel="stylesheet"
      href="/Library-Management-System/Project/public/css/report.css">


<?php require_once __DIR__ .
'/../layouts/navbar.php'; ?>


<div class="report-container">

    <h1>

        Admin Reports & Analytics

    </h1>


    <!-- ========================= -->
    <!-- TOP BORROWED BOOKS -->
    <!-- ========================= -->

    <div class="report-box">

        <h2>

            Top Borrowed Books

        </h2>

        <table>

            <thead>

                <tr>

                    <th>Book</th>

                    <th>Total Borrows</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach($topBooks as $book): ?>

                    <tr>

                        <td>

                            <?= $book['title'] ?>

                        </td>

                        <td>

                            <?= $book['total_borrows'] ?>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>



    <!-- ========================= -->
    <!-- TOP MEMBERS -->
    <!-- ========================= -->

    <div class="report-box">

        <h2>

            Most Active Members

        </h2>

        <table>

            <thead>

                <tr>

                    <th>Member</th>

                    <th>Total Loans</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach($topMembers as $member): ?>

                    <tr>

                        <td>

                            <?= $member['name'] ?>

                        </td>

                        <td>

                            <?= $member['total_loans'] ?>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>



    <!-- ========================= -->
    <!-- CHART -->
    <!-- ========================= -->

    <div class="report-box">

        <h2>

            Monthly Borrow Analytics

        </h2>

        <canvas id="borrowChart"></canvas>

    </div>

</div>



<!-- ========================= -->
<!-- CHART JS -->
<!-- ========================= -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>

    const monthlyData =
        <?= json_encode($monthlyBorrows) ?>;


    const labels =
        monthlyData.map(
            item => item.month
        );


    const totals =
        monthlyData.map(
            item => item.total
        );


    const ctx =
        document.getElementById(
            'borrowChart'
        );


    new Chart(ctx, {

        type: 'bar',

        data: {

            labels: labels,

            datasets: [{

                label: 'Borrows',

                data: totals,

                borderWidth: 1
            }]
        },

        options: {

            responsive: true
        }
    });

</script>


<?php require_once __DIR__ .
'/../layouts/footer.php'; ?>