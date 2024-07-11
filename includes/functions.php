<?php
function is_logged_in() {
    return isset($_SESSION['id']);
}

function is_admin() {
    return is_logged_in() && $_SESSION['role'] == 'admin';
}

function get_user_name($conn, $id) {
    $sql = "SELECT name FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row['name'];
    }
    return null;
}

function get_book_title($conn, $book_id) {
    $sql = "SELECT title FROM books WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return $row['title'];
    }
    return null;
}
?>
