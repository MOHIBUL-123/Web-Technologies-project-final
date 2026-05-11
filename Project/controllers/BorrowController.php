<?php

require_once __DIR__ .
'/../models/Book.php';

require_once __DIR__ .
'/../models/BorrowRecord.php';

require_once __DIR__ .
'/../helpers/auth_helper.php';

class BorrowController
{
    // =========================
    // BORROW BOOK
    // =========================

    public function borrow()
    {
        // Only Members

        auth_check('member');

        $bookModel =
            new Book();

        $borrowModel =
            new BorrowRecord();


        // Get Book ID

        $bookId =
            $_POST['book_id'] ?? null;

        $memberId =
            $_SESSION['member_id'];


        // Find Book

        $book =
            $bookModel->findById($bookId);


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


        // =========================
        // CHECK AVAILABLE COPIES
        // =========================

        $books =
            $bookModel->getAll();

        $selectedBook = null;

        foreach($books as $b)
        {
            if($b['id'] == $bookId)
            {
                $selectedBook = $b;
                break;
            }
        }

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
                "Location: /Library-Management-System/Project/books"
            );

            exit;
        }


        // =========================
        // DUPLICATE BORROW CHECK
        // =========================

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
                "Location: /Library-Management-System/Project/books"
            );

            exit;
        }


        // =========================
        // CREATE BORROW
        // =========================

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


        // Success Message

        $_SESSION['message'] =
            "Book Borrowed Successfully";

        $_SESSION['message_type'] =
            "success";

        header(
            "Location: /Library-Management-System/Project/books"
        );

        exit;
    }
    // =========================
// MEMBER BORROW LIST
// =========================

public function myBooks()
{
    auth_check('member');

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
// =========================
// RETURN BOOK
// =========================

// =========================
// PROCESS RETURN
// =========================

public function returnBook()
{
    auth_check(['librarian', 'admin']);

    $borrowModel =
        new BorrowRecord();

    $borrowId =
        $_POST['borrow_id'] ?? null;


    // Process Return

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
        "Location: /Library-Management-System/Project/active-loans"
    );

    exit;
}
// =========================
// PENDING BORROW REQUESTS
// =========================

public function pendingRequests()
{
    auth_check(['librarian', 'admin']);

    $borrowModel =
        new BorrowRecord();

    $requests =
        $borrowModel->getPendingRequests();

    require_once __DIR__ .
    '/../views/borrow/pending_requests.php';
}
// =========================
// APPROVE REQUEST
// =========================

public function approveRequest()
{
    auth_check(['librarian', 'admin']);

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



// =========================
// REJECT REQUEST
// =========================

public function rejectRequest()
{
    auth_check(['librarian', 'admin']);

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
// =========================
// ACTIVE LOANS
// =========================

public function activeLoans()
{
    auth_check(['librarian', 'admin']);

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
   auth_check(['librarian', 'admin']);


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