<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #confirm, #cancel {
            padding: 10px 20px;
            font-weight: bold;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            border: none;
            margin: 5px;
        }
        #confirm{
            background-color: #AAFF00;
            color: black;
        }
        #cancel{
            background-color:rgb(255, 82, 20);
            color: white;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        #container{
            padding: 20px;
            padding-left:50px;
            padding-right:50px;
            background-color:rgb(255, 239, 239);
            box-shadow: 5px 5px 5px lightblue;
            border-radius:15px;
        }

    </style>
</head>
<body>
    <div id="container">
    <?php
    if(isset($_POST["submit"]))
    {
        session_start();
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['zcode'] = $_POST['zip'];
        $_SESSION['city'] = $_POST['city'];
        $_SESSION['check'] = isset($_POST['check']);
        
        echo "<br>Email: ".$_POST['email'];
        echo "<br>Username: ".$_POST['username'];
        echo "<br>Password: ".$_POST['password'];
        
        echo "<br>Zipcode: ".$_POST['zip'];
        echo "<br>City: ".$_POST['city'];
        echo "<br>Terms_and_Conditions: ".$_POST['check'];

        


        /*$username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);
        $email = htmlspecialchars($_POST["email"]);**/
        
        /*echo"<p >USERNAME:$username</p>";
        echo"<p>PASSWORD:$password</p>";
        echo"<p>E-mail:$email</p>";*/
    }

    ?>
    <div class="buttons">
    <form method="POST" action="index.php">
    <input type="hidden" name="confirmed" value="yes">
    <button type="submit" name="confirm" id="confirm">Confirm</button>
    </form>

    <form method="POST" action="index.php">
    <input type="hidden" name="cancelled" value="yes">
    <button type="submit" name="cancel" id="cancel">Cancel</button>
    </form>
    </div>
</div>
    
</body>
</html>

