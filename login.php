<?php
session_start();
include "mysql_conn.php";
$mysql_obj = new mysql_conn();
$mysql = $mysql_obj->GetConn();

$gss = isset($_SESSION['gss']) ? $_SESSION['gss'] : 0;

// Generate a CSRF token and store it in the session
if (!isset($_SESSION['csrf_token']) || (time() - $_SESSION['csrf_token_time']) > 3600) {
    $_SESSION['csrf_token'] = uniqid("",true); // Generate a new random token
    $_SESSION['csrf_token_time'] = time(); // Store the token generation time
}

// Check if the form is submitted
if (isset($_POST['btnPressed'])) {
    // Validate CSRF token
    if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
        $pass = isset($_POST['pass']) ? htmlspecialchars($_POST['pass']) : "";

        if (($gss < 4) && ($pass === 'AAA')) { // Check if the password is "AAA"
            $_SESSION['ValidUser'] = true;
            header("location: page1.php");
            exit;
        } else {
            echo "Try again";
            $gss++;
        }
    } else {
        echo "CSRF token validation failed. This could be a security threat.";
    }
}

$_SESSION['gss'] = $gss;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
<form action="" method="post">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <input type="text" name="pass" placeholder="Password" />
    <br>
    <button name="btnPressed" value="1">Send</button>
</form>

</body>
</html>
