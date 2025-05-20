<?php

include ('../Model/connecttodb.php');

class BookModel{
    private $bookModel;

    public function __construct($db) {
        $this->conn = $db;
      
    }

    public function createBook($data) {
        $stmt = $this->conn->prepare("INSERT INTO book (Title, Author, Publish_Year, Book_Num, Status, Shelf_Num) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiss", $data['Title'], $data['Author'], $data['Publish_Year'], $data['Book_Num'], $data['Status'], $data['Shelf_Num']);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function availableBooks() {
        $stmt = $this->conn->prepare("SELECT * FROM book WHERE Status = 'Available'");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    public function editBook($data) {
        $stmt = $this->conn->prepare("UPDATE book SET Title=?, Author=?, Publish_Year=?, Book_Num=?, Status=?, Shelf_Num=? WHERE Book_Id=?");
        $stmt->bind_param("sssissi", $data['Title'], $data['Author'], $data['Publish_Year'], $data['Book_Num'], $data['Status'], $data['Shelf_Num'], $data['Book_Id']);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteBook($bookId) {
        $stmt = $this->conn->prepare("DELETE FROM book WHERE Book_Id = ?");
        $stmt->bind_param("i", $bookId);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getBookById($bookId) {
        $stmt = $this->conn->prepare("SELECT * FROM book WHERE Book_Id = ?");
        $stmt->bind_param("i", $bookId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function getAllBooks() {
        $stmt = $this->conn->prepare("SELECT * FROM book");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}