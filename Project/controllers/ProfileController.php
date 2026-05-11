<?php

require_once __DIR__ .
'/../models/Member.php';

require_once __DIR__ .
'/../helpers/auth_helper.php';

class ProfileController
{
   public function profile()
{
    auth_check('member');

    $memberModel = new Member();

    $member =
        $memberModel->findById(
            $_SESSION['member_id']
        );

    $errors = [];


    // =========================
    // UPDATE PROFILE
    // =========================

    if(
        $_SERVER['REQUEST_METHOD'] === 'POST' &&
        isset($_POST['update_profile'])
    )
    {
        $name = trim($_POST['name']);

        $email = trim($_POST['email']);

        $phone = trim($_POST['phone']);

        // Validation

        if(empty($name))
        {
            $errors['name'] =
                "Name is required";
        }

        if(
            !filter_var(
                $email,
                FILTER_VALIDATE_EMAIL
            )
        )
        {
            $errors['email'] =
                "Invalid email";
        }

        if(!preg_match('/^[0-9]+$/', $phone))
        {
            $errors['phone'] =
                "Phone must be numeric";
        }

        // If No Errors

        if(empty($errors))
        {
            // Check Changes

            if(
                $member['name'] === $name &&
                $member['email'] === $email &&
                $member['phone'] === $phone
            )
            {
                $_SESSION['message'] =
                    "No Changes Detected";

                $_SESSION['message_type'] =
                    "warning";
            }
            else
            {
                $memberModel->updateProfile([
                    'id' =>
                        $_SESSION['member_id'],

                    'name' => $name,

                    'email' => $email,

                    'phone' => $phone
                ]);

                // Update Session Name

                $_SESSION['name'] = $name;

                $_SESSION['message'] =
                    "Profile Updated Successfully";

                $_SESSION['message_type'] =
                    "success";
            }

            header(
                "Location: /Library-Management-System/Project/profile"
            );

            exit;
        }
    }


    // =========================
    // CHANGE PASSWORD
    // =========================

    if(
        $_SERVER['REQUEST_METHOD'] === 'POST' &&
        isset($_POST['change_password'])
    )
    {
        $currentPassword =
            trim($_POST['current_password']);

        $newPassword =
            trim($_POST['new_password']);

        // Verify Current Password

        if(
            !password_verify(
                $currentPassword,
                $member['password_hash']
            )
        )
        {
            $errors['current_password'] =
                "Current password incorrect";
        }

        // New Password Validation

        if(strlen($newPassword) < 8)
        {
            $errors['new_password'] =
                "Password minimum 8 characters";
        }

        // If No Errors

        if(empty($errors))
        {
            $hashedPassword =
                password_hash(
                    $newPassword,
                    PASSWORD_DEFAULT
                );

            $memberModel->changePassword(
                $_SESSION['member_id'],
                $hashedPassword
            );

            $_SESSION['message'] =
                "Password Changed Successfully";

            $_SESSION['message_type'] =
                "success";

            header(
                "Location: /Library-Management-System/Project/profile"
            );

            exit;
        }
    }

    require_once __DIR__ .
    '/../views/profile/profile.php';
}
}