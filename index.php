<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Air Quality Index Application </title>
    <link rel="stylesheet" href="aqi.css">
    <link rel="stylesheet" href="box4.css">
    <style>
        label{
            font-family: monospace;
            color: #000000;
            font-weight: 5px;
        }
        input{
            display: flex;
            background-color: rgb(255, 255, 255);
            box-shadow: 5px 5px 5px lightblue;
            color: rgb(0, 0, 0);
            flex-direction: column;
            justify-content: space-evenly;
            justify-items: center;
            align-items: center;
            font-family:  monospace;
            border-radius: 5px; 

        }
        form{
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        #submit
        {
            border:none;
            border-radius: 5px;
            color: rgb(0, 234, 133);
            background-color: rgb(0, 0, 0);
            margin-top: 15px;
            width: 80px;
            height: 20px;
            font-family: monospace;
            font-weight: bold;
        }
        #registration{
            border: 5px solid;
            border-radius: 20px;
            width: 600px;
            height: 300px;
            background-color: #fdfdfd;
            transition: 0.5s ease-out;
            overflow: hidden;
        }
        #registration:hover {
        content-visibility: visible;
        box-shadow: 10px 10px lightblue;
        height: 600px;
        width: 700px;
        }
        .form1{
            content-visibility: hidden;
            animation: 0.7s ease-out;
        }
        #registration:hover .form1{
            content-visibility: visible;
        }
        .regtext{
            content-visibility: visible;
            animation:0.5s ease-out;
            font-size: 5em;
        }
        #registration:hover .regtext{
            content-visibility: hidden;
            display: none;
        }
        .image{
            content-visibility: visible;
            animation:0.5s ease-out;
            font-size: 5em;
        }
        #registration:hover .image{
            content-visibility: hidden;
            display: none;
        }
        #cloud{
            color: white;
            text-shadow: 5px 5px #000000b4;
        }
        .termschk{
            display: inline-flex;
        }
        #box4{
            display:flex;
            justify-content:center;
            flex-direction:column;
            align-items:center;
            padding-left: 30%;
            padding-right:30%;
        }
        
    </style>
