<?php
session_start();
// Save the registration data to the database
$servername = "localhost";
$username = "root";
$db_password = "";
$dbname = "tdh";

// Create a database connection
$conn = new mysqli($servername, $username, $db_password, $dbname);

// Check the connection
if ($conn->connect_error) {
    echo "Could not connect.";
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and perform server-side validation
    $name = $_POST["name"];
    $course = $_POST["course"];
    $customCourse = $_POST["custom-course"];
    $semester = $_POST["semester"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $remember = isset($_POST["remember"]) ? "Yes" : "No"; // Check if the remember checkbox is checked

    // Perform server-side validation
    $errors = array();

    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (empty($course)) {
        $errors[] = "Course is required.";
    } elseif ($course === "other" && empty($customCourse)) {
        $errors[] = "Custom course is required for 'Other' option.";
    }

    if (empty($semester)) {
        $errors[] = "Semester is required.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($phone)) {
        $errors[] = "Phone number is required.";
    } elseif (!preg_match("/^\d{10}$/", $phone)) {
        $errors[] = "Invalid phone number format. Please enter a 10-digit phone number.";
    }

    // Check if email already in use
    $query = "SELECT * FROM signup WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        // Duplicate entry found
        echo "Email already in use!";
        exit();
    }

    // If there are any validation errors, display them
    if (!empty($errors)) {
        echo "<h2>Error:</h2>";
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    } else {
        // Prepare and execute the SQL query to insert the form values into the table
        $sql = "INSERT INTO signup (name, course, custom_course, semester, email, phone, remember) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $name, $course, $customCourse, $semester, $email, $phone, $remember);
        $stmt->execute();

        // Close the statement and database connection
        $stmt->close();
        $conn->close();

        // Display success message
        echo "<h2>Thank You!</h2>";
        echo "<h3>You have signed up successfully!!</h3>";

        // If "Remember me" checkbox is checked, set a cookie with the email
        if ($remember) {
            // Define the cookie expiration time (e.g., one week)
            $cookieExpiration = time() + (60 * 24 * 60 * 60);

            // Set the username and password cookies
            setcookie('username', $email, $cookieExpiration);
            setcookie('password', $password, $cookieExpiration);
        } else {
            // Delete the username and password cookies
            setcookie('username', '', time() - 1);
            setcookie('password', '', time() - 1);
        }

        // Redirect to the account page
        header("Location: participantaccountpage.php");
        exit();
    }
}
?>