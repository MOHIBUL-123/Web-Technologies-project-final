<?php

require_once __DIR__ .
'/../config/database.php';

class Fine
{
    private $conn;

    public function __construct()
    {
        $database =
            new Database();

        $this->conn =
            $database->connect();
    }




    public function upsertFine(
        $borrowRecordId,
        $memberId,
        $amount,
        $overdueDays
    )
    {


        $sql = "
            SELECT id

            FROM fines

            WHERE borrow_record_id = :borrow_id
        ";

        $stmt =
            $this->conn->prepare($sql);

        $stmt->execute([

            ':borrow_id' =>
                $borrowRecordId
        ]);

        $existing =
            $stmt->fetch(PDO::FETCH_ASSOC);


        if($existing)
        {
            $updateSql = "
                UPDATE fines

                SET
                    amount = :amount,

                    overdue_days = :days

                WHERE
                    borrow_record_id = :borrow_id
            ";

            $updateStmt =
                $this->conn->prepare($updateSql);

            return $updateStmt->execute([

                ':amount' =>
                    $amount,

                ':days' =>
                    $overdueDays,

                ':borrow_id' =>
                    $borrowRecordId
            ]);
        }


        $insertSql = "
            INSERT INTO fines
            (
                borrow_record_id,
                member_id,
                amount,
                overdue_days
            )
            VALUES
            (
                :borrow_id,
                :member_id,
                :amount,
                :days
            )
        ";

        $insertStmt =
            $this->conn->prepare($insertSql);

        return $insertStmt->execute([

            ':borrow_id' =>
                $borrowRecordId,

            ':member_id' =>
                $memberId,

            ':amount' =>
                $amount,

            ':days' =>
                $overdueDays
        ]);
    }




public function getMemberFines($memberId)
{
    $sql = "
        SELECT
            fines.*,

            books.title,

            borrow_records.due_date,

            borrow_records.return_date

        FROM fines

        INNER JOIN borrow_records
        ON fines.borrow_record_id =
           borrow_records.id

        INNER JOIN books
        ON borrow_records.book_id =
           books.id

        WHERE
            fines.member_id = :member_id

        AND
            fines.is_paid = 0

        ORDER BY fines.id DESC
    ";

    $stmt =
        $this->conn->prepare($sql);

    $stmt->execute([

        ':member_id' =>
            $memberId
    ]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




public function getTotalUnpaid($memberId)
{
    $sql = "
        SELECT
            COALESCE(
                SUM(amount),
                0
            ) AS total

        FROM fines

        WHERE
            member_id = :member_id

        AND
            is_paid = 0
    ";

    $stmt =
        $this->conn->prepare($sql);

    $stmt->execute([

        ':member_id' =>
            $memberId
    ]);

    $result =
        $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['total'];
}




public function getAllUnpaidFines($search = '')
{
    $sql = "
        SELECT
            fines.*,

            members.name AS member_name,

            books.title

        FROM fines

        INNER JOIN members
        ON fines.member_id = members.id

        INNER JOIN borrow_records
        ON fines.borrow_record_id =
           borrow_records.id

        INNER JOIN books
        ON borrow_records.book_id =
           books.id

        WHERE
            fines.is_paid = 0
    ";


    if(!empty($search))
    {
        $sql .= "
            AND members.name LIKE :search
        ";
    }


    $sql .= "
        ORDER BY fines.id DESC
    ";


    $stmt =
        $this->conn->prepare($sql);


    if(!empty($search))
    {
        $stmt->execute([

            ':search' =>
                "%$search%"
        ]);
    }
    else
    {
        $stmt->execute();
    }

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




public function markAsPaid($fineId)
{
    $sql = "
        UPDATE fines

        SET
            is_paid = 1

        WHERE
            id = :id
    ";

    $stmt =
        $this->conn->prepare($sql);

    return $stmt->execute([

        ':id' =>
            $fineId
    ]);
}




public function getOutstandingFineTotal($memberId)
{
    $sql = "

        SELECT SUM(amount) as total

        FROM fines

        WHERE member_id = :member_id

        AND is_paid = 0
    ";

    $stmt =
        $this->conn->prepare($sql);

    $stmt->execute([

        ':member_id' => $memberId
    ]);

    $result =
        $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['total'] ?? 0;
}
}