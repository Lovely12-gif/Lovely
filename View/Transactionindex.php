
<?php 
    include ('../Config/layout.php');
    ?>
  



    <div class="container">
          <div class="page-inner">

          
          <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Student List</h4>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">Add a new Transaction</button>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        id="basic-datatables"
                        class="display table table-striped table-hover"
                      >
                        <thead>
                          <tr>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Due_Date</th>
                            <th>Return_Date</th>
                            <th>Actions</th>
                          
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                          <th>Type/th>
                            <th>Date</th>
                            <th>Due_Date</th>
                            <th>Return_Date</th>
                            <th>Actions</th>
                          </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            include ('../Config/connecttodb.php');
                            $sql = "SELECT * FROM Transaction";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>".$row["Type"]."</td>";
                                echo "<td>".$row["Date"]."</td>";
                                echo "<td>".$row["Due_Date"]."</td>";
                                echo "<td>".$row["Return_Date"]."</td>";
                                echo "<td>";
                                echo "<a href='#' class='btn btn-link btn-primary btn-lg' data-bs-toggle='modal' data-bs-target='#editUserModal' 
                                        data-id='".$row["Transaction_Id"]."' 
                                        data-Book_Id='".$row["Book_Id"]."' 
                                        data-User_Id='".$row["User_Id"]."' 
                                        data-Type='".$row["Type"]."' 
                                        data-Date='".$row["Date"]."' 
                                        data-Due_Date='".$row["Due_Date"]."' 
                                        data-Return_Date='".$row["Return_Date"]."' 
                                        <i class='fa fa-edit'></i>
                                      </a>";
                                echo "<a href='TransactionController.php?user_id=".$row["Transaction_Id"]."' type='button' class='btn btn-link btn-danger delete-btn'>";
                                echo "<i class='fa fa-times'></i>";
                                echo "</a>";
                                echo "</td>";
                                echo "</tr>";
                                }
                            } else {
                                echo "0 results";
                            }
                            $conn->close();

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
                <h5 class="modal-title" id="addUserModalLabel">Add New Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="TransactionController.php" method="POST">
                    <div class="row ">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Type">Type</label>
                                <select class="form-control" id="Type" name="Type" required>
                                    <option value="">Select Type</option>
                                    <option value="Available">Available</option>
                                    <option value="Borrow">Borrow</option>
                                     <option value="Return">Return</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="Date">Date</label>
                                <input type="date" class="form-control" id="Date" name="Date" placeholder="Enter Date" required>
                            </div>
                            <div class="form-group">
                                <label for="Due_Date">Due_Date</label>
                                <input type="date" class="form-control" id="Due_Date" name="Due_Date" placeholder="Enter Due_Date" required>
                            </div>
                            <div class="form-group">
                                <label for="Return_Date">Return_Date</label>
                                <input type="date" class="form-control" id="Return_Date" name="Return_Date" placeholder="Enter Return_Date ">
                            </div>
                        </div>


                    </div>
                    <div class="card-action ms-auto me-auto" style="text-align: center;">
                        <button type="submit" class="btn btn-success" name="saveTransaction">Submit</button>
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
                <h5 class="modal-title" id="editUserModalLabel">Edit Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="TransactionController.php" method="POST">
                    <input type="hidden" id="editTransactionID" name="Transaction_id">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Type">Type</label>
                                <select class="form-control" id="Type" name="Type" required>
                                    <option value="">Select Type</option>
                                    <option value="Available">Available</option>
                                    <option value="Borrow">Borrow</option>
                                     <option value="Return">Return</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="Date">Date</label>
                                <input type="date" class="form-control" id="Date" name="Date" placeholder="Enter Date" required>
                            </div>
                            <div class="form-group">
                                <label for="Due_Date">Due_Date</label>
                                <input type="date" class="form-control" id="Due_Date" name="Due_Date" placeholder="Enter Due_Date" required>
                            </div>
                            <div class="form-group">
                                <label for="Return_Date">Return_Date</label>
                                <input type="date" class="form-control" id="Return_Date" name="Return_Date" placeholder="Enter Return_Date ">
                            </div>
                        </div>
                    </div>
                    <div class="card-action ms-auto me-auto" style="text-align: center;">
                        <button type="submit" class="btn btn-success" name="editTransaction">Submit</button>
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
        
        document.getElementById("editTransaction_Id").value = button.getAttribute("data-id");
        document.getElementById("editBook_Id").value = button.getAttribute("data-Book_Id");
        document.getElementById("editUser_Id").value = button.getAttribute("data-User_Id");
        document.getElementById("editType").value = button.getAttribute("data-type");
        document.getElementById("editDate").value = button.getAttribute("data-date");
        document.getElementById("editDue_Date").value = button.getAttribute("data-due_date");
        document.getElementById("editReturn_Date").value = button.getAttribute("data-return_date");
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
            text: "New transaction record created successfully!",
            icon: "success"
        }).then(() => {
            window.location.href = "Transactionindex.php"; // Removes message from URL
        });
    } else if (message === 'error') {
        swal({
            title: "Error!",
            text: "Failed to create transaction record.",
            icon: "error"
        }).then(() => {
            window.location.href = "Transactionindex.php";
        });
    }
    if (message === 'deleted') {
        swal({
            title: "Success!",
            text: "Transaction record deleted successfully!",
            icon: "success"
        }).then(() => {
            window.location.href = "Transactionindex.php"; // Removes message from URL
        });
    } else if (message === 'error') {
        swal({
            title: "Error!",
            text: "Failed to delete transaction record.",
            icon: "error"
        }).then(() => {
            window.location.href = "Transactionindex.php";
        });
    }
    if (message === 'updated') {
        swal({
            title: "Success!",
            text: "Transaction record updated successfully!",
            icon: "success"
        }).then(() => {
            window.location.href = "Transactionindex.php"; // Removes message from URL
        });
    } else if (message === 'error') {
        swal({
            title: "Error!",
            text: "Failed to update transaction record.",
            icon: "error"
        }).then(() => {
            window.location.href = "Transactionindex.php";
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