<?php require_once("Includes/DB.php");?>

 <?php require_once("Includes/Functions.php");?>

 <?php require_once("Includes/Sessions.php");?>

 <?php Confirm_Login(); ?>


 <?php 

$SearchQueryParameter = $_GET['id'];
if (isset($_POST["submit"])) {
  $PostTitle = $_POST["PostTitle"];
  $Category  = $_POST["Category"];
  $Image     = $_FILES["Image"]["name"];
  $Target    = "Uploads/".basename($_FILES["Image"]["name"]);
  $PostText  = $_POST["PostDescription"];
  $Admin     = "Forid";


    date_default_timezone_set("Asia/Dhaka");
    $CurrentTime=time();

    $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

   

  //echo $Category;
    if (empty($PostTitle)) {
      //echo "Not empty";
      $_SESSION["ErrorMessage"] = "Title can't be empty" ;
      Redirect_to("EditPost.php?id=$SearchQueryParameter");
    }
   elseif (strlen($PostTitle)<5) {
    $_SESSION["ErrorMessage"] = "Post Title should be greater than 5 characters";
      Redirect_to("EditPost.php?id=$SearchQueryParameter");
   }
   elseif (strlen($PostText)>999) {
    $_SESSION["ErrorMessage"] = "Post description should be less than 1000 characters";
      Redirect_to("EditPost.php?id=$SearchQueryParameter");
   }
   else{
    //Query to update post in DB when everything is fine
    
    
    global $ConnectingDB;

    if (!empty($_FILES["Image"]["name"])) {
      $sql = "UPDATE posts SET title='$PostTitle',category='$Category',image='$Image',post='$PostText' WHERE id='$SearchQueryParameter'";
    }
    else{

    $sql = "UPDATE posts SET title='$PostTitle',category='$Category',post='$PostText' WHERE id='$SearchQueryParameter'";

    }

   /* $sql = "UPDATE posts SET title='$PostTitle',category='$Category',image='$Image',post='$PostText' WHERE id='$SearchQueryParameter'";
*/
    $Execute = $ConnectingDB->query($sql);

  /*  $sql= "INSERT INTO posts(datetime,title,category,author,image,post)";
    $sql .= 
    "VALUES(:dateTime,:postTile,:categoryName,:adminName,:imageName,:postDescription)";
    $stmt = $ConnectingDB->prepare($sql); 
    $stmt->bindValue(':dateTime',$DateTime);
    $stmt->bindValue(':postTile',$PostTitle);
    $stmt->bindValue(':categoryName',$Category);
    $stmt->bindValue(':adminName',$Admin);
    $stmt->bindValue(':imageName',$Image);
    $stmt->bindValue(':postDescription',$PostText);

   // echo "hello 1";
    
    $Execute=$stmt->execute();*/

    move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);

    //var_dump($Execute);

    if ($Execute) {
      $_SESSION["SuccessMessage"]= " Post Updated Successfully";
      Redirect_to("Posts.php");
     }
     else{
    //  echo "hello 3 ";
      $_SESSION["ErrorMessage"] = "Something Went Wrong. Try Again!";
      Redirect_to("EditPost.php?id=$SearchQueryParameter");
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

  <title>Edit Post</title>
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
    <h1> <i class="fas fa-edit" style="color:#27aae1;"></i>Edit Post</h1>
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

      //Fetching Existing Content to our 

      global $ConnectingDB;
     // $SearchQueryParameter = $_GET["id"];
      $sql= "SELECT * FROM posts WHERE id= '$SearchQueryParameter'";
      $stmt=$ConnectingDB ->query($sql);
      while ($DataRows= $stmt->fetch()) {
        $TitleToBeUpdated=$DataRows['title'];
        $CategotyToBeUpdated = $DataRows['category'];
        $ImageToBeUpdated =$DataRows['image'];
        $PostToBeUpdated =$DataRows['post']; 
      }

       ?>
      
        <form class="" action="EditPost.php?id=<?php echo $SearchQueryParameter;?>" method="post" enctype="multipart/form-data">
          <div class="card bg-secondary text-light mb-3">
            
            <div class="card-body bg-dark">
              <div class="form-group">
                <label for="title"><span class="FieldInfo">Post Title:</span></label>
                  <input class="form-control" type="text" name="PostTitle" id="title" placeholder="Type title here" value="<?php echo $TitleToBeUpdated; ?>">
              </div>
              <div class="form-group">
                <span class="FieldInfo">Existing Category:</span>
                <?php echo $CategotyToBeUpdated;  ?>
                <br>
                <label for="CategoryTitle"><span class="FieldInfo">Choose Category:</span></label>
                  <select class="form-control" id="CategoryTitle" name="Category">
                   <?php 
                   //Fetching all the categories from category table
                   global $ConnectingDB;
                     $sql = "SELECT id,title FROM category ";
                     $stmt = $ConnectingDB->query($sql);
                     
                     while ($DateRows = $stmt->fetch()) {
                       $Id = $DateRows["id"];
                       $CategoryName = $DateRows["title"];
                     

                    ?>
                    <option> <?php echo $CategoryName; ?> </option>
              <?php  
                  }
                  ?>

                  </select>
              </div>
              
              <div class="form-group mb-1">
                <span class="FieldInfo">Existing Image: </span>
                <img class="mb-2" src="Uploads/<?php echo $ImageToBeUpdated;?>" width="170px"; height="70px";>
                <div class="custom-file">
                  <input class="custom-file-input" type="File" name="Image" id="imageSelect" value="">
                  <label for="imageSelect" class="custom-file-label">Select Image</label>
                </div>                
              </div>

              <div class="form-group">
                <label for="Post"><span class="FieldInfo">Post:</span></label>
                <textarea class="form-control" id="Post" name="PostDescription" 
                rows="8" cols="80">
                  <?php echo $PostToBeUpdated; ?>
                </textarea>

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