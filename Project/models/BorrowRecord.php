<?php

require_once __DIR__ .
'/../config/database.php';

class BorrowRecord
{
    private $conn;

    public function __construct()
    {
        $database = new Database();

        $this->conn =
            $database->connect();
    }




    public function create($data)
    {
        $sql = "
            INSERT INTO borrow_records
            (
                member_id,
                book_id,
                status,
                borrow_date,
                due_date
            )

            VALUES
            (
                :member_id,
                :book_id,
                :status,
                :borrow_date,
                :due_date
            )
        ";

        $stmt =
            $this->conn->prepare($sql);

        return $stmt->execute([

            ':member_id' =>
                $data['member_id'],

            ':book_id' =>
                $data['book_id'],

            ':status' =>
                $data['status'],

            ':borrow_date' =>
                $data['borrow_date'],

            ':due_date' =>
                $data['due_date']
        ]);
    }




   public function alreadyBorrowed(
    $memberId,
    $bookId
)
{
    $sql = "
        SELECT id

        FROM borrow_records

        WHERE
            member_id = :member_id

        AND
            book_id = :book_id

        AND
        (
            status = 'Pending'

            OR

            status = 'Active'
        )

        LIMIT 1
    ";

    $stmt =
        $this->conn->prepare($sql);

    $stmt->execute([

        ':member_id' =>
            $memberId,

        ':book_id' =>
            $bookId
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}




public function getMemberBorrows($memberId)
{
    $sql = "
        SELECT
            borrow_records.*,

            books.title,
            books.author,
            books.isbn

        FROM borrow_records

        INNER JOIN books
        ON borrow_records.book_id = books.id

        WHERE
            borrow_records.member_id = :member_id

        ORDER BY borrow_records.id DESC
    ";

    $stmt =
        $this->conn->prepare($sql);

    $stmt->execute([

        ':member_id' =>
            $memberId
    ]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}







public function processReturn($borrowId)
{
    $sql = "
        UPDATE borrow_records

        SET
            status = 'Returned',

            return_date = NOW()

        WHERE
            id = :id

        AND
            status = 'Active'
    ";

    $stmt =
        $this->conn->prepare($sql);

    return $stmt->execute([

        ':id' =>
            $borrowId
    ]);
}




public function getPendingRequests()
{
    $sql = "
        SELECT
            borrow_records.*,

            members.name AS member_name,

            books.title AS book_title

        FROM borrow_records

        INNER JOIN members
        ON borrow_records.member_id = members.id

        INNER JOIN books
        ON borrow_records.book_id = books.id

        WHERE
            borrow_records.status = 'Pending'

        ORDER BY borrow_records.id DESC
    ";

    $stmt =
        $this->conn->prepare($sql);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




public function approveRequest($id)
{
    $sql = "
        UPDATE borrow_records

        SET
            status = 'Active'

        WHERE
            id = :id

        AND
            status = 'Pending'
    ";

    $stmt =
        $this->conn->prepare($sql);

    return $stmt->execute([

        ':id' => $id
    ]);
}




public function rejectRequest($id)
{
    $sql = "
        DELETE FROM borrow_records

        WHERE
            id = :id

        AND
            status = 'Pending'
    ";

    $stmt =
        $this->conn->prepare($sql);

    return $stmt->execute([

        ':id' => $id
    ]);
}




public function searchActiveLoans($search)
{
    $sql = "

        SELECT
            br.*,

            m.name AS member_name,

            b.title AS book_title

        FROM borrow_records br

        JOIN members m
            ON br.member_id = m.id

        JOIN books b
            ON br.book_id = b.id

        WHERE br.status = 'Active'

        AND
        (
            m.name LIKE :search

            OR

            b.title LIKE :search
        )

        ORDER BY br.id DESC
    ";


    $stmt =
        $this->conn->prepare($sql);


    $stmt->execute([

        ':search' =>
            "%$search%"
    ]);


    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




public function getOverdueBorrows()
{
    $sql = "
        SELECT *

        FROM borrow_records

        WHERE
            status = 'Active'

        AND
            due_date < NOW()
    ";

    $stmt =
        $this->conn->prepare($sql);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




public function getActiveLoanCount($memberId)
{
    $sql = "

        SELECT COUNT(*) as total

        FROM borrow_records

        WHERE member_id = :member_id

        AND status = 'Active'
    ";

    $stmt =
        $this->conn->prepare($sql);

    $stmt->execute([

        ':member_id' => $memberId
    ]);

    $result =
        $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['total'];
}




public function getUpcomingDueCount($memberId)
{
    $sql = "

        SELECT COUNT(*) as total

        FROM borrow_records

        WHERE member_id = :member_id

        AND status = 'Active'

        AND due_date <= DATE_ADD(NOW(), INTERVAL 3 DAY)
    ";

    $stmt =
        $this->conn->prepare($sql);

    $stmt->execute([

        ':member_id' => $memberId
    ]);

    $result =
        $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['total'];
}




public function getTopBorrowedBooks()
{
    $sql = "
        SELECT
            books.title,

            COUNT(borrow_records.id)
            AS total_borrows

        FROM borrow_records

        INNER JOIN books
        ON borrow_records.book_id =
           books.id

        GROUP BY borrow_records.book_id

        ORDER BY total_borrows DESC

        LIMIT 10
    ";

    $stmt =
        $this->conn->prepare($sql);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




public function getTopMembers()
{
    $sql = "
        SELECT
            members.name,

            COUNT(borrow_records.id)
            AS total_loans

        FROM borrow_records

        INNER JOIN members
        ON borrow_records.member_id =
           members.id

        GROUP BY borrow_records.member_id

        ORDER BY total_loans DESC

        LIMIT 10
    ";

    $stmt =
        $this->conn->prepare($sql);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




public function getMonthlyBorrows()
{
    $sql = "
        SELECT

            DATE_FORMAT(
                borrow_date,
                '%Y-%m'
            ) AS month,

            COUNT(*) AS total

        FROM borrow_records

        WHERE
            borrow_date >= DATE_SUB(
                NOW(),
                INTERVAL 6 MONTH
            )

        GROUP BY month

        ORDER BY month ASC
    ";

    $stmt =
        $this->conn->prepare($sql);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}