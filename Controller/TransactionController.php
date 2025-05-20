
<?php 
include '../Config/connecttodb.php'; 

if(isset($_POST['saveTransaction'])){
    $TransactionID = $_POST['Transaction_id'];
    $BookID = $_POST['Book_Id'];
    $UserID = $_POST['User_Id'];
    $Type = $_POST['Type'];
    $Date = $_POST['Date'];
    $Due_Date = $_POST['Due_Date'];
    $ReturnDate = $_POST['Return_Date'];

    // Use prepared statements
    $sql = "INSERT INTO Transaction (Transaction_Id, Book_Id, User_Id, Type, Date, Due_Date, Return_Date) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $Transaction_Id, $Book_Id, $User_Id, $Type, $Date, $Due_Date, $Return_Date);
    if ($stmt->execute()) {
        header("Location: Transactionindex.php?message=created");
    } else {
        echo "Error: " . $stmt->error;
    }

}
if(isset($_POST['editTransaction'])){
    $TransactionID = $_POST['transaction_id'];
    $BookID = $_POST['Book_Id'];
    $UserID = $_POST['User_Id'];
    $Type = $_POST['Type'];
    $Date = $_POST['Date'];
    $Due_Date = $_POST['Due_Date'];
    $ReturnDate = $_POST['Return_Date'];
   
    // Use prepared statements
    $sql = "UPDATE Transaction SET Book_Id=?, User_Id=?, Type=?, Date=?, Due_Date=?, Return_Date=? WHERE Transaction_Id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $BookID, $UserID, $Type, $Date, $Due_Date, $ReturnDate, $TransactionID);
    if ($stmt->execute()) {
        header("Location: Transactionindex.php?message=updated");
    } else {
        echo "Error: " . $stmt->error;
    }
}

if (isset($_GET['Transaction_Id'])) {
    $id = intval($_GET['Transaction_Id']); // Convert to integer to prevent SQL injection

    // Prepare the SQL statement
    $stmt = mysqli_prepare($conn, "DELETE FROM Transaction WHERE Transaction_Id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    if ($stmt->execute()) {
        header("Location: Transactionindex.php?message=deleted");
    } else {
        echo "Error: " . $stmt->error;
    }

}
?>