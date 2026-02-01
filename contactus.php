<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PowerCore Fitness | Contact Us</title>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet" />
  <link rel="stylesheet" href="styles.css" />
</head>

<body>
  <nav>
    <div class="nav__logo">
      <a href="#"><img src="assets/GGWP-removebg-preview.png" alt="logo" /></a>
    </div>
    <ul class="nav__links">
      <li class="link"><a href="index.html">Home</a></li>
      <li class="link"><a href="programs.php">Program</a></li>
      <li class="link"><a href="service.html">Service</a></li>
      <li class="link"><a href="about.html">About</a></li>
      <li class="link"><a href="contactus.php">Contact Us</a></li>
    </ul>
    <button class="btn" onclick="window.location.href='programs.php#login-form'">Join Now</button>
  </nav>

  <section class="section__container">
    <h2>Contact Us</h2>
    <p>Have questions or need assistance? Get in touch with our team via email at <a
        href="mailto:powercorefitness@gmail.com">powercorefitness@gmail.com</a> or call us at (+94)70 11 27 427. We're
      here to help!</p>
  </section>
  <section class="section__container contact-form">
    <h2>Send Us a Message</h2>
    <?php if (isset($_SESSION['contact_error'])): ?>
        <div class="alert alert-error" style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border-radius: 5px; text-align: center;">
            <?php 
                echo htmlspecialchars($_SESSION['contact_error']); 
                unset($_SESSION['contact_error']);
            ?>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['contact_success'])): ?>
        <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 5px; text-align: center;">
            <?php 
                echo htmlspecialchars($_SESSION['contact_success']); 
                unset($_SESSION['contact_success']);
            ?>
        </div>
    <?php endif; ?>
    <form class="form__wrapper" action="process_contact.php" method="POST">
      <div class="form__group">
        <input type="text" name="name" placeholder="Your Name" required />
      </div>
      <div class="form__group">
        <input type="email" name="email" placeholder="Your Email" required />
      </div>
      <div class="form__group">
        <textarea name="message" placeholder="Your Message" rows="4" required></textarea>
      </div>
      <button type="submit" class="btn">Send Message</button>
    </form>
  </section>

  <footer class="section__container footer">
    <p>© 2025 PowerCore Fitness. All rights reserved.</p>
  </footer>
</body>

</html>