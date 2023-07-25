<?php
 session_start();
 $conn = mysqli_connect("localhost","root","","HotelBook");
 if(isset($_POST["submit"])) 
 {
  $email = isset($_SESSION["Email"]) ? $_SESSION["Email"] : "Anonymous";
  $name = isset($_SESSION["FName"]) && isset($_SESSION["MName"]) && isset($_SESSION["LName"]) ? $_SESSION["FName"] . " " . $_SESSION["MName"] . " " . $_SESSION["LName"] : "Anonymous";
  
     $review = $_POST["review"];
 
     // Check if any files were uploaded
     if(isset($_FILES["img"])) {
         $fileCount = count($_FILES["img"]["name"]);
         $imagePath="";
 
         // Loop through each uploaded file
         for($i = 0; $i < $fileCount; $i++) {
             $imag = $_FILES["img"]["name"][$i];
             $tmpFilePath = $_FILES["img"]["tmp_name"][$i];
             $path = "images/reviews/" . $imag;
 
             // Move the uploaded file to the desired location
             if(move_uploaded_file($tmpFilePath, $path)) {
              $imagePath.=$path.";";
             }
              else {
                // Handle the case where file upload failed
                echo "File upload failed.";
            }
        }

        // Remove the trailing delimiter from the concatenated image paths
        $imagePath = rtrim($imagePath, ";");

                 // Insert the file path into the database
                 $sql = "INSERT INTO review (Email,Name, review, image) VALUES ('$email','$name','$review', '$imagePath')";
                 $res = mysqli_query($conn, $sql);
             } else {
                 // Handle the case where file upload failed
                 echo "File upload failed.";
             }
         }
     
 
 $sql2="SELECT*FROM review";
 $res=mysqli_query($conn, $sql2);
 if($res)
 {
  if(mysqli_num_rows($res) > 0)
  {
 while($row=mysqli_fetch_assoc($res))
 {
  $imagePath = $row['image'];
  echo "<div class='row'>
  <div class='col-md-3'></div>
  <div class='col-md-6 well weell'>
      <p>" . $row['Name'] . "</p>
      <p>" . $row['review'] . "</p>";
      $pathArray=explode(";",$imagePath);
      foreach($pathArray as $path)
      {
      echo "<img src='" . $path. "' class='img'>";
      }
 echo "</div>
</div>";

        
 }
}
 }

 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Hotel Booking</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></scrip>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&display=swap" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&family=Cinzel+Decorative&family=Cinzel:wght@400;500&family=Orbitron:wght@500&family=Playfair:ital,wght@0,400;1,500&display=swap" rel="stylesheet">
<style>
html {
  box-sizing: border-box;
   /* overflow-y: scroll; */
  height:fit-content;
  width:100%;
  overflow-x: hidden;
  display:flex;
  flex-wrap: wrap;
  flex-direction: column;
}
body::-webkit-scrollbar{
  display: none;
}

*, *:before, *:after {
  box-sizing:inherit;
}
     h1{
 
 font-family: 'Bruno Ace SC', cursive;
  
 font-size: 140px;
 font-weight:500;
 -webkit-text-fill-color: transparent;
 -webkit-text-stroke-width: 2px;
 -webkit-text-stroke-color:hsla(12, 94%, 50%, 0.877);
 text-align:center;
 /* padding: 20px; */
 text-shadow: 1px 1px 10px rgba(250, 82, 4, 0.671);
 width:100%;
  height:180px;
  
 }
 .well {
            background: rgba(0, 0, 0, 0.5);
            border: none;
           
        }
        
        body {
            background-image: url('images/home_gallary/2.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
            margin: 0px;
        }
        .img
        {
          height: 200px;
          width: 200px;
          margin-left: 20px;
          margin-bottom: 20px;
          // float:left;
        }
        .weell{
            position: relative;
            top:500px;
        } 
        .fix{
            position:absolute;
            top:-0px;
            left:200px;
            /* margin-left:20px; */
        }
        </style>
  </head>
  <body>
    <div class="container fix">
      
      
     <h1 class="well">La Sereno</h1>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li ><a href="register.php">SignUp</a></li>
                    <li><a href="roomDetails.php">Room &amp; Facilities</a></li>
                    <li ><a href="avail.php">Online Reservation</a></li>
                    <li class="active"><a href="review.php">Review</a></li>

                   <li><a href="admin.php">Admin</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="http://www.facebook.com"><img src="images/facebook.png"></a></li>
                    <li><a href="http://www.twitter.com"><img src="images/twitter.png"></a></li>                    
                </ul>
            </div>
        </nav>
    
        
       <div class='row'>
        <div class='col-md-4'></div>
        <div class='col-md-5 well'>
         <form action="" method="post" enctype="multipart/form-data">
              
              
               <div class="form-group">
                    
                    <input type="text" name="review">

                </div>
               
               <div class="form-group">
                    <label for="upload">Upload Image:</label>&nbsp;&nbsp;
                    <input type="file" name="img[]" multiple>
                    <button type="submit" class="btn btn-primary button" name="submit">Submit</button>
                </div>
                </form>