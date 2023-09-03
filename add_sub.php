<?php
include "database.php";
session_start();

// Check if the user is authenticated
if (!isset($_SESSION["AID"])) {
    echo "<script>window.open('index.php?mes=Access Denied...', '_self');</script>";
    exit; // Add an exit to stop executing the rest of the code
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>School Management System</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <?php include "navbar.php"; ?><br>
    <img src="img/1.jpg" style="margin-left:90px;" class="sha">

    <div id="section">
        <?php include "sidebar.php"; ?><br><br><br>
        <h3 class="text">Welcome <?php echo htmlspecialchars($_SESSION["ANAME"]); ?></h3><br><hr><br>
        <div class="content1">

            <h3> Add Subject Details</h3><br>
            <?php
            if (isset($_POST["submit"])) {
                $sname = htmlspecialchars($_POST["sname"]); // Sanitize user input
                $sql = "INSERT INTO sub (SNAME) VALUES ('$sname')";
                if ($db->query($sql)) {
                    echo "<div class='success'>Insert Success..</div>";
                } else {
                    echo "<div class='error'>Insert Failed..</div>";
                }
            }
            ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label>Subject Name</label><br>
                <input type="text" name="sname" required class="input">
                <button type="submit" class="btn" name="submit">Add Subject Details</button>
            </form>
        </div>

        <div class="tbox">
            <h3 style="margin-top:30px;"> Subject Details</h3><br>
            <?php
            if (isset($_GET["mes"])) {
                echo "<div class='error'>" . htmlspecialchars($_GET["mes"]) . "</div>";
            }
            ?>
            <table border="1px">
                <tr>
                    <th>S.No</th>
                    <th>Subject Name</th>
                    <th>Delete</th>
                </tr>
                <?php
                $sql = "SELECT * FROM sub";
                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                    $i = 0;
                    while ($row = $result->fetch_assoc()) {
                        $i++;
                        echo "
                            <tr>
                            <td>{$i}</td>
                            <td>{$row["SNAME"]}</td>
                            <td><a href='sub_delete.php?id={$row["SID"]}' class='btnr'>Delete</a></td>
                            </tr>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='3'>No Record Found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>

    <?php include "footer.php"; ?>
</body>

</html>
