<?php
include '../Model/connecttodb.php';

class ReturnModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createReturn($data) {
        $stmt = $this->conn->prepare("INSERT INTO returnbook (User_Id, Book_Id, Type, Date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $data['UserUser_Id_ID'], $data['Book_Id'], $data['Type'], $data['Date']);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getReturnById($returnId) {
        $stmt = $this->conn->prepare("SELECT * FROM returnbook WHERE Return_Id = ?");
        $stmt->bind_param("i", $returnId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function getAllReturns() {
        $stmt = $this->conn->prepare("SELECT * FROM returnbook INNER JOIN borrow ON returnbook.Borrow_Id = borrow.Borrow_Id INNER JOIN book ON borrow.Book_Id = book.Book_Id INNER JOIN users ON borrow.User_Id = users.User_Id");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    public function deleteReturn($returnId) {
        $stmt = $this->conn->prepare("DELETE FROM returnbook WHERE Return_Id = ?");
        $stmt->bind_param("i", $returnId);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateReturn($data) {
        $stmt = $this->conn->prepare("UPDATE returnbook SET User_Id=?, Book_Id=?, Type=?, Date=? WHERE Return_ID=?");
        $stmt->bind_param("iissi", $data['User_Id'], $data['Book_Id'], $data['Type'], $data['Date'], $data['Return_ID']);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
