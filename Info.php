<?php
echo "<h1>Login Successful</h1>";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "info";

$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT DISTINCT City FROM info";
$result = $conn->query($sql);

$citylabels = "";
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $city = htmlspecialchars($row['City']);
        $citylabels .= "
        <div class='city-option'>
            <input type='checkbox' class='cityCheckbox' name='cities[]' value='$city' id='$city'>
            <label for='$city' style='margin-left: 10px;'>$city</label>
        </div>";
    }
} else {
    $citylabels = "<p>No cities found</p>";
}
?>

<!-- ✅ Form that submits selected cities to nextpage.php -->
<form id="cityForm" action="show.php" method="POST">
  <div class="container">
    <?php echo $citylabels; ?>
    <button type="submit" id="confirmBtn" disabled>Confirm</button>
  </div>
</form>

<!-- ✅ JS to ensure exactly 10 checkboxes are selected -->
<script>
  const checkboxes = document.querySelectorAll('.cityCheckbox');
  const confirmBtn = document.getElementById('confirmBtn');

  function updateButtonState() {
    const checked = Array.from(checkboxes).filter(checkbox => checkbox.checked).length;
    confirmBtn.disabled = checked !== 10;
  }

  checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', updateButtonState);
  });
</script>

</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>City Selection</title>
  <style>
    body {
      font-family: monospace;
    }

    .city-option {
      display: flex;
      align-items: center;
      margin: 5px;
    }

    .container {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      margin: 20px;
    }

    #confirmBtn {
      margin-top: 20px;
      padding: 10px 20px;
      font-weight: bold;
      background-color: #00d084;
      border: none;
      border-radius: 5px;
      color: white;
      cursor: pointer;
    }

    #confirmBtn:disabled {
      background-color: gray;
      cursor: not-allowed;
    }
  </style>
</head>
<body>

