<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <!-- CSS Stylesheet  -->
  <link rel="stylesheet" href="signupstyle.css">
</head>

<body>
  <div class="modal">
    <div class="modal-content">
      <p>Register yourself for this upcoming event.</p>
      <form class="modal-form" action="validate.php" onsubmit="return validateForm()" id="registration-form" method="post">
        <!-- Name -->
        <input type="text" class="input-field" placeholder="Name" name="name" required>
        <!-- Course -->
        <select class="input-field" name="course" style="color: #777777;" required>
          <option value="" disabled selected>Select a Course</option>
          <option value="bba">BBA</option>
          <option value="bca">BCA</option>
          <option value="bca">B.Com</option>
          <option value="btech">B.Tech</option>
          <option value="mba">MBA</option>
          <option value="mca">MCA</option>
          <option value="mtech">M.Tech</option>
          <option value="other">Other</option>
          <!-- Add more options as needed -->
        </select>

        <input type="text" id="custom-course" class="input-field" name="custom-course" placeholder="Enter Course" style="display: none;">
        <!-- Semester -->
        <select class="input-field" name="semester" style="color: #777777;" required>
          <option value="" disabled selected>Select a Semester</option>
          <option value="1">1st</option>
          <option value="2">2nd</option>
          <option value="3">3rd</option>
          <option value="4">4th</option>
          <option value="5">5th</option>
          <option value="6">6th</option>
          <option value="7">7th</option>
          <option value="8">8th</option>
        </select>

        <!-- Email  -->
        <input type="text" class="input-field" placeholder="Email" name="email" id="email" required>

        <!-- Phone Number  -->
        <input type="phone" class="input-field" placeholder="Phone No" name="phone" id="phone" required>

        <!-- password -->
        <input type="password" class="input-field" placeholder="Password" name="password" id="pw" required>

        <!-- Remember me  -->
        <input type="checkbox" class="check-box" checked="checked" name="remember"> Remember me
        <!-- Register  -->
        <button type="submit" class="register-btn">Sign Up</button>
        <div class="popup" id="popup">
          <h2>Thank You!</h2>
          <h3>You have signed up successfully!!</h3>
          <a href="#" class="go-back" onclick="closePopup()" style="color: black;">Go back to the event page</a>
        </div>
        <div id="message" class="message"></div>
      </form>
    </div>
  </div>

  <script src="signupscript.js"></script>
</body>

</html>

