<?php require_once("Includes/DB.php");?>

 <?php require_once("Includes/Functions.php");?>

 <?php require_once("Includes/Sessions.php");?>

<!--Existing Data-->

 <?php 

$SearchQueryParameter= $_GET["username"];

global $ConnectingDB;

$sql = "SELECT aname,aheadline,abio,aimage FROM admins WHERE username=:userName";
$stmt= $ConnectingDB->prepare($sql);
$stmt->bindValue(':userName',$SearchQueryParameter);
$stmt->execute();
$Result = $stmt->rowcount();

if($Result==1){
	while($DataRows=$stmt->fetch()){
	$ExistingName     = $DataRows["aname"];
	$ExistingBio      = $DataRows["abio"];
	$ExistingImage    = $DataRows["aimage"];
	$ExistingHeadline = $DataRows["aheadline"];
}
}
else{
	$_SESSION["ErrorMessage"]="Bad Request!!";
	Redirect_to("Blog.php?page=1");
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

	<title>Profile</title>
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
				<a href="Blog.php" class="nav-link">Home</a>
			</li>

			<li class="nav-item">
				<a href="#" class="nav-link">About Us</a>
			</li>

			<li class="nav-item">
				<a href="Blog.php" class="nav-link">Blog</a>
			</li>

			<li class="nav-item">
				<a href="#" class="nav-link">Contact Us</a>
			</li>

			<li class="nav-item">
				<a href="#" class="nav-link">Features</a>
			</li>

			

		</ul>

        <ul class="navbar-nav ml-auto">
            <form class="form-inline d-none d-sm-block" action="Blog.php">
              <div class="form-group">
              	<input class="form-control mr-2" type="text" name="Search" placeholder="Search here" value="" >
                <button  class="btn btn-primary" name="SearchButton" >GO</button>

              </div>

            </form>
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
       
      <div class="col-md-6">
	<h1><i class="fas fa-user text-success mr-2" style="color:#27aae1;"></i><?php echo $ExistingName; ?></h1>
       
       <h3><?php echo $ExistingHeadline;?></h3>

      </div>
	</div>

</div>

</header>




<!--Header end-->

<section class="container py-2 mb-4">
	<div class="row">
		<div class="col-md-3">
			<img src="Images/<?php echo $ExistingImage;?>" class="d-block img-fluid mb-3 rounded-circle">
		</div>
		<div class="col-md-9" style="min-height:320px;">
			<div class="card">
				<div class="card-body">
					<p class="lead"><?php echo $ExistingBio; ?></p>
				</div>
				
			</div>
		</div>
	</div>
	
</section>

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