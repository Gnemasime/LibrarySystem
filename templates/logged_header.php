<!-- templates/header.php -->
<?php/*
session_start();


// Check if user is logged in
$is_logged_in = isset($_SESSION['user_id']);
$name = $is_logged_in ? $_SESSION['name'] : '';*/
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Library System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
        <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item">
                <a class="nav-link" href="./login.php">Logged in as <?php echo $_SESSION['name']; ?> </a>
            </li>
                <li class="nav-item">
                    <a class="nav-link" href="../user/booking_history.php">Booking History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
