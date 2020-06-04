<?php require_once("Includes/DB.php");?>

 <?php require_once("Includes/Functions.php");?>

 <?php require_once("Includes/Sessions.php");?>

<?php 

 $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
 //echo $_SESSION["TrackingURL"];

 Confirm_Login(); ?>


 <?php 


if (isset($_POST["submit"])) {
  $UserName        = $_POST["Username"];
  $Name            = $_POST["Name"];
  $Password        = $_POST["Password"];
  $ConfirmPassword = $_POST["ConfirmPassword"];

  $Admin = $_SESSION["AdminName"];

    date_default_timezone_set("Asia/Dhaka");
    $CurrentTime=time();

    $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

   

  //echo $Category;
    if (empty($UserName)||empty($Password)||empty($ConfirmPassword)) {
      //echo "Not empty";
      $_SESSION["ErrorMessage"] = "All fields must be filled out" ;
      Redirect_to("Admins.php");
    }
   elseif (strlen($Password)<4) {
    $_SESSION["ErrorMessage"] = "Password should be greater than 3 characters";
      Redirect_to("Admins.php");
   }
   elseif ($Password!=$ConfirmPassword) {
    $_SESSION["ErrorMessage"] = "Password and ConfirmPassword should be matched";
      Redirect_to("Admins.php");
   }

   elseif (CheckUserNameExistsOrNot($UserName)) {
    $_SESSION["ErrorMessage"] = "Username Exists. Try another one!";
      Redirect_to("Admins.php");
   }

   else{
    //Query to insert new Admin in DB when everything is fine
    
    global $ConnectingDB;

     $sql= "INSERT INTO admins(datetime,username,password,aname,addedby)";
     $sql .= "VALUES(:dateTime,:userName,:password,:aName,:adminName)";
  /*  $sql="INSERT INTO `admins` (`datetime`, `username`, `password`, `aname`, `addedby`) ";
    $sql .= "VALUES(:dateTime,:userName,:password,:aName,:adminName)";
    $stmt = $ConnectingDB->prepare($sql); 
    $stmt->bindvalue(':datetime',$DateTime);
    $stmt->bindvalue(':userName',$UserName);
    $stmt->bindvalue(':password',$Password);
    $stmt->bindvalue(':aName',$Name);
    $stmt->bindvalue(':adminName',$Admin);


    $stmt->execute();
   print_r($stmt);*/

   $stmt = $ConnectingDB->prepare($sql); 
    $stmt->bindvalue(':dateTime',$DateTime);
    $stmt->bindvalue(':userName',$UserName);
    $stmt->bindvalue(':password',$Password);
    $stmt->bindvalue(':aName',$Name);
    $stmt->bindvalue(':adminName',$Admin);

    $Execute=$stmt->execute();

    echo "hello1";

    if ($Execute) {
      $_SESSION["SuccessMessage"]= "New Admin with the name of ".$Name." Added Successfully";
      Redirect_to("Admins.php");
     }
     else{
      $_SESSION["ErrorMessage"] = "Something Went Wrong. Try Again!";
      Redirect_to("Admins.php");
     } 

    
   }


}


  ?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">

   <link rel="stylesheet"  href="Css/all.min.css">
    <link rel="stylesheet"  href="Css/fontawesome.min.css">

   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

   <link rel="stylesheet"  href="Css/Styles.css">

  <title>Admin Page</title>
</head>
<body>
 <!--NAVBAR start-->
<div style="height:10px; background:#27aae1"></div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container" >
    <a href="#" class="navbar-brand">FORID.COM</a>

    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS"> <span class="navbar-toggler-icon"></span> </button>

        <div class="collapse navbar-collapse" id="navbarcollapseCMS">

    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a href="MyProfile.php" class="nav-link"><i class="fas fa-user text-success"></i> My Profile</a>
      </li>

      <li class="nav-item">
        <a href="Dashboard.php" class="nav-link">Dashboard</a>
      </li>

      <li class="nav-item">
        <a href="Posts.php" class="nav-link">Posts</a>
      </li>

      <li class="nav-item">
        <a href="Categories.php" class="nav-link">Categories</a>
      </li>

      <li class="nav-item">
        <a href="Admins.php" class="nav-link">Manage Admins</a>
      </li>

      <li class="nav-item">
        <a href="Comments.php" class="nav-link">Comments</a>
      </li>

      <li class="nav-item">
        <a href="Blog.php?page=1" class="nav-link">Live Blog</a>
      </li>

    </ul>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="Logout.php" class="nav-link text-danger">
            <i class="fas fa-user-times"></i> Logout</a></li>

        </ul>

       </div>   
  </div>
 


