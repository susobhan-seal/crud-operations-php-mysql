<?php
include('connection.php');

 //$id=$_GET["id"];

$id = isset($_GET['id']) ? $_GET['id'] : '';

mysqli_query($conn, "DELETE FROM users WHERE id=$id");
?>

<script type="text/javascript">
	window.location="index.php";
</script> 