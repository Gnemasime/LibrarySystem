<?php
session_start();
require_once('includes/db.php');
require_once('includes/functions.php');
require_once('includes/auth.php');

$books = $conn->query("SELECT * FROM books");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Library Booking System</title>
    <style>
        .carousel-item {
            height: 80vh;
            background-size: cover;
            background-position: center center;
        }
        .carousel-caption {
            bottom: 20%;
        }
    </style>
</head>
<body>
    <?php include('templates/header.php'); ?>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active" style="background-image: url('./assets/images/pexels-luri-2761017.jpg');">
                <div class="carousel-caption d-none d-md-block">
                    <h2>Welcome to Our Library</h2>
                    <p>Explore a wide range of books.</p>
                    <a href="#book-section" class="btn btn-warning">Borrow Books</a>
                </div>
            </div>
            <div class="carousel-item" style="background-image: url('./assets/images/pexels-polina-zimmerman-3747507.jpg');">
                <div class="carousel-caption d-none d-md-block">
                    <h2>Find Your Next Read</h2>
                    <p>Discover new and exciting books.</p>
                    <a href="#book-section" class="btn btn-warning">Borrow Books</a>
                </div>
            </div>
            <div class="carousel-item" style="background-image: url('./assets/images/pexels-yankrukov-8199562.jpg');">
                <div class="carousel-caption d-none d-md-block">
                    <h2>Join Our Community</h2>
                    <p>Connect with fellow book lovers.</p>
                    <a href="#book-section" class="btn btn-warning">Borrow Books</a>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

   <div class="container mt-5" id="book-section">
        <h1 class="text-center">Available Books</h1>
        
        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="alert alert-success" role="alert">
                Welcome, <?php echo $_SESSION['name']; ?>!
            </div>
        <?php endif; ?>
        
        <div class="row">
            <?php while ($book = $books->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $book['title']; ?></h5>
                            <p class="card-text">Author: <?php echo $book['author']; ?></p>
                            <p class="card-text">ISBN: <?php echo $book['isbn']; ?></p>
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <a href="book.php?id=<?php echo $book['id']; ?>" class="btn btn-primary">Book Now</a>
                            <?php else: ?>
                                <a href="login.php" class="btn btn-primary">Login to Book</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <?php include('templates/footer.php'); ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
