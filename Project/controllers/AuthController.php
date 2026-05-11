<?php

// session_start();

require_once __DIR__ . '/../models/Member.php';

class AuthController
{
    // =========================
    // REGISTER
    // =========================

    public function register()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);
            $password = trim($_POST['password']);

            // Validation

            if (empty($name)) {
                $errors['name'] = "Name is required";
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Invalid email";
            }

           if(
    !preg_match(
        '/^[0-9]{11}$/',
        $phone
    )
)
{
    $errors['phone'] =
        "Phone must be 11 digits";
}

            if (strlen($password) < 8) {
                $errors['password'] = "Password must be at least 8 characters";
            }

            $memberModel = new Member();

            // Check Duplicate Email
            if ($memberModel->findByEmail($email)) {
                $errors['email'] = "Email already exists";
            }
            if ($memberModel->findByPhone($phone)) {
    $errors['phone'] = "Phone already exists";
}

            // If No Errors
            if (empty($errors))
            {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $data = [
                    'name' => $name,
                    'email' => $email,
                    'password_hash' => $hashedPassword,
                    'phone' => $phone
                ];

                $memberModel->register($data);
$_SESSION['message'] =
    "Registration Successful";

$_SESSION['message_type'] =
    "success";

header(
    "Location: /Library-Management-System/Project/login"
);

exit;
            }
        }

        require_once __DIR__ . '/../views/auth/register.php';
    }

    // =========================
    // LOGIN
    // =========================

    public function login()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $memberModel = new Member();

            $member = $memberModel->findByEmail($email);

            // Email Check
            if (!$member)
            {
                $errors['email'] = "Email not found";
            }
            else
            {
                // Password Verify
                if (!password_verify($password, $member['password_hash']))
                {
                    $errors['password'] = "Incorrect password";
                }
                else
                {
                    // Session Create

                    $_SESSION['member_id'] = $member['id'];
                    $_SESSION['name'] = $member['name'];
                    $_SESSION['role'] = $member['role'];

                    // Role Redirect
if ($member['role'] === 'admin')
{
    header(
        "Location: /Library-Management-System/Project/dashboard/admin"
    );
}
elseif ($member['role'] === 'librarian')
{
    header(
        "Location: /Library-Management-System/Project/dashboard/librarian"
    );
}
else
{
    header(
        "Location: /Library-Management-System/Project/dashboard/member"
    );
}
                    exit;
                }
            }
        }

        require_once __DIR__ . '/../views/auth/login.php';
    }

    // =========================
    // LOGOUT
    // =========================

    public function logout()
{
    session_start();

    session_unset();

    session_destroy();

    header(
        "Location: /Library-Management-System/Project/login"
    );

    exit;
}
}