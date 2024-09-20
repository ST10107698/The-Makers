<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create bookings table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS bookings (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    booking_date DATE NOT NULL,
    restringing VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    bat_knocking VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql) !== TRUE) {
    die("Error creating table: " . $conn->error);
}

// Retrieve and validate form data
if (isset($_POST['booking_date'], $_POST['restringing'], $_POST['bat_knocking'])) {
    $booking_date = $_POST['booking_date'];
    $restringing = $_POST['restringing'];
    $bat_knocking = $_POST['bat_knocking'];

    if (empty($booking_date) || empty($restringing) || empty($bat_knocking)) {
        $confirmation_message = "Please fill out all fields.";
    } else {
        // Prepare and execute the SQL query
        $sql = "INSERT INTO bookings (booking_date, restringing, bat_knocking) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sss", $booking_date, $restringing, $bat_knocking);
            if ($stmt->execute()) {
                // Create confirmation message with details
                $confirmation_message = "Booking successful!<br>";
                $confirmation_message .= "Booking Date: " . htmlspecialchars($booking_date) . "<br>";
                $confirmation_message .= "Restringing: " . htmlspecialchars($restringing) . "<br>";
                $confirmation_message .= "Bat Knocking: " . htmlspecialchars($bat_knocking) . "<br>";
            } else {
                $confirmation_message = "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $confirmation_message = "Error preparing statement: " . $conn->error;
        }
    }
} else {
    $confirmation_message = "Form data is missing.";
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Sona Template">
    <meta name="keywords" content="Sona, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking Confirmation</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="css/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/css/style.css" type="text/css">
</head>

<body>
    <!-- Header Section Begin -->
    <header class="header-section">
        
        <div class="menu-item">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="logo">
                            <a href="dashboard.html">
                                <img src="img/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="nav-menu">
                            <nav class="mainmenu">
                                <ul>
                                    <li class="active"><a href="dashboard.html">Home</a></li>
                                    <li><a href="./about-us.html">About Us</a></li>
                                    <li><a href="./contact.html">Contact</a></li>
                                    <li><a href="./history.php">History</a></li>
                                </ul>
                            </nav>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .contain {
    background-color: #fff;
    padding: 20px;
    border: 2px solid #e6eaee;
    max-width: 600px;
    margin: 0 auto;
}
            </style>
    </header>
    <!-- Header End -->

    <div class="contain">
        <div class="confirmation">
            <h3><?php echo $confirmation_message; ?></h3>
            <p><a href="dashboard.html">Back to Booking Form</a></p>
        </div>
    </div>

 <!-- Footer Section Begin -->
 <footer class="footer-section">
        <div class="container">
            <div class="footer-text">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ft-about">
                            <div class="logo">
                                <a href="#">
                                    <img src="img/footer-logo.png" alt="">
                                </a>
                            </div>
                            <p>Browse our online store and if you can't find what you are looking for please don't hesitate to give us a call or visit one of our 43 stores countrywide.</p>
                            <div class="fa-social">
                                <a href="https://www.facebook.com/SportsmansW/" title="Facebook" target="_blank" class="social-icon text-decoration-none"><i class="fa fa-facebook"></i></a>
                                <a href="https://twitter.com/SportsmansW/" title="Twitter" target="_blank" class="social-icon text-decoration-none"><i class="fa fa-twitter"></i></a>
                                <a href="https://www.instagram.com/sportsmanswarehouseza/" title="Instagram" target="_blank" class="social-icon text-decoration-none"><i class="fa fa-instagram"></i></a>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="ft-contact">
                            <h6>Contact Us</h6>
                            <ul>
                                <a href="tel:0800007030">0800 007 030 (Toll Free)</a>
                                <a href="mailto:customercare@sportsmanswarehouse.co.za" target="_blank">customercare@sportsmanswarehouse.co.za</a>
                                <div class="card-link"><a href="https://www.sportsmanswarehouse.co.za/store-locator/">Find Branches &amp; Details</a></div>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="ft-newslatter">
                            <h6>New latest</h6>
                            <p>Get the latest updates and offers.</p>
                            <form action="#" class="fn-form">
                                <input type="text" placeholder="Email">
                                <button type="submit"><i class="fa fa-send"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-option">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <ul>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Terms of use</a></li>
                            <li><a href="#">Privacy</a></li>
                            <li><a href="#">Environmental Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-5">
                        <div class="co-text"><p>
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | </p></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

  
</body>

</html>
