<?php

require_once __DIR__ .
'/../models/Book.php';

require_once __DIR__ .
'/../models/Genre.php';

require_once __DIR__ .
'/../helpers/auth_helper.php';

class BookController
{
    // =========================
    // BOOK LIST
    // =========================

    public function index()
    {
        // auth_check(['admin', 'librarian']);

        $bookModel = new Book();

        $books =
            $bookModel->getAll();

        require_once __DIR__ .
        '/../views/book/index.php';
    }


    // =========================
    // CREATE BOOK
    // =========================

    public function create()
    {
        auth_check(['admin', 'librarian']);

        $bookModel = new Book();

        $genreModel = new Genre();

        $genres =
            $genreModel->getAll();

        $errors = [];

        // Form Submit

        if(
            $_SERVER['REQUEST_METHOD'] === 'POST'
        )
        {
            $genreId =
                trim($_POST['genre_id']);

            $title =
                trim($_POST['title']);

            $author =
                trim($_POST['author']);

            $isbn =
                trim($_POST['isbn']);

            $totalCopies =
                trim($_POST['total_copies']);

            $shelfLocation =
                trim($_POST['shelf_location']);

            $publishedYear =
                trim($_POST['published_year']);


            // =========================
            // VALIDATION
            // =========================

            if(empty($genreId))
            {
                $errors['genre_id'] =
                    "Genre required";
            }

            if(empty($title))
            {
                $errors['title'] =
                    "Title required";
            }

            if(empty($author))
            {
                $errors['author'] =
                    "Author required";
            }

            if(empty($isbn))
            {
                $errors['isbn'] =
                    "ISBN required";
            }

            if(
                $bookModel->findByISBN($isbn)
            )
            {
                $errors['isbn'] =
                    "ISBN already exists";
            }

            if(
                !is_numeric($totalCopies) ||
                $totalCopies < 1
            )
            {
                $errors['total_copies'] =
                    "Copies must be greater than 0";
            }

            if(empty($shelfLocation))
            {
                $errors['shelf_location'] =
                    "Shelf location required";
            }

            if(
                !is_numeric($publishedYear)
            )
            {
                $errors['published_year'] =
                    "Invalid year";
            }


            // =========================
            // INSERT
            // =========================

            if(empty($errors))
            {
                $data = [

                    'genre_id' =>
                        $genreId,

                    'title' =>
                        $title,

                    'author' =>
                        $author,

                    'isbn' =>
                        $isbn,

                    'total_copies' =>
                        $totalCopies,

                    'shelf_location' =>
                        $shelfLocation,

                    'published_year' =>
                        $publishedYear
                ];

                $bookModel->create($data);

                $_SESSION['message'] =
                    "Book Created Successfully";

                $_SESSION['message_type'] =
                    "success";

                header(
                    "Location: /Library-Management-System/Project/books"
                );

                exit;
            }
        }

        require_once __DIR__ .
        '/../views/book/create.php';
    }
    // =========================
// EDIT BOOK
// =========================

public function edit()
{
    auth_check(['admin', 'librarian']);

    $bookModel = new Book();

    $genreModel = new Genre();

    $genres =
        $genreModel->getAll();

    $errors = [];

    // Get Book ID

    $id = $_GET['id'] ?? null;

    // Find Book

    $book =
        $bookModel->findById($id);

    // Invalid Book

    if(!$book)
    {
        $_SESSION['message'] =
            "Book Not Found";

        $_SESSION['message_type'] =
            "error";

        header(
            "Location: /Library-Management-System/Project/books"
        );

        exit;
    }

    // Form Submit

    if(
        $_SERVER['REQUEST_METHOD'] === 'POST'
    )
    {
        $genreId =
            trim($_POST['genre_id']);

        $title =
            trim($_POST['title']);

        $author =
            trim($_POST['author']);

        $isbn =
            trim($_POST['isbn']);

        $totalCopies =
            trim($_POST['total_copies']);

        $shelfLocation =
            trim($_POST['shelf_location']);

        $publishedYear =
            trim($_POST['published_year']);


        // =========================
        // VALIDATION
        // =========================

        if(empty($genreId))
        {
            $errors['genre_id'] =
                "Genre required";
        }

        if(empty($title))
        {
            $errors['title'] =
                "Title required";
        }

        if(empty($author))
        {
            $errors['author'] =
                "Author required";
        }

        if(empty($isbn))
        {
            $errors['isbn'] =
                "ISBN required";
        }

        // Duplicate ISBN Check

        $existingBook =
            $bookModel->findByISBN($isbn);

        if(
            $existingBook &&
            $existingBook['id'] != $id
        )
        {
            $errors['isbn'] =
                "ISBN already exists";
        }

        if(
            !is_numeric($totalCopies) ||
            $totalCopies < 1
        )
        {
            $errors['total_copies'] =
                "Copies must be greater than 0";
        }

        if(empty($shelfLocation))
        {
            $errors['shelf_location'] =
                "Shelf location required";
        }

        $currentYear = date('Y');

        if(
            !preg_match(
                '/^[0-9]{4}$/',
                $publishedYear
            ) ||
            $publishedYear > $currentYear
        )
        {
            $errors['published_year'] =
                "Invalid published year";
        }


        // =========================
        // UPDATE
        // =========================

        if(empty($errors))
        {
            $data = [

                'genre_id' =>
                    $genreId,

                'title' =>
                    $title,

                'author' =>
                    $author,

                'isbn' =>
                    $isbn,

                'total_copies' =>
                    $totalCopies,

                'shelf_location' =>
                    $shelfLocation,

                'published_year' =>
                    $publishedYear
            ];

            $bookModel->update(
                $id,
                $data
            );

            $_SESSION['message'] =
                "Book Updated Successfully";

            $_SESSION['message_type'] =
                "success";

            header(
                "Location: /Library-Management-System/Project/books"
            );

            exit;
        }
    }

    require_once __DIR__ .
    '/../views/book/edit.php';
}
// =========================
// DELETE BOOK
// =========================

public function delete()
{
    auth_check(['admin', 'librarian']);

    $bookModel = new Book();

    // Get ID

    $id = $_POST['id'] ?? null;

    // Find Book

    $book =
        $bookModel->findById($id);

    // Invalid Book

    if(!$book)
    {
        $_SESSION['message'] =
            "Book Not Found";

        $_SESSION['message_type'] =
            "error";

        header(
            "Location: /Library-Management-System/Project/books"
        );

        exit;
    }
// Check Active Borrows

if(
    $bookModel->hasActiveBorrows($id)
)
{
    $_SESSION['message'] =
        "Cannot delete book with active borrows";

    $_SESSION['message_type'] =
        "warning";

    header(
        "Location: /Library-Management-System/Project/books"
    );

    exit;
}
    // Delete

    $bookModel->delete($id);

    $_SESSION['message'] =
        "Book Deleted Successfully";

    $_SESSION['message_type'] =
        "success";

    header(
        "Location: /Library-Management-System/Project/books"
    );

    exit;
}
// =========================
// BOOK DETAILS
// =========================

public function details()
{
    $bookModel =
        new Book();

    $id =
        $_GET['id'] ?? null;

    $book =
        $bookModel->findWithAvailability(
            $id
        );

    if(!$book)
    {
        echo "Book Not Found";
        exit;
    }

    require_once __DIR__ .
    '/../views/book/details.php';
}
// =========================
// BOOK AVAILABILITY API
// =========================

public function availability()
{
    $bookModel =
        new Book();

    $id =
        $_GET['id'] ?? null;

    $book =
        $bookModel->findWithAvailability(
            $id
        );

    header(
        'Content-Type: application/json'
    );

    if(!$book)
    {
        echo json_encode([

            'success' => false
        ]);

        exit;
    }

    echo json_encode([

        'success' => true,

        'available_copies' =>
            $book['available_copies'],

        'available' =>
            $book['available_copies'] > 0
    ]);

    exit;
}
// =========================
// SEARCH API
// =========================

public function searchApi()
{
    $bookModel =
        new Book();

    $query =
        trim($_GET['q'] ?? '');


    // SEARCH

    $books =
        $bookModel->search($query);


    // JSON RESPONSE

    header(
        'Content-Type: application/json'
    );

    echo json_encode($books);

    exit;
}
}