</nav>
<div style="height:10px; background:#27aae1"></div>

<!--NAVBAR end-->

<!--Header start-->

<header class="bg-dark text-white px">
  
<div class="container">
  <div class="row">
       
        <div class="col-md-12">
    <h1> <i class="fas fa-user" style="color:#27aae1;"></i>Manage Admins</h1>
        </div>
  </div>

</div>

</header>




<!--Header end-->

<!--Main area start-->

<section class="container py-2 mb-4">
  <div class="row" >
    <div class="offset-lg-1 col-lg-10 " style="min-height:340px;" >

      <?php 

      echo ErrorMessage();
      echo SuccessMessage(); 

       ?>
      
        <form class="" action="Admins.php" method="post">
          <div class="card bg-secondary text-light mb-3">
            <div class="card-header">
              <h1>Add New Admin</h1>
            </div> 
            <div class="card-body bg-dark">
              <div class="form-group">
                <label for="username"><span class="FieldInfo"> Username: </span></label>
                <input class="form-control" type="text" name="Username" id="username"  value="">
              </div>

              <div class="form-group">
                <label for="username"><span class="FieldInfo"> Name: </span></label>
              <input class="form-control" type="text" name="Name" id="Name" value="">
              <small class="text-danger text-muted">Optional</small>
              </div>

              <div class="form-group">
                <label for="Password"><span class="FieldInfo"> Password: </span></label>
                  <input class="form-control" type="password" name="Password" id="Password" value="">
              </div>

              

              <div class="form-group">
                <label for="ConfirmPassword"> <span class="FieldInfo">  
                 ConfirmPassword:  </span>
                </label>
                <input class="form-control" type="password" name="ConfirmPassword" id="ConfirmPassword" value="">
              </div>


              <div class="row" >
                <div class="col-lg-6 mb-2">
                  <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"> Back to the Dashboard</i></a>
                </div>
                <div class="col-lg-6 mb-2">
                <button type="submit" name="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> publish
                  
                </button>
                </div>
              </div>
            </div>
          </div>

        </form>

        <h2>Existing Categories</h2>

            <table class="table table-striped table-hover">
              <thead class="thead-dark">
                <tr>
                  <th>No.</th>
                  <th>Date&Time</th>
                  <th>UserName</th>
                  <th>Admin Name</th>
                  <th>Added By</th>
                  <th>Action</th>
                    
                </tr>

              </thead>
              
            

      
      <?php
             global $ConnectingDB;
             $sql = "SELECT * FROM admins ORDER BY id desc";
             $Execute = $ConnectingDB->query($sql);
             $SrNo=0;

             while($DataRows=$Execute->fetch()){
             $AdminId = $DataRows["id"];
             $DateTime = $DataRows["datetime"];
             $AdminUsername = $DataRows["username"];
             $AdminName = $DataRows["aname"];
             $AddedBy  = $DataRows["addedby"];
             
             $SrNo++;

            
         

      ?>
      <tbody>
        <tr>
      <td><?php echo htmlentities($SrNo); ?></td>
      <td><?php echo htmlentities($DateTime); ?></td>
      <td><?php echo htmlentities($AdminUsername);?></td>
      <td><?php echo htmlentities($AdminName);?></td>
      <td><?php echo htmlentities($AddedBy);?></td>
      

      <td> <a href="DeleteAdmin.php?id=<?php echo $AdminId;?>" class="btn btn-danger" > Delete </a> </td>

      
          
        </tr>
      </tbody>
      <?php
            }
      ?>
    </table>

    </div>

  </div>


</section>




<!--Main area end-->
<!--FOOTER start-->

<footer class="bg-dark text-white">
  
<div class="container">
  
<div class="row">
  <div class="col">
   <p class="lead text-center">Theme By | Mohammad forid | <span id="year"></span> &copy; ------All Rights Reserved.</p>

   <p class="text-center small"><a style="color: white; text-decoration: none; cursor: pointer;" href="http://forid.com/coupons" target="_blank">This site is only used for study purpose ,no one is allowed to distribute copies other than <br>&trade; forid.com &trade; Udemy ; &trade; SkillShare ; &trade; StackSkills</a></p>

</div>
</div>
</div>

</footer>

<div style="height:10px; background:#27aae1"></div>

<!--FOOTER end-->


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<script type="text/javascript">
  
$('#year').text(new Date().getFullYear());


</script>

</body>
</html>