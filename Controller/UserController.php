
<?php
require_once '../Model/connecttodb.php';
require_once '../Model/UserModel.php';

class UserController {
    private $userModel;
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
        $this->userModel = new UserModel($db);
    }

   

    public function createUser($data) {
        if ($this->userModel->createUser($data)) {
            header("Location: ../View/Userindex.php?message=added");
        } else {
            echo "Error: Unable to create user.";
        }
    }

    public function editUser($data) {
        if ($this->userModel->editUser($data)) {
            header("Location: ../View/Userindex.php?message=updated");
        } else {
            echo "Error: Unable to update user.";
        }
    }
    public function deleteUser($userId) {
        if ($this->userModel->deleteUser($userId)) {
            header("Location: ../View/Userindex.php?message=deleted");
        } else {
            echo "Error: Unable to delete user.";
        }
    }
    public function getUserById($userId) {
        return $this->userModel->getUserById($userId);
    }
    public function getAllUsers() {
       return $stmt = $this->userModel->getAllUsers();
      
     
    }
}

if (isset($_POST['saveUser'])) {
  

    $userController = new UserController($conn);
    $Username = $_POST['Username'];
  
    $Fname = $_POST['Fname'];
    $Lname = $_POST['Lname'];
    $Email = $_POST['email'];
    $Year_Level = $_POST['Year_Level'];
    $Grade_Level = $_POST['Grade_Level'];
    $Type = $_POST['type']; 
    $Password = password_hash($_POST['Password'], PASSWORD_DEFAULT); // Secure password hashing
$userController->createUser([
        'Username' => $Username,
        'Password' => $Password,
        'Fname' => $Fname,
        'Lname' => $Lname,
        'Email' => $Email,
        'Year_Level' => $Year_Level,
        'Grade_Level' => $Grade_Level,
        'Type' => $Type

        
    ]);

   
}

// Edit User
if (isset($_POST['editUser'])) {
    $Username = $_POST['Username'];
    $Password = password_hash($_POST['Password'], PASSWORD_DEFAULT); // Secure password hashing
    $Fname = $_POST['Fname'];
    $Lname = $_POST['Lname'];
    $Email = $_POST['email'];
    $Year_Level = $_POST['Year_Level'];
    $Grade_Level = $_POST['Grade_Level'];
    $Type = $_POST['Type'];


    $UserID = $_POST['UserID'];
    $userController = new UserController($conn);
    $userController->editUser([
        'Username' => $Username,
        'Password' => $Password,
        'Fname' => $Fname,
        'Lname' => $Lname,
        'Email' => $Email,
        'Year_Level' => $Year_Level,
        'Grade_Level' => $Grade_Level,
        'Type' => $Type,
        'UserID' => $UserID

    ]);
}

// Delete User
if (isset($_GET['User_Id'])) {
    $id = intval($_GET['User_Id']); // Convert to integer to prevent SQL injection

    $userController = new UserController($conn);
    $userController->deleteUser($id);

 
}
?>
