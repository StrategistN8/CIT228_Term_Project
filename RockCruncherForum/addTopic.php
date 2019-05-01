<?php
session_start();
?>

<?php
include 'connect.php';
doDB();

// Check required fields for content:
if ((!$_POST['owner']) || (!$_POST['title']) || (!$_POST['content'])) {
	header("Location: forumAddTopic.html");
	exit;
}

// Clean data for the database:
$clean_owner = mysqli_real_escape_string($mysqli, $_POST['owner']);
$clean_title = mysqli_real_escape_string($mysqli, $_POST['title']);
$clean_content = mysqli_real_escape_string($mysqli, $_POST['content']);

// First SQL query: Insert topic data:
$add_topic_sql = "INSERT INTO topics (title, date_posted, owner) VALUES ('".$clean_title ."', now(), '".$clean_owner."')";
$add_topic_res = mysqli_query($mysqli, $add_topic_sql) or die(mysqli_error($mysqli));

// Get the topic ID from the query:
$topic_id = mysqli_insert_id($mysqli);
$_SESSION["topic_id"] = $topic_id;
$_SESSION['title'] = $clean_title;
$_SESSION['content'] = $clean_content;

// Second SQL query: Insert post data:
$add_post_sql = "INSERT INTO posts (topic_id, content, date_posted, owner) VALUES ('".$topic_id."', '".$clean_content."',  now(), '".$clean_owner."')";
$add_post_res = mysqli_query($mysqli, $add_post_sql) or die(mysqli_error($mysqli));

mysqli_close($mysqli);

// Message for user:
$display_block = "<p>Your topic has been created! Click <a href='forumEditPost.php'>here</a> if you would like to make edits or <a href='forumDeletePost.php'>here</a> if you would like to delete the post.</p>";
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
<h2>Form Index</h2>
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