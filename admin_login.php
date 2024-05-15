<html>
<head>
  <title>Admin Login</title>
</head>

<body>
    <h1>Admin Login</h1>

    <div class="navbar">
        <a class="active" href = "home.php"><i class="fa fa-fw fa-home"></i> Home</a>
        <a href="tech_login.php"><i class="fa fa-fw fa-envelope"></i> Employee Login</a>
        <a href="make_appointment.php"><i class="fa fa-fw fa-envelope"></i> Schedule Visit</a>
        <a href="cancel_appointment.php"><i class="fa fa-fw fa-envelope"></i> Cancel Visit</a>
    </div>

    <?php
    if (isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $con = new mysqli("localhost", "root", "", "hvac_website", 3307);
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        
        $sql = "SELECT * FROM admin
                WHERE Username = '$username' AND Password = '$password'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            echo "Login successful.";
            echo "<script> location.href='admin_console.php'; </script>";
        }
        else {
            echo "Login unsuccessful. Please enter a new username/password.";
        }
        
    
    }
    ?>

    <form action="admin_login.php" method="post">
        <div class="form_group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" placeholder="Username">
        </div>
        <div class="form_group">
            <label for="password">Password</label>
            <input type="text" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="form-btn">
            <input type="submit" class="btn btn-primary" value="Login" name="login">
        </div>

</body>
</html>