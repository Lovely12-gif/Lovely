
<?php 
     include ('../Config/layout.php');
    include '../Controller/UserController.php';


    $data = new UserController($conn);
   

    ?>
  



    <div class="container">
          <div class="page-inner">

          
          <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">User List</h4>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">Add a new User</button>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        id="basic-datatables"
                        class="display table table-striped table-hover"
                      >
                        <thead>
                          <tr>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>GradeLevel</th> 
                            <th>Type</th>
                            <th>Actions</th>
                          
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>GradeLevel</th>
                            <th>Type</th>
                            <th>Actions</th> 

                          </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $userList = $data->getAllUsers();
                            foreach ($userList as $user) {
                                echo "<tr>";
                                echo "<td>" . $user['Fname'] . " " . $user['Lname'] . "</td>";
                                echo "<td>" . $user['Email'] . "</td>";
                                echo "<td>" . $user['Grade_Level'] . "</td>";
                                echo "<td>" . $user['Type'] . "</td>";
                                echo '<td>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal" 
                                        data-id="' . $user['User_Id'] . '" 
                                        data-username="' . $user['Username'] . '" 
                                        data-fname="' . $user['Fname'] . '" 
                                        data-lname="' . $user['Lname'] . '" 
                                        data-password="' . $user['Password'] . '" 
                                        data-email="' . $user['Email'] . '" 
                                        data-YearLevel="' . $user['Year_Level'] . '" 
                                        data-GradeLevel="' . $user['Grade_Level'] . '" 
                                        data-Type="' . $user['Type'] . '">Edit</button>
                                        <a href="../Controller/UserController.php?User_Id=' .$user['User_Id']. '" class="btn btn-danger delete-btn">Delete</a>
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
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../Controller/UserController.php" method="POST">
                    <div class="row ">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Username">Username</label>
                                <input type="text" class="form-control" id="username" name="Username" placeholder="Enter Username" required>
                            </div>
                            <div class="form-group">
                                <label for="Password">Password</label>
                                <input type="Password" class="form-control" id="Password" name="Password" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <label for="Fname">First Name</label>
                                <input type="text" class="form-control" id="Fname" name="Fname" placeholder="Enter First name" required>
                            </div>
                            <div class="form-group">
                                <label for="Lname">Last Name</label>
                                <input type="text" class="form-control" id="Lname" name="Lname" placeholder="Enter Last name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                            </div>
                            <div class="form-group">
                                <label for="Year_Level">Year Level</label>
                                <select class="form-control" id="Year_Level" name="Year_Level" required>
                                    <option value="">Select YearLevel</option>
                                    <option value="Grade - 1">Grade - 1</option>
                                    <option value="Grade - 2">Grade - 2</option>
                                    <option value="Grade - 3">Grade - 3</option>
                                    <option value="Grade - 4">Grade - 4</option>
                                    <option value="Grade - 5">Grade - 5</option>
                                    <option value="Grade - 6">Grade - 6</option>
                                    <option value="Grade - 7">Grade - 7</option>
                                    <option value="Grade - 8">Grade - 8</option>
                                    <option value="Grade - 9">Grade - 9</option>
                                    <option value="Grade - 10">Grade - 10</option>
                                    <option value="Grade - 11">Grade - 11</option>
                                    <option value="Grade - 12">Grade - 12</option>
                                    <option value="1st Year">1st Year</option>
                                    <option value="2nd Year">2nd Year</option>
                                    <option value="3rd Year">3rd Year</option>
                                    <option value="4th Year">4th Year</option>
                                    <option value="Staff">Staff</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Grade_Level">Grade Level</label>
                                <select class="form-control" id="Grade_Level" name="Grade_Level" required>
                                    <option value="">Select GradeLevel</option>
                                    <option value="Primary">Primary</option>
                                    <option value="Secondary">Secondary</option>
                                    <option value="Senior HighSchool">Senior HighSchool</option>
                                    <option value="College">College</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Type">Type</label>
                                <select class="form-control" id="type" name="type" required>
                                    <option value="">Select Type</option>
                                    <option value="Student">Student</option>
                                    <option value="Teacher">Faculty</option>
                                    <option value="LibraryStaff">Library Staff</option>
                                </select>
                            </div>
                    
                        </div>

                    </div>
                    <div class="card-action ms-auto me-auto" style="text-align: center;">
                        <button type="submit" class="btn btn-success" name="saveUser">Submit</button>
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
                <form action="../Controller/UserController.php" method="POST">
                    <input type="hidden" id="editUserID" name="user_Id">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editUsername">Username</label>
                                <input type="text" class="form-control" id="editUsername" name="Username" required>
                            </div>
                            <div class="form-group">
                                <label for="editPassword">New Password (Leave blank to keep current)</label>
                                <input type="password" class="form-control" id="editPassword" name="Password">
                            </div>
                            <div class="form-group">
                                <label for="editFname">First Name</label>
                                <input type="text" class="form-control" id="editFname" name="Fname" required>
                            </div>
                            <div class="form-group">
                                <label for="editLname">Last Name</label>
                                <input type="text" class="form-control" id="editLname" name="Lname" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editEmail">Email</label>
                                <input type="email" class="form-control" id="editEmail" name="email" required>
                            </div>
                             <div class="form-group">
                                <label for="Year_Level">Year Level</label>
                                <select class="form-control" id="Year_Level" name="Year_Level" required>
                                    <option value="">Select YearLevel</option>
                                    <option value="Grade - 1">Grade - 1</option>
                                    <option value="Grade - 2">Grade - 2</option>
                                    <option value="Grade - 3">Grade - 3</option>
                                    <option value="Grade - 4">Grade - 4</option>
                                    <option value="Grade - 5">Grade - 5</option>
                                    <option value="Grade - 6">Grade - 6</option>
                                    <option value="Grade - 7">Grade - 7</option>
                                    <option value="Grade - 8">Grade - 8</option>
                                    <option value="Grade - 9">Grade - 9</option>
                                    <option value="Grade - 10">Grade - 10</option>
                                    <option value="Grade - 11">Grade - 11</option>
                                    <option value="Grade - 12">Grade - 12</option>
                                    <option value="1st Year">1st Year</option>
                                    <option value="2nd Year">2nd Year</option>
                                    <option value="3rd Year">3rd Year</option>
                                    <option value="4th Year">4th Year</option>
                                    <option value="Staff">Staff</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Grade_Level">Grade Level</label>
                                <select class="form-control" id="Grade_Level" name="Grade_Level" required>
                                    <option value="">Select GradeLevel</option>
                                    <option value="Primary">Primary</option>
                                    <option value="Secondary">Secondary</option>
                                    <option value="Senior HighSchool">Senior HighSchool</option>
                                    <option value="College">College</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="editType">Type</label>
                                <select class="form-control" id="editType" name="Type" required>
                                <option value="">Select Type</option>
                                    <option value="Student">Student</option>
                                    <option value="Teacher">Faculty</option>
                                    <option value="LibraryStaff">Library Staff</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-action ms-auto me-auto" style="text-align: center;">
                        <button type="submit" class="btn btn-success" name="editUser">Submit</button>
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
        
        document.getElementById("editUserID").value = button.getAttribute("data-id");
        document.getElementById("editUsername").value = button.getAttribute("data-username");
        document.getElementById("editFname").value = button.getAttribute("data-fname");
        document.getElementById("editLname").value = button.getAttribute("data-lname");
        document.getElementById("editPassword").value = button.getAttribute("data-password");
        document.getElementById("editYear_Level").value = button.getAttribute("data-YearLevel");
        document.getElementById("editGrade_Level").value = button.getAttribute("data-GradeLevel");
        document.getElementById("editEmail").value = button.getAttribute("data-email");
        document.getElementById("editType").value = button.getAttribute("data-Type");
    });
});

