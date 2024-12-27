<?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                  $email = $_POST['email'];
                  $password = $_POST['password'];
              
                  // Povezivanje sa bazom
                  $conn = new mysqli('db', 'devuser', 'devpass', 'test_db');
              
                  // Provera konekcije
                  if ($conn->connect_error) {
                      die("Konekcija neuspešna: " . $conn->connect_error);
                  }
              
                  // Priprema i izvršenje upita
                  $stmt = $conn->prepare("SELECT * FROM doktori WHERE email = ? AND password = ?");
                  $stmt->bind_param("ss", $email, $password);
                  $stmt->execute();
                  $result = $stmt->get_result();
              
                  if ($result->num_rows > 0) {
                      // Uspešna prijava - preusmeravanje na doktor.php
                      header("Location: doktor.php");
                      exit();
                  } else {
                      // Pogrešan email ili lozinka - prikaz poruke
                      echo "<script>alert('Pogrešan email ili lozinka!');</script>";
                  }
              
                  $stmt->close();
                  $conn->close();
              }
                ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        section {
            background-color: #08AEEA;
            background-image: linear-gradient(0deg, #08AEEA 0%, #2AF598 100%);
        }
        .form-control {
            width: 300px;
        }
        .form-outline {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form p {
            text-align: center;
        }
    </style>
</head>
<body>
<section class="h-100 gradient-form" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-12">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <h4 class="mt-1 mb-5 pb-1">Klinika</h4>
                </div>

                <form method="POST" action="">
                  <p>Logujte se kao doktor</p>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" name="email" class="form-control"
                      placeholder="Email" required />
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" name="password" class="form-control" 
                    placeholder="Password" required />
                  </div>

                  <button type="submit" class="btn btn-primary btn-block">Login</button>

                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">Loguj se kao <a href="/index.php">pacijent</a></p>
                  </div>

                </form>

                

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
