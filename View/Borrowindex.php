
<?php 
     include ('../Config/layout.php');
    include '../Controller/UserController.php';
    include '../Model/connecttodb.php';  // Ensure DB connection is included
    include '../Controller/BookController.php';
    include '../Controller/BorrowController.php';


 
    $userController = new UserController($conn);
    $users = $userController->getAllUsers();
   
    $bookController = new BookController($conn);
    $books = $bookController->availableBooks();

    $borrowController = new BorrowController($conn);
    $borrows = $borrowController->getAllBorrows();

    ?>
  



    <div class="container">
          <div class="page-inner">

          
          <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Borrow List</h4>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">Add a new Borrow</button>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        id="basic-datatables"
                        class="display table table-striped table-hover"
                      >
                        <thead>
                          <tr>
                            <th>Book Name</th>
                            <th>User Name</th>
                            <th>Date</th> 
                            <th>DueDate</th>
                            <th>Actions</th>
                          
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                         <th>Book Name</th>
                            <th>User Name</th>
                            <th>Date</th> 
                            <th>DueDate</th>
                            <th>Actions</th>

                          </tr>
                        </tfoot>
                        <tbody>
                             <?php
                         
                            foreach ($borrows as $user) {
                                echo "<tr>";
                                    echo "<td>" . $user['Title'] . "</td>";
                                    echo "<td>" . $user['Fname'] . " " . $user['Lname'] . "</td>";
                                    echo "<td>" . $user['Date'] . "</td>";
                                    echo "<td>" . $user['DueDate'] . "</td>";
                                    echo '<td>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal" 
                                        data-id="' . $user['User_Id'] . '" 
                                        data-username="' . $user['Username'] . '" 
                                        data-fname="' . $user['Fname'] . '" 
                                       >Edit</button>
                                        <a href="../Controller/BorrowController.php?Borrow_Id=' .$user['Borrow_Id']. '" class="btn btn-danger delete-btn">Delete</a>
                                      </td>';
                                echo "</tr>";
                            }
                            ?>
                           
                        
                          </tbody>
                        </table>
                        </div>
                 </div>
        </div>
   
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit Borrow</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../Controller/BorrowController.php" method="POST">
                    <input type="hidden" id="editBorrowID" name="Borrow_Id">

                    <div class="row">
                        
                        <div class="col-md-6">
                           
                            
                            <div class="form-group">
                                <label for="Username">Users</label>
                                <select class="form-control" id="Username" name="User_Id" required>
                                   <option value="">Select Users</option>
                                    <?php 
                                      foreach ($users as $user) {
                                         echo "<option value='" . $user['User_Id'] . "'>" . $user['Fname'] . " " . $user['Lname'] . "</option>";
                                        }
                                
                                    ?>
                                 
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editType">Book</label>
                                <select class="form-control" id="editType" name="Book_Id" required>
                                <option value="">Select Book</option>
                                    <?php 
                                      foreach ($books as $book) {
                                         echo "<option value='" . $book['Book_Id'] . "'>" . $book['Title'] . "</option>";
                                        }
                                
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-action ms-auto me-auto" style="text-align: center;">
                        <button type="submit" class="btn btn-success" name="saveBorrow">Submit</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Student Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../Controller/UserController.php" method="POST">
                    <input type="hidden" id="editUserID" name="user_Id">

                    <div class="row">
                        
                        <div class="col-md-6">
                           
                            
                           <div class="form-group">
                                <label for="User_Id">Users</label>
                                <select class="form-control" id="User_Id" name="User_Id" required>
                                   <option value="">Select Users</option>
                                    <?php 
                                      foreach ($users as $user) {
                                         echo "<option value='" . $user['User_Id'] . "'>" . $user['Fname'] . " " . $user['Lname'] . "</option>";
                                        }
                                
                                    ?>
                                 
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Book_Id">Book</label>
                                <select class="form-control" id="Book_Id" name="Book_Id" required>
                                <option value="">Select Book</option>
                                    <?php 
                                      foreach ($books as $book) {
                                         echo "<option value='" . $book['Book_Id'] . "'>" . $book['Title'] . "</option>";
                                        }
                                
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-action ms-auto me-auto" style="text-align: center;">
                        <button type="submit" class="btn btn-success" name="editBorrow">Submit</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
