<?php

require_once __DIR__ . '/../config/database.php';

class Member
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function register($data)
    {
        $sql = "INSERT INTO members
                (name, email, password_hash, phone, role)
                VALUES
                (:name, :email, :password_hash, :phone, 'member')";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':password_hash' => $data['password_hash'],
            ':phone' => $data['phone']
        ]);
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM members WHERE email = :email";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':email' => $email
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

public function findByPhone($phone)
{
    $sql = "SELECT * FROM members
            WHERE phone = :phone";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute([
        ':phone' => $phone
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}




public function findById($id)
{
    $sql = "SELECT * FROM members
            WHERE id = :id";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute([
        ':id' => $id
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}




public function updateProfile($data)
{
    $sql = "UPDATE members
            SET
                name = :name,
                email = :email,
                phone = :phone
            WHERE id = :id";

    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
        ':name' => $data['name'],
        ':email' => $data['email'],
        ':phone' => $data['phone'],
        ':id' => $data['id']
    ]);
}




public function changePassword($id, $newPassword)
{
    $sql = "UPDATE members
            SET password_hash = :password
            WHERE id = :id";

    $stmt = $this->conn->prepare($sql);

    return $stmt->execute([
        ':password' => $newPassword,
        ':id' => $id
    ]);
}




public function getAllUsers()
{
    $sql = "
        SELECT *

        FROM members

        ORDER BY id DESC
    ";

    $stmt =
        $this->conn->prepare($sql);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




public function createLibrarian($data)
{
    $sql = "
        INSERT INTO members
        (
            name,
            email,
            password_hash,
            phone,
            role
        )

        VALUES
        (
            :name,
            :email,
            :password_hash,
            :phone,
            'librarian'
        )
    ";

    $stmt =
        $this->conn->prepare($sql);

    return $stmt->execute([

        ':name' =>
            $data['name'],

        ':email' =>
            $data['email'],

        ':password_hash' =>
            $data['password_hash'],

        ':phone' =>
            $data['phone']
    ]);
}




public function updateUser($data)
{
    $sql = "
        UPDATE members

        SET
            name = :name,
            email = :email,
            phone = :phone,
            role = :role

        WHERE id = :id
    ";

    $stmt =
        $this->conn->prepare($sql);

    return $stmt->execute([

        ':id' =>
            $data['id'],

        ':name' =>
            $data['name'],

        ':email' =>
            $data['email'],

        ':phone' =>
            $data['phone'],

        ':role' =>
            $data['role']
    ]);
}




public function deleteUser($id)
{
    $sql = "
        DELETE FROM members

        WHERE id = :id
    ";

    $stmt =
        $this->conn->prepare($sql);

    return $stmt->execute([

        ':id' => $id
    ]);
}

}