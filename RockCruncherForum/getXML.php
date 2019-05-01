<?php
include 'connect.php';
doDB();

$get_user_info = "SELECT id, username, email FROM authetication";
$get_user_info_res = mysqli_query($mysqli, $get_user_info) or die($mysqli_error);

$xml = "<users>";
while ($r = mysqli_fetch_array($get_user_info_res))
{
    $xml .= "<user>";
    $xml .= "<id>".$r['id']."</id>";
    $xml .= "<userName>".$r['username']."</userName>";
    $xml .= "<email>".$r['email']."</email>";
    $xml .= "</user>";
}
$xml .= "</users>";

//Free up memeory:
mysqli_free_result($get_user_info_res);

//Close query:
mysqli_close($mysqli);

$sxe = new SimpleXMLElement($xml);
$sxe->asXML("users.xml");

$display_block = "<p>An XML file has been created.<br/> Would you like to <a href='readXML.php'>view</a> it now?</p>"
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
<h2>XML Generator</h2>
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
