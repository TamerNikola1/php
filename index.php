<!DOCTYPE html>
<html>
<head>
    <title>ניהול תיבות דואר</title>
</head>
<body>
<?php


// בדיקת אימות
if(!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] ==! true) {
    // הצגת תוכן ניהול המרצים
    include('page1.php');
} else {
    // טופס הכניסה למנהל
    include('login.php');
}
?>
</body>
</html>
