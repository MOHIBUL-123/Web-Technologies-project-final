<?php

if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ .
'/../models/Genre.php';

class GenreController
{




    public function index()
    {
        if (!isset($_SESSION['member_id']) || !in_array($_SESSION['role'], ['admin', 'librarian'])) { header("Location: /project/Web-Technologies-project-final/Project/login"); exit; }

        $genreModel = new Genre();

        $genres =
            $genreModel->getAll();

        $errors = [];

        require_once __DIR__ .
        '/../views/genre/index.php';
    }




    public function create()
    {
        if (!isset($_SESSION['member_id']) || !in_array($_SESSION['role'], ['admin', 'librarian'])) { header("Location: /project/Web-Technologies-project-final/Project/login"); exit; }

        $genreModel = new Genre();

        $errors = [];


        if(
            $_SERVER['REQUEST_METHOD'] === 'POST'
        )
        {
            $name = trim($_POST['name']);


            if(empty($name))
            {
                $errors['name'] =
                    "Genre name required";
            }
            if(
    $genreModel->findByName($name)
)
{
    $errors['name'] =
        "Genre already exists";
}


            if(empty($errors))
            {
                $genreModel->create($name);

                $_SESSION['message'] =
                    "Genre Created Successfully";

                $_SESSION['message_type'] =
                    "success";

                header(
                    "Location: /project/Web-Technologies-project-final/Project/genres"
                );

                exit;
            }
        }

        require_once __DIR__ .
        '/../views/genre/create.php';
    }




public function edit()
{
    if (!isset($_SESSION['member_id']) || !in_array($_SESSION['role'], ['admin', 'librarian'])) { header("Location: /project/Web-Technologies-project-final/Project/login"); exit; }

    $genreModel = new Genre();

    $errors = [];


    $id = $_GET['id'] ?? null;


    $genre =
        $genreModel->findById($id);


    if(!$genre)
    {
        $_SESSION['message'] =
            "Genre Not Found";

        $_SESSION['message_type'] =
            "error";

        header(
            "Location: /project/Web-Technologies-project-final/Project/genres"
        );

        exit;
    }


    if(
        $_SERVER['REQUEST_METHOD'] === 'POST'
    )
    {
        $name = trim($_POST['name']);


        if(empty($name))
        {
            $errors['name'] =
                "Genre name required";
        }


        $existingGenre =
            $genreModel->findByName($name);

        if(
            $existingGenre &&
            $existingGenre['id'] != $id
        )
        {
            $errors['name'] =
                "Genre already exists";
        }


        if(empty($errors))
        {
            $genreModel->update(
                $id,
                $name
            );

            $_SESSION['message'] =
                "Genre Updated Successfully";

            $_SESSION['message_type'] =
                "success";

            header(
                "Location: /project/Web-Technologies-project-final/Project/genres"
            );

            exit;
        }
    }

    require_once __DIR__ .
    '/../views/genre/edit.php';
}




public function delete()
{
    if (!isset($_SESSION['member_id']) || !in_array($_SESSION['role'], ['admin', 'librarian'])) { header("Location: /project/Web-Technologies-project-final/Project/login"); exit; }

    $genreModel = new Genre();


    $id = $_POST['id'] ?? null;


    $genre =
        $genreModel->findById($id);


    if(!$genre)
    {
        $_SESSION['message'] =
            "Genre Not Found";

        $_SESSION['message_type'] =
            "error";

        header(
            "Location: /project/Web-Technologies-project-final/Project/genres"
        );

        exit;
    }


    if($genreModel->hasBooks($id))
    {
        $_SESSION['message'] =
            "Cannot delete genre with assigned books";

        $_SESSION['message_type'] =
            "warning";

        header(
            "Location: /project/Web-Technologies-project-final/Project/genres"
        );

        exit;
    }


    $genreModel->delete($id);

    $_SESSION['message'] =
        "Genre Deleted Successfully";

    $_SESSION['message_type'] =
        "success";

    header(
        "Location: /project/Web-Technologies-project-final/Project/genres"
    );

    exit;
}
}