</div>
<!-- script for edit moda -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
    var editModal = document.getElementById("editUserModal");
    editModal.addEventListener("show.bs.modal", function (event) {
        var button = event.relatedTarget;
        
        document.getElementById("editBook_Id").value = button.getAttribute("data-id");
        document.getElementById("editUser_Id").value = button.getAttribute("data-User_Id");
        document.getElementById("editDate").value = button.getAttribute("data-Date");
        document.getElementById("editDueDate").value = button.getAttribute("data-DueDate");
       
    });
});

</script>
<!-- script for notif alert  -->
<script>
    // Check if there is a message in the URL
    

    if (message === 'created') {
        swal({
            title: "Success!",
            text: "New borrow record created successfully!",
            icon: "success"
        }).then(() => {
            window.location.href = "Borrowindex.php"; // Removes message from URL
        });
    } else if (message === 'error') {
        swal({
            title: "Error!",
            text: "Failed to create borrow record.",
            icon: "error"
        }).then(() => {
            window.location.href = "Borrowindex.php";
        });
    }
    if (message === 'deleted') {
        swal({
            title: "Success!",
            text: "Borrow record deleted successfully!",
            icon: "success"
        }).then(() => {
            window.location.href = "Borrowindex.php"; // Removes message from URL
        });
    } else if (message === 'error') {
        swal({
            title: "Error!",
            text: "Failed to delete Borrow record.",
            icon: "error"
        }).then(() => {
            window.location.href = "Borrowindex.php";
        });
    }
    if (message === 'updated') {
        swal({
            title: "Success!",
            text: "Borrow record updated successfully!",
            icon: "success"
        }).then(() => {
            window.location.href = "Borrowindex.php"; // Removes message from URL
        });
    } else if (message === 'error') {
        swal({
            title: "Error!",
            text: "Failed to update borrow record.",
            icon: "error"
        }).then(() => {
            window.location.href = "Borrowindex.php";
        });
    }

</script>
<!-- script for alert -->
<script>
    
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function (e) {
            e.preventDefault();
            let deleteUrl = this.getAttribute("href");

            swal({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                buttons: {
                    confirm: {
                        text: "Yes, delete it!",
                        className: "btn btn-success",
                    },
                    cancel: {
                        visible: true,
                        className: "btn btn-danger",
                    },
                },
            }).then((confirmDelete) => {
                if (confirmDelete) {
                    window.location.href = deleteUrl; // Redirect to delete URL
                } else {
                    swal.close();
                }
            });
        });
    });
});
</script>


<!-- script for datatable -->
<script>
      $(document).ready(function () {
        $("#basic-datatables").DataTable({});

        $("#multi-filter-select").DataTable({
          pageLength: 5,
          initComplete: function () {
            this.api()
              .columns()
              .every(function () {
                var column = this;
                var select = $(
                  '<select class="form-select"><option value=""></option></select>'
                )
                  .appendTo($(column.footer()).empty())
                  .on("change", function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                    column
                      .search(val ? "^" + val + "$" : "", true, false)
                      .draw();
                  });

                column
                  .data()
                  .unique()
                  .sort()
                  .each(function (d, j) {
                    select.append(
                      '<option value="' + d + '">' + d + "</option>"
                    );
                  });
              });
          },
        });

        // Add Row
        $("#add-row").DataTable({
          pageLength: 5,
        });

        var action =
          '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

        $("#addRowButton").click(function () {
          $("#add-row")
            .dataTable()
            .fnAddData([
              $("#addName").val(),
              $("#addPosition").val(),
              $("#addOffice").val(),
              action,
            ]);
          $("#addRowModal").modal("hide");
        });
      });
    </script>