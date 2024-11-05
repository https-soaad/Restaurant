<?php
// Include the database connection
include 'db_connection.php';

$message = '';  // Initialize an empty message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $bookingDate = $_POST['bookingDate'];
    $bookingTime = $_POST['bookingTime'];
    $numGuests = $_POST['numGuests'];
    $specialRequest = $_POST['specialRequest'];

    // Prepare and execute the insert statement
    $stmt = $pdo->prepare("INSERT INTO reservations (full_name, email, phone, booking_date, booking_time, num_guests, special_request)
                           VALUES (:fullName, :email, :phone, :bookingDate, :bookingTime, :numGuests, :specialRequest)");

    // Bind parameters
    $stmt->bindParam(':fullName', $fullName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':bookingDate', $bookingDate);
    $stmt->bindParam(':bookingTime', $bookingTime);
    $stmt->bindParam(':numGuests', $numGuests);
    $stmt->bindParam(':specialRequest', $specialRequest);

    // Set the message based on the execution result
    if ($stmt->execute()) {
        $message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Booking successful! Thank you for your reservation.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
    } else {
        $message = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Booking failed. Please try again later.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Sofadi+One&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <title>Tasty Restaurant</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
   <link rel=stylesheet href="style.css">
</head>

<body>
    <?= $message ?>
    <section class="container-fluid section1">
        <header>
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a href="#" class="navbar-brand d-flex align-items-center">
                        <img src="images/cutlery.png">
                        <h5 class="ms-1 mb-0 logo">Tasty</h5>
                    </a>
                    <button type="button" class="navbar-toggler border-0 menubtn " data-bs-toggle="collapse"
                        data-bs-target="#menuLinks">
                        <span class="navbar-toggler-icon "></span>
                    </button>
                    <div class="navbar-collapse collapse" id="menuLinks">
                        <ul class="navbar-nav ms-auto ">
                            <li class="nav-item">
                                <a href="#" class="nav-link active">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="#weServe" class="nav-link">We serve</a>
                            </li>
                            <li class="nav-item">
                                <a href="#about" class="nav-link">About</a>
                            </li>
                            <li class="nav-item">
                                <a href="#contacter" class="nav-link">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="row align-items-center">
            <div class="col-lg-6 text-center text-lg-start mt-5 p-5 landingtext">
                <h1 class="title1">A new taste A new experience</h1>
                <p class="fw-blod title2">We care about the quality</p>

                <div class="d-block align-items-start">
                    <div class="row">
                        <div class="col-12 col-md-4 mb-2">
                            <a href="menu.html" class="btn btn-sm landingBtn w-100">Menu</a>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <a href="#booking" class="btn btn-sm landingBtn w-100">Book a table</a>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <a href="#gallery" class="btn btn-sm landingBtn w-100">Gallery</a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-6 text-center mt-4 mt-lg-0">
                <img src="images/beef.png" class="img-fluid mx-auto d-block landingPhoto" alt="Landing Image">
            </div>
        </div>
    </section>
    <section class="section2  container-fluid  d-flex flex-wrap" id="about">
        <div class="part1">
            <h1>Discover</h1>
            <h2>Our story</h2>
            <p> At <span>Tasty</span> we combine a passion for great food with a welcoming atmosphere. Led by our
                Chef , our kitchen creates flavorful dishes using fresh, locally sourced ingredients. With a perfect
                blend of tradition and creativity, we aim to offer a memorable dining experience for every guest.
                Come and enjoy a meal crafted with care and culinary expertise!</p>

        </div>
        <div class="part2">
            <img src="images/chef2.jpg" class="img-fluid">
        </div>
        </div>
    </section>
    <section class="section3 container-fluid" id="weServe">
        <h2 class="text-center ">What we Serve </h2>
        <div class="container py-5">
            <div class="row">
                <div class="col-md-4 col-sm-6 mb-4">
                    <a href="menu.html">
                        <img src="images/salmon.jpg" class="img-fluid" alt="Image 1"> </a>
                    <h4>Our main dishes</h4>

                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <a href="menu.html">
                        <img src="images/juice.jpg" class="img-fluid" alt="Image 2"></a>
                    <h4>Our refreshing drinks</h4>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <a href="menu.html">
                        <img src="images/brouni.jpg" class="img-fluid" alt="Image 3"></a>
                    <h4>Our delightful dessert </h4>
                </div>
            </div>
        </div>
        <div class="col-12 text-center">
            <a href="menu.html" class="btn btn-ms  menuP ">
                Discover all the menu !
            </a>
        </div>
        </div>
    </section>
    <section class="container-fluid section4 " id="booking">
        <div class=" headSec">
            <h2 class="form-title text-center">Booking a Table</h2>
        </div>
        <div class="container">
            <div class="row align-items-center"> <!-- This row will have the form and image side by side -->

                <!-- Form on the Left -->
                <div class="col-lg-6 col-md-12">
                    <div class="form-container">
                        <!-- Title of the Form -->


                        <form id="reservationForm" method="POST" action="main.php">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="fullName" class="form-label"><i class="bi bi-person"></i> Full
                                        name</label>
                                    <input type="text" class="form-control" id="fullName" name="fullName">
                                    <span id="nameError" class="error "></span><br>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label"><i class="bi bi-envelope"></i>
                                        Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                    <span id="emailError" class="error "></span><br>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="phone" class="form-label"><i class="bi bi-telephone"></i>
                                        Phone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone">
                                    <span id="phoneError" class="error "></span><br>
                                </div>
                                <div class="col-md-6">
                                    <label for="bookingDate" class="form-label"><i class="bi bi-calendar"></i> Booking
                                        date</label>
                                    <input type="date" class="form-control" id="bookingDate" name="bookingDate">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="bookingTime" class="form-label"><i class="bi bi-clock"></i>
                                        Booking time</label>
                                    <input type="time" class="form-control" id="bookingTime" name="bookingTime">
                                    <span id="timeError" class="error"></span><br>
                                </div>
                                <div class="col-md-6">
                                    <label for="numGuests" class="form-label"><i class="bi bi-people"></i>
                                        Number of guests</label>
                                    <input type="number" class="form-control" id="numGuests" min="1" max="8"
                                        name="numGuests">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="specialRequest" class="form-label"><i class="bi bi-chat-left-dots"></i></i>
                                    Special request</label>
                                <textarea class="form-control" id="specialRequest" rows="1"
                                    name="specialRequest"></textarea>
                            </div>
                            <button type="submit" name="sendBtn" class="btn btn-custom w-100">Book now</button>
                        </form>
                    </div>
                </div>
                <!-- Image on the Right -->
                <div class="col-lg-6 col-md-12 d-flex align-items-center justify-content-center py-3">
                    <img src="images/tt.png" class="img-fluid restaurantTable p-5" alt="Restaurant Image">
                </div>
                <!-- <div class="alert alert-success fade show success-notification" id="successNotification" role="alert">
                    <strong>Your reservation has been successful!</strong>
                    <p>Your table is booked. Thank you!</p>
                    <button type="button" class="btn-close" id="closeNotification" aria-label="Close"></button>
                </div> -->

            </div>
        </div>

    </section>
    <section class="section5 container-fluid" id="gallery">
        <h1 class="pt-4">Happy moments</h1>
        <p>thanks to our team and our amazing clients for making those beautyful moments</p>
        <div class="parent">
            <div class="cardPhoto">
                <video src="gallery/chefC.mp4" autoplay muted loop></video>
            </div>
            <div class="cardPhoto">
                <img src="gallery/view1.jpg">
            </div>
            <div class="cardPhoto">
                <img src="gallery/wom.jpg">
            </div>
            <div class="cardPhoto">
                <img src="gallery/waiter.jpg">
            </div>
            <div class="cardPhoto">
                <video src="gallery/eat.mp4" autoplay muted loop></video>
            </div>
            <div class="cardPhoto">
                <img src="gallery/view2.jpg">
            </div>
            <div class="cardPhoto">
                <img src="gallery/bur.jpg">
            </div>
        </div>
        <p class="p2">Do not hesitate to try our restaurant and to contact us. You are welcome at any time.</p>

    </section>

    <section class="section6" id="contacter">
        <div class="container footerInfos py-3">
            <div class="row">
                <!-- Map Section -->
                <div class="col-md-6">

                    <a href="#" class="navbar-brand d-flex align-items-center">
                        <img src="images/cutlery.png">
                        <h5 class="ms-1 mb-0 logo">Tasty</h5>
                    </a>
                    <div id="map" class="mb-4">
                        <!-- Google Map Embed -->
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d220197.14822367163!2d-9.742555049028931!3d30.4196435025449!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdb3b6e9daad1cc9%3A0xbcf8d0b78bf48474!2sAgadir%2080000!5e0!3m2!1sfr!2sma!4v1728821027956!5m2!1sfr!2sma"
                            width="500" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" class="col-md-12"></iframe>
                    </div>
                </div>

                <!-- Contact Section -->
                <div class="col-md-6 info">
                    <h5>Contact Us</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-geo-alt-fill"></i> 123 Tasty Restaurant Street, Agadir, Morroco</li>
                        <li><i class="bi bi-telephone-fill"></i> +123 456 789</li>
                        <li><i class="bi bi-envelope-at-fill"></i> info@Tastyrestaurant.com</li>
                    </ul>
                    <h5>Follow Us</h5>
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="#" class="text-light"><i class="bi bi-facebook"></i></a>
                        </li>
                        <li class="list-inline-item"><a href="#" class="text-light"><i class="bi bi-instagram"></i></a>
                        </li>
                        <li class="list-inline-item"><a href="#" class="text-light"><i class="bi bi-youtube"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center ">
            <p>&copy; 2024 Tasty Restaurant. All rights reserved.</p>
        </div>
    </section>
    <script src="validation.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



</body>

</html>