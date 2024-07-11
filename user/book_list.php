
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Book List</title>
</head>
<body>
<?php include('../templates/logged_header.php'); ?>
    <div class="container mt-5">
        <h2 class="text-center">Book List</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Availability</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch books from database
                require_once('../includes/db.php');
                //require_once('../includes/functions.php');
                //require_once('../includes/auth.php');
                session_start();
                if (!isset($_SESSION['user_id'])) {
                    header("Location: ../login.php");
                    exit();
                }
                $result = $conn->query("SELECT * FROM books");
                while ($book = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $book['title']; ?></td>
                    <td><?php echo $book['author']; ?></td>
                    <td><?php echo $book['isbn']; ?></td>
                    <td><?php echo $book['available'] ? 'Yes' : 'No'; ?></td>
                    <td><a href="book_details.php?id=<?php echo $book['id']; ?>" class="btn btn-primary">View</a></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php include('../templates/footer.php'); ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
