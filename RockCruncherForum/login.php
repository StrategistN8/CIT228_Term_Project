<?php
// Check form is filled in:
if (($_POST['username']=="") || ($_POST['password']==""))
{
    header("Location: forumLogin.html");
    exit;
}

$display_block="";

// Connect: 
//$mysqli = mysqli_connect("localhost", "root", "", "forumDB");
$mysqli = mysqli_connect("localhost", "lisabalbach_lyons41", "CIT190135", "lisabalbach_Lyons");

// Clean Data: 
$safe_username = mysqli_real_escape_string($mysqli, $_POST['username']);
$safe_password = mysqli_real_escape_string($mysqli, $_POST['password']);

// Create SQL Query to check username:
$sql = "SELECT username FROM authetication WHERE username = '".$safe_username."' AND password = '".$safe_password."'";  // Mysql isn't liking the AND operator for some reason, so using a work-around:
$res = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

// Create SQL Query to check password:
// $pwsql = "SELECT password FROM authetication WHERE password = '".$safe_password."'";
// $pwres = mysqli_query($mysqli, $pwsql) or die(mysqli_error($mysqli));

$modsql = "SELECT m.username, m.email, u.email FROM moderators AS m JOIN authetication AS u ON u.email = m.email WHERE m.username = '".$safe_username."'";
$modres = mysqli_query($mysqli, $modsql) or die(mysqli_error($mysqli));

// Check if data matches: 

    if (mysqli_num_rows($res) == 1) 
    {
        $_SESSION['mod'] = 'false';
        header("Location: ../RockCruncherForum/forumIndex.html");
        exit;
    }

//  if (mysqli_num_rows($res) == 1 && mysqli_num_rows($pwres) == 1 && mysqli_num_rows($modres) == 1)
// {
//     $_SESSION['mod'] = 'true';
//     header("Location: ../RockCruncherForum/modIndex.html");
//     exit;
// }
// else if (mysqli_num_rows($res) == 1 && mysqli_num_rows($pwres) == 1) 
// {
//     $_SESSION['mod'] = 'false';
//     header("Location: ../RockCruncherForum/forumIndex.html");
//     exit;
// }
else
{
    $display_block = "<p><em>Invalid login information.</em> Please check your input and try again. If you continue to have problems logging in, please contact administration.<br/>
    <a href='forumLogin.html'>Return to login</a></p>";
}

//End Connection: 
mysqli_close($mysqli);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset=utf-8 />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rock Crunchers</title>
    <meta name="description" content="Website created for CIT228 final project." />
    <meta name="keywords" content="games, assignment, CIT228, NMC, northwestern michigan collage" />
    <link rel="stylesheet" href="css/final.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
</head>

<body>
<header id="navigation" class="col-12 col-m-12">
    <nav class="col-6 col-m-6">
        <h1>Rock Crunchers</h1>
        <h3>Forum</h3>
        <hr/>
        <ul> 
        <li><a href=../lyons41/CIT190/FinalProject/landing.html>Home</a></li>
        <li><a href="forumIndex.html">Forum Index</a></li>
        <li><a href=../lyons41/CIT190/FinalProject/about.html>About</a></li>
        </ul>
   </nav>
</header>
<h2>Forum Login</h2>
<hr/>
<section class="col-12 col-m-12">
<?php echo $display_block; ?>
</section>

<footer class="col-12 col-m-12">
    <div class=icons>
        <a href="https://www.facebook.com/CIT.NMC/?ref=bookmarks"><i class="fab fa-facebook-square"></i></a>
        <a href="https://twitter.com/NMC_CIT"><i class="fab fa-twitter-square"></i></a>
        <a href="https://twitter.com/NMC_CIT"><i class="fab fa-linkedin"></i></a>
    </div>
    <small>&copy; Jim Lyons 2019-2020.</small>
</footer>
</body>
</html>
