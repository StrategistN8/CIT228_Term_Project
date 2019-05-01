<?php
session_start();
?>

<?php
include 'connect.php';
doDB();

// Check required fields for content:
if ((!$_POST['username']) || (!$_POST['email']) || (!$_POST['password']) || (!$_POST['fName']) || (!$_POST['lName']))
{
	header("Location: register.html");
	exit;
}

// Clean data for the database:
$clean_user = mysqli_real_escape_string($mysqli, $_POST['username']);
$clean_email = mysqli_real_escape_string($mysqli, $_POST['email']);
$clean_password = mysqli_real_escape_string($mysqli, $_POST['password']);
$clean_fN = mysqli_real_escape_string($mysqli, $_POST['fName']);
$clean_lN = mysqli_real_escape_string($mysqli, $_POST['fName']);

// First SQL query: Insert topic data:
$add_user_sql = "INSERT INTO authetication (username, email, password, firstName, lastName) VALUES ('".$clean_user ."', '".$clean_email."', '".$clean_password."', '".$clean_fN."', '".$clean_lN."')";
$add_user_res = mysqli_query($mysqli, $add_user_sql) or die(mysqli_error($mysqli));

mysqli_close($mysqli);

// Message for user:
$display_block = "<p>You have been registered! Click <a href='forumLogin.html'>here</a> to log in.</p>";
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
        <li><a href=https://lisabalbach.com/lyons41/CIT190/FinalProject/landing.html>Home</a></li>
        <li><a href="forumIndex.html">Forum Index</a></li>
        <li><a href="https://lisabalbach.com/lyons41/CIT190/FinalProject/about.html">About</a></li>
        </ul>
   </nav>
</header>
<h2>Registration</h2>
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