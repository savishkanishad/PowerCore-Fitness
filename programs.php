<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PowerCore Fitness | Programs</title>
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

    <section id="login-form" class="section__container login">
      <div class="register__wrapper">
        <h2>Login</h2>
        <?php if (isset($_SESSION['login_error'])): ?>
            <div class="alert alert-error" style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border-radius: 5px; text-align: center;">
                <?php 
                    echo htmlspecialchars($_SESSION['login_error']); 
                    unset($_SESSION['login_error']);
                ?>
            </div>
            <?php if (isset($_SESSION['login_success'])): ?>
            <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 5px; text-align: center;">
                <?php 
                    echo htmlspecialchars($_SESSION['login_success']); 
                    unset($_SESSION['login_success']);
                ?>
            </div>
        <?php endif; ?>
        <?php endif; ?>
        <form class="login__form" action="login.php" method="POST">
          <div class="form__group">
            <input type="email" placeholder="Email" name="email" required />
          </div>
          <div class="form__group">
            <input type="password" placeholder="Password" name="password" required />
          </div>
          <button type="submit" class="btn">Login</button>
        </form>
         <p style="text-align:center; margin-top: 10px;">Don't have an account? <a href="#register-form" style="color: var(--secondary-color);">Register here</a></p>
      </div>
    </section>

    <section id="register-form" class="section__container register">
      <div class="register__wrapper">
        <h2>Register</h2>
        <?php if (isset($_SESSION['register_error'])): ?>
            <div class="alert alert-error" style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border-radius: 5px; text-align: center;">
                <?php 
                    echo htmlspecialchars($_SESSION['register_error']); 
                    unset($_SESSION['register_error']);
                ?>
            </div>
        <?php endif; ?>
        <form class="register__form" action="register.php" method="POST">
          <div class="form__group">
            <input type="text" placeholder="Full Name" name="name" required />
          </div>
          <div class="form__group">
            <input type="email" placeholder="Email" name="email" required />
          </div>
          <div class="form__group">
            <input type="password" placeholder="Password" name="password" required />
          </div>
          <div class="form__group">
            <input type="password" placeholder="Confirm Password" name="confirm_password" required />
          </div>
          <div class="form__group">
            <input type="tel" placeholder="Phone Number" name="phone" required />
          </div>
          <div class="form__group">
            <select name="program" required>
              <option value="">Select Program</option>
              <option value="strength">Strength Training</option>
              <option value="cardio">Cardio Blast</option>
              <option value="yoga">Yoga & Flexibility</option>
              <option value="coaching">Personal Coaching</option>
            </select>
          </div>
          <button type="submit" class="btn">Register</button>
        </form>
        <p style="text-align:center; margin-top: 10px;">Already have an account? <a href="#login-form" style="color: var(--secondary-color);">Login here</a></p>
      </div>
    </section>

    <section class="section__container">
      <h2>Our Programs</h2>
      <p>
        Explore a wide range of fitness programs designed for all levels. Whether you're looking for strength training, cardio, yoga, or personalized coaching—we’ve got something for everyone. Each program includes flexible schedules and expert guidance.
      </p>
    </section>
    <section class="section__container programs">
      <h2>Featured Programs & Pricing</h2>
      <div class="program__grid">
        <div class="program__card">
          <h3>Strength Training</h3>
          <ul>
            <li>Progressive resistance workouts</li>
            <li>Access to free weights & machines</li>
            <li>Weekly group sessions</li>
            <li>Nutrition guidance</li>
          </ul>
          <div class="program__price">
            <strong>LKR 2000.00/month</strong>
          </div>
          <button class="btn">Join Strength</button>
        </div>
        <div class="program__card">
          <h3>Cardio Blast</h3>
          <ul>
            <li>High-intensity interval training</li>
            <li>Endurance and stamina focus</li>
            <li>Unlimited cardio classes</li>
            <li>Heart rate monitoring</li>
          </ul>
          <div class="program__price">
            <strong>LKR 2500.00/month</strong>
          </div>
          <button class="btn">Join Cardio</button>
        </div>
        <div class="program__card">
          <h3>Yoga & Flexibility</h3>
          <ul>
            <li>Guided yoga sessions</li>
            <li>Stretching and mobility routines</li>
            <li>Mindfulness & relaxation</li>
            <li>All skill levels welcome</li>
          </ul>
          <div class="program__price">
            <strong>LKR 3000.00/month</strong>
          </div>
          <button class="btn">Join Yoga</button>
        </div>
        <div class="program__card">
          <h3>Personal Coaching</h3>
          <ul>
            <li>One-on-one sessions</li>
            <li>Custom training plans</li>
            <li>Progress tracking</li>
            <li>Direct support from trainers</li>
          </ul>
          <div class="program__price">
            <strong>LKR 3500.00/month</strong>
          </div>
          <button class="btn">Join Coaching</button>
        </div>
      </div>
    </section></div>

   



    <footer class="section__container footer">
      <p>© 2025 PowerCore Fitness. All rights reserved.</p>
    </footer>

 <script>
        // Handle Login Form
        // Removed broken fetch scripts to allow standard form submission
        // which handles redirects correctly from PHP.
    </script>


  </body>
</html>
