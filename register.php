<?php

  if(isset($_POST["signup"]))
  {
    $conn=mysqli_connect("localhost","root","","HotelBook");
    $Fname=$_POST["Fname"];
    $Mname=$_POST["Mname"];
    $Lname=$_POST["Lname"];
    $DOB=$_POST["dob"];
    $address=$_POST["address"];
    $phno=$_POST["phno"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $path="images/users/$email.jpeg";
    $sql="insert into register values('$Fname','$Mname','$Lname','$DOB','$address',$phno,'$email','$password','$path')";

     if($_SERVER["REQUEST_METHOD"]=="POST")

     {
    if(isset($_FILES["img"])&& $_FILES["img"]["error"]==0)
    {
      $valid=["jpg"=>"image/jpg","png"=>"image/png","jpeg"=>"image/jpeg","jfif"=>"image/jfif"];
      $type=$_FILES["img"]["type"];
      $fname=$_FILES["img"]["name"];
      $size=$_FILES["img"]["size"];
      $ext=pathinfo($fname,PATHINFO_EXTENSION);
      if(!array_key_exists($ext,$valid))
      {
        die("Not a valid extension");
      }
      $orsize=2*1024*1024;
      if($size>$orsize)
      {
        die("please select valid size");
      }
      if(in_array($type,$valid))
      {
        if(file_exists("images/users/".$fname))
        {
          echo "file already exists";
        }
        else{
          move_uploaded_file($_FILES["img"]["tmp_name"],"images/users/".$email.".jpg");
        }
      }
      else
      {
        echo "not image";
      }
    }
    }
    $res=mysqli_query($conn,$sql);
    
   if($res)
{     
  // echo "<script>alert('Registered Successfully')</script>";
  session_start();
  $_SESSION["Email"]=$email;
  $_SESSION["FName"]=$Fname;
  $_SESSION["MName"]=$Mname;
  $_SESSION["LName"]=$Lname;
  // session_status()=true;
  header('location:index.php');
      // exit();
    }
    
    else{
      echo "<script>alert('Please fill required details')</script>";
      // header('location:index.html');
    }
    // $data=true;
   
  }


?>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hotel</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&family=Cinzel+Decorative&family=Cinzel:wght@400;500&family=Orbitron:wght@500&family=Playfair:ital,wght@0,400;1,500&display=swap" rel="stylesheet">
  <script src="js/bootstrap.min.js"></script>
  <!-- <link rel="stylesheet"href="signup.css"> -->
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
body {
            background-image: url('images/home_bg.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        h1{
font-family: 'Cinzel Decorative', cursive;
 font-size: 140px;  
 text-align:center;
 -webkit-text-fill-color: #f49393;
-webkit-text-stroke-width: 1px;
-webkit-text-stroke-color:hsla(10, 50%, 50%, 0.77);
 text-shadow: 1px 1px 10px rgba(250, 82, 4, 0.671);
 width:100%;
  height:180px;
  color: #f49393;
 }
 form {
    width: 500px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    
  }
  table {
    width: 100%;
  }
  
  table td {
    padding: 10px;
  }
  
  input[type="text"],
  input[type="password"],
  input[type="email"],
  input[type="date"],
  input[type="file"]
   {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
    margin-bottom: 10px;
  }
  input[type="submit"] {
    width: 100%;
    background-color: #4CAF50;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
  }
  
  a {
    color: #897df2;
  }
  
  .well {
            background: rgba(0, 0, 0, 0.5);
            border: none;
            /* height: 250px; */
        }
        h2{
font-family: 'Cinzel', serif;
font-family: 'Cinzel Decorative', cursive;
font-size: 50px;
font-weight:500;
text-align: center;
        }
  </style>
</head>
<body>
<div class="container">
      
      
      <h1 class="well">La Sereno</h1>     
          <nav class="navbar navbar-inverse">
              <div class="container-fluid">
                  <ul class="nav navbar-nav">
                      <li><a href="index.php">Home</a></li>
                      <li class="active" ><a href="register.php">SignUp</a></li>
      <li><a href="member.php">Membership</a></li>
                      <li ><a href="roomDetails.php">Room &amp; Facilities</a></li>
                      <li><a href="avail.php">Online Reservation</a></li>
                      <li><a href="login.php">Login</a></li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                      <li><a href="http://www.facebook.com"><img src="images/facebook.png"></a></li>
                      <li><a href="http://www.twitter.com"><img src="images/twitter.png"></a></li>                    
                  </ul>
              </div>
          </nav>
  <form action="#" method="POST" enctype="multipart/form-data">
  <h2>REGISTER</h2>

    <table border=0>
  <tr>
        <td><label for="Fname">FIRST NAME:</label></td>
        <td><input type="text" id="Fname" name="Fname" size="40" maxlength="25" pattern="[A-Za-z]*" required></td>
      </tr>
      <tr>
        <td><label for="Mname">MIDDLE NAME:</label></td>
        <td><input type="text" id="Mname" name="Mname" size="40" maxlength="25" pattern="[A-Za-z]*"></td>
      </tr>

      <tr>
        <td><label for="Lname">LAST NAME:</label></td>
        <td><input type="text" id="Lname" name="Lname" size="40" maxlength="25" pattern="[A-Za-z]*" required></td>
      </tr>
      <tr>
        <td><label for="dob">DOB:</label></td>
        <td><input type="date" id="dob" name="dob" size="40"></td>
      </tr>
      <tr>
        <td><label for="address">ADDRESS:</label></td>
        <td><input type="text" id="address" name="address" size="40"></td>
      </tr>
      <tr>
       <td><label for="phno">PHONE NUMBER:</label></td>
       <td><input type="text" id="phno" name="phno" size=40 pattern="[0-9]{10}"></td>
     </tr>
     <tr>
       <td><label for="email">EMAIL:</label></td>
       <td><input type="email" id="email" name="email" size=40 required pattern="[a-z0-9._/%+-4]*@gmail.com"></td>
     </tr>
     <tr>
        <td><label for="psswrd">PASSWORD:</label></td>
        <td><input type="password" id="psswrd" name="password" size="40" required ></td></tr>
        <td><label for="img">PROFILE PIC:</label></td>
        <td><input type="file" id="img" name="img" size="40" required ></td></tr>
      <tr>
       <td><input type="submit" value="SignUp" name="signup" id="button"></td>
       <td>already have an account?<a href="http://localhost/hotelbook/login.php ">login</a></td></tr>
      </table>
      Be a member and avail special offers<a href="http://localhost/hotelbook/member.php ">Membership</a>
  </form>
      </body>