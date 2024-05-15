<html>
<head>
  <title>Schedule Appointment</title>
</head>

<body>
    <h1>Schedule Appointment</h1>

    <div class="navbar">
        <a class="active" href = "home.php"><i class="fa fa-fw fa-home"></i> Home</a>
        <a href="tech_login.php"><i class="fa fa-fw fa-envelope"></i> Employee Login</a>
        <a href="admin_login.php"><i class="fa fa-fw fa-envelope"></i> Admin Login</a>
        <a href="cancel_appointment.php"><i class="fa fa-fw fa-envelope"></i> Cancel Visit</a>
    </div>

    <?php
    if (isset($_POST["schedule"])) {
        $firstName = $_POST["firstname"];
        $lastName = $_POST["lastname"];
        $email = $_POST["email"];
        $phoneNumber = $_POST["phone"];
        $street = $_POST["street"];
        $city = $_POST["city"];
        $state = $_POST["state"];
        $houseSize = $_POST["housesize"];
        $date = $_POST["date"];
        $time = $_POST["time"];
        $urgency = $_POST["urgency"];
        
        if ($houseSize == 'Small') {
            $price = '$1000.00';
        }
        elseif ($houseSize == 'Medium') {
            $price = '$4000.00';
        }
        elseif ($houseSize == 'Large') {
            $price = '$10000.00';
        }
        elseif ($houseSize == 'Mansion') {
            $price = '$50000.00';
        }

       

        $con = new mysqli("localhost", "root", "", "hvac_website", 3307);
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        
        $sql = "SELECT * FROM appointment
                WHERE Date = '$date'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            echo "Date conflict! Please select a new day.";
        }
        else {
            $sql = "SELECT * FROM appointment
                WHERE Time = '$time'";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                echo "Time conflict! Please select a new time.";
            }
            else {
                $sql = "INSERT INTO customer (CustomerID, FirstName, LastName, HouseSize, Phone, Street, City, USState, Email) 
                    VALUES (DEFAULT, '$firstName', '$lastName', '$houseSize', '$phoneNumber', '$street', '$city', '$state', '$email')";
                $con->query($sql);
                $sql = "INSERT INTO appointment VALUES (DEFAULT, '$date', '$time', '$price', '$urgency', '$email', '1', '1')";
                if ($con->query($sql)===TRUE) {
                    echo "Appointment scheduled for " . $firstName . " " . $lastName . " at " . $time . " " . $date . " for " . $price . ".";
                }
                else {
                    echo "Error: " . $sql . "<br>" . $con->error;
                }
            }   
        }
        
    
    }
    ?>

    <form action="make_appointment.php" method="post">
        <div class="form_group">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" name="firstname" placeholder="First Name">
        </div>
        <div class="form_group">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" name="lastname" placeholder="Last Name">
        </div>
        <div class="form_group">
            <label for="email">E-mail Address</label>
            <input type="text" class="form-control" name="email" placeholder="E-mail">
        </div>
        <div class="form_group">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control" name="phone" placeholder="Phone #">
        </div>
        <div class="form_group">
            <label for="street">Street</label>
            <input type="text" class="form-control" name="street" placeholder="Street Address">
        </div>
        <div class="form_group">
            <label for="city">City</label>
            <input type="text" class="form-control" name="city" placeholder="City">
        </div>
        <div class="form_group">
            <label for="state">State</label>
            <select name="state" id="state">
                <option value="AL">Alabama</option>
                <option value="AK">Alaska</option>
                <option value="AZ">Arizona</option>
                <option value="AR">Arkansas</option>
                <option value="CA">California</option>
                <option value="CO">Colorado</option>
                <option value="CT">Connecticut</option>
                <option value="DE">Delaware</option>
                <option value="DC">District Of Columbia</option>
                <option value="FL">Florida</option>
                <option value="GA">Georgia</option>
                <option value="HI">Hawaii</option>
                <option value="ID">Idaho</option>
                <option value="IL">Illinois</option>
                <option value="IN">Indiana</option>
                <option value="IA">Iowa</option>
                <option value="KS">Kansas</option>
                <option value="KY">Kentucky</option>
                <option value="LA">Louisiana</option>
                <option value="ME">Maine</option>
                <option value="MD">Maryland</option>
                <option value="MA">Massachusetts</option>
                <option value="MI">Michigan</option>
                <option value="MN">Minnesota</option>
                <option value="MS">Mississippi</option>
                <option value="MO">Missouri</option>
                <option value="MT">Montana</option>
                <option value="NE">Nebraska</option>
                <option value="NV">Nevada</option>
                <option value="NH">New Hampshire</option>
                <option value="NJ">New Jersey</option>
                <option value="NM">New Mexico</option>
                <option value="NY">New York</option>
                <option value="NC">North Carolina</option>
                <option value="ND">North Dakota</option>
                <option value="OH">Ohio</option>
                <option value="OK">Oklahoma</option>
                <option value="OR">Oregon</option>
                <option value="PA">Pennsylvania</option>
                <option value="RI">Rhode Island</option>
                <option value="SC">South Carolina</option>
                <option value="SD">South Dakota</option>
                <option value="TN">Tennessee</option>
                <option value="TX">Texas</option>
                <option value="UT">Utah</option>
                <option value="VT">Vermont</option>
                <option value="VA">Virginia</option>
                <option value="WA">Washington</option>
                <option value="WV">West Virginia</option>
                <option value="WI">Wisconsin</option>
                <option value="WY">Wyoming</option>
            </select>
        </div>
        <div class="form_group">
            <label for="size">House Size</label>
            <select name="housesize" id="housesize">
                <option value="Small">Small House</option>
                <option value="Medium">Medium House</option>
                <option value="Large">Large House</option>
                <option value="Mansion">Mansion</option>
            </select>
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
        <div class="form_group">
            <label for="urgency">Urgency</label>
            <select name="urgency" id="urgency">
                <option value="Normal">Normal</option>
                <option value="Emergency">Emergency</option>
            </select>
        </div>
        <div class="form-btn">
            <input type="submit" class="btn btn-primary" value="Schedule" name="schedule">
        </div>

</body>
</html>