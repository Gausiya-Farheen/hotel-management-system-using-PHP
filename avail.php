<?php
if(isset($_POST["submit"]))
{
    $conn=mysqli_connect("localhost","root","","HotelBook");
    $checkin=$_POST["checkin"];
    $checkout=$_POST["checkout"];
    if(empty($_GET['roomname']))
    {


        $sql="SELECT DISTINCT RoomName FROM room_book WHERE room_id NOT IN (SELECT DISTINCT room_id
        FROM room_book WHERE  (arrival <= '$checkin' AND departure >='$checkout') OR (arrival >= '$checkin' AND departure <='$checkout') OR (arrival >= '$checkout' AND departure >='$checkout'))";
                 $check= mysqli_query($conn,$sql)  or die(mysqli_connect_errno()."Query Doesnt run");
                 if(mysqli_num_rows($check) > 0)
                 {
                     while($row = mysqli_fetch_array($check))
                     {
                         
                         $roomname1=$row['RoomName'];
                         $sql2="SELECT * FROM rooms WHERE RoomName='$roomname1' ";
                         $query = mysqli_query($conn, $sql2);
                         $row2 = mysqli_fetch_array($query);
                         echo "
                         <div class='row'>
                         <div class='col-md-3'></div>
                         <div class='col-md-6 well weell'>
                             <h4>".$row2['RoomName']."</h4><hr>
                             <h6>Features: ".$row2['Features']."</h6>
                             <h6>Size: ".$row2['Size']."</h6>
                             <h6>Price: ".$row2['Price']."/night.</h6>
                             
                             </div>
                            <div class='col-md-3 weell'>
                                <a href='book.php?roomname=".$row2['RoomName']."'><button class='btn btn-primary button'>Book Now</button> </a>
                            </div>   
                            </div>
                            ";
                     }
                    }
                }
                    elseif(!empty($_GET['roomname']))
{
    $roomname=$_GET['roomname'];
 $sql3="SELECT distinct room_id FROM room_book WHERE RoomName='$roomname' 
 AND ((arrival < '$checkin' AND departure < '$checkout')
    
    or(arrival >= '$checkout' AND departure > '$checkout'))";
  
   $res= mysqli_query($conn,$sql3)  or die(mysqli_connect_errno()."Query Doesnt run");
   if(mysqli_num_rows($res) > 0)
   {
    $row3 = mysqli_fetch_array($res);
        $sql4="SELECT * FROM rooms WHERE RoomName='$roomname'";
        $resul = mysqli_query($conn, $sql4);
        $row4= mysqli_fetch_array($resul);
        echo "rooms are available!!";
        $sql4="SELECT  COUNT(booked) as total from room_book where RoomName='$roomname' AND (
            (arrival < '$checkin' AND departure < '$checkout')
             
           or(arrival >= '$checkout' AND departure > '$checkout')
           
          )";
$result=mysqli_query($conn,$sql4);
$data=mysqli_fetch_assoc($result);
$s=$data['total'];
// echo $s;

        
        echo "
        <div class='row'>
        <div class='col-md-3'></div>
        <div class='col-md-6 well weell'>
            <h4>".$row4['RoomName']."</h4><hr>
            <h6>Features: ".$row4['Features']."</h6>
            <h6>Size: ".$row4['Size']."</h6>
            <h6>Price: ".$row4['Price']."/night.</h6>
            <h6>Available: ".$s."</h6>
            
            </div>
           <div class='col-md-3 weell'>
               <a href='book.php?roomname=".$row4['RoomName']."'><button class='btn btn-primary button'>Continue </button> </a>
           </div>   
           </div>
           ";
    }
}
    else{
        echo "Sorry rooms not available";

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
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&display=swap" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&family=Cinzel+Decorative&family=Cinzel:wght@400;500&family=Orbitron:wght@500&family=Playfair:ital,wght@0,400;1,500&display=swap" rel="stylesheet">
  
  <style>
       
  .well{
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
        
        h4 {
            color: #ffbb2b;
        }
        h6
        {
            color: navajowhite;
            font-family:  monospace;
        }
        label
        {
            color:#ffbb2b;
            font-size:13px;
            font-weight: 100;
        }
         .fix{
            position:absolute;
            top:-0px;
            left:200px;
        }
        .weell{
            position: relative;
            top:500px;
        } 

       html {
  box-sizing: border-box;
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
      <li><a href="member.php">Membership</a></li>
                    <li><a href="roomDetails.php">Room &amp; Facilities</a></li>
                    <li class="active"><a href="avail.php">Online Reservation</a></li>
                <li><a href="login.php">Login</a></li>
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
         <form action="" method="post" name="room_category">
              
              
               <div class="form-group">
                    <label for="checkin">Check In :</label>&nbsp;&nbsp;&nbsp;
                    <input type="date" name="checkin">

                </div>
               
               <div class="form-group">
                    <label for="checkout">Check Out:</label>&nbsp;&nbsp;
                    <input type="date" name="checkout">
                </div>
                 
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <!-- <input type="hidden" name="submit" value="hid"> -->
                <button type="submit" class="btn btn-primary button" name="submit" value="ss">Check Availability</button>

            </form>
           </div>
        </div> 
    </div>
</body>