<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

require_once('../includes/db.php');


    include("../includes/functions.php");
    //$user_data = get_user_name($conn, $id) ; 
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <?php include('../templates/header.php'); ?>
    <div class="container mt-5">
        <h2> Admin Dashboard</h2> <br>
        <div class="row">
            <div class="col-md-4">
                <div class="card badge-dark">
                    <div class="card-body">
                        <h4 class="card-title"  style="text-align:center;"><a href="manage_books.php" >Manage Books</a></h4>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card badge-dark">
                    <div class="card-body ">
                        
                        <h4 class="card-title " style="text-align:center;"> <a href="manage_users.php" >Manage Users</a></h4>
                     
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body badge-dark">
                        <h4 class="card-title" style="text-align:center;"><a href="manage_bookings.php" >Manage Bookings</a></h4>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <br>

    <?php include('../templates/footer.php'); ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
