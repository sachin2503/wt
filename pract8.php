<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Now</title>
    <script language="javascript">
        function validate() {
            const uname = document.login.uname.value;
            const pwd = document.login.pwd.value;

            if (uname === "") {
                alert("Please enter username.");
                document.login.uname.focus();
                return false;
            }
            if (pwd === "") {
                alert("Please enter password.");
                document.login.pwd.focus();
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <h3>Login</h3>
    <form name="login" method="POST" action="" onsubmit="return validate();">
        <table>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="uname"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="pwd"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="login" value="Login"></td>
            </tr>
        </table>
    </form>

    <?php
    // Database connection
    $conn = new mysqli("localhost", "Sachin", "Sachin#2503", "newdb");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle form submission
    if (isset($_POST['login'])) {
        $user = $_POST['uname'];
        $pass = $_POST['pwd'];

        // Prepare the SQL statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE uname = ? AND pwd = ?");
        $stmt->bind_param("ss", $user, $pass);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if any row matches
        if ($result->num_rows > 0) {
            echo "<script> location.href = 'pract8_loginsuccess.php';</script>";
        } else {
            echo "<p style='color:red;'>Wrong Credentials</p>";
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
