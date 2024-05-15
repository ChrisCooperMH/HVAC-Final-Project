<html>
<head>
  <title>Enter Appointment E-mail, Date, and Time to Cancel</title>
</head>

<body>
    <h1>Enter Appointment E-mail, Date, and Time to Cancel</h1>

    <div class="navbar">
        <a class="active" href = "home.php"><i class="fa fa-fw fa-home"></i> Home</a>
        <a href="tech_login.php"><i class="fa fa-fw fa-envelope"></i> Employee Login</a>
        <a href="admin_login.php"><i class="fa fa-fw fa-envelope"></i> Admin Login</a>
        <a href="make_appointment.php"><i class="fa fa-fw fa-envelope"></i> Schedule Visit</a>
    </div>

    <?php
    if (isset($_POST["cancel"])) {
        $email = $_POST["email"];
        $date = $_POST["date"];
        $time = $_POST["time"];

        $con = new mysqli("localhost", "root", "", "hvac_website", 3307);
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        
        $sql = "SELECT * FROM appointment
                WHERE CustomerEmail = '$email' AND Date = '$date' AND Time = '$time'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            $sql = "DELETE FROM appointment
                WHERE CustomerEmail = '$email' AND Date = '$date' AND Time = '$time'";
            $result = $con->query($sql);
            $sql = "DELETE FROM customer
                WHERE Email = '$email'";
            $result = $con->query($sql);
            echo "Appointment canceled. Thanks for using our service!";
        }
        else {
            echo "There was no such appointment in our records.";  
        }
        
    
    }
    ?>

    <form action="cancel_appointment.php" method="post">
        <div class="form_group">
            <label for="email">E-mail Address</label>
            <input type="text" class="form-control" name="email" placeholder="E-mail">
        </div>
        <div class="form_group">
            <label for="date">Date</label>
            <select name="date" id="date">
                <option value="monday">Monday</option>
                <option value="tuesday">Tuesday</option>
                <option value="wednesday">Wednesday</option>
                <option value="thursday">Thursday</option>
                <option value="friday">Friday</option>
            </select>
        </div>
        <div class="form_group">
            <label for="time">Time</label>
            <select name="time" id="time">
                <option value="10:00">10:00 AM</option>
                <option value="11:00">11:00 AM</option>
                <option value="12:00">12:00 PM</option>
                <option value="2:00">2:00 PM</option>
                <option value="3:00">3:00 PM</option>
                <option value="4:00">4:00 PM</option>
            </select>
        </div>
        <div class="form-btn">
            <input type="submit" class="btn btn-primary" value="Cancel" name="cancel">
        </div>

</body>
</html>