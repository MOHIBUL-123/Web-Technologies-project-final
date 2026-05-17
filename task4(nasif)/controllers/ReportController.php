<?php

if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ .
'/../config/database.php';


class ReportController
{
    public function index()
    {
        if (!isset($_SESSION['member_id']) || $_SESSION['role'] !== 'admin') { header("Location: /project/Web-Technologies-project-final/Project/login"); exit; }

        $database = new Database();
        $conn = $database->connect();


        // TOP BOOKS

        $topBooksSql = "
            SELECT books.title, COUNT(borrow_records.id) AS total_borrows
            FROM borrow_records
            INNER JOIN books ON borrow_records.book_id = books.id
            GROUP BY borrow_records.book_id
            ORDER BY total_borrows DESC
            LIMIT 10
        ";
        $stmt = $conn->prepare($topBooksSql);
        $stmt->execute();
        $topBooks = $stmt->fetchAll(PDO::FETCH_ASSOC);


        // TOP MEMBERS

        $topMembersSql = "
            SELECT members.name, COUNT(borrow_records.id) AS total_loans
            FROM borrow_records
            INNER JOIN members ON borrow_records.member_id = members.id
            GROUP BY borrow_records.member_id
            ORDER BY total_loans DESC
            LIMIT 10
        ";
        $stmt = $conn->prepare($topMembersSql);
        $stmt->execute();
        $topMembers = $stmt->fetchAll(PDO::FETCH_ASSOC);


        // MONTHLY REPORT

        $monthlySql = "
            SELECT DATE_FORMAT(borrow_date, '%Y-%m') AS month, COUNT(*) AS total
            FROM borrow_records
            WHERE borrow_date >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
            GROUP BY month
            ORDER BY month ASC
        ";
        $stmt = $conn->prepare($monthlySql);
        $stmt->execute();
        $monthlyBorrows = $stmt->fetchAll(PDO::FETCH_ASSOC);


        require_once __DIR__ .
        '/../views/reports/index.php';
    }
}