<?php
session_start();
?>
<?php
include 'connect.php';
doDB();

	//haven't seen the selection form, so show it
	$display_block = "<h3 style='margin-left:5%;'>Confirm Deletion</h3>";
	$saved_id = $_SESSION['topic_id'];
	//get parts of records
	$get_list_sql = "SELECT * FROM topics WHERE topic_id = $saved_id;";
	$get_list_res = mysqli_query($mysqli, $get_list_sql) or die(mysqli_error($mysqli));

	if (mysqli_num_rows($get_list_res) < 1) {
		//no records
		$display_block .= "<p><em>There was an error retrieving the topic!</em></p>";

	} else {
		//has a record, so display results for confirmation
		$rec = mysqli_fetch_array($get_list_res);
		$display_title = stripslashes($rec['title']);
		$display_block .= "<p style='margin-left:10%;'>Do you wish to delete the topic:  ".$display_title."?<br/>";
		$display_block .= "<a href='deleteTopic.php'>Delete</a> | ";
		$display_block .= "<a href='discussionMenu.html'>Cancel</a></p>";
	}
	//free result
	mysqli_free_result($get_list_res);

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
