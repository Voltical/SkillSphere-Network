<?php
session_start();
include("database.inc.php");

print_r($_SESSION);

function checkPost() {
	foreach($_POST as $key => $value) {
		$_POST[$key] = htmlentities(trim(strip_tags($value)));
	}
}
echo "start";
print_r($_POST);

if (isset($_POST['frmLogin'])) {
	echo 2;
	checkPost();

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
		echo 3;
        // Prepared statement om de gebruiker op te halen
        $sql = "SELECT * FROM user WHERE email = ?";
        $data = array($email);
        $result = Database::getData($sql, $data);
print_r($result);
        if (!empty($result)) {
			echo 4;
            // Haal de opgeslagen hash op
            $hashed_password_from_db = $result[0]['password'];

            // Debugging: Toon het wachtwoord en de opgeslagen hash
            var_dump($password);
            var_dump($hashed_password_from_db);

            // Verifieer het wachtwoord
            if (password_verify($password, $hashed_password_from_db)) {
                // Wachtwoord is correct
                $_SESSION['user_id'] = $result[0]['id'];
                header("Location: profile.php"); // Redirect naar profile
                exit();
            } else {
                // Wachtwoord is niet correct
                echo "<p style='color:red;'>Ongeldig wachtwoord.</p>";
            }
        } else {
            // Geen gebruiker gevonden
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
    <title>SkillBuddy | Login</title>
    <link rel="stylesheet" href="../css/auth.css">
    <link rel="icon" href="../images/favicon-32x32-circle.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
    <div class="session">
        <div class="left">
            <!-- Left Section (SVG or image) -->
            <!-- Je kunt hier een afbeelding of een andere SVG plaatsen -->
        </div>
        <form action="" method="post" class="log-in" autocomplete="off"> 
            <h4>Welcome back to <span>SkillBuddy!</span></h4>
            <p>Login to view and create new posts!</p>

            <div class="floating-label">
                <div class="icon">
                    <i class="fas fa-envelope"></i> <!-- Email Icon -->
                </div>
                <input placeholder="Email" type="email" name="email" id="email" autocomplete="off" required>
                <label for="email">Email:</label>
            </div>

            <div class="floating-label">
                <div class="icon">
                    <i class="fas fa-lock"></i> <!-- Password Icon -->
                </div>
                <input placeholder="Password" type="password" name="password" id="password" autocomplete="off" required>
                <label for="password">Password:</label>
            </div>
				<input type="hidden" name="frmLogin" value="frmLogin"/>
            <button type="submit">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
			
			<p>Don't have an account?<br><a href="signup.php">Sign Up</a></p>
			
        </form>
    </div>
</body>
</html>
