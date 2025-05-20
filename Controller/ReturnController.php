
<?php 
include '../Model/ReturnModel.php';

class ReturnController {
    private $returnModel;

    public function __construct($db) {
        $this->conn = $db;
        $this->returnModel = new ReturnModel($db);
    }

    public function createReturn($data) {
        if ($this->returnModel->createReturn($data)) {
            header("Location: ../View/Returnindex.php?message=returned");
        } else {
            echo "Error: Unable to return book.";
        }
    }
    public function editReturn($data) {
        if ($this->returnModel->editReturn($data)) {
            header("Location: ../View/Returnindex.php?message=updated");
        } else {
            echo "Error: Unable to update return.";
        }
    }
    public function deleteReturn($returnId) {
        if ($this->returnModel->deleteReturn($returnId)) {
            header("Location: ../View/Returnindex.php?message=deleted");
        } else {
            echo "Error: Unable to delete return.";
        }
    }
    public function getReturnById($returnId) {
        return $this->returnModel->getReturnById($returnId);
    }
    public function getAllReturns() {
        return $this->returnModel->getAllReturns();
    }
}





if (isset($_GET['Return_Id'])) {
    $id = intval($_GET['Return_Id']); // Convert to integer to prevent SQL injection
    // Prepare the SQL statement
    $returnController = new ReturnController($conn);
    if ($returnController->deleteReturn($id)) {
        header("Location: Returnindex.php?message=deleted");
    } else {
        echo "Error: Unable to delete return.";
    }
    
}

?>