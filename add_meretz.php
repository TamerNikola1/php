<?php
include "mysql_conn.php";
$mysql_obj = new mysql_conn();
$mysql = $mysql_obj->GetConn();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate user inputs
    $name = htmlspecialchars($_POST['name']);
    $mailbox = htmlspecialchars($_POST['mailbox']);
    $phone = htmlspecialchars($_POST['phone']);

    // Implement CSRF protection
    session_start();
    if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
        // CSRF token is valid

        // Implement SQL injection prevention using prepared statements
        $stmt = $mysql->prepare("INSERT INTO `user` (name, mailbox, phone) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $mailbox, $phone);

        if ($stmt->execute()) {
            header('Location: index.php');
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "CSRF token validation failed. This could be a security threat.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add User</title>
</head>
<body>
<form action="" method="post">
    <!-- Add CSRF token to the form -->
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    שם מרץ: <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>"><br>
    מספר תיבה: <input type="text" name="mailbox" value="<?php echo htmlspecialchars($mailbox); ?>"><br>
    מספר טלפון: <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>"><br>

    <input type="submit" value="הוסף משתמש">
</form>
</body>
</html>
