<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require_once('../includes/db.php');

$book_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_date = $_POST['booking_date'];

    $sql = "INSERT INTO bookings (user_id, book_id, booking_date) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $user_id, $book_id, $booking_date);
    if ($stmt->execute()) {
        echo "Booking successful";
    } else {
        echo "Error: " . $stmt->error;
    }
}

$sql = "SELECT * FROM books WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Book Details</title>
</head>
<body>
    <?php include('../templates/header.php'); ?>
    <div class="container mt-5">
        <h2><?php echo $book['title']; ?></h2>
        <p>Author: <?php echo $book['author']; ?></p>
        <p>ISBN: <?php echo $book['isbn']; ?></p>
        <p>Availability: <?php echo $book['available'] ? 'Yes' : 'No'; ?></p>

        <form action="" method="post">
            <div class="form-group">
                <label for="booking_date">Booking Date:</label>
                <input type="date" name="booking_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Book</button>
        </form>
    </div>
    <?php include('../templates/footer.php'); ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
