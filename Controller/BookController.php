
<?php 
include ('../Model/connecttodb.php');
include '../Model/BookModel.php';

class BookController {
    private $bookModel;
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
        $this->bookModel = new BookModel($db);
    }
    public function createBook($data) {
        if ($this->bookModel->createBook($data)) {
            header("Location: ../View/Bookindex.php?message=added");
        } else {
            echo "Error: Unable to create book.";
        }
    }

    public function editBook($data) {
        if ($this->bookModel->editBook($data)) {
            header("Location: ../View/Bookindex.php?message=updated");
        } else {
            echo "Error: Unable to update book.";
        }
    }
    public function deleteBook($bookId) {
        if ($this->bookModel->deleteBook($bookId)) {
            header("Location: ../View/Bookindex.php?message=deleted");
        } else {
            echo "Error: Unable to delete book.";
        }
    }
    public function getBookById($bookId) {
        return $this->bookModel->getBookById($bookId);
    }
    public function getAllBooks() {
        return $this->bookModel->getAllBooks();
    }
    public function  availableBooks() {
        return $this->bookModel->availableBooks();
    }
}
if(isset($_POST['saveBook'])){

    $bookController = new BookController($conn);
    $Title = $_POST['Title'];
    $Author = $_POST['Author'];
    $Publish_Year = $_POST['Publish_Year'];
    $Book_Num = $_POST['Book_Num'];
    $Status = $_POST['Status'];
    $Shelf_Num = $_POST['Shelf_Num'];

    $bookController->createBook([
        'Title' => $Title,
        'Author' => $Author,
        'Publish_Year' => $Publish_Year,
        'Book_Num' => $Book_Num,
        'Status' => $Status,
        'Shelf_Num' => $Shelf_Num
    ]);
}
if(isset($_POST['editBook'])){
    $Book_Id = $_POST['Book_Id'];
   $Title = $_POST['Title'];
    $Author = $_POST['Author'];
    $Publisher = $_POST['Publisher'];
    $Book_Num = $_POST['Book_Num'];
    $Publish_Year = $_POST['Publish_Year'];
    $Status = $_POST['Status'];
    $Shelf_Num = $_POST['Shelf_Num'];
   
    $bookController = new BookController($conn);
    $bookController->editBook([
        'Book_Id' => $Book_Id,
        'Title' => $Title,
        'Author' => $Author,
        'Publisher' => $Publisher,
        'Book_Num' => $Book_Num,
        'Publish_Year' => $Publish_Year,
        'Status' => $Status,
        'Shelf_Num' => $Shelf_Num
    ]);
}

if (isset($_GET['Book_Id'])) {
    $id = intval($_GET['Book_Id']); // Convert to integer to prevent SQL injection
    // Prepare the SQL statement
   $bookController = new BookController($conn);
   $bookController->deleteBook($id);
}
?>