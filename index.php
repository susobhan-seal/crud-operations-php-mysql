<?php
include('connection.php');
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
  <h2>Registration form</h2>

<!-- Form contents -->
  <form action="" name="myform" method="POST" enctype="multipart/form-data">

    <!-- enctype='multipart/form-data is an encoding type that allows files to be sent through a POST. Quite simply, without this encoding the files cannot be sent through POST. If you want to allow a user to upload a file via a form, you must use this enctype. -->

    <div class="form-group">
      <label for="firstname">Firstname:</label>
      <input type="text" class="form-control"  placeholder="Enter Your Firstname" required="required" name="firstname">
    </div>

    <div class="form-group">
      <label for="lastname">Lastname:</label>
      <input type="text" class="form-control"  placeholder="Enter Your Lastname"  name="lastname">
    </div>

    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" placeholder="Enter Your Email Address" required="required" name="email">
    </div>

    <div class="form-group">
      <label for="contact">Contact:</label>
      <input type="number" class="form-control" placeholder="Enter Your Contact No"  name="contact">
    </div>

     <div class="form-group">
      <label for="image">Image:</label>
      <input type="file" class="form-control" name="f1">
    </div>

    <button type="submit" name="insert" class="btn btn-default">Insert</button>
    <button type="reset" name="reset" class="btn btn-default">Reset</button>
<!-- 
    <button type="submit" name="update" class="btn btn-default">Update</button>
    <button type="submit" name="delete" class="btn btn-default">Delete</button> -->

  </form>
</div>
</div>
<br>
<br>

<!-- Displaying records -->

	<div class="col-lg-12">
    <table class="table table-bordered">
    <thead>
      <tr>
        <th>Id</th>
        <th>Image</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
     
     <?php
     $result=mysqli_query($conn, "SELECT * FROM users");

     // The fetch_array() / mysqli_fetch_array() function fetches a result row as an associative array, a numeric array, or both.
     while ($row=mysqli_fetch_array($result)) {

       echo "<tr>";

       echo "<td>";  echo $row['id'];        echo"</td>";
       echo "<td>";  ?> <img src="<?php echo $row['image1'] ?>" height="100" width="100"><?php echo"</td>";
       echo "<td>";  echo $row['firstname']; echo"</td>";
       echo "<td>";  echo $row['lastname'];  echo"</td>";
       echo "<td>";  echo $row['email'];     echo"</td>";
       echo "<td>";  echo $row['contact'];   echo"</td>";

       echo "<td>";  ?><a href="edit.php?id=<?php echo $row["id"]; ?>"><button type="button" class="btn btn-success">Edit</button></a><?php echo"</td>";

       echo "<td>";  ?><a href="delete.php?id=<?php echo $row["id"]; ?>"><button type="button" class="btn btn-danger">Delete</button></a> <?php echo"</td>";

       echo"</tr>";

     }
     ?>


    </tbody>
  </table>

	</div>
	
</body>
</html>

<?php

// The isset() function checks whether a variable is set, which means that it has to be declared and is not NULL. 

if (isset($_POST['insert'])) {

  $tm=md5(time());  //to make image name unique
  $fnm=$_FILES["f1"]["name"];  //f1 is control name
  $dst="./images/" .$tm. $fnm; //path i.e source to destination
  $dst1="images/" .$tm. $fnm;  //image location

  // The move_uploaded_file() function moves an uploaded file to a new destination. Note: This function only works on files uploaded via PHP's HTTP POST upload mechanism.

  move_uploaded_file($_FILES["f1"]["tmp_name"], $dst);


  // we need to pass name of input fields like $_POST['name']

  mysqli_query($conn, "INSERT INTO users  VALUES (NULL, '$_POST[firstname]','$_POST[lastname]','$_POST[email]','$_POST[contact]', '$dst1')");

  ?>

  <!-- The window.location object can be used to get the current page address (URL) and to redirect the browser to a new page. -->

 <!--  window.location.href returns the href (URL) of the current page -->

  <script type="text/javascript">
  window.location.href=window.location.href;
</script>

<?php

}

if (isset($_POST['delete'])) {
  mysqli_query($conn, "DELETE FROM users WHERE firstname='$_POST[firstname]'");
  ?>

  <script type="text/javascript">
  window.location.href=window.location.href;
</script>

<?php
}


if (isset($_POST['update'])) {
  mysqli_query($conn, "UPDATE users SET firstname='$_POST[lastname]'  WHERE firstname='$_POST[firstname]'");
  ?>

<script type="text/javascript">
  window.location.href=window.location.href;
</script>

<?php
}

?>