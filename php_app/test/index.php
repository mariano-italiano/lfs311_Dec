<?php
$host = "localhost";
$username = "sqladmin";
$password = "pass123";
$database = "myDB";

// Create a connection to the database
$conn = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to add a new car
function addCar($brand, $year) {
    global $conn;
    $brand = mysqli_real_escape_string($conn, $brand);
    $year = mysqli_real_escape_string($conn, $year);

    $query = "INSERT INTO Cars (Brand, Year) VALUES ('$brand', '$year')";
    mysqli_query($conn, $query);
}

// Function to delete a car
function deleteCar($carId) {
    global $conn;
    $carId = mysqli_real_escape_string($conn, $carId);

    $query = "DELETE FROM Cars WHERE Id = '$carId'";
    mysqli_query($conn, $query);
}

// Function to get all cars
function getAllCars() {
    global $conn;

    $query = "SELECT * FROM Cars";
    $result = mysqli_query($conn, $query);

    $cars = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $cars[] = $row;
    }

    return $cars;
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["addCar"])) {
        $brand = $_POST["brand"];
        $year = $_POST["year"];
        addCar($brand, $year);
    } elseif (isset($_POST["deleteCar"])) {
        $carId = $_POST["carId"];
        deleteCar($carId);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🚗 Car Rental App 🚗</title>
<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #66cccc;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            font-size: 2em;
            color: #fff;
            margin: 0;
        }

        nav {
            background-color: #66cccc;
            padding: 10px;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            padding: 10px;
            margin: 0 10px;
            background-color: #4CAF50; /* Green background for links */
            border-radius: 5px;
        }

        nav a:hover {
            background-color: #45a049; /* Darker green background on hover */
        }

        form {
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            border-collapse: collapse;
            width: 50%;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<header>
    <h1>🚗 Car Rental Application 🚗</h1>
</header>

<nav>
    <a href="?page=home">Home</a>
    <a href="?page=add">Add Car</a>
    <a href="?page=delete">Delete Car</a>
    <a href="?page=info">PHP Info</a>
</nav>

<?php
// Display content based on the selected page
if (!empty($_GET['page'])) {
    $page = $_GET['page'];

    switch ($page) {
        case 'add':
            include 'add_car_form.php';
            break;
        case 'delete':
            include 'delete_car_form.php';
            break;
        case 'info':
            include 'phpinfo.php';
            break;
        default:
            include 'all_cars_table.php';
            break;
    }
} else {
    // Default to displaying all cars
    include 'all_cars_table.php';
}
?>

</body>
</html>
