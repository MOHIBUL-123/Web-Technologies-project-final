<?php

require_once __DIR__ .
'/../config/database.php';

class Book
{
    private $conn;

    public function __construct()
    {
        $database = new Database();

        $this->conn =
            $database->connect();
    }


    // =========================
    // GET ALL BOOKS
    // =========================

  public function getAll()
{
    $sql = "
        SELECT
            books.*,

            genres.name AS genre_name,

            (
                books.total_copies -

                COALESCE(
                    (
                        SELECT COUNT(*)

                        FROM borrow_records

                        WHERE
                            borrow_records.book_id = books.id

                        AND
                            borrow_records.status = 'Active'
                    ),
                    0
                )

            ) AS available_copies

        FROM books

        INNER JOIN genres
        ON books.genre_id = genres.id

        ORDER BY books.id DESC
    ";

    $stmt =
        $this->conn->prepare($sql);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    // =========================
    // CREATE BOOK
    // =========================

    public function create($data)
    {
        $sql = "
            INSERT INTO books
            (
                genre_id,
                title,
                author,
                isbn,
                total_copies,
                shelf_location,
                published_year
            )

            VALUES
            (
                :genre_id,
                :title,
                :author,
                :isbn,
                :total_copies,
                :shelf_location,
                :published_year
            )
        ";

        $stmt =
            $this->conn->prepare($sql);

        return $stmt->execute([
            ':genre_id' =>
                $data['genre_id'],

            ':title' =>
                $data['title'],

            ':author' =>
                $data['author'],

            ':isbn' =>
                $data['isbn'],

            ':total_copies' =>
                $data['total_copies'],

            ':shelf_location' =>
                $data['shelf_location'],

            ':published_year' =>
                $data['published_year']
        ]);
    }


    // =========================
    // FIND BOOK BY ID
    // =========================

    public function findById($id)
    {
        $sql = "
            SELECT *
            FROM books
            WHERE id = :id
        ";

        $stmt =
            $this->conn->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
// =========================
// SEARCH BOOKS
// =========================

public function search($query)
{
    $sql = "
        SELECT
            books.*,

            genres.name AS genre_name,

            (
                books.total_copies -

                COALESCE(
                    (
                        SELECT COUNT(*)

                        FROM borrow_records

                        WHERE
                            borrow_records.book_id = books.id

                        AND
                            borrow_records.status = 'Active'
                    ),
                    0
                )

            ) AS available_copies

        FROM books

        INNER JOIN genres
        ON books.genre_id = genres.id
WHERE
(
    books.title LIKE :query

    OR books.author LIKE :query

    OR books.isbn LIKE :query
)

        ORDER BY books.id DESC
    ";

    $stmt =
        $this->conn->prepare($sql);

    $stmt->execute([

        ':query' =>
            "%$query%"
    ]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    // =========================
    // FIND BY ISBN
    // =========================

    public function findByISBN($isbn)
    {
        $sql = "
            SELECT *
            FROM books
            WHERE isbn = :isbn
        ";

        $stmt =
            $this->conn->prepare($sql);

        $stmt->execute([
            ':isbn' => $isbn
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // =========================
// UPDATE BOOK
// =========================

public function update($id, $data)
{
    $sql = "
        UPDATE books
        SET
            genre_id = :genre_id,
            title = :title,
            author = :author,
            isbn = :isbn,
            total_copies = :total_copies,
            shelf_location = :shelf_location,
            published_year = :published_year

        WHERE id = :id
    ";

    $stmt =
        $this->conn->prepare($sql);

    return $stmt->execute([

        ':id' =>
            $id,

        ':genre_id' =>
            $data['genre_id'],

        ':title' =>
            $data['title'],

        ':author' =>
            $data['author'],

        ':isbn' =>
            $data['isbn'],

        ':total_copies' =>
            $data['total_copies'],

        ':shelf_location' =>
            $data['shelf_location'],

        ':published_year' =>
            $data['published_year']
    ]);
}
// =========================
// CHECK ACTIVE BORROWS
// =========================

public function hasActiveBorrows($id)
{
    $sql = "
        SELECT COUNT(*) AS total

        FROM borrow_records

        WHERE
            book_id = :id

        AND
            status = 'Active'
    ";

    $stmt =
        $this->conn->prepare($sql);

    $stmt->execute([

        ':id' => $id
    ]);

    $result =
        $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['total'] > 0;
}

// =========================
// DELETE BOOK
// =========================

public function delete($id)
{
    $sql = "
        DELETE FROM books
        WHERE id = :id
    ";

    $stmt =
        $this->conn->prepare($sql);

    return $stmt->execute([
        ':id' => $id
    ]);
}
// =========================
// BOOK DETAILS WITH AVAILABILITY
// =========================

public function findWithAvailability($id)
{
    $sql = "
        SELECT
            books.*,

            genres.name AS genre_name,

            (
                books.total_copies -

                COALESCE(
                    (
                        SELECT COUNT(*)

                        FROM borrow_records

                        WHERE
                            borrow_records.book_id = books.id

                        AND
                            borrow_records.status = 'Active'
                    ),
                    0
                )

            ) AS available_copies

        FROM books

        INNER JOIN genres
        ON books.genre_id = genres.id

        WHERE books.id = :id
    ";

    $stmt =
        $this->conn->prepare($sql);

    $stmt->execute([

        ':id' => $id
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
}