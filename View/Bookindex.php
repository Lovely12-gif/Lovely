
<?php 
    include ('../Config/layout.php');
    include '../Controller/BookController.php';

    ?>
  



    <div class="container">
          <div class="page-inner">

          
          <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Book List</h4>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">Add a new Book</button>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        id="basic-datatables"
                        class="display table table-striped table-hover"
                      >
                        <thead>
                          <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Book_Num</th>
                            <th>Publish_Year</th>
                            <th>Status</th>
                             <th>Shelf_Num</th>
                            <th>Actions</th>
                          
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                         <th>Title</th>
                            <th>Author</th>
                            <th>Book_Num</th>
                            <th>Publish_Year</th>
                            <th>Status</th>
                             <th>Shelf_Num</th>
                            <th>Actions</th>
                          </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $bookController = new BookController($conn);
                            $bookList = $bookController->getAllBooks();
                            if ($bookList) {
                                foreach ($bookList as $book) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($book['Title']) . "</td>";
                                    echo "<td>" . htmlspecialchars($book['Author']) . "</td>";
                                    echo "<td>" . htmlspecialchars($book['Book_Num']) . "</td>";
                                    echo "<td>" . htmlspecialchars($book['Publish_Year']) . "</td>";
                                    echo "<td>" . htmlspecialchars($book['Status']) . "</td>";
                                    echo "<td>" . htmlspecialchars($book['Shelf_Num']) . "</td>";
                                    echo '<td>
                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal" 
                                            data-id="' . $book['Book_Id'] . '" 
                                            data-Title="' . $book['Title'] . '" 
                                            data-Author="' . $book['Author'] . '" 
                                            data-Book_Num="' . $book['Book_Num'] . '" 
                                            data-Publish_Year="' . $book['Publish_Year'] . '" 
                                            data-Status="' . $book['Status'] . '" 
                                            data-Shelf_Num="' . $book['Shelf_Num'] . '">Edit</button>
                                            <a href="../Controller/BookController.php?Book_Id=' . $book['Book_Id'] . '" class="btn btn-danger delete-btn">Delete</a>
                                          </td>';
                                    echo "</tr>";
                                }
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
                <h5 class="modal-title" id="addUserModalLabel">Add New Book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../controller/BookController.php" method="POST">
                    <div class="row ">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Title">Title</label>
                                <input type="text" class="form-control" id="Title" name="Title" placeholder="Enter Title" required>
                            </div>
                            <div class="form-group">
                                <label for="Author">Author</label>
                                <input type="text" class="form-control" id="Author" name="Author" placeholder="Author" required>
                            </div>
                            <div class="form-group">
                                <label for="Book_Num">Book_Num</label>
                                <input type="text" class="form-control" id="Book_Num" name="Book_Num" placeholder="Enter Book_Num" required>
                            </div>
                            </div>

                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="Publish_Year">Publish_Year</label>
                                <input type="text" class="form-control" id="Publish_Year" name="Publish_Year" placeholder="Enter Publish_Year" required>
                            </div>
                            <div class="form-group">
                                <label for="Status">Status</label>
                                <input type="text" class="form-control" id="Status" name="Status" placeholder="Enter Status" required>
                            </div>
                            <div class="form-group">
                                <label for="Shelf_Num">Shelf_Num</label>
                                <input type="text" class="form-control" id="Shelf_Num" name="Shelf_Num" placeholder="Enter Shelf_Num" required>
                            </div>
                        </div>

                    </div>
                    <div class="card-action ms-auto me-auto" style="text-align: center;">
                        <button type="submit" class="btn btn-success" name="saveBook">Submit</button>
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
                <h5 class="modal-title" id="editUserModalLabel">Edit Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form action="../Controller/BookController.php" method="POST">
                    <input type="hidden" id="editBookID" name="Book_Id">
                    <div class="row ">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Title">Title</label>
                                <input type="text" class="form-control" id="editTitle" name="Title" placeholder="Enter Title" required>
                            </div>
                            <div class="form-group">
                                <label for="Author">Author</label>
                                <input type="text" class="form-control" id="Author" name="Author" placeholder="Author" required>
                            </div>
                            <div class="form-group">
                                <label for="Book_Num">Book_Num</label>
                                <input type="text" class="form-control" id="Book_Num" name="Book_Num" placeholder="Enter Book_Num" required>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="Publish_Year">Publish_Year</label>
                                <input type="text" class="form-control" id="Publish_Year" name="Publish_Year" placeholder="Enter Publish_Year" required>
                            </div>
                            <div class="form-group">
                                <label for="Status">Status</label>
                                <input type="text" class="form-control" id="Status" name="Status" placeholder="Enter Status" required>
                            </div>
                            <div class="form-group">
                                <label for="Shelf_Num">Shelf_Num</label>
                                <input type="text" class="form-control" id="Shelf_Num" name="Shelf_Num" placeholder="Enter Shelf_Num" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-action ms-auto me-auto" style="text-align: center;">
                        <button type="submit" class="btn btn-success" name="editBook">Submit</button>
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
        
        document.getElementById("editBookID").value = button.getAttribute("data-id");
        document.getElementById("editTitle").value = button.getAttribute("data-title");
        document.getElementById("editAuthor").value = button.getAttribute("data-author");
        document.getElementById("editBook_Num").value = button.getAttribute("data-Book_Num");
        document.getElementById("editPublish_Year").value = button.getAttribute("data-Publish_Year");
        document.getElementById("editStatus").value = button.getAttribute("data-Status");
        document.getElementById("editShelf_Num").value = button.getAttribute("data-Shelf_Num");
    });
});

</script>
<!-- script for notif alert  -->
<script>

    if (message === 'created') {
        swal({
            title: "Success!",
            text: "New book record created successfully!",
            icon: "success"
        }).then(() => {
            window.location.href = "Bookindex.php"; // Removes message from URL
        });
    } else if (message === 'error') {
        swal({
            title: "Error!",
            text: "Failed to create book record.",
            icon: "error"
        }).then(() => {
            window.location.href = "Bookindex.php";
        });
    }
    if (message === 'deleted') {
        swal({
            title: "Success!",
            text: "Book record deleted successfully!",
            icon: "success"
        }).then(() => {
            window.location.href = "Bookindex.php"; // Removes message from URL
        });
    } else if (message === 'error') {
        swal({
            title: "Error!",
            text: "Failed to delete Book record.",
            icon: "error"
        }).then(() => {
            window.location.href = "Bookindex.php";
        });
    }
    if (message === 'updated') {
        swal({
            title: "Success!",
            text: "Book record updated successfully!",
            icon: "success"
        }).then(() => {
            window.location.href = "Bookindex.php"; // Removes message from URL
        });
    } else if (message === 'error') {
        swal({
            title: "Error!",
            text: "Failed to update book record.",
            icon: "error"
        }).then(() => {
            window.location.href = "Bookindex.php";
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