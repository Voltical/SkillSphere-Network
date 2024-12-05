<?php
session_start();
include("database.inc.php");


function checkPost() {
	foreach($_POST as $key => $value) {
		$_POST[$key] = htmlentities(trim(strip_tags($value)));
	}
}

if (isset($_POST['frmLogin'])) {
	echo 2;
	checkPost();
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
		echo 3;
        $sql = "SELECT * FROM user WHERE email = ?";
        $data = array($email);
        $result = Database::getData($sql, $data);
        if (!empty($result)) {
			echo 4;
            $hashed_password_from_db = $result[0]['password'];

            var_dump($password);
            var_dump($hashed_password_from_db);

            if (password_verify($password, $hashed_password_from_db)) {
                $_SESSION['user_id'] = $result[0]['id'];
                header("Location: profile.php");
                exit();
            } else {
                echo "<p style='color:red;'>Ongeldig wachtwoord.</p>";
            }
        } else {
            echo "<p style='color:red;'>Ongeldige email of wachtwoord.</p>";
        }
    } else {
        echo "<p style='color:red;'>Vul alstublieft een email en wachtwoord in.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillBuddy | Log In</title>
    <link rel="stylesheet" href="../css/auth.css">
    <link rel="icon" href="../images/favicon-32x32-circle.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="icon" href="../images/favicon-32x32-circle.png">
</head>
<body>
<style>
    .success-message {
        color: green;
        font-weight: bold;
        text-align: center;
        background-color: #eaf7ea;
        border: 1px solid #d4e5d4;
        padding: 10px;
        border-radius: 5px;
        margin: 20px auto;
        max-width: 400px;
        font-size: 16px;
    }
</style>
    <div class="session">
        <div class="left">
            <?xml version="1.0" encoding="UTF-8"?>
            <svg enable-background="new 0 0 300 302.5" version="1.1" viewBox="0 0 300 302.5" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                <style type="text/css">.st01{fill:#fff;}</style>
                <path class="st01" d="m126 302.2c-2.3 0.7-5.7 0.2-7.7-1.2l-105-71.6c-2-1.3-3.7-4.4-3.9-6.7l-9.4-126.7c-0.2-2.4 1.1-5.6 2.8-7.2l93.2-86.4c1.7-1.6 5.1-2.6 7.4-2.3l125.6 18.9c2.3 0.4 5.2 2.3 6.4 4.4l63.5 110.1c1.2 2 1.4 5.5 0.6 7.7l-46.4 118.3c-0.9 2.2-3.4 4.6-5.7 5.3l-121.4 37.4zm63.4-102.7c2.3-0.7 4.8-3.1 5.7-5.3l19.9-50.8c0.9-2.2 0.6-5.7-0.6-7.7l-27.3-47.3c-1.2-2-4.1-4-6.4-4.4l-53.9-8c-2.3-0.4-5.7 0.7-7.4 2.3l-40 37.1c-1.7 1.6-3 4.9-2.8 7.2l4.1 54.4c0.2 2.4 1.9 5.4 3.9 6.7l45.1 30.8c2 1.3 5.4 1.9 7.7 1.2l52-16.2z"/>
            </svg>
        </div>
        <form action="" method="POST" class="log-in" autocomplete="off"> 
    <h4>Welcome back to <span>SkillBuddy!</span></h4>
    <p>Log in to access your account.</p>

    <div class="floating-label">
        <div class="icon">
            <i class="fas fa-envelope"></i>
        </div>
        <input placeholder="Email" type="email" name="email" id="email" autocomplete="off" required>
        <label for="email">Email:</label>
    </div>

    <div class="floating-label">
        <div class="icon">
            <i class="fas fa-lock"></i>
        </div>
        <input placeholder="Password" type="password" name="password" id="password" autocomplete="off" required>
        <label for="password">Password:</label>
    </div>

    <button type="submit">
        <i class="fas fa-sign-in-alt"></i> Log In
    </button>
    <?php
    if (isset($_GET['signup']) && $_GET['signup'] === 'success') {
    echo "<div class='success-message'>Account succesvol aangemaakt! Je kan nu inloggen.</div>";
    }
    ?>

    <p style="font-size:17px;">Don't have an account yet?<br><a href="signup.php">Sign Up</a></p>

        </form>
    </div>
</body>
</html>