<html>
<head>
  <title>Welcome, Technician</title>
</head>

<body>
    <h1>Welcome, Technician</h1>

    <div class="navbar">
        <a class="active" href = "home.php"><i class="fa fa-fw fa-home"></i> Home</a>
    </div>

    <h1>Mark Appointment as Complete</h1>

    <?php
    if (isset($_POST["complete"])) {
        $email = $_POST["email"];
        
        $con = new mysqli("localhost", "root", "", "hvac_website", 3307);
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        

        $sql = "DELETE FROM appointment
                WHERE CustomerEmail = '$email'";
        if ($con->query($sql)===TRUE) {
            $sql = "DELETE FROM customer
            WHERE Email = '$email'";
            $con->query($sql);
            echo "Assignment successfully completed.";
        }
        else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
        
    
    }
    ?>

    <form action="tech_console.php" method="post">
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
        </div>
        <div class="form-btn">
            <input type="submit" class="btn btn-primary" value="Complete" name="complete">
        </div>

</body>
</html>