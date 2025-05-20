<?php
class TransactionModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createTransaction($data) {
        $stmt = $this->conn->prepare("INSERT INTO transactions (User_ID, Book_ID, Transaction_Type, Date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $data['User_ID'], $data['Book_ID'], $data['Transaction_Type'], $data['Date']);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getTransactionById($transactionId) {
        $stmt = $this->conn->prepare("SELECT * FROM transactions WHERE Transaction_ID = ?");
        $stmt->bind_param("i", $transactionId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function getAllTransactions() {
        $stmt = $this->conn->prepare("SELECT * FROM transactions");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    public function deleteTransaction($transactionId) {
        $stmt = $this->conn->prepare("DELETE FROM transactions WHERE Transaction_ID = ?");
        $stmt->bind_param("i", $transactionId);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateTransaction($data) {
        $stmt = $this->conn->prepare("UPDATE transactions SET User_ID=?, Book_ID=?, Transaction_Type=?, Date=? WHERE Transaction_ID=?");
        $stmt->bind_param("iissi", $data['User_ID'], $data['Book_ID'], $data['Transaction_Type'], $data['Date'], $data['Transaction_ID']);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}