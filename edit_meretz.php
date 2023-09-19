<?php
// Include the Database class or use your existing database connection code
include('mysql_conn.php');
$mysql_obj = new mysql_conn();
$mysql = $mysql_obj->GetConn();

// Check if an ID parameter is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the existing data for the specified lecturer
    $sql = "SELECT * FROM `user` WHERE id = $id";
    $result = $mysql->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $mailbox = $row['mailbox'];
        $phone = $row['phone'];
    } else {
        echo "Lecturer not found.";
        exit();
    }
} else {
    echo "Invalid ID parameter.";
    exit();
}

// Check if the form is submitted for updating the lecturer
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newName = $_POST['name'];
    $newBoxNumber = $_POST['mailbox'];
    $newPhoneNumber = $_POST['phone'];

    // Update the lecturer's information in the database
    $updateData = [
        'name' => $newName,
        'mailbox' => $newBoxNumber,
        'phone' => $newPhoneNumber
    ];

    $whereClause = "id = $id";

    // Use the `update` method from your `mysql_conn` class
    if ($mysql_obj->update('user', $updateData, $whereClause)) {
        header('Location: index.php');
    } else {
        echo "Error updating lecturer.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Lecturer</title>
</head>
<body>
<h1>Edit Lecturer</h1>
<form method="post" action="">
    שם מרץ: <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>"><br>
    מספר תיבה: <input type="text" name="mailbox" value="<?php echo htmlspecialchars($mailbox); ?>"><br>
    מספר טלפון: <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>"><br>
    <input type="submit" value="ערוך משתמש">
</form>
</body>
</html>
