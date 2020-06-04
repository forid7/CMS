<?php require_once("Includes/DB.php");?>

 <?php require_once("Includes/Functions.php");?>

 <?php require_once("Includes/Sessions.php");?>

<?php 

 $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
 

 Confirm_Login(); ?>

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

	<title>Document</title>
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
		<h1> <i class="fas fa-comments" style="color:#27aae1;"></i> Manage Comments</h1>
        </div>
	</div>

</div>

</header>

<br>


<!--Header end-->

<section class="container py-2 mb-4">
	
	<div class="row" style="min-height:30px;">
		<div class="col-lg-12" style="min-height:400px;">

			<?php
             echo ErrorMessage();
             echo SuccessMessage(); 

			?>

			<h2>Un-Approved Comments</h2>

            <table class="table table-striped table-hover">
            	<thead class="thead-dark">
            		<tr>
            			<th>No.</th>
            			<th>Date&Time</th>
            			<th>Name</th>
            			<th>Comment</th>
            			<th>Approve</th>
            			<th>Action</th>
            			<th>Details</th>
            		    
            		</tr>

            	</thead>
            	
            

			
			<?php
             global $ConnectingDB;
             $sql = "SELECT * FROM comments WHERE status='OFF' ORDER BY id desc";
             $Execute = $ConnectingDB->query($sql);
             $SrNo=0;

             while($DataRows=$Execute->fetch()){
             $CommentId = $DataRows["id"];
             $DateTimeOfComment = $DataRows["datetime"];
             $CommenterName = $DataRows["name"];
             $CommentContent = $DataRows["comment"];
             $CommentPostId = $DataRows["post_id"];
             $SrNo++;

            
         

			?>
			<tbody>
				<tr>
			<td><?php echo htmlentities($SrNo); ?></td>
			<td><?php echo htmlentities($DateTimeOfComment); ?></td>
			<td><?php echo htmlentities($CommenterName);?></td>
			<td><?php echo htmlentities($CommentContent);?></td>
			<td style="min-width:140px;"> <a href="ApproveComment.php?id=<?php echo $CommentId;?>" class="btn btn-success" > Approve </a> </td>

			<td> <a href="DeleteComment.php?id=<?php echo $CommentId;?>" class="btn btn-danger" > Delete </a> </td>

			<td style="min-width:140px;"><a class="btn btn-primary" href="FullPost.php?id=<?php echo $CommentPostId;?>" target="_blank" >Live Preview</a></td>
					
				</tr>
			</tbody>
			<?php
            }
			?>
		</table>

		<h2>Approved Comments</h2>

            <table class="table table-striped table-hover">
            	<thead class="thead-dark">
            		<tr>
            			<th>No.</th>
            			<th>Date&Time</th>
            			<th>Name</th>
            			<th>Comment</th>
            			<th>Revert</th>
            			<th>Action</th>
            			<th>Details</th>
            		    
            		</tr>

            	</thead>
            	
            

			
			<?php
             global $ConnectingDB;
             $sql = "SELECT * FROM comments WHERE status='ON' ORDER BY id desc";
             $Execute = $ConnectingDB->query($sql);
             $SrNo=0;

             while($DataRows=$Execute->fetch()){
             $CommentId = $DataRows["id"];
             $DateTimeOfComment = $DataRows["datetime"];
             $CommenterName = $DataRows["name"];
             $CommentContent = $DataRows["comment"];
             $CommentPostId = $DataRows["post_id"];
             $SrNo++;

            
         

			?>
			<tbody>
				<tr>
			<td><?php echo htmlentities($SrNo); ?></td>
			<td><?php echo htmlentities($DateTimeOfComment); ?></td>
			<td><?php echo htmlentities($CommenterName);?></td>
			<td><?php echo htmlentities($CommentContent);?></td>
			<td style="min-width:140px;"> <a href="DisApproveComment.php?id=<?php echo $CommentId;?>" class="btn btn-warning" >Dis-Approve </a> </td>

			<td> <a href="DeleteComment.php?id=<?php echo $CommentId;?>" class="btn btn-danger" > Delete </a> </td>

			<td style="min-width:140px;" ><a class="btn btn-primary" href="FullPost.php?id=<?php echo $CommentPostId;?>" target="_blank" >Live Preview</a></td>
					
				</tr>
			</tbody>
			<?php
            }
			?>
		</table>
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