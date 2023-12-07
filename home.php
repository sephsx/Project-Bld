<!DOCTYPE html >
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
<link rel="stylesheet" href="style.css">
<title>Home</title>
</head>
<body>

  <section id="title">
    <!-- navbar -->

    <nav class="navbar bg-danger navbar-expand-lg fixed-top">
    <a class="navbar-brand fs-5  fw-medium " href=""><img src="./img/pic5.jpg" alt="#"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link  fs-5 fw-medium" href="donor.php">Become a donor</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  fs-5 fw-medium" href="request.php">Request Blood</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  fs-5 fw-medium" href="#contact">Contact us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  fs-5 fw-medium" href="list.php">List of Donators</a>
        </li>
      </ul>
      </div>
    </div>
  </section>


<section id="testimonials">
  <!-- Testimonials -->
  <h1 class="welcome-heading fs-1 fw-semibold">Welcome to BloodBank & Donor Management System</h1>
  <h2 class="welcome-heading fs-1 mb-0   fw-semibold"> A bridge to Generousity</h2>
  <div id="carouselExample" class="carousel slide">
      <div class="carousel-inner">
        <div class="carousel-item active" >
          <img class="testimonials-img" src="./img/pic2.jpg" alt="#">
          <h2 class="testimonial-text class=fw-medium">Every bag of your blood save live's.</h2>
        </div>
        <div class="carousel-item">
        <img class="testimonials-img" src="./img/pic3.jpg" alt="#">
          <h2 class="testimonial-text class=fw-medium">Give the gift of life with a single drop donate blood and become a hero in someone's story.</h2>
        </div>
        <div class="carousel-item">
        <img class="testimonials-img" src="./img/pic1.jpg" alt="#">
          <h2 class="testimonial-text class=fw-medium">Your blood is the key to someone's tomorrow. Donate and unlock a brighter future for those in need.</h2>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
</section>

<section id="features">
    <!-- features -->
    <div class="row">
     

      <!-- Feature Box 1 -->
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body text-center">
            <i class="icon fa-solid fa-hand-holding-medical fa-bounce fa-4x"></i>
            <h3 class="card-title  class=fw-medium">The need for blood</h3>
            <p class="card-text fw-medium">There are many reasons patients need blood. A common misunderstanding about blood usage is that accident victims are the patients who use the most blood. Actually, people needing the most blood include those:</p>
            <ul  class="fw-medium">
              <li>Being treated for cancer</li>
              <li>Undergoing orthopedic surgeries</li>
              <li>Undergoing cardiovascular surgeries</li>
              <li>Being treated for inherited blood disorders</li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Feature Box 2 -->
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body text-center">
            <i class="icon fa-solid fa-briefcase-medical fa-bounce fa-4x"></i>
            <h3 class="card-title  fw-medium">Who you could Help</h3>
            <p class="card-text fw-medium">Every 2 seconds, someone in the World needs blood. Donating blood can help:</p>
            <ul  class="fw-medium">
              <li>People who go through disasters or emergency situations.</li>
              <li>People who lose blood during major surgeries.</li>
              <li>People who have lost blood because of a gastrointestinal bleed.</li>
              <li>Women who have serious complications during pregnancy or childbirth.</li>
              <li>People with cancer or severe anemia sometimes caused by thalassemia or sickle cell disease.</li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Feature Box 3 -->
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body text-center">
            <i class="icon fa-solid fa-fire-flame-simple fa-bounce fa-4x"></i>
            <h3 class="card-title  fw-medium">Blood Tips</h3>
            <ul  class="fw-medium">
              <li>You must be in good health.</li>
              <li>Hydrate and eat a healthy meal before your donation.</li>
              <li>You’re never too old to donate blood.</li>
              <li>Rest and relaxed.</li>
              <li>Don’t forget your FREE post-donation snack.</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>


<section id="why">
  <!-- WHY DONATE BLOOD -->
<div class="row">
  <div class="col-lg-6">
    <h1 class="big-heading">Why Should I Donate Blood ?</h1>
    <p class="fw-medium">Blood is the most precious gift that anyone can give to another person — the gift of life. A decision to donate your blood can save a life, or even several if your blood is separated into its components — red cells, platelets and plasma — which can be used individually for patients with specific conditions. Safe blood saves lives and improves health. Blood transfusion is needed for:</p>
    <ul class="fw-medium">
      <li>women with complications of pregnancy, such as ectopic pregnancies and haemorrhage before, during or after childbirth.</li>
      <li>children with severe anaemia often resulting from malaria or malnutrition.</li>
      <li>people with severe trauma following man-made and natural disasters.</li>
      <li>many complex medical and surgical procedures and cancer patients.</li>
    </ul>
    <p class="fw-medium">It is also needed for regular transfusions for people with conditions such as thalassaemia and sickle cell disease and is used to make products such as clotting factors for people with haemophilia. There is a constant need for regular blood supply because blood can be stored for only a limited time before use. Regular blood donations by a sufficient number of healthy people are needed to ensure that safe blood will be available whenever and wherever it is needed.</p>
  </div>
  <div class="col-lg-6">
    <img class="title-img"src="./img/pic4.png" alt="#">
  </div>
</div>
</section>
<section id="about">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="big-heading">About us</h1>
      <p class="fw-medium">Blood bank is a place where blood bag that is collected from blood donation events is stored in one place. The term “blood bank” refers to a division of a hospital laboratory where the storage of blood product occurs and where proper testing is performed to reduce the risk of transfusion related events . The process of managing the blood bag that is received from the blood donation events needs a proper and systematic management. The blood bag must be handled with care and treated thoroughly as it is related to someone’s life. The development of Web-based Blood Bank And Donation Management System (BBDMS) is proposed to provide a management functional to the blood bank in order to handle the blood bag and to make entries of the individuals who want to donate blood and who are in need.</p>
    </div>
  </div>

</section>
<section id="contact">
  <div class="container">
    <div class="row">
      <!-- Contact Form -->
      <div class="col-lg-6">
<form>
  <div class="row">
    <div class="col-md-6 mb-3">
      <div class="form-group">
        <label for="name">Your Name</label>
        <input type="text" class="form-control" id="name" placeholder="Enter your name">
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <div class="form-group">
        <label for="email">Your Email</label>
        <input type="email" class="form-control" id="email" placeholder="Enter your email">
      </div>
    </div>
  </div>
  <div class="form-group mb-3">
    <label for="message">Your Message</label>
    <textarea class="form-control" id="message" rows="4" placeholder="Enter your message"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
      </div>
      <!-- Contact Details -->
      <div class="col-lg-6">
        <div class="contact-details">
          <h3>Contact Details</h3>
          <p><strong>Address:</strong> temporary</p>
          <p><strong>Contact Number:</strong> temporary</p>
          <p><strong>Email:</strong> bloodlink001@gmail.com</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- footer -->
<section id="footer">
<footer class="bg-dark text-light py-3 ">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center ">
        <p>&copy; 2023 Your Blood Bank. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>

</section>
</body>
</html>

