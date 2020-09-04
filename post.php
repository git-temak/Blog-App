<?php 
	//database connection
	require('config/config.php');
	require('config/connection.php');

	//get ID
	$id = mysqli_real_escape_string($conn, $_GET['id']);

	// create query
	$query = 'SELECT * FROM posts WHERE id = '.$id;

	//get results
	$result = mysqli_query($conn, $query);

	//fetch data
	$post = mysqli_fetch_assoc($result);

	//free result
	mysqli_free_result($result);

	//close connection
	mysqli_close($conn);
?>

<?php require('inc/header.php'); ?>
	<div class="container text-center my-5">
		<a class="btn btn-primary" href="<?php echo ROOT_URL; ?>">Back</a>
		<h1><?php echo $post['title']; ?></h1>
		<div class="card text-white bg-primary mb-3">
		  <div class="card-header">Created on <?php echo $post['created_at']; ?> by <span class="font-weight-bold"><?php echo $post['author']; ?></span>
		  	<a class="btn btn-warning float-right" href="<?php echo ROOT_URL; ?>editpost.php?id=<?php echo $post['id'] ?>">Edit Post</a>
		  </div>
		  <div class="card-body">
		    <!-- <h4 class="card-title">Primary card title</h4> -->
		    <p class="card-text"><?php echo $post['body']; ?></p>
		  </div>
		</div>
	</div>
<?php require('inc/footer.php'); ?>