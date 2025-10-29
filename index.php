<!DOCTYPE html>
<html>

<head>
  <title>Bookstore Registration Form</title>
</head>

<body>
  <h2>Bookstore Registration Form</h2>
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="name">Name:</label>
    <input type="text" name="name" required><br><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required><br><br>

    <label for="phone">Phone:</label>
    <input type="text" name="phone" required><br><br>

    <input type="submit" name="submit" value="Register">
  </form>

  <?php
  // Database connection configuration
  $servername = "localhost";
  $username = "root";
  $password = "new_password";
  $database = "books_db";

  // Create a connection
  $conn = new mysqli($servername, $username, $password, $database);

  // Check the connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Process form submission
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    // Prepare and execute the SQL statement to insert member data into the database
    $stmt = $conn->prepare("INSERT INTO members (name, email, phone) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $phone);
    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
      echo "Registration successful!";
    } else {
      echo "Registration failed!";
    }

    // Close the statement
    $stmt->close();
  }

  // Close the connection
  $conn->close();
  ?>
</body>

</html>