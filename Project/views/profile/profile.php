<?php

$pageTitle = "My Profile";

?>

<?php require_once __DIR__ .
'/../layouts/header.php'; ?>


<link rel="stylesheet"
      href="/Library-Management-System/Project/public/css/profile.css">


<?php require_once __DIR__ .
'/../layouts/navbar.php'; ?>


<div class="container">

    <h1>My Profile</h1>


    <!-- SUCCESS MESSAGE -->
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
    <!-- UPDATE PROFILE -->
    <!-- ========================= -->

    <div class="card">

        <h2>Update Profile</h2>

        <form method="POST" id="profileForm">

            <input
                type="hidden"
                name="update_profile"
                value="1"
            >

            <!-- Name -->

            <div class="form-group">

                <label>Name</label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    value="<?= $member['name'] ?>"
                >

                <small class="js-error"></small>

                <?php if(isset($errors['name'])): ?>
                    <p class="error">
                        <?= $errors['name'] ?>
                    </p>
                <?php endif; ?>

            </div>


            <!-- Email -->

            <div class="form-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    value="<?= $member['email'] ?>"
                >

                <small class="js-error"></small>

                <?php if(isset($errors['email'])): ?>
                    <p class="error">
                        <?= $errors['email'] ?>
                    </p>
                <?php endif; ?>

            </div>


            <!-- Phone -->

            <div class="form-group">

                <label>Phone</label>

                <input
                    type="text"
                    name="phone"
                    id="phone"
                    value="<?= $member['phone'] ?>"
                >

                <small class="js-error"></small>

                <?php if(isset($errors['phone'])): ?>
                    <p class="error">
                        <?= $errors['phone'] ?>
                    </p>
                <?php endif; ?>

            </div>


            <button type="submit">

                Update Profile

            </button>

        </form>

    </div>


    <!-- ========================= -->
    <!-- CHANGE PASSWORD -->
    <!-- ========================= -->

    <div class="card">

        <h2>Change Password</h2>

        <form method="POST" id="passwordForm">

            <input
                type="hidden"
                name="change_password"
                value="1"
            >

            <!-- Current Password -->

            <div class="form-group">

                <label>Current Password</label>

                <input
                    type="password"
                    name="current_password"
                    id="current_password"
                >

                <small class="js-error"></small>

                <?php if(isset($errors['current_password'])): ?>
                    <p class="error">
                        <?= $errors['current_password'] ?>
                    </p>
                <?php endif; ?>

            </div>


            <!-- New Password -->

            <div class="form-group">

                <label>New Password</label>

                <input
                    type="password"
                    name="new_password"
                    id="new_password"
                >

                <small class="js-error"></small>

                <?php if(isset($errors['new_password'])): ?>
                    <p class="error">
                        <?= $errors['new_password'] ?>
                    </p>
                <?php endif; ?>

            </div>


            <button type="submit">

                Change Password

            </button>

        </form>

    </div>

</div>


<script src="/Library-Management-System/Project/public/js/profile.js"></script>

<?php require_once __DIR__ .
'/../layouts/footer.php'; ?>