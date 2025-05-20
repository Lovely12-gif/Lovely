<?php
include ('../Model/connecttodb.php');

class BorrowModel {
    private $borrowModel;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createBorrow($data) {
        // Assuming $data is an associative array with keys 'User_Id', 'Book_Id', 'Date', and 'DueDate'
        $Borrowed = $this->conn->prepare("UPDATE book SET Status = 'Borrowed' WHERE Book_Id = ?");
        $Borrowed->bind_param("i", $data['Book_ID']);
        $Borrowed->execute();
        
        $stmt = $this->conn->prepare("INSERT INTO borrow (User_Id, Book_Id, DueDate) VALUES ( ?, ?, ?)");
        $stmt->bind_param("iis", $data['User_ID'], $data['Book_ID'], $data['DueDate']);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
      
       
    }
    public function getBorrowById($borrowId) {
        $stmt = $this->conn->prepare("SELECT * FROM borrow WHERE Borrow_Id = ?");
        $stmt->bind_param("i", $borrowId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function getAllBorrows() {
        $stmt = $this->conn->prepare("SELECT * FROM borrow INNER JOIN book ON borrow.Book_Id = book.Book_Id INNER JOIN users ON borrow.User_Id = users.User_Id");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    public function deleteBorrow($borrowId) {
        $stmt = $this->conn->prepare("DELETE FROM borrow WHERE Borrow_Id = ?");
        $stmt->bind_param("i", $borrowId);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateBorrow($data) {
        $stmt = $this->conn->prepare("UPDATE borrow SET User_Id=?, Book_Id=?,DueDate=? WHERE Borrow_Id=?");
        $stmt->bind_param("iissi", $data['User_ID'], $data['Book_ID'], $data['DueDate'], $data['Borrow_Id']);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}