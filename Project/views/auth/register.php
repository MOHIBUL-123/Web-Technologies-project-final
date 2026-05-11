<?php

$pageTitle = "Register";

?>

<?php require_once __DIR__ .
'/../layouts/header.php'; ?>


<link rel="stylesheet"
      href="/Library-Management-System/Project/public/css/register.css">


<?php require_once __DIR__ .
'/../layouts/navbar.php'; ?>


<div class="container">

    <h2>Member Registration</h2>


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


    <form method="POST" id="registerForm">


        <!-- NAME -->

        <label>Name</label>

        <input
            type="text"
            name="name"
            value="<?= $_POST['name'] ?? '' ?>"
        >

        <?php if(isset($errors['name'])): ?>

            <p class="error">

                <?= $errors['name'] ?>

            </p>

        <?php endif; ?>


        <!-- EMAIL -->

        <label>Email</label>

        <input
            type="email"
            name="email"
            value="<?= $_POST['email'] ?? '' ?>"
        >

        <?php if(isset($errors['email'])): ?>

            <p class="error">

                <?= $errors['email'] ?>

            </p>

        <?php endif; ?>


        <!-- PHONE -->

        <label>Phone</label>

        <input
            type="text"
            name="phone"
            value="<?= $_POST['phone'] ?? '' ?>"
        >

        <?php if(isset($errors['phone'])): ?>

            <p class="error">

                <?= $errors['phone'] ?>

            </p>

        <?php endif; ?>


        <!-- PASSWORD -->

        <label>Password</label>

        <input
            type="password"
            name="password"
        >

        <?php if(isset($errors['password'])): ?>

            <p class="error">

                <?= $errors['password'] ?>

            </p>

        <?php endif; ?>


        <button type="submit">

            Register

        </button>

    </form>


    <br>


    <a href="/Library-Management-System/Project/login">

        Already have an account?

    </a>

</div>


<script src="/Library-Management-System/Project/public/js/register.js"></script>

<?php require_once __DIR__ .
'/../layouts/footer.php'; ?>