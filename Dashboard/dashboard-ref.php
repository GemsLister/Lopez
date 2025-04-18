<?php
echo 'Dashboard';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" type="image/png" href="images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="heads" style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;">D A S H B O A R D
                <img class="logo" src="images/logo.png" alt="logo"> 
            </div>
            <ul class="menu">
                <li>
                    <a href="index.html" >
                        <img style="width: 20px; height: 20px;" src="images/dashboard.png" alt="">
                        <span style="margin-left: 10px;">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="products.html" >
                        <img style="width: 20px; height: 20px;" src="images/product.png" alt="">
                        <span style="margin-left: 10px;">Products</span>
                    </a>
                </li>
                <li>
                    <a href="reports.html">
                        <img style="width: 20px; height: 20px;" src="images/graphic.png" alt="">
                        <span style="margin-left: 10px;">Reports</span>
                    </a>
                </li>
                <li>
                    <a href="accounts.html" class="active">
                        <img style="width: 20px; height: 20px;" src="images/verified-account.png" alt="">
                        <span style="margin-left: 10px;">Accounts</span>
                    </a>
                </li>
                <li>
                    <a href="settings.html">
                        <img style="width: 20px; height: 20px;" src="images/settings.png" alt="">
                        <span style="margin-left: 10px;">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img style="width: 20px; height: 20px;" src="images/logout.png" alt="">
                        <span style="margin-left: 10px;">Logout</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Topbar -->
            <div class="topbar">
                <div class="search">
                    <input type="text" placeholder="Search...">
                </div>
                <div class="user-profile" id="userProfile">
                    <span>Gil Nicholas Cagande</span>
                    <img src="images/hacker.png" alt="User">
                </div>
            </div>

           <!-- Content Area -->
           <main role="main" class="col-md-12 px-md-12" style="margin-top: 10px;">
            <div class="row">
                <!-- First Column: Add User Form -->
                <div class="col-md-3">
                    <div class="card" style="width: 100%;">
                        <div class="card-header">
                            ADD USER
                        </div>
                        <div class="card-body">
                            <form id="userInfoForm">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-id-card"></i></span>
                                    <input type="number" class="form-control" required id="stud_id" placeholder="Student ID" aria-label="Student ID" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-account"></i></span>
                                    <input type="text" class="form-control" id="fname" placeholder="First Name" aria-label="First Name" aria-describedby="basic-addon1">
                                    <input type="text" class="form-control" id="lname" placeholder="Last Name" aria-label="Last Name" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-email"></i></span>
                                    <input type="email" class="form-control" id="email" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-counter"></i></span>
                                    <input type="number" class="form-control" id="age" placeholder="Age" aria-label="Age" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-marker"></i></span>
                                    <input type="text" class="form-control" id="address" placeholder="Address" aria-label="Address" aria-describedby="basic-addon2">
                                </div>
                                <div class="input-group mb-3">
                                    <button style="width: 100%; border-radius: 5px; margin-right: 20px;" class="btn btn-primary" type="button" id="addUserBtn" onclick="addUser()"> Add User</button>
                                    <button style="width: 100%; border-radius: 5px; margin-right: 20px; display: none;" class="btn btn-primary" type="button" id="updateUserBtn" onclick="updateUser()"> Update User</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Second Column: User Table -->
                <div class="col-md-9">
                    <div style="margin-top: 20px;" id="liveAlert"></div>
                    <div class="card" style="width:100%;">
                        <div class="card-body">
                            <input type="text" style="width: 100%; margin-top: 20px; margin-bottom: 20px;" class="form-control" id="search" placeholder="Search ..." aria-label="Search" aria-describedby="basic-addon2">
                            <table id="userTable" class="table table-stripped">
                                <thead>
                                    <tr>
                                        <th scope="col">ID Number</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Age</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="userTableBody" style="font-size: 13px;">
                                    <!--- this is where the data will be added -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
        function addUser() {
            let stud_id = $("#stud_id").val();
            let fname = $("#fname").val();
            let lname = $("#lname").val();
            let email = $("#email").val();
            let age = $("#age").val();
            let address = $("#address").val();

            if (stud_id !== '' && fname !== '') {
                let newRow = $("<tr></tr>");

                newRow.append(`
                    <td>${stud_id}</td>
                    <td>${fname}</td>
                    <td>${lname}</td>
                    <td>${email}</td>
                    <td>${age}</td>
                    <td>${address}</td>
                    <td>
                        <button class="btn btn-warning"><i class="mdi mdi-pencil"></i></button>
                        <button class="btn btn-danger" type="button" value="Delete"><i class="mdi mdi-delete"></i></button>
                    </td>
                `);

                $("#userTableBody").append(newRow);
                $("#liveAlert").html('<div class="alert alert-success" role="alert">Data has been Added.</div>');
            } else {
                $("#liveAlert").html('<div class="alert alert-danger" role="alert">Please Filled In the Required Data.</div>');
            }

            $("#stud_id").val("");
            $("#fname").val("");
            $("#lname").val("");
            $("#email").val("");
            $("#age").val("");
            $("#address").val("");
        }
        

        function deleteUser() {
            var confirmation = confirm("Are you sure to delete this data?");
            if (confirmation) {
                $(this).closest("tr").remove();
                $("#liveAlert").html('<div class="alert alert-success" role="alert">Data has been deleted.</div>');
                reset();
            }
        }

        function reset(){
            $("#stud_id").val("");
            $("#fname").val("");
            $("#lname").val("");
            $("#email").val("");
            $("#age").val("");
            $("#address").val("");
        }


    function editUser() {
        let row = $(this).closest("tr");
        let stud_id = row.find("td:eq(0)").text();
        let fname = row.find("td:eq(1)").text();
        let lname = row.find("td:eq(2)").text();
        let email = row.find("td:eq(3)").text();
        let age = row.find("td:eq(4)").text();
        let address = row.find("td:eq(5)").text();

        $("#stud_id").val(stud_id).prop("readonly", true);
        $("#fname").val(fname);
        $("#lname").val(lname);
        $("#email").val(email);
        $("#age").val(age);
        $("#address").val(address);
        $("#updateUserBtn").show();
        $("#addUserBtn").hide();

        $("#updateUserBtn").show().css("width", "100%");
        $("#addUserBtn").css("display", "none");

    }

    function updateUser() {
        if (stud_id ==='' || fname==='')  {
            $("#liveAlert").html('<div class="alert alert-danger" role="alert">There is an error.</div>');
        } else {
        let stud_id = $("#stud_id").val();
        let fname = $("#fname").val();
        let lname = $("#lname").val();
        let email = $("#email").val();
        let age = $("#age").val();
        let address = $("#address").val();
        // Find the row to update based on the values in the input fields
        let row = $("#userTableBody").find(`tr:contains(${stud_id})`);

        // Update the row with new values
        row.find("td:eq(1)").text(fname);
        row.find("td:eq(2)").text(lname);
        row.find("td:eq(3)").text(email);
        row.find("td:eq(4)").text(age);
        row.find("td:eq(5)").text(address);
        // Display success message

   
        $("#liveAlert").html('<div class="alert alert-success" role="alert">Data has been updated.</div>');
         $("#updateUserBtn").hide();
        $("#addUserBtn").show();
       
        }
        
    }  

    $(document).ready(function() {
        $(document).on("click", ".btn-danger", deleteUser);
        $(document).on("click", ".btn-warning", editUser);
        $("#updateUserBtn").on("click", updateUser);

        $("#search").on("keyup", function() {
            let value = $(this).val().toLowerCase();
            $("#userTableBody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
 
    });
</script>