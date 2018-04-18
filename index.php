<?php
	
	

	if(isset($_POST['upload'])){
		
		$msg = "";
		//$diretorio = dirname($_FILES['image']['name']);
		$target = "images/".$_FILES['image']['name'];
		$db = mysqli_connect("localhost", "root", "", "testes_imagem2", 3306);
		
		$image = $_FILES['image']['name'];
		$text = $_POST['text'];

		$sql = "INSERT INTO images (image, text) VALUES ('$image', '$text')";
		mysqli_query($db, $sql);

		if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
			$msg = "imagem uploaded suessfully";
		}else{
			$msg = "There was a problem uploading image";
		}
		
		
		

		

		

		
		
		

	}


?>


<!DOCTYPE html>
<html>
<head>
	<title>Upload de imagens com php</title>
</head>
<style type="text/css">
	#content{
		width: 50%;
		margin: 20px auto;
		border: 1px solid #cbcbcb;
	}
	form{
		width: 50%;
		margin: 20px auto;

	}
	#img_div{
		width: 80%;
		padding: 5px;
		margin: 15px auto;
		border:1px solid #cbcbcb;
	}
	#img_div:after{
		content: "";
		display: block;
		clear: both;
	}
	img{
		float: left;
		margin: 5px;
		width: 300px;
		height: 140px;
	}
</style>
<body>
	<div id="content">
		
		<?php
			$db = mysqli_connect("localhost", "root", "", "testes_imagem2", 3306);
			$sql = "SELECT * FROM images";
			$result = mysqli_query($db,$sql);
			while($row = mysqli_fetch_array($result)){
				echo"<div id='img_div'>";
					echo"<img src='images/".$row['image']. " ' >";
					echo "<p>".$row['text']."</p>";
					echo "</div>";
			}
			
		?>
	

		<form enctype="multipart/form-data" action="index.php" method="POST" >
			

			<div>
				<input type="file" name="image" multiple >
			</div>
			<div>
				<textarea name="text" cols="40" rows="4" placeholder="Diga algo sobre  a imagem"></textarea>
			</div>
			<div>
				<input type="submit" name="upload" value="Upload Image" />
			</div>
			
			
			
			

	</form>
	</div>

	

</body>
</html>