</script>
<!-- script for notif alert  -->
<script>
    // Check if there is a message in the URL
    

    if (message === 'created') {
        swal({
            title: "Success!",
            text: "New book record created successfully!",
            icon: "success"
        }).then(() => {
            window.location.href = "Userindex.php"; // Removes message from URL
        });
    } else if (message === 'error') {
        swal({
            title: "Error!",
            text: "Failed to create user record.",
            icon: "error"
        }).then(() => {
            window.location.href = "Userindex.php";
        });
    }
    if (message === 'deleted') {
        swal({
            title: "Success!",
            text: "Book record deleted successfully!",
            icon: "success"
        }).then(() => {
            window.location.href = "Userindex.php"; // Removes message from URL
        });
    } else if (message === 'error') {
        swal({
            title: "Error!",
            text: "Failed to delete Book record.",
            icon: "error"
        }).then(() => {
            window.location.href = "Userindex.php";
        });
    }
    if (message === 'updated') {
        swal({
            title: "Success!",
            text: "Book record updated successfully!",
            icon: "success"
        }).then(() => {
            window.location.href = "Userindex.php"; // Removes message from URL
        });
    } else if (message === 'error') {
        swal({
            title: "Error!",
            text: "Failed to update book record.",
            icon: "error"
        }).then(() => {
            window.location.href = "Userindex.php";
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