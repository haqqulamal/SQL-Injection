<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "sql_injection_demo");

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perbaikan dengan Prepared Statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Login Successful!";
    } else {
        echo "Invalid Login";
    }
}
?>

<!-- Form login -->
<form method="post" action="login.php">
    Username: <input type="text" name="username">
    Password: <input type="password" name="password">
    <input type="submit" value="Login">
</form>
