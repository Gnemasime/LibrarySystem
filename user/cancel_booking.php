<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once('../includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_cancel'])) {
    $booking_id = $_POST['booking_id'];
    $user_id = $_SESSION['user_id'];

    // Verify if the booking belongs to the logged-in user
    $sql = "SELECT * FROM bookings WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $booking_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Booking found, proceed with cancellation
        $sql_delete = "DELETE FROM bookings WHERE id = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $booking_id);

        if ($stmt_delete->execute()) {
            $_SESSION['success_message'] = "Booking canceled successfully.";
        } else {
            $_SESSION['error_message'] = "Error canceling booking: " . $stmt_delete->error;
        }
    } else {
        $_SESSION['error_message'] = "Booking not found or you do not have permission to cancel.";
    }
    header("Location: booking_history.php");
    exit();
} elseif (isset($_GET['id'])) {
    $booking_id = $_GET['id'];

    // Fetch booking details for confirmation
    $sql = "SELECT * FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $booking = $result->fetch_assoc();
    } else {
        $_SESSION['error_message'] = "Booking not found.";
        header("Location: booking_history.php");
        exit();
    }
} else {
    $_SESSION['error_message'] = "Booking ID not specified.";
    header("Location: booking_history.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Cancel Booking</title>
</head>
<body>
    <?php include('../templates/header.php'); ?>
    
    <div class="container mt-5">
        <h2>Cancel Booking</h2>
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error_message']; ?></div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $booking['title']; ?></h5>
                <p class="card-text">Author: <?php echo $booking['author']; ?></p>
                <p class="card-text">ISBN: <?php echo $booking['isbn']; ?></p>
                <p class="card-text">Booking Date: <?php echo $booking['booking_date']; ?></p>
                <form action="cancel_booking.php" method="post">
                    <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                    <p>Are you sure you want to cancel this booking?</p>
                    <button type="submit" name="confirm_cancel" class="btn btn-danger">Confirm Cancel</button>
                    <a href="booking_history.php" class="btn btn-secondary">Back to Booking History</a>
                </form>
            </div>
        </div>
    </div>
    
    <?php include('../templates/footer.php'); ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
