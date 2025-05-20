
<?php 
include '../Model/BorrowModel.php'; 
include '../Model/connecttodb.php';

class BorrowController {
    private $conn;
    private $borrowModel;

    public function __construct($db) {
        $this->borrowModel = new BorrowModel($db);
        $this->conn = $db;
    }

    public function createBorrow($data) {
        if ($this->borrowModel->createBorrow($data)) {
            header("Location: ../View/Borrowindex.php?message=added");
        } else {
            echo "Error: Unable to create borrow.";
        }
    }
    public function editBorrow($data) {
        if ($this->borrowModel->editBorrow($data)) {
            header("Location: ../View/Borrowindex.php?message=updated");
        } else {
            echo "Error: Unable to update borrow.";
        }
    }
    public function deleteBorrow($borrowId) {
        if ($this->borrowModel->deleteBorrow($borrowId)) {
            header("Location: ../View/Borrowindex.php?message=deleted");
        } else {
            echo "Error: Unable to delete borrow.";
        }
    }
    public function getBorrowById($borrowId) {
        return $this->borrowModel->getBorrowById($borrowId);
    }
    public function getAllBorrows() {
        return $this->borrowModel->getAllBorrows();
    }
}

if(isset($_POST['saveBorrow'])){
  $borrowController = new BorrowController($conn);  
    $Book_ID = $_POST['Book_Id'];
    $User_ID = $_POST['User_Id'];
    $DueDate = date("Y-m-d h:m:s", strtotime("+5 days")); // Set due date to 7 days from now


    $borrowController->createBorrow([   
          'User_ID' => $User_ID,
        'Book_ID' => $Book_ID,
        'DueDate' => $DueDate
    ]);



}
if(isset($_POST['editBorrow'])){
    $Borrow_Id = $_POST['Borrow_Id'];
    $Book_ID = $_POST['Book_Id'];
    $User_ID = $_POST['User_Id'];
    
    $DueDate = $_POST['DueDate'];
   
    $borrowController = new BorrowController($conn);
    $borrowController->editBorrow([   
        'Borrow_Id' => $Borrow_Id,
         'User_ID' => $User_ID,
        'Book_ID' => $Book_ID,
        'Due_Date' => $DueDate
    ]);
}

if (isset($_GET['Borrow_Id'])) {
    $id = intval($_GET['Borrow_Id']); // Convert to integer to prevent SQL injection
    // Prepare the SQL statement
    $borrowController = new BorrowController($conn);
    $borrowController->deleteBorrow($id);


}
?>