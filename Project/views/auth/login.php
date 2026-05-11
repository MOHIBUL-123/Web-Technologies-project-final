<?php

$pageTitle = "Login";

?>

<?php require_once __DIR__ .
'/../layouts/header.php'; ?>


<link rel="stylesheet"
      href="/Library-Management-System/Project/public/css/login.css">


<?php require_once __DIR__ .
'/../layouts/navbar.php'; ?>


<div class="container">

    <h2>Member Login</h2>


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


    <form method="POST" id="loginForm">


        <!-- EMAIL -->

        <div class="form-group">

            <label>Email</label>

            <input
                type="email"
                name="email"
                id="email"
                value="<?= $_POST['email'] ?? '' ?>"
            >

            <small class="js-error"></small>

            <?php if(isset($errors['email'])): ?>

                <p class="error">

                    <?= $errors['email'] ?>

                </p>

            <?php endif; ?>

        </div>


        <!-- PASSWORD -->

        <div class="form-group">

            <label>Password</label>

            <input
                type="password"
                name="password"
                id="password"
            >

            <small class="js-error"></small>

            <?php if(isset($errors['password'])): ?>

                <p class="error">

                    <?= $errors['password'] ?>

                </p>

            <?php endif; ?>

        </div>


        <button type="submit">

            Login

        </button>

    </form>


    <br>


    <a href="/Library-Management-System/Project/register">

        Create New Account

    </a>

</div>


<script src="/Library-Management-System/Project/public/js/login.js"></script>

<?php require_once __DIR__ .
'/../layouts/footer.php'; ?>