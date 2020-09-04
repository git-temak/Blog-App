<?php 
	//database connection
	require('config/config.php');
	require('config/connection.php');

	// check form submit
	if (isset($_POST['submit'])) {
		// get form data
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$body = mysqli_real_escape_string($conn, $_POST['content']);
		$author = mysqli_real_escape_string($conn, $_POST['author']);

		$query = "INSERT INTO posts(title, author, body) VALUES('$title', '$author', '$body')";

		if(mysqli_query($conn, $query)){
			header('Location: '.ROOT_URL.'');
		} else {
			echo 'ERROR: '.mysqli_error($conn);
		}
	}
?>

<?php require('inc/header.php'); ?>
	<div class="container text-center my-5">
		<h1>Add New Post</h1>
		<form class="w-50 mx-auto" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
		    <div class="form-group">
		        <label for="title">Title</label>
		        <input type="text" name="title" class="form-control mb-4" placeholder="Enter Post Title">
		        <label for="author">Author</label>
		        <input type="text" name="author" class="form-control mb-4" placeholder="Enter Author Name">
		        <label for="content">Content</label>
	            <textarea class="form-control" name="content" id="content" rows="6" spellcheck="false" placeholder="Post content goes here..."></textarea>
		    </div>
		    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
		</form>
	</div>
<?php require('inc/footer.php'); ?>