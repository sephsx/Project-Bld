<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style.css">
  <title>Become a Donor</title>
</head>
<style>
  #form {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  grid-gap: 20px;
}

.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input,
select {
  width: 100%;
  padding: 8px;
  box-sizing: border-box;
}

button {
  width: 50%;
  height: 50px;
  padding: 10px;
  margin-top:20px;
  box-sizing: border-box;
}

</style>
<body>

  <section id="title">
    <!-- navbar -->
    <nav class="navbar bg-danger navbar-expand-lg">
      <a class="navbar-brand fs-5 fw-medium " href="home.php">Become a donor</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link  fs-5 fw-medium" href="request.php">Request Blood</a>
          </li>
          <li class="nav-item">
            <a class="nav-link  fs-5 fw-medium" href="Home.php">Home</a>
          </li>
        </ul>
      </div>
    </div>
  </section>

  <section id="form">
    <!-- form -->
    <div class="container">
      <h2 class="mt-5 mb-4">Donate Blood</h2>
      <form method="post" id="form">
        <div class="form-group">
          <label for="firstName">First Name</label>
          <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your First Name" required>
        </div>
        <div class="form-group">
          <label for="lastName">Last Name</label>
          <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your Last Name" required>
        </div>
        <div class="form-group">
          <label for="age">Age</label>
          <input type="number" class="form-control" id="age" name="age" placeholder="Enter your age" required>
        </div>
        <div class="form-group">
          <label for="address">Address</label>
          <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" required>
        </div>
        <div class="form-group">
          <label for="mobileNumber">Mobile Number</label>
          <input type="tel" class="form-control" id="mobileNumber" name="mobileNumber" placeholder="Enter your mobile number" required>
        </div>
        <div class="form-group">
          <label for="bagsOfBlood">Bags of Blood</label>
          <input type="number" class="form-control" id="bagsOfBlood" name="bagsOfBlood" placeholder="Bags of Blood" required>
        </div>
        <div class="form-group">
          <label for="sex">Gender</label>
          <select class="form-control" id="sex" name="sex">
            <option value="">Select your gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
          </select>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
        </div>
        <div class="form-group">
          <label for="bloodGroup">Blood Type</label>
          <select class="form-control" id="bloodGroup" name="bloodGroup" required>
            <option value="">Select your blood Type</option>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
          </select>
        </div>
        <div class="form-group">
          <label for="Weight">Weight</label>
            <input type="weight" class="form-control" id="weight" name="weight">
        </div>

        <button type="submit" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#successModal">Submit</button>
      </form>
    </div>
  </section>
  <!-- modal -->
  <div class="modal" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="successModalLabel">Success!</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          New record created successfully.
        </div>
        <div class="modal-footer">
          <!-- User needs to close the modal manually -->
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>

  <!-- form validation -->
<script>
  document.addEventListener('DOMContentLoaded', function(){
    var form = document.querySelector('#form');
    form.addEventListener('submit', function (event){
        var inputs = document.querySelectorAll('input, select');
        var allFieldsFilled = true;
        inputs.forEach(function (input){
            if(input.hasAttribute('required') && !input.value.trim()){
                allFieldsFilled = false;
            }
        });
        if(!allFieldsFilled){
            event.preventDefault();
            alert('Please fill in all required fields. ');
        }
    });
});
</script>
</body>
</html>





 <!-- DATABASE CONFIGURATION -->
<?php

$server = "localhost";
$username = "root";
$password = "password";
$database = "bbd";

// Create connection
$conn = new mysqli($server, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // COLLECT DATA FROM FORM
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $phoneNumber = $_POST['mobileNumber'];
    $sex = $_POST['sex'];
    $email = $_POST['email'];
    $bloodType = $_POST['bloodGroup'];
    $weight = $_POST['weight'];
    $bagsofBlood = $_POST['bagsOfBlood'];
    
    // Execute query
    $sql = "INSERT INTO donor (firstName, lastName, age, address, phoneNumber, sex, email, bloodType ,weight, bagsOfBlood)
VALUES ('$firstName','$lastName', '$age', '$address', '$phoneNumber', '$sex', '$email', '$bloodType' , '$weight', '$bagsofBlood')";



  if ($conn->query($sql) === TRUE) {
    // Trigger the success modal
    echo '<script>
    $(document).ready(function () {
      $("#successModal").modal("show");
    });
  </script>';
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
      // Close the database connection
      $conn->close();
  }
?>