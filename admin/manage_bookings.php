<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

require_once('../includes/db.php');

if (isset($_GET['approve_id'])) {
    $booking_id = $_GET['approve_id'];

    $sql = "UPDATE bookings SET status = 'approved' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id);
    if ($stmt->execute()) {
        header("Location: manage_bookings.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}

if (isset($_GET['reject_id'])) {
    $booking_id = $_GET['reject_id'];

    $sql = "UPDATE bookings SET status = 'rejected' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id);
    if ($stmt->execute()) {
        header("Location: manage_bookings.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Manage Bookings</title>
</head>
<body>
    <?php include('../templates/header.php'); ?>
    <div class="container mt-5">
        <h2>Manage Bookings</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Book</th>
                    <th>Booking Date</th>
                    <th>Return Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT bookings.*, users.name AS user_name, books.title AS book_title FROM bookings
                                        JOIN users ON bookings.user_id = users.id
                                        JOIN books ON bookings.book_id = books.id");
                while ($booking = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $booking['user_name']; ?></td>
                    <td><?php echo $booking['book_title']; ?></td>
                    <td><?php echo $booking['booking_date']; ?></td>
                    <td><?php echo $booking['return_date']; ?></td>
                    <td><?php echo $booking['status']; ?></td>
                    <td>
                        <?php if ($booking['status'] == 'pending'): ?>
                        <a href="manage_bookings.php?approve_id=<?php echo $booking['id']; ?>" class="btn btn-success">Approve</a>
                        <a href="manage_bookings.php?reject_id=<?php echo $booking['id']; ?>" class="btn btn-danger">Reject</a>
                        <?php endif; ?>
                    </td>
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
