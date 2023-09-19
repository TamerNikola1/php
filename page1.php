<h1>ניהול מרצים</h1>
<!-- טופס להוספת מרץ חדש -->
<form method="post" action="add_meretz.php">
    שם מרץ: <input type="text" name="name"><br>
    מספר תיבה: <input type="text" name="mailbox"><br>
    מספר טלפון: <input type="text" name="phone"><br>
    <input type="submit" value="הוסף מרץ">
</form>

<!-- הצגת רשימת המרצים ואפשרות לעריכה ומחיקה -->
<table border="1">
    <tr>
        <th>שם מרץ</th>
        <th>מספר תיבה</th>
        <th>מספר טלפון</th>
        <th>עריכה</th>
        <th>מחיקה</th>
    </tr>
    <?php
    // חיבור לבסיס הנתונים
    $conn = new mysqli('localhost', 'root', '', 'profsion');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // שאילתת SQL לקבלת רשימת המרצים
    $sql = "SELECT * FROM `user`";
    $result = $conn->query($sql);

    // הצגת המרצים בטבלה
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["mailbox"] . "</td>";
            echo "<td>" . $row["phone"] . "</td>";
            echo "<td><a href='edit_meretz.php?id=" . $row["id"] . "'>ערוך</a></td>";
            echo "<td><a href='delete_meretz.php?id=" . $row["id"] . "'>מחק</a></td>";
            echo "</tr>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
</table>