<?php
include 'connect.php';
doDB();

//Check that the topic id is set. If not, redirect to topic listings.
if (!isset($_GET['topic_id'])) 
{
	header("Location: forumTopicList.php");
	exit;
}

//Clean data for query:
$safe_topic_id = mysqli_real_escape_string($mysqli, $_GET['topic_id']);

//Check that the topic exists before proceeding.
$verify_topic_sql = "SELECT title FROM topics WHERE topic_id = '".$safe_topic_id."'";
$verify_topic_res =  mysqli_query($mysqli, $verify_topic_sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($verify_topic_res) < 1) 
{
	$display_block = "<p><em>You have selected an invalid topic.<br/>
	Please <a href=\"forumTopicList.php\">try again</a>.</em></p>";
}
else 
{
	//Topic exists, so grab title:
	while ($topic_info = mysqli_fetch_array($verify_topic_res)) 
	{
		$topic_title = stripslashes($topic_info['title']);
	}

	//Select and display posts:
	$get_posts_sql = "SELECT post_id, topic_id, content, DATE_FORMAT(date_posted, '%b %e %Y<br/>%r') AS fmt_post_create_time, owner FROM posts WHERE topic_id = '".$safe_topic_id."' ORDER BY fmt_post_create_time ASC";
	$get_posts_res = mysqli_query($mysqli, $get_posts_sql) or die(mysqli_error($mysqli));
	$display_block = <<<END_OF_TEXT
	<section class="col-12 col-m-12"><p>Showing posts for the topic: <strong>$topic_title</strong></p></section><br/>
	<section><table class="col-12 col-m-12">
	<tr>
	<th>AUTHOR</th>
	<th>POST</th>
	</tr>
END_OF_TEXT;

	while ($posts_info = mysqli_fetch_array($get_posts_res)) 
	{
		$post_id = $posts_info['post_id'];
		$post_text = nl2br(stripslashes($posts_info['content']));
		$post_create_time = $posts_info['fmt_post_create_time'];
		$post_owner = stripslashes($posts_info['owner']);
		$topic_id = $posts_info['topic_id'];
		
		//Add data to display block:
	 	$display_block .= <<<END_OF_TEXT
		<tr>
		<td>$post_owner<br/><br/>created on:<br/>$post_create_time</td>
		<td>$post_text<br/><br/>
		<a href="forumReplyToPost.php?post_id=$post_id"><strong>REPLY TO POST</strong></a></td>
		</tr>
END_OF_TEXT;
	}

	//Free up memory:
	mysqli_free_result($get_posts_res);
	mysqli_free_result($verify_topic_res);

	mysqli_close($mysqli);

	$display_block .= "</table></section>";
}
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
<h2>View Topic</h2>
<hr/>
<article class="col-12 col-m-12">
<?php echo $display_block; ?>
</article>
<hr/>
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