</head>
<body style="background-color: #C4FFDD;margin: 0;">

    <?php
    /*$Username1 = $_SESSION['username'];
    $Password = $_SESSION['password'];*/
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "info";


    if (isset($_POST["bgcolor"])) {
        $color = $_POST["bgcolor"];
        setcookie("bgColor", $color, 0, "/");
    }

    $UserName = $_SESSION['username'] ?? '';
    $PassWord = $_SESSION['password'] ?? '';
    $Email = $_SESSION['email'] ?? '';
    $City = $_SESSION['city'] ?? '';
    $Zipcode = $_SESSION['zcode'] ?? '';
    

    if (isset($_POST['confirmed'])) {
        //echo "<h2>Confirmed Successfully</h2>";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        //echo "<h3>$UserName</h3>";

        $sql = "INSERT INTO user(Username,Email,passs,Zipcode,city)
        VALUES('$UserName','$Email','$PassWord','$Zipcode','$City')";

        if ($conn->query($sql) === TRUE) {
            //echo "New record created successfully";
        }
        else{
            echo "Error";
        }
    }

    if (isset($_POST['cancelled'])) {
        session_unset();
        session_destroy();
        echo "<h2>Cancelled. Data discarded.</h2>";
    }
    
    if (isset($_POST["login"])){
    $Loginusername = $_POST['Loginusername'];
    $Loginpassword = $_POST['Loginpassword'];
    
    // Create database connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT Username, passs FROM user WHERE Username = ? AND passs = ?");
    $stmt->bind_param("ss", $Loginusername, $Loginpassword);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Login successful
        $_SESSION['username'] = $Loginusername;
        $_SESSION['logged_in'] = true;
        header("Location: Info.php");
        exit();
    } else {
        // Login failed
        echo "<div style='color: red; text-align: center; font-family: monospace;'>Invalid username or password!</div>";
    }
    
    $stmt->close();
    $conn->close();
}
    ?>








    <div style="display: flex;flex-wrap: wrap;justify-content: center;">
    <div style="width: 100%; margin: 0; padding: 0;height: 70px;">
    <div style="display: flex;justify-content: center;margin: 0;background-color: #2eff85;">
        <h3 style="font-family: monospace;font-weight: 20px;font-size: 4em;
    color: rgb(0, 0, 0);font-weight: bolder;
    margin-bottom: 10px;margin-top: 2px;">AQI APPLICATION <span id="cloud">☁︎</span> </h3>
    </div>
    </div>
    <div style="display: flex; justify-content: center; gap: 10px;">
        <div style="display: flex; flex-direction: column; gap: 10px;margin-top: 30px;">
            <div id="bg" style="border: 5px solid; width: 550px; height: 400px;background-color: #fdfdfd;border-radius: 20px;align-content: center;">
                <div id="table" >
                    <p style="display: flex;justify-content: center;font-weight: bold;font-size: 25px;margin: 0;">AQI DATA OF CITIES</p>
                    <table>
                        <tr>
                            <th>City</th>
                            <th>AQI</th>
                        </tr>
                        <tr>
                            <td>DHAKA</td>
                            <td>11</td>
                        </tr>
                        <tr>
                            <td>Chattogram</td>
                            <td>9</td>
                        </tr>
                        <tr>
                            <td>Sylhet</td>
                            <td>10</td>
                        </tr>
                        <tr>
                            <td>Rajshahi</td>
                            <td>9</td>
                        </tr>
                        <tr>
                            <td>Bogura</td>
                            <td>7.8</td>
                        </tr>
                        <tr>
                            <td>Khulna</td>
                            <td>8</td>
                        </tr>
                        <tr>
                            <td>Rangpur</td>
                            <td>8.2</td>
                        </tr>
                        <tr>
                            <td>Comilla</td>
                            <td>9.3</td>
                        </tr>
                        <tr>
                            <td>Pabna</td>
                            <td>7.8</td>
                        </tr>
                        <tr>
                            <td>Feni</td>
                            <td>8.8</td>
                        </tr>
                        
                    </table>
                </div>

            </div>
            <div style="border: 5px solid; width: 550px; height: 300px;background-color: #fdfdfd;border-radius: 20px;align-content: center;">box2</div>
        </div>
        <div style="display: flex; flex-direction: column; gap: 10px;margin-top: 30px;align-items: center;">
            <div id="registration">
                <span class="regtext" style="display: flex;justify-content: center; align-items: center;font-family: monospace;">REGISTRATION
                </span>
                <div style="display: flex; justify-content: center; align-items: center; margin-top: 10px;">
                <span class="image"><img src="image.png" alt="" style="width: 100px;height: 100px;"></span>
                </div>
                
                <form class="form1" id="form1" style="margin-top: 30px;" action="process.php" method="POST">
                    <label for="fname" style="margin: 5px;">FullName</label>
                    <input name="username" id="fname" type="text" style="margin: 5px;" placeholder="FullName"><span id="fnameerror"></span>
                    <label for="mail" style="margin-left: 5px;">email</label>
                    <input id="mail" type="email" style="margin: 5px;" placeholder="e-mail" name="email"><span id="emailerror"></span>
                    <label for="pass" style="margin: 5px;">Password</label>
                    <input id="pass" type="password" style="margin: 5px;" placeholder="Password" name="password"><span id="Passworderror"></span>
                    <label for="Cpass" style="margin: 5px;">Confirm Password</label>
                    <input id="Cpass" type="password" style="margin: 5px;" placeholder="Confirm_Password"><span id="confirmpassworderror"></span>
                    
                    <label for="zcode" style="margin: 5px;">Zipcode</label>
                    <input name="zip" id="zcode" type="text" style="margin: 5px; " placeholder="Zipcode" ><span id="ziperror"></span>
                    
                    <label for="city" style="margin: 5px;">Location</label>
                    <select name="city" id="city" style="box-shadow: 5px 5px 5px lightblue;">
                        <option value="Dhaka">Dhaka</option>
                        <option value="Chattogram">Chattogram</option>
                        <option value="Sylhet">Sylhet</option>
                        <option value="Rajshahi">Rajshahi</option>
                    </select>
                    <div class="termschk"><input name="check" id="terms" type="checkbox" style="margin-top: 20px;">
                    <label style="margin-top: 20px;margin-left: 10px;">Agree to terms and consditions</label></div>
                    <span id="termerror"></span>
                    
                    <input type="submit" id="submit" name="submit" value="submit"/>
                    

                </form>
            </div>


            <div style="border: 5px solid; width: 600px; height: 300px;background-color: #fdfdfd;border-radius: 20px;align-content: center;">
                <form action="index.php" method="POST">
                    <div id="box4">
                    <label for="fname" style="margin: 5px;">FullName</label>
                    <input name="Loginusername" id="fname" type="text" style="margin: 5px;" placeholder="FullName"><span id="fnameerror"></span>
                    <br>
                    <label for="pass" style="margin: 5px;">Password</label>
                    <input name="Loginpassword" id="pass" type="password" style="margin: 5px;" placeholder="Password"><span id="Passworderror"></span>
                    <br>
                    <label for="colorPicker" style="margin: 5px;">Choose Background Color</label>
                    <input type="color" name="bgcolor" id="colorPicker" style="margin: 5px;">
                    <br>
                    <input type="submit" id="submit" name="login" value="login"/>

                </div>
                </form>
            </div>
        </div>
    </div> 
    </div>  
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("form1");
  const fname = document.getElementById("fname");
  const fnameerror = document.getElementById("fnameerror");
  const email = document.getElementById("mail");
  const emailerror = document.getElementById("emailerror");
  const password = document.getElementById("pass");
  const passworderror = document.getElementById("Passworderror");
  const confirmpassword = document.getElementById("Cpass");
  const confirmpassworderror = document.getElementById("confirmpassworderror");
  const zipcode = document.getElementById("zcode");
  const ziperror = document.getElementById("ziperror");
  const terms = document.getElementById("terms");
  const termserror = document.getElementById("termerror");

  function checkName(name) {
    if (name.trim() === "") return false;
    return /^[A-Za-z.\s]+$/.test(name);
  }

  function checkEmail(em) {
    return /^[a-zA-Z0-9._%+-]+@aiub\.edu$/.test(em.trim());
  }

  function checkPass(pass) {
    return pass.length >= 5 && /^[A-Za-z\d.,?!@#%]+$/.test(pass);
  }

  function checkZip(zip) {
    return /^\d{4}$/.test(zip);
  }

  function validate() {
    let valid = true;

    if (!checkName(fname.value)) {
      fnameerror.textContent = "Please enter a valid name (letters, dots, spaces only)";
      valid = false;
    } else {
      fnameerror.textContent = "";
    }

    if (!checkEmail(email.value)) {
      emailerror.textContent = "Please enter a valid AIUB email (e.g., abc123@aiub.edu)";
      valid = false;
    } else {
      emailerror.textContent = "";
    }

    if (!checkPass(password.value)) {
      passworderror.textContent = "Password must be 5+ chars and contain allowed symbols (letters, digits, .,?!@#%)";
      valid = false;
    } else {
      passworderror.textContent = "";
    }

    if (confirmpassword.value !== password.value || confirmpassword.value === "") {
      confirmpassworderror.textContent = "Passwords do not match";
      valid = false;
    } else {
      confirmpassworderror.textContent = "";
    }

    if (!checkZip(zipcode.value)) {
      ziperror.textContent = "Zip code must be exactly 4 digits";
      valid = false;
    } else {
      ziperror.textContent = "";
    }

    if (!terms.checked) {
      termserror.textContent = "You must agree to terms and conditions";
      valid = false;
    } else {
      termserror.textContent = "";
    }

    return valid;
  }

  form.addEventListener("submit", function (e) {
    if (!validate()) {
      e.preventDefault();
    }
  });
  [fname, email, password, confirmpassword, zipcode].forEach(el => {
    el.addEventListener("input", validate);
  });
  terms.addEventListener("change", validate);
});
    </script> 
</body>
</html>