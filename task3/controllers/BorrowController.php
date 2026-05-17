<?php

if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ .
'/../config/database.php';

require_once __DIR__ .
'/../models/BorrowRecord.php';

class BorrowController
{




    public function borrow()
    {


        if (!isset($_SESSION['member_id']) || $_SESSION['role'] !== 'member') { header("Location: /project/Web-Technologies-project-final/Project/login"); exit; }

        $database = new Database();
        $conn = $database->connect();

        $borrowModel =
            new BorrowRecord();


        $bookId =
            $_POST['book_id'] ?? null;

        $memberId =
            $_SESSION['member_id'];


        $bookStmt = $conn->prepare("SELECT * FROM books WHERE id = :id");
        $bookStmt->execute([':id' => $bookId]);
        $book = $bookStmt->fetch(PDO::FETCH_ASSOC);


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




        $availSql = "
            SELECT
                books.total_copies - COALESCE(
                    (SELECT COUNT(*) FROM borrow_records WHERE borrow_records.book_id = books.id AND borrow_records.status = 'Active'), 0
                ) AS available_copies
            FROM books WHERE books.id = :id
        ";
        $availStmt = $conn->prepare($availSql);
        $availStmt->execute([':id' => $bookId]);
        $selectedBook = $availStmt->fetch(PDO::FETCH_ASSOC);

        if(
            !$selectedBook ||
            $selectedBook['available_copies'] <= 0
        )
        {
            $_SESSION['message'] =
                "No copies available";

            $_SESSION['message_type'] =
                "warning";

            header(
                "Location: /project/Web-Technologies-project-final/Project/books"
            );

            exit;
        }




        if(
            $borrowModel->alreadyBorrowed(
                $memberId,
                $bookId
            )
        )
        {
            $_SESSION['message'] =
                "You already borrowed this book";

            $_SESSION['message_type'] =
                "warning";

            header(
                "Location: /project/Web-Technologies-project-final/Project/books"
            );

            exit;
        }




        $borrowDate =
            date('Y-m-d');

        $dueDate =
    date(
        'Y-m-d',
        strtotime('+14 days')
    );

        $data = [

            'member_id' =>
                $memberId,

            'book_id' =>
                $bookId,

        'status' =>
    'Pending',
            'borrow_date' =>
                $borrowDate,

            'due_date' =>
                $dueDate
        ];

        $borrowModel->create($data);


        $_SESSION['message'] =
            "Book Borrowed Successfully";

        $_SESSION['message_type'] =
            "success";

        header(
            "Location: /project/Web-Technologies-project-final/Project/books"
        );

        exit;
    }




public function myBooks()
{
    if (!isset($_SESSION['member_id']) || $_SESSION['role'] !== 'member') { header("Location: /project/Web-Technologies-project-final/Project/login"); exit; }

    $borrowModel =
        new BorrowRecord();

    $memberId =
        $_SESSION['member_id'];

    $borrows =
        $borrowModel->getMemberBorrows(
            $memberId
        );

    require_once __DIR__ .
    '/../views/borrow/my_books.php';
}







public function returnBook()
{
    if (!isset($_SESSION['member_id']) || !in_array($_SESSION['role'], ['librarian', 'admin'])) { header("Location: /project/Web-Technologies-project-final/Project/login"); exit; }

    $borrowModel =
        new BorrowRecord();

    $borrowId =
        $_POST['borrow_id'] ?? null;


    $returned =
        $borrowModel->processReturn(
            $borrowId
        );


    if($returned)
    {
        $_SESSION['message'] =
            "Return Processed Successfully";

        $_SESSION['message_type'] =
            "success";
    }
    else
    {
        $_SESSION['message'] =
            "Return Failed";

        $_SESSION['message_type'] =
            "error";
    }


    header(
        "Location: /project/Web-Technologies-project-final/Project/active-loans"
    );

    exit;
}




public function pendingRequests()
{
    if (!isset($_SESSION['member_id']) || !in_array($_SESSION['role'], ['librarian', 'admin'])) { header("Location: /project/Web-Technologies-project-final/Project/login"); exit; }

    $borrowModel =
        new BorrowRecord();

    $requests =
        $borrowModel->getPendingRequests();

    require_once __DIR__ .
    '/../views/borrow/pending_requests.php';
}




public function approveRequest()
{
    if (!isset($_SESSION['member_id']) || !in_array($_SESSION['role'], ['librarian', 'admin'])) { header("Location: /project/Web-Technologies-project-final/Project/login"); exit; }

    $borrowModel =
        new BorrowRecord();

    $id =
        $_POST['id'] ?? null;

    $success =
        $borrowModel->approveRequest($id);


    header('Content-Type: application/json');

    echo json_encode([

        'success' => $success
    ]);

    exit;
}




public function rejectRequest()
{
    if (!isset($_SESSION['member_id']) || !in_array($_SESSION['role'], ['librarian', 'admin'])) { header("Location: /project/Web-Technologies-project-final/Project/login"); exit; }

    $borrowModel =
        new BorrowRecord();

    $id =
        $_POST['id'] ?? null;

    $success =
        $borrowModel->rejectRequest($id);


    header('Content-Type: application/json');

    echo json_encode([

        'success' => $success
    ]);

    exit;
}




public function activeLoans()
{
    if (!isset($_SESSION['member_id']) || !in_array($_SESSION['role'], ['librarian', 'admin'])) { header("Location: /project/Web-Technologies-project-final/Project/login"); exit; }

    $borrowModel =
        new BorrowRecord();

    $search =
        trim($_GET['search'] ?? '');

    $loans =
        $borrowModel->searchActiveLoans(
            $search
        );

    require_once __DIR__ .
    '/../views/borrow/active_loans.php';
}
public function activeLoanSearch()
{
   if (!isset($_SESSION['member_id']) || !in_array($_SESSION['role'], ['librarian', 'admin'])) { header("Location: /project/Web-Technologies-project-final/Project/login"); exit; }


    require_once __DIR__ .
    '/../models/BorrowRecord.php';


    $borrowModel =
        new BorrowRecord();


    $search =
        $_GET['q'] ?? '';


    $loans =
        $borrowModel->searchActiveLoans(
            $search
        );


    header(
        'Content-Type: application/json'
    );

    echo json_encode($loans);
}

}