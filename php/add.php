<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Listing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    <h1 class='display-3'>User Listings</h1>


<!-- 
    NOTE: this is our backend (server side) code. 
    1. User cannot see this code -- unlike HTML/CSS/JavaScript
    2. This is how we will do database opperations (DB is also on server)
-->    

<?php
// DYNAMIC HTML

$firstname = $_GET['apiFirst'];
$lastname =$_GET['apiLast'];
$country = $_GET['apiCountry'];


echo " <div class='container'>";
echo "<h1>Newly added</h1>";

echo "<div class='row'>";


echo "<div class ='alert alert-info col-6'><strong>$firstname </strong> has been added! </div>";


// DATABASE OPERATIONS:
// https://www.w3schools.com/php/php_mysql_insert.asp
$servername = "localhost";
$username = "user75";
$password = "75sung";
$dbname = "db75";

//Connect to database
//

// Create connection (assuming these exist -- we set up the DB on the CLI)
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// SQL OPPERATIONS
$sql = "INSERT INTO randuser2 VALUES ('$firstname', '$lastname', '$country')";


if ($conn->query($sql) === TRUE) {
  echo "<div class ='alert alert-success col-6'>New record created successfully!</div>";
  echo "</div>";

} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql2 = "SELECT * FROM randuser2";
$result = $conn->query($sql2);

echo "<div class='table-hover'>";
echo "<table class ='table table-hover'>";
echo "<th>First name</th> <th>Last name</th> <th>Country</th>";



if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    //echo "First name: " . $row["first"]. ", Last name: ". $row["last"]. ", Country: ". $row["country"]. "<br>";
    echo "<tr><td>". $row["first"]. "</td><td>" . $row["last"]. "</td><td>" . $row["country"] . "</td></tr>";
  }
} 
$conn->close();
echo "</table>";
echo "</div>";


?>

    <br>
    <button onclick="history.back()" class="btn btn-primary">Back</button>
    </div>
    <br>

    <footer>

    I used a container for the content including the table with all added records.
    Also, I used a Bootstrap grid to put the alerts (success and info alert box) in one row.
    Then, I used a Bootstrap table (table-hover) to display all added people.
    </footer>

</body>
</html>
