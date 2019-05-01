<?php
session_start();
?>

<?php
include 'connect.php';
doDB();

// If not posting, display records from the database:
if (!$_POST) 
{
	//Menu Block:
	$display_block = "<h3>Edit Post</h3>";
	$saved_id = $_SESSION['topic_id'];
	$saved_title = $_SESSION['title'];
	$saved_post_text = $_SESSION['content'];
	
	// Retrieve Records from the database:
	$get_topic_sql = "SELECT * FROM topics WHERE topic_id = $saved_id;";
	$get_topic_res = mysqli_query($mysqli, $get_topic_sql) or die(mysqli_error($mysqli));
    
	$get_post_sql = "SELECT * FROM posts WHERE topic_id = $saved_id;";
	$get_post_res = mysqli_query($mysqli, $get_post_sql) or die(mysqli_error($mysqli));

	if (mysqli_num_rows($get_topic_res) < 1) 
	{
		$display_block .= "<p><em>Unable to fetch records.</em></p>";
	} 
	else 
	{
		// Display Data for update:
		$rec = mysqli_fetch_array($get_topic_res);
		$display_id = stripslashes($rec['topic_id']);
		$display_title = stripslashes($rec['title']);
		$display_block .= "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
		$display_block .="<p>Topic Title: <input type='text' id='title' name='title' value='".$display_title."'></p>";
		$postRec = mysqli_fetch_array($get_post_res);
		$display_post = stripslashes($postRec['post_text']);
		$display_block .="<p>Post Text: <textarea  style='vertical-align:text-top;' id='content' name='content'>".$display_post."</textarea></p>";
		$display_block .= "<button type='submit' id='change' name='change' value='change'>Change entry</button></p>";
		$display_block .="</form>";
	}
	//Free up memeory:
	mysqli_free_result($get_post_res);
	mysqli_free_result($get_topic_res);
}

// If posting new data to the database: 
else
{
	$clean_topic_title = mysqli_real_escape_string($mysqli, $_POST['title']);
	$clean_post_text = mysqli_real_escape_string($mysqli, $_POST['content']);

	//SQL query for updating the title: 
	$update_topic_sql = "UPDATE topics SET title = '".$clean_topic_title ."' WHERE topic_id =".$_SESSION['topic_id'];
	$update_topic_res = mysqli_query($mysqli, $update_topic_sql) or die(mysqli_error($mysqli));

	//SQL query for updating the content:
	$update_post_sql = "UPDATE posts SET content='" .$clean_post_text."' WHERE topic_id= ".$_SESSION['topic_id'];
	$update_post_res = mysqli_query($mysqli, $update_post_sql) or die(mysqli_error($mysqli));

	//Close query:
	mysqli_close($mysqli);

	// Message for user:
	$display_block ="<h3>Edits Complete!</h3><br/>   ";
	$display_block.="<p style='margin-left:10%;'>The topic title: <strong><em>".$clean_topic_title."</em></strong><br>";
	$display_block.="The topic text: <strong><em>".$clean_post_text."</em></strong></p>";

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
<h2>Edit Post</h2>
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