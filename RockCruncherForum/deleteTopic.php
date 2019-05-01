<?php
session_start();
?>

<?php
include 'connect.php';
doDB();

$saved_id = $_SESSION['topic_id'];

// Delete data from the topics database:
$del_topic_sql = "DELETE FROM topics WHERE topic_id = $saved_id;";
$del_topic_res = mysqli_query($mysqli, $del_topic_sql) or die(mysqli_error($mysqli));

// Delete data from the posts database:
$del_post_sql = "DELETE FROM posts WHERE topic_id = $saved_id;";
$del_post_res = mysqli_query($mysqli, $del_post_sql) or die(mysqli_error($mysqli));

$display_block = "<p><em>Topic deleted</em><br/>";
$display_block .= "<a href='forumIndex.html'>Return to Index</a></p>";

//Disconnect: 
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
        <li><a href=https://lisabalbach.com/lyons41/CIT190/FinalProject/landing.html>Home</a></li>
        <li><a href="forumIndex.html">Forum Index</a></li>
        <li><a href="https://lisabalbach.com/lyons41/CIT190/FinalProject/about.html">About</a></li>
        </ul>
   </nav>
</header>
<h2>Delete Topic</h2>
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
