<?php

require_once __DIR__ .
'/../models/Book.php';

require_once __DIR__ .
'/../models/Genre.php';

require_once __DIR__ .
'/../helpers/auth_helper.php';

class BookController
{




    public function index()
    {


        $bookModel = new Book();

        $books =
            $bookModel->getAll();

        require_once __DIR__ .
        '/../views/book/index.php';
    }




    public function create()
    {
        auth_check(['admin', 'librarian']);

        $bookModel = new Book();

        $genreModel = new Genre();

        $genres =
            $genreModel->getAll();

        $errors = [];


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
                    "Location: /project/Web-Technologies-project-final/Project/books"
                );

                exit;
            }
        }

        require_once __DIR__ .
        '/../views/book/create.php';
    }




public function edit()
{
    auth_check(['admin', 'librarian']);

    $bookModel = new Book();

    $genreModel = new Genre();

    $genres =
        $genreModel->getAll();

    $errors = [];


    $id = $_GET['id'] ?? null;


    $book =
        $bookModel->findById($id);


    if(!$book)
    {
        $_SESSION['message'] =
            "Book Not Found";

        $_SESSION['message_type'] =
            "error";

        header(
            "Location: /project/Web-Technologies-project-final/Project/books"
        );

        exit;
    }


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
                "Location: /project/Web-Technologies-project-final/Project/books"
            );

            exit;
        }
    }

    require_once __DIR__ .
    '/../views/book/edit.php';
}




public function delete()
{
    auth_check(['admin', 'librarian']);

    $bookModel = new Book();


    $id = $_POST['id'] ?? null;


    $book =
        $bookModel->findById($id);


    if(!$book)
    {
        $_SESSION['message'] =
            "Book Not Found";

        $_SESSION['message_type'] =
            "error";

        header(
            "Location: /project/Web-Technologies-project-final/Project/books"
        );

        exit;
    }


if(
    $bookModel->hasActiveBorrows($id)
)
{
    $_SESSION['message'] =
        "Cannot delete book with active borrows";

    $_SESSION['message_type'] =
        "warning";

    header(
        "Location: /project/Web-Technologies-project-final/Project/books"
    );

    exit;
}


    $bookModel->delete($id);

    $_SESSION['message'] =
        "Book Deleted Successfully";

    $_SESSION['message_type'] =
        "success";

    header(
        "Location: /project/Web-Technologies-project-final/Project/books"
    );

    exit;
}




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




public function searchApi()
{
    $bookModel =
        new Book();

    $query =
        trim($_GET['q'] ?? '');


    $books =
        $bookModel->search($query);


    header(
        'Content-Type: application/json'
    );

    echo json_encode($books);

    exit;
}
}