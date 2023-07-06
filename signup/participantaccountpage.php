<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Account</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    /* CSS styles */
  </style>
</head>
<body>
  <nav>
    <ul>
      <li><a href="/">HOME</a></li>
      <li><a href="/events">EVENTS</a></li>
      <li><a href="/research">RESEARCH</a></li>
      <li><a href="/blog">BLOG</a></li>
      <li><a href="/about">ABOUT</a></li>
    </ul>
  </nav>

  <img src="logo.jpg" alt="tdh" height="100px" width="100px" style="border-radius: 50%">

  <p>Upcoming Events: <i class="fa fa-calendar"></i></p>
  <div class="events">
    <h2>Checkout your past events</h2>
    <div id="pastEvents">
      <?php
      // Connect to the MySQL database
      $hostname = "localhost";
      $username = "root";
      $password = "";
      $database = "tdh";

      $conn = mysqli_connect($hostname, $username, $password, $database);
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }

      // Retrieve past events the participant has attended
      $participantEmail = "participant@example.com"; // Replace with actual participant email
      $query = "SELECT * FROM events WHERE mail = '$participantEmail' AND eventnameattend = 1";
      $result = mysqli_query($conn, $query);

      while ($row = mysqli_fetch_assoc($result)) {
        $eventName = $row['eventName'];
        echo "<button class='pbutton'>$eventName</button>";
      }

      // Close the database connection
      mysqli_close($conn);
      ?>
    </div>
  </div>

  <div class="registered">
    <h2>Registered Events</h2>
    <div id="registeredEvents">
      <?php
      
      $conn = mysqli_connect($hostname, $username, $password, $database);
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }

      // Retrieve all registered events
      $participantEmail = "participant@example.com";
      $query = "SELECT * FROM events WHERE mail = '$participantEmail'";
      $result = mysqli_query($conn, $query);

      while ($row = mysqli_fetch_assoc($result)) {
        if ($row['eventnameattend'] == 1) {
          $eventName = $row['eventName'];
          echo "<button class='fbutton'>$eventName</button>";
        }
      }

      // Close the database connection
      mysqli_close($conn);
      ?>
    </div>
  </div>
</body>
</html>
