<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Travel Form</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Sriracha&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to Amity University US Trip form</h1>
        <p>Enter your details and submit this form to confirm your participation in the trip.</p>
        
        <!-- PHP will inject a message here if the form is successfully submitted -->
        <?php
        $insert = false;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Set connection variables
            $server = "localhost";
            $username = "root";
            $password = "";

            // Create a database connection
            $con = mysqli_connect($server, $username, $password);

            // Check for connection success
            if (!$con) {
                die("connection to this database failed due to " . mysqli_connect_error());
            }

            // Collect post variables
            $name = $_POST['name'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $desc = $_POST['desc'];

            // SQL query to insert data
            $sql = "INSERT INTO `trip`.`trip` (`name`, `age`, `gender`, `email`, `phone`, `other`, `date`) 
                    VALUES ('$name', '$age', '$gender', '$email', '$phone', '$desc', current_timestamp());";

            // Execute the query
            if ($con->query($sql) === true) {
                $insert = true; // Flag for successful insertion
            } else {
                echo "ERROR: $sql <br> $con->error";
            }

            // Close the database connection
            $con->close();
        }
        ?>

        <!-- Display a message if the form was successfully submitted -->
        <?php if ($insert): ?>
            <p id="submitMsg" class="submitMsg">Thanks for submitting your form. We are happy to see you joining us for the US trip!</p>
        <?php endif; ?>
        
        <form action="http://localhost/Travel-web-php/" method="post">
            <input type="text" name="name" id="name" placeholder="Enter your name" required>
            <input type="text" name="age" id="age" placeholder="Enter your Age" required>
            <input type="text" name="gender" id="gender" placeholder="Enter your gender" required>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>
            <input type="tel" name="phone" id="phone" placeholder="Enter your phone" required>
            <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Enter any other information here"></textarea>
            <button class="btn">Submit</button> 
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>
