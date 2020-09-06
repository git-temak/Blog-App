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

		// image file data
		$fileName = $_FILES['upload']['name'];
		$fileType = $_FILES['upload']['type'];
		$fileSize = $_FILES['upload']['size'];
		$fileTempName = $_FILES['upload']['tmp_name'];
		$fileError = $_FILES['upload']['error'];

		// image file extension data
		$fileDefaultExt = explode('.', $fileName);
		$fileExt = strtolower(end($fileDefaultExt));

		// allowed file extensions
		$allowed = ['jpg', 'jpeg', 'png'];

		// image file upload target directory
		$fileDestination = "uploads/";

		if (in_array($fileExt, $allowed)) {
			if ($fileError === 0) {
				if ($fileSize < 5242881) {
					$fileUniqueName = $fileDefaultExt[0]."_".uniqid('', true).".".$fileExt;
					move_uploaded_file($fileTempName, $fileDestination.$fileUniqueName);
				} else {
				echo "File is larger than 5MB";
				}
			} else {
				echo "There was an error uploading your file";
			}
		} else {
			echo "File type not supported";
		}

		$image = mysqli_real_escape_string($conn, $fileUniqueName);

		// insert post information into the db
		$query = "INSERT INTO posts(title, author, body, image) VALUES('$title', '$author', '$body', '$image')";

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
		<form class="w-lg-50 mx-auto" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>"  enctype="multipart/form-data">
		    <div class="form-group">
		        <label for="title">Title</label>
		        <input type="text" name="title" class="form-control mb-4" placeholder="Enter Post Title">
		        <label for="author">Author</label>
		        <input type="text" name="author" class="form-control mb-4" placeholder="Enter Author Name">
		        <label for="content">Content</label>
	            <textarea class="form-control mb-4" name="content" id="content" rows="6" spellcheck="false" placeholder="Post content goes here..."></textarea>
	            <label for="image" class="mb-0">Upload Image</label>
	            <small id="fileHelp" class="form-text pb-2">Only jpeg and png files are supported. Files should be less than 5MB.</small>
	                <div class="input-group mb-3">
	                  <div class="custom-file">
	                    <input type="file" class="custom-file-input" id="inputGroupFile02" name="upload">
	                    <label class="custom-file-label" for="inputGroupFile02">Choose Image File</label>
	                  </div>
	                </div>
		    </div>
		    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
		</form>
	</div>
<?php require('inc/footer.php'); ?>