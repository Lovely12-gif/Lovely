
<?php 
    include ('../Config/layout.php');
    include '../Controller/ReturnController.php';

    ?>
  



    <div class="container">
          <div class="page-inner">

          
          <div class="row">
              <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Return Book</div>
                      
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        id="basic-datatables"
                        class="display table table-striped table-hover"
                      >
                        <thead>
                          <tr>
                            <th>Full Name</th>
                            <th>Book Title</th>
                            <th>Date Borrowed</th>
                            <th>Actions</th>
                          
                          </tr>
                        </thead>
                        <tfoot> 
                          <tr>
                            <th>Full Name</th>
                            <th>Book Title</th>
                               <th>Date Borrowed</th>
                            <th>Actions</th>
                          </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $returnController = new ReturnController($conn);
                            $returns = $returnController->getAllReturns();
                            foreach ($returns as $return) {
                                echo "<tr>";
                                echo "<td>" . $return['Fname'] . " " . $return['Lname'] . "</td>";
                                echo "<td>" . $return['Title'] . "</td>";
                                echo "<td>" . $return['Date'] . "</td>";
                                echo '<td>
                                        <a href="../Controller/ReturnController.php?Return_Id=' . $return['Return_Id'] . '" class="btn btn-danger delete-btn">Delete</a>
                                      </td>';
                                echo "</tr>";
                            }

                            ?>
                        
                          </tbody>
                        </table>
                        </div>
                 </div>
        </div>
   

    <!-- create Student Modal -->
     <!-- Bootstrap Modal -->
<<!-- Bootstrap Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New Returning</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../controller/ReturnController.php" method="POST">
                    <div class="row ">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-group">
                                <label for="User_Id">Full Name</label>
                                <select class="form-select" id="User_Id" name="User_Id" required>
                                    <option value="">Select User</option>
                                    <?php
                                    include ('../Model/connecttodb.php');
                                    $sql = "SELECT * FROM users";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "<option value='".$row["User_Id"]."'>".$row["Fname"]."".$row["Lname"]."</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No users available</option>";
                                    }
                                    $conn->close();
                                    ?>
                                </select>
                            </div>
                                <label for ="Book_Id">Book Title</label>
                                <select class="form-select" id="Book_Id" name="Book_Id" required>
                                    <option value="">Select Book</option>
                                    <?php
                                    include ('../Model/connecttodb.php');
                                    $sql = "SELECT * FROM book";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "<option value='".$row["Book_Id"]."'>".$row["Title"]."</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No books available</option>";
                                    }
                                    $conn->close();
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
<!-- end of create student modal -->
 <!-- Edit Student Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit Borrow</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../Controller/ReturnController.php" method="POST">
                    <input type="hidden" id="editReturnId" name="Return_Id">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="User_Id">Full Name</label>
                                <select class="form-select" id="User_Id" name="User_Id" required>
                                    <option value="">Select User</option>
                                    <?php
                                    include ('../Model/connecttodb.php');
                                    $sql = "SELECT * FROM users";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "<option value='".$row["User_Id"]."'>".$row["User_Id"]."</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No users available</option>";
                                    }
                                    $conn->close();
                                    ?>
                                </select>
                            </div>
                                <label for ="Book_Id">Book Title</label>
                                <select class="form-select" id="Book_Id" name="Book_Id" required>
                                    <option value="">Select Book</option>
                                    <?php
                                    include ('../Model/connecttodb.php');
                                    $sql = "SELECT * FROM book";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "<option value='".$row["Book_Id"]."'>".$row["Title"]."</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No books available</option>";
                                    }
                                    $conn->close();
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
        
        document.getElementById("editReturnId").value = button.getAttribute("data-Return_Id");
        document.getElementById("editBorrow_Id").value = button.getAttribute("data-id");
        document.getElementById("editBook_Id").value = button.getAttribute("data-Book_Id");
        document.getElementById("editUser_Id").value = button.getAttribute("data-User_Id");
        document.getElementById("editType").value = button.getAttribute("data-type");
        document.getElementById("editDate").value = button.getAttribute("data-date");
        document.getElementById("editDueDate").value = button.getAttribute("data-due_date");
    });
});

</script>
<!-- script for notif alert  -->
<script>
    // Check if there is a message in the URL
    const urlParams = new URLSearchParams(window.location.search);
    const message = urlParams.get('message');

    if (message === 'created') {
        swal({
            title: "Success!",
            text: "New return record created successfully!",
            icon: "success"
        }).then(() => {
            window.location.href = "Returnindex.php"; // Removes message from URL
        });
    } else if (message === 'error') {
        swal({
            title: "Error!",
            text: "Failed to create return record.",
            icon: "error"
        }).then(() => {
            window.location.href = "Returnindex.php";
        });
    }
    if (message === 'deleted') {
        swal({
            title: "Success!",
            text: "Return record deleted successfully!",
            icon: "success"
        }).then(() => {
            window.location.href = "Returnindex.php"; // Removes message from URL
        });
    } else if (message === 'error') {
        swal({
            title: "Error!",
            text: "Failed to delete return record.",
            icon: "error"
        }).then(() => {
            window.location.href = "Returnindex.php";
        });
    }
    if (message === 'updated') {
        swal({
            title: "Success!",
            text: "Return record updated successfully!",
            icon: "success"
        }).then(() => {
            window.location.href = "Returnindex.php"; // Removes message from URL
        });
    } else if (message === 'error') {
        swal({
            title: "Error!",
            text: "Failed to update return record.",
            icon: "error"
        }).then(() => {
            window.location.href = "Returnindex.php";
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
                title: "Are you sure you want to return?",
                text: "You won't be able to revert this!",
                icon: "warning",
                buttons: {
                    confirm: {
                        text: "Yes, return it!",
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