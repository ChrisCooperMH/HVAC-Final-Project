<html>
<head>
  <title>Welcome, Admin</title>
</head>

<body>
    <h1>Welcome, Admin</h1>

    <div class="navbar">
        <a class="active" href = "home.php"><i class="fa fa-fw fa-home"></i> Home</a>
    </div>

    <h1>Add Technician</h1>
    <?php
    if (isset($_POST["add"])) {
        $firstName = $_POST["firstname"];
        $lastName = $_POST["lastname"];
        $username = $_POST["username"];
        $password = $_POST["password"];

        $con = new mysqli("localhost", "root", "", "hvac_website", 3307);
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        
        $sql = "SELECT * FROM technician
                WHERE Username = '$username' AND Password = '$password'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            echo "Technician with same user/password already exists.";
        }
        else {
            $sql = "INSERT INTO technician VALUES (DEFAULT, '$firstName', '$lastName', '$username', '$password', '1')";
            $result = $con->query($sql);
            echo "Technician successfully added.";
        }
    }
    ?>

    <form action="admin_console.php" method="post">
        <div class="form_group">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" name="firstname" placeholder="First Name">
        </div>
        <div class="form_group">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" name="lastname" placeholder="Last Name">
        </div>
        <div class="form_group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" placeholder="Username">
        </div>
        <div class="form_group">
            <label for="password">Password</label>
            <input type="text" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="form-btn">
            <input type="submit" class="btn btn-primary" value="Add" name="add">
        </div>

        <h1>Remove Technician</h1>
    <?php
    if (isset($_POST["remove"])) {
        $remove_username = $_POST["remove_username"];

        $con = new mysqli("localhost", "root", "", "hvac_website", 3307);
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        
        $sql = "SELECT * FROM technician
                WHERE Username = '$remove_username'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            $sql = "DELETE FROM technician
                WHERE Username = '$remove_username'";
            $result = $con->query($sql);
            echo "Technician successfully removed.";
        }
        else {
            echo "No technician with that username exists.";
        }
    }
    ?>

    <form action="admin_console.php" method="post">
        <div class="form_group">
            <label for="remove_username">Username</label>
            <input type="text" class="form-control" name="remove_username" placeholder="Username">
        </div>
        <div class="form-btn">
            <input type="submit" class="btn btn-primary" value="Remove" name="remove">
        </div>

        <h1>Assign Technician to Appointment</h1>
    <?php
    if (isset($_POST["assign"])) {
        $email = $_POST["email"];
        $technician = $_POST["technician"];

        $con = new mysqli("localhost", "root", "", "hvac_website", 3307);
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        
        $sql = "SELECT TechnicianID FROM technician WHERE Username = '$technician'";
        $id_result = $con->query($sql);
        foreach($id_result as $rows) {
            $id = $rows['TechnicianID'];
        }

        $sql = "UPDATE appointment
                SET TechnicianID = '$id'
                WHERE CustomerEmail = '$email'";
        if ($con->query($sql)===TRUE) {
            echo "Technician assigned successfully to customer";
        }
        else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
        
    
    }
    ?>

    <form action="admin_console.php" method="post">
        <div class="form_group">
        <label for="email">Customer</label>
        <select name="email" id='email'>
            <?php
            $con = new mysqli("localhost", "root", "", "hvac_website", 3307);
            if ($con->connect_error) {
                die("Connection failed: " . $con->connect_error);
            }
            
            $sql = "SELECT * FROM appointment";
            $app_result = $con->query($sql);
            foreach($app_result as $rows) {
                echo "<option value='" . $rows['CustomerEmail'] . "'>" . $rows['CustomerEmail'] . "</option>";
            }
            ?>
        </select>
        </div>
        <div class="form_group">
        <label for="technician">Employee</label>
        <select name="technician" id='technician'>
            <?php
            $con = new mysqli("localhost", "root", "", "hvac_website", 3307);
            if ($con->connect_error) {
                die("Connection failed: " . $con->connect_error);
            }

            $sql = "SELECT * FROM technician";
            $tech_result = $con->query($sql);
            foreach($tech_result as $rows) {
                echo "<option value='" . $rows['Username'] . "'>" . $rows['Username'] . "</option>";
            }
            ?>
        </select>
        </div>
        <div class="form-btn">
            <input type="submit" class="btn btn-primary" value="Assign" name="assign">
        </div>

</body>
</html>