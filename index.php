<?php 
	//database connection
	require('config/config.php');
	require('config/connection.php');

	// create query
	$query = 'SELECT * FROM posts';

	//get results
	$result = mysqli_query($conn, $query);

	//fetch data
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

	//free result
	mysqli_free_result($result);

	//close connection
	mysqli_close($conn);
?>

<?php require('inc/header.php'); ?>
	<div class="container text-center my-5">
		<h1>Posts</h1>
		<p>Posts are ordered by the most recent ones displaying first.</p>
		<div class="row d-flex justify-content-between justify-content-lg-center mx-3 mx-lg-0 pt-3">
			<?php foreach($posts as $post) : ?>
				<div class="col-12 col-lg-4 card cst-crd text-white bg-primary px-0 mb-3 mx-lg-2">
				  <div class="card-header">Created on <?php echo $post['created_at']; ?> by <span class="font-weight-bold"><?php echo $post['author']; ?></span></div>
				  <div class="card-body">
				    <h4 class="card-title"><?php echo $post['title']; ?></h4>
				    <p class="card-text"><?php echo $post['body']; ?></p>
				    <a class="btn btn-danger" href="post.php?id=<?php echo $post['id'] ?>">Read More</a>
				  </div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php require('inc/footer.php'); ?>