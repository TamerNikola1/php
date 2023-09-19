<?php
// Include the Database class or use your existing database connection code
include('mysql_conn.php');
$mysql_obj = new mysql_conn();
$mysql = $mysql_obj->GetConn();

// Check if an ID parameter is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Construct the DELETE SQL query
    $sql = "DELETE FROM `user` WHERE id = $id";

    // Execute the DELETE query
    if ($mysql->query($sql) === TRUE) {
        header('Location: index.php');
    } else {
        echo "Error deleting lecturer: " . $mysql->error;
    }
} else {
    echo "Invalid ID parameter.";
    exit();
}
?>
