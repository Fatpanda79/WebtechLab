<?php
if (!isset($_POST['cities']) || count($_POST['cities']) !== 10) {
    echo "<h2 style='text-align:center;color:red;'>Error: You must select exactly 10 cities.</h2>";
    exit();
}



$selectedCities = $_POST['cities'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "info";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$placeholders = implode(',', array_fill(0, count($selectedCities), '?'));

$sql = "SELECT City, Country, AQI FROM info WHERE City IN ($placeholders)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(str_repeat('s', count($selectedCities)), ...$selectedCities);

$stmt->execute();
$result = $stmt->get_result();

$bgColor = "#ffffff";
if (isset($_COOKIE['bgColor'])) {
    $bgColor = htmlspecialchars($_COOKIE['bgColor']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Selected City AQI Data</title>
  <style>
     body {
        font-family: Arial, sans-serif;
        background-color: <?php echo $bgColor; ?>;
    }
    .table-container {
      display: flex;
      justify-content: center;
      margin-top: 40px;
    }
    table {
      border-collapse: collapse;
      width: 80%;
      max-width: 700px;
      text-align: center;
    }
    th, td {
      border: 1px solid #aaa;
      padding: 10px;
      background-color: #ffffff;
    }
    th {
      background-color: #C4FFDD;
    }
    h2 {
      text-align: center;
      margin-top: 30px;
    }
  </style>
</head>
<body>

<h2>Selected City AQI Data</h2>
<div class="table-container">
  <table>
    <tr>
      <th>City</th>
      <th>Country</th>
      <th>AQI</th>
    </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['City']) . "</td>
                <td>" . htmlspecialchars($row['Country']) . "</td>
                <td>" . htmlspecialchars($row['AQI']) . "</td>
              </tr>";
    }
    ?>
  </table>
  
</div>
<br>
  <div style="text-align:center; margin-top:10px;">
  <a href="index.php">
    <button style="padding: 10px 20px; font-size: 16px; cursor: pointer; background-color: #4CAF50; color: white; border: none; border-radius: 5px;">
      Home
    </button>
  </a>
</div>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
