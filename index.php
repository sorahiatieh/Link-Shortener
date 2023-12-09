<?php
    require_once "config/loader.php";

    if(isset($_POST['submit'])){
        $custom=$_POST['custom_link'];
        $endpoint=$_POST['endpoint_link'];

        $q="SELECT * FROM tbl_links WHERE custom_link=?";
        $hasLink=$conn->prepare($q);
        $hasLink->bindValue(1,$custom);
        $hasLink->execute();

        if(!$hasLink->rowCount()){
            $q="INSERT INTO tbl_links SET custom_link=? , endpoint_link=?";
            $result=$conn->prepare($q);
            $result->bindValue(1,$custom);
            $result->bindValue(2,$endpoint);
            $result->execute();

            echo  '<p class="alert alert-success">Your link is: '.$custom.'</p>';
        }else echo '<p class="alert alert-danger">Link is Alerday exists'.$endpoint.'</p>';
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>URL Shortner</title>
</head>
<body>
<h2 class="title">Link Shortener</h2>

<form id="shorten-form" method="post">
    <input type="url" name="endpoint_link" id="shorten-input" placeholder="Enter your link" required>
    <input type="url" name="custom_link" id="shorten-input" value="https://localhost/link?url=" placeholder="Enter your link" required>
    <button type="submit" name="submit" id="shorten-button"> cut short</button>
</form>

<div id="shorten-result"></div>

<script src="script.js"></script>
</body>
</html>