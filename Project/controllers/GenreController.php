<?php

require_once __DIR__ .
'/../models/Genre.php';

require_once __DIR__ .
'/../helpers/auth_helper.php';

class GenreController
{
    // =========================
    // GENRE LIST
    // =========================

    public function index()
    {
        auth_check(['admin', 'librarian']);

        $genreModel = new Genre();

        $genres =
            $genreModel->getAll();

        $errors = [];

        require_once __DIR__ .
        '/../views/genre/index.php';
    }


    // =========================
    // CREATE GENRE
    // =========================

    public function create()
    {
        auth_check(['admin', 'librarian']);

        $genreModel = new Genre();

        $errors = [];

        // Form Submit

        if(
            $_SERVER['REQUEST_METHOD'] === 'POST'
        )
        {
            $name = trim($_POST['name']);

            // Validation

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

            // Insert

            if(empty($errors))
            {
                $genreModel->create($name);

                $_SESSION['message'] =
                    "Genre Created Successfully";

                $_SESSION['message_type'] =
                    "success";

                header(
                    "Location: /Library-Management-System/Project/genres"
                );

                exit;
            }
        }

        require_once __DIR__ .
        '/../views/genre/create.php';
    }
    // =========================
// EDIT GENRE
// =========================

public function edit()
{
    auth_check(['admin', 'librarian']);

    $genreModel = new Genre();

    $errors = [];

    // Get Genre ID

    $id = $_GET['id'] ?? null;

    // Find Genre

    $genre =
        $genreModel->findById($id);

    // Invalid Genre

    if(!$genre)
    {
        $_SESSION['message'] =
            "Genre Not Found";

        $_SESSION['message_type'] =
            "error";

        header(
            "Location: /Library-Management-System/Project/genres"
        );

        exit;
    }

    // Form Submit

    if(
        $_SERVER['REQUEST_METHOD'] === 'POST'
    )
    {
        $name = trim($_POST['name']);

        // Validation

        if(empty($name))
        {
            $errors['name'] =
                "Genre name required";
        }

        // Duplicate Check

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

        // Update

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
                "Location: /Library-Management-System/Project/genres"
            );

            exit;
        }
    }

    require_once __DIR__ .
    '/../views/genre/edit.php';
}
// =========================
// DELETE GENRE
// =========================

public function delete()
{
    auth_check(['admin', 'librarian']);

    $genreModel = new Genre();

    // Get ID

    $id = $_POST['id'] ?? null;

    // Find Genre

    $genre =
        $genreModel->findById($id);

    // Invalid Genre

    if(!$genre)
    {
        $_SESSION['message'] =
            "Genre Not Found";

        $_SESSION['message_type'] =
            "error";

        header(
            "Location: /Library-Management-System/Project/genres"
        );

        exit;
    }

    // Check Assigned Books

    if($genreModel->hasBooks($id))
    {
        $_SESSION['message'] =
            "Cannot delete genre with assigned books";

        $_SESSION['message_type'] =
            "warning";

        header(
            "Location: /Library-Management-System/Project/genres"
        );

        exit;
    }

    // Delete Genre

    $genreModel->delete($id);

    $_SESSION['message'] =
        "Genre Deleted Successfully";

    $_SESSION['message_type'] =
        "success";

    header(
        "Location: /Library-Management-System/Project/genres"
    );

    exit;
}
}