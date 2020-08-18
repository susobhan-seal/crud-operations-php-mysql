<?php
include('connection.php');

//$id=$_GET["id"];

$id = isset($_GET['id']) ? $_GET['id'] : '';

// You are not getting value of $id=$_GET['id'];
// And you are using it (before it gets initialised).
// Use php's in built isset() function to check whether the variable is defied or not.

$firstname="";
$lastname="";
$email="";
$contact="";
$image1="";



$result=mysqli_query($conn,"SELECT * FROM users WHERE id=$id"); ////Warning: mysqli_fetch_array() expects parameter 1 to be mysqli_result, bool given in 


while ($row=mysqli_fetch_array($result)) {
  $firstname=$row['firstname'];
  $lastname=$row['lastname'];
  $email=$row['email'];
  $contact=$row['contact'];
  $image1=$row['image1'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<div class="col-lg-4">
  <h2>Login form</h2>

  <form action="" name="myform" method="POST" enctype="multipart/form-data">

    <!-- enctype='multipart/form-data is an encoding type that allows files to be sent through a POST. Quite simply, without this encoding the files cannot be sent through POST. If you want to allow a user to upload a file via a form, you must use this enctype. -->

    <img src="<?php echo $image1; ?>" height="100" width="100">

    <div class="form-group">
      <label for="firstname">Firstname:</label>
      <input type="text" class="form-control" placeholder="Update Your Firstname" name="firstname" value="<?php echo $firstname; ?>">
    </div>

    <div class="form-group">
      <label for="lastname">Lastname:</label>
      <input type="text" class="form-control"  placeholder="Update Your Lastname" name="lastname" value="<?php echo $lastname; ?>">
    </div>

    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control"  placeholder="Update Your Email" name="email" value="<?php echo $email; ?>">
    </div>

    <div class="form-group">
      <label for="contact">Contact:</label>
      <input type="number" class="form-control"  placeholder="Update Your Contact No" name="contact" value="<?php echo $contact; ?>">
    </div>

    <div class="form-group">
      <label for="image">Image:</label>
      <input type="file" class="form-control" name="f1">
    </div>
   
    <button type="submit" name="update" class="btn btn-default">Update</button>
   
  </form>
</div>
</div>


	
</body>

<?php
if (isset($_POST["update"])) {

  $tm=md5(time());
  $fnm=$_FILES["f1"]["name"];

  //condition for image uploading
  if ($fnm=="") {
         mysqli_query($conn,"UPDATE users SET firstname='$_POST[firstname]', lastname='$_POST[lastname]', email='$_POST[email]', contact='$_POST[contact]' WHERE id=$id");
  }
  else{
        $dst="./images/" .$tm. $fnm;
        $dst1="images/" .$tm. $fnm;
        move_uploaded_file($_FILES["f1"]["tmp_name"], $dst);

        //Update query
      
        mysqli_query($conn,"UPDATE users SET firstname='$_POST[firstname]', lastname='$_POST[lastname]', email='$_POST[email]', contact='$_POST[contact]', image1='$dst1' WHERE id=$id");
  }
  
  ?>

  <script type="text/javascript">
    window.location="index.php";
  </script>

  <?php
}
?> 
</html>




