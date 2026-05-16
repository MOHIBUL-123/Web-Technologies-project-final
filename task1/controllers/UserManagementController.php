<?php

require_once __DIR__ .
'/../helpers/auth_helper.php';

require_once __DIR__ .
'/../models/Member.php';


class UserManagementController
{
    // =========================
    // USER LIST
    // =========================

    public function index()
    {
        auth_check('admin');


        $memberModel =
            new Member();


        $users =
            $memberModel->getAllUsers();


        require_once __DIR__ .
        '/../views/users/index.php';
    }
    // =========================
// CREATE PAGE
// =========================

public function create()
{
    auth_check('admin');

    require_once __DIR__ .
    '/../views/users/create.php';
}
// =========================
// STORE LIBRARIAN
// =========================

public function store()
{
    auth_check('admin');


    $memberModel =
        new Member();


    $name =
        trim($_POST['name']);

    $email =
        trim($_POST['email']);

    $phone =
        trim($_POST['phone']);

    $password =
        trim($_POST['password']);


    // REQUIRED VALIDATION

    if(
        empty($name) ||
        empty($email) ||
        empty($phone) ||
        empty($password)
    )
    {
        $_SESSION['error'] =
            "All fields are required";


        $_SESSION['old'] =
            $_POST;


        header(
            "Location: /project/Web-Technologies-project-final/Project/users/create"
        );

        exit;
    }


    // EMAIL EXISTS

    if(
        $memberModel->findByEmail(
            $email
        )
    )
    {
        $_SESSION['error'] =
            "Email already exists";


        $_SESSION['old'] =
            $_POST;


        header(
            "Location: /project/Web-Technologies-project-final/Project/users/create"
        );

        exit;
    }


    // HASH PASSWORD

    $hashedPassword =
        password_hash(
            $password,
            PASSWORD_DEFAULT
        );


    // INSERT USER

    $memberModel->createLibrarian([

        'name' => $name,

        'email' => $email,

        'phone' => $phone,

        'password_hash' =>
            $hashedPassword
    ]);


    // CLEAR OLD INPUT

    unset($_SESSION['old']);


    // SUCCESS MESSAGE

    $_SESSION['message'] =
        "Librarian Created Successfully";


    $_SESSION['message_type'] =
        "success";


    // REDIRECT

    header(
        "Location: /project/Web-Technologies-project-final/Project/users"
    );

    exit;
}
// =========================
// EDIT PAGE
// =========================

public function edit()
{
    auth_check('admin');


    $memberModel =
        new Member();


    $id =
        $_GET['id'] ?? null;


    $user =
        $memberModel->findById($id);


    if(!$user)
    {
        die("User Not Found");
    }


    require_once __DIR__ .
    '/../views/users/edit.php';
}
// =========================
// UPDATE USER
// =========================

public function update()
{
    auth_check('admin');


    $memberModel =
        new Member();


    $id =
        $_POST['id'];

    $name =
        trim($_POST['name']);

    $email =
        trim($_POST['email']);

    $phone =
        trim($_POST['phone']);

    $role =
        trim($_POST['role']);


    $memberModel->updateUser([

        'id' => $id,

        'name' => $name,

        'email' => $email,

        'phone' => $phone,

        'role' => $role
    ]);


    header(
        "Location: /project/Web-Technologies-project-final/Project/users"
    );

    exit;
}
// =========================
// DELETE USER
// =========================

public function delete()
{
    auth_check('admin');


    $memberModel =
        new Member();


    $id =
        $_POST['id'];


    $memberModel->deleteUser($id);


    $_SESSION['message'] =
        "User Deleted Successfully";


    $_SESSION['message_type'] =
        "success";


    header(
        "Location: /project/Web-Technologies-project-final/Project/users"
    );

    exit;
}
}