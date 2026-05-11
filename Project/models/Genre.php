<?php

require_once __DIR__ .
'/../config/database.php';

class Genre
{
    private $conn;

    public function __construct()
    {
        $database = new Database();

        $this->conn =
            $database->connect();
    }


    // =========================
    // GET ALL GENRES
    // =========================

    public function getAll()
    {
        $sql = "
            SELECT *
            FROM genres
            ORDER BY name ASC
        ";

        $stmt =
            $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // =========================
    // CREATE GENRE
    // =========================

    public function create($name)
    {
        $sql = "
            INSERT INTO genres(name)
            VALUES(:name)
        ";

        $stmt =
            $this->conn->prepare($sql);

        return $stmt->execute([
            ':name' => $name
        ]);
    }
    public function findByName($name)
{
    $sql = "
        SELECT *
        FROM genres
        WHERE name = :name
    ";

    $stmt =
        $this->conn->prepare($sql);

    $stmt->execute([
        ':name' => $name
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
// =========================
// FIND BY ID
// =========================

public function findById($id)
{
    $sql = "
        SELECT *
        FROM genres
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
// UPDATE GENRE
// =========================

public function update($id, $name)
{
    $sql = "
        UPDATE genres
        SET name = :name
        WHERE id = :id
    ";

    $stmt =
        $this->conn->prepare($sql);

    return $stmt->execute([
        ':id' => $id,
        ':name' => $name
    ]);
}
// =========================
// CHECK BOOKS EXIST
// =========================

public function hasBooks($id)
{
    $sql = "
        SELECT COUNT(*) as total
        FROM books
        WHERE genre_id = :id
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
// DELETE GENRE
// =========================

public function delete($id)
{
    $sql = "
        DELETE FROM genres
        WHERE id = :id
    ";

    $stmt =
        $this->conn->prepare($sql);

    return $stmt->execute([
        ':id' => $id
    ]);
}

}