<?php
include ('../Model/connecttodb.php');

class UserModel {
    private $conn;

    public function __construct($db) {

        $this->conn = $db;
        

    }

    public function createUser($data) {
        $stmt = $this->conn->prepare("INSERT INTO Users (Username, Password, Fname, Lname, Email, Year_Level, Grade_Level, Type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $data['Username'], password_hash($data['Password'], PASSWORD_DEFAULT), $data['Fname'], $data['Lname'], $data['Email'], $data['Year_Level'], $data['Grade_Level'], $data['Type']);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function editUser($data) {
        if (!empty($data['Password'])) {
            $stmt = $this->conn->prepare("UPDATE Users SET Username=?, Password=?, Fname=?, Lname=?, Email=?, Year_Level=?, Grade_Level=?, Type=? WHERE User_ID=?");
            $stmt->bind_param("ssssssssi", $data['Username'], password_hash($data['Password'], PASSWORD_DEFAULT), $data['Fname'], $data['Lname'], $data['Email'], $data['Year_Level'], $data['Grade_Level'], $data['Type'], $data['UserID']);
        } else {
            $stmt = $this->conn->prepare("UPDATE Users SET Username=?, Fname=?, Lname=?, Email=?, Year_Level=?, Grade_Level=?, Type=? WHERE User_ID=?");
            $stmt->bind_param("ssssssssi", $data['Username'], $data['Fname'], $data['Lname'], $data['Email'], $data['Year_Level'], $data['Grade_Level'], $data['Type'], $data['UserID']);
        }

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteUser($userId) {
        $stmt = $this->conn->prepare("DELETE FROM Users WHERE User_ID = ?");
        $stmt->bind_param("i", $userId);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getUserById($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM Users WHERE User_ID = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function getAllUsers() {
        $stmt = $this->conn->prepare("SELECT * FROM Users");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}