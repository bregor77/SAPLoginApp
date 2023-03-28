<?php
// session_start();
include("include/config.php");

// Get the user's input from a form
if (isset($_POST['email'], $_POST['password'])) {
  $email = test_input($_POST['email']);
  $password = test_input($_POST['password']);

  // prevent SQL injection by using prepared statements
  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $stored_password = $row['password'];

    // verify the password using a strong hashing algorithm like bcrypt
    if (password_verify($password, $stored_password)) {
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['firstname'] = $row['firstname'];
      $_SESSION['surname'] = $row['surname'];
      // successfully login credentials
      echo "<p style='color:green; text-align:center;'>You are successfully logged in</p>";
      // redirecting to index page after successfully login
      header("Location: index.php");
      exit();
    }
  }

  // invalid login credentials
  echo "<p style='color:red; text-align:center;'>Invalid Login Credentials</p>";
}

// Sanitize the user's input to prevent XSS attacks

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data, ENT_QUOTES | ENT_HTML5, 'UTF-8');
  return $data;
}
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  
  <title>Sap Project - Secure Version</title>

  <!-- CSS FILES -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="css/slick.css" />
  <link href="css/tooplate-little-fashion.css" rel="stylesheet">
</head>

<body>

  <section class="preloader">
    <div class="spinner">
      <span class="sk-inner-circle"></span>
    </div>
  </section>

  <main>

    <section class="sign-in-form section-padding">
      <div class="container">
        <div class="row">

          <div class="col-lg-8 mx-auto col-12">

            <h1 class="hero-title text-center mb-5">Login</h1>

            <div class="row">
              <div class="col-lg-8 col-11 mx-auto">
                <form role="form" method="post">

                  <div class="form-floating mb-4 p-0">
                    <input type="email" name="email" id="email" class="form-control"
                      placeholder="Email address">

                    <!-- <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control"
                      placeholder="Email address" required> -->

                    <label for="email">Email address</label>
                  </div>

                  <div class="form-floating p-0">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                      required>

                    <label for="password">Password</label>
                  </div>

                  <button type="submit" class="btn custom-btn form-control mt-4 mb-3">
                    Login
                  </button>

                  <p class="text-center">Don't have an account? <a href="registration.php">Create a New Account</a></p>

                </form>
              </div>
            </div>

          </div>

        </div>
      </div>
    </section>

  </main>

  <footer class="site-footer">
    <div class="container">
      <div class="row">

        <div class="col-lg-3 col-10 me-auto mb-4">
          <h4 class="text-white mb-3"><a href="index.php">SAP </a>Project</h4>
          <h6 class="text-white mb-3"><a href="index.php">Login App </a>Secure Version</h6>
          <p class="copyright-text text-muted mt-lg-5 mb-4 mb-lg-0">Copyright © 2023 <strong>Mariusz</strong></p>
          <br>
          <p class="copyright-text">Designed for <a href="#" target="_blank">SAP Project</a></p>
        </div>

        <div class="col-lg-5 col-8">
          <h5 class="text-white mb-3">Sitemap</h5>

          <ul class="footer-menu d-flex flex-wrap">
            <li class="footer-menu-item"><a href="#" class="footer-menu-link">Products</a></li>           
          </ul>
        </div>

        <div class="col-lg-3 col-4">
          <h5 class="text-white mb-3">Social</h5>
          <ul class="social-icon">
            <li><a href="#" class="social-icon-link bi-youtube"></a></li>
            <li><a href="#" class="social-icon-link bi-whatsapp"></a></li>
            <li><a href="#" class="social-icon-link bi-instagram"></a></li>
            <li><a href="#" class="social-icon-link bi-skype"></a></li>
          </ul>
        </div>

      </div>
    </div>
  </footer>

  <!-- JAVASCRIPT FILES -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/Headroom.js"></script>
  <script src="js/jQuery.headroom.js"></script>
  <script src="js/slick.min.js"></script>
  <script src="js/custom.js"></script>

</body>

</html>