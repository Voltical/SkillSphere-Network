<?php
session_start();
include("database.inc.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "
    SELECT user.*, profiles.bio, profiles.hobbies, profiles.skills
    FROM user
    LEFT JOIN profiles ON user.id = profiles.user_id
    WHERE user.id = ?
";

$data = array($user_id);
$result = Database::getData($sql, $data);

if (!empty($result)) {
    $user = $result[0];
    $bio = !empty($user['bio']) ? $user['bio'] : 'No bio available.';
    $hobbies = !empty($user['hobbies']) ? $user['hobbies'] : 'No hobbies listed.';
    $skills = !empty($user['skills']) ? $user['skills'] : 'No skills listed.';
    $first_name = ucfirst(strtolower($user['fname']));
    $last_name = ucfirst(strtolower($user['lname']));
    $username = $first_name . ' ' . $last_name;
    $profile_picture = !empty($user['profile_picture']) ? htmlspecialchars($user['profile_picture']) : '../images/jp_balkenende.jpg';
} else {
    $bio = 'No bio available.';
    $hobbies = 'No hobbies listed.';
    $skills = 'No skills listed.';
    $username = 'Unknown User';
    $profile_picture = '../images/jp_balkenende.jpg';
}

// Update profile details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updated_bio = $_POST['bio'];
    $updated_hobbies = $_POST['hobbies'];
    $updated_skills = $_POST['skills'];

    $update_sql = "
        UPDATE profiles
        SET bio = ?, hobbies = ?, skills = ?
        WHERE user_id = ?
    ";

    $update_data = array($updated_bio, $updated_hobbies, $updated_skills, $user_id);
    Database::executeQuery($update_sql, $update_data);

    header("Location: profile.php"); // Redirect to the profile page after saving changes
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>

    <!-- Custom Css -->
    <link rel="stylesheet" href="../css/dashboard.css">

    <!-- Favicon -->
    <link rel="icon" href="../images/favicon-32x32-circle.png">

    <!-- FontAwesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
</head>
<body>
    <!-- Navbar top -->
    <div class="navbar-top">
        <div class="title">
            <h1>Profile</h1>
        </div>

        <!-- Navbar -->
        <ul>
            <li>
                <a href="#message">
                    <span class="icon-count">29</span>
                    <i class="fa fa-envelope fa-2x"></i>
                </a>
            </li>
            <li>
                <a href="#notification">
                    <span class="icon-count">59</span>
                    <i class="fa fa-bell fa-2x"></i>
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <i class="fa fa-sign-out-alt fa-2x"></i>
                </a>
            </li>
        </ul>
        <!-- End -->
    </div>
    <!-- End -->

    <!-- Sidenav -->
    <div class="sidenav">
        <div class="profile">
            <!-- Show profile picture -->
            <img src="<?php echo $profile_picture; ?>" alt="Profile Picture" width="100" height="100">

            <div class="name">
                <?php echo htmlspecialchars($username); ?>
            </div>
            <div class="job">
                Forum Member
            </div>
        </div>

        <div class="sidenav-url">
            <div class="url">
                <a href="#profile" class="active">Profile</a>
                <hr align="center">
            </div>
            <div class="url">
                <a href="#settings">Settings</a>
                <hr align="center">
            </div>
        </div>
    </div>
    <!-- End -->

    <!-- Main -->
    <div class="main">
        <h2>IDENTITY</h2>
        <div class="card">
            <div class="card-body">
                <i class="fa fa-pen fa-xs edit"></i>
                <table>
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($username); ?></td>
                        </tr>
                        <tr>
                            <td>Bio</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($bio); ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td>Bali, Indonesia</td>
                        </tr>
                        <tr>
                            <td>Hobbies</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($hobbies); ?></td>
                        </tr>
                        <tr>
                            <td>Job</td>
                            <td>:</td>
                            <td>Web Developer</td>
                        </tr>
                        <tr>
                            <td>Skill</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($skills); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <h2>SOCIAL MEDIA</h2>
        <div class="card">
            <div class="card-body">
                <i class="fa fa-pen fa-xs edit"></i>
                <div class="social-media">
                    <span class="fa-stack fa-sm">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-facebook fa-stack-1x fa-inverse"></i>
                    </span>
                    <span class="fa-stack fa-sm">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                    </span>
                    <span class="fa-stack fa-sm">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-instagram fa-stack-1x fa-inverse"></i>
                    </span>
                    <span class="fa-stack fa-sm">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-invision fa-stack-1x fa-inverse"></i>
                    </span>
                    <span class="fa-stack fa-sm">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                    </span>
                    <span class="fa-stack fa-sm">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-whatsapp fa-stack-1x fa-inverse"></i>
                    </span>
                    <span class="fa-stack fa-sm">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-snapchat fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- End -->

    <script>
        function toggleEditForm() {
            var form = document.getElementById('edit-form');
            var profileView = document.getElementById('profile-view');
            if (form.style.display === "none") {
                form.style.display = "block";
                profileView.style.display = "none";
            } else {
                form.style.display = "none";
                profileView.style.display = "block";
            }
        }
    </script>
</body>
</html>
