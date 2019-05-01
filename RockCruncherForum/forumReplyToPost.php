<?php
include 'connect.php';
doDB();

// Check for viewing or replying:
if (!$_POST) {
   // Reply:
   if (!isset($_GET['post_id'])){
      header("Location: forumTopicList.php");
      exit;
      
   }

   $safe_post_id = mysqli_real_escape_string($mysqli, $_GET['post_id']);

   //Verify topic and post
   $verify_sql = "SELECT ft.topic_id, ft.title, fp.topic_id
                  FROM posts AS fp LEFT JOIN topics AS ft ON fp.topic_id =
                  ft.topic_id WHERE fp.post_id = '".$safe_post_id."'";

   $verify_res = mysqli_query($mysqli, $verify_sql)
                 or die(mysqli_error($mysqli));

   if (mysqli_num_rows($verify_res) < 1) {
      header("Location: forumTopicList.php");
      exit;
   } else {
  
      while($topic_info = mysqli_fetch_array($verify_res)) {
         $topic_id = $topic_info['topic_id'];
         $topic_title = stripslashes($topic_info['title']);
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
<h2>Reply to topic</h2>
<hr/>
<section class="col-12 col-m-12">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <p><label for="owner">Your Email Address:</label><br/>
      <input type="email" id="owner" name="owner" size="40"
         maxlength="150" required="required"></p>
      <p><label for="content">Post Text:</label><br/>
      <textarea id="content" name="content" rows="8" cols="40"
         required="required"></textarea></p>
  <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">
      <button type="submit" name="submit" value="submit">Add Post</button>
</form>
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
<?php
      //free result
      mysqli_free_result($verify_res);

      //close connection to MySQL
      mysqli_close($mysqli);
   }

} else if ($_POST) {
      //check for required items from form
      if ((!$_POST['topic_id']) || (!$_POST['content']) ||
          (!$_POST['owner'])) {
         //  header("Location: forumTopicList.php");
         //  exit;
         echo ($_POST['topic_id']);
         echo ($_POST['content']);
         echo ($_POST['owner']);
      }

      //create safe values for use
      $safe_topic_id = mysqli_real_escape_string($mysqli, $_POST['topic_id']);
      $safe_content = mysqli_real_escape_string($mysqli, $_POST['content']);
      $safe_owner = mysqli_real_escape_string($mysqli, $_POST['owner']);

      //add the post
      $add_post_sql = "INSERT INTO posts (topic_id, content,
                       date_posted, owner) VALUES
                       ('".$safe_topic_id."', '".$safe_content."',
                       now(),'".$safe_owner."')";
      $add_post_res = mysqli_query($mysqli, $add_post_sql)
                      or die(mysqli_error($mysqli));

      //close connection to MySQL
      mysqli_close($mysqli);

      //redirect user to topic
      header("Location: forumShowTopic.php?id=".$_POST['topic_id']);
      exit;
}
?>

