// html ------------------------------------------------
<html lang="cs">
<head>
	<meta charset="utf-8">
	<title>Fileuploader</title>
</head>
	<body>
	<h1>Nahrávač obrázků</h1>
	<br>
		<form action="upload.php" method="post" enctype="multipart/form-data">
			 Cesta k obrázku: 
			 <input type="file" name="fileToUpload"><br/>
			 <br>
			 Název vč. přípony:
			 <input type="text" name="name"><br/>
			 <br>
			 Zobrazit obrázek ihned po odeslání?
			 <input type="checkbox" name="show" value="ano"><br/>
			 <br>
			 <input type="submit" name="submit" value="Nahrát">
		</form>
	<hr>
	</body>
</html>
//php --------------------------------------------
<?php
if(isset($_POST['submit']))
{
	$filepath = "uploads/" . $_FILES["fileToUpload"]["name"];
	$filetype = pathinfo($filepath, PATHINFO_EXTENSION);
	$allowed = array('gif', 'png', 'jpg', 'jpeg');
	$name = $_POST["name"];
	$path = "uploads/";

	if(!in_array($filetype, $allowed))
	{
		echo "Jsou povoleny pouze soubory s příponami JPG, JPEG, PNG & GIF!";
	}
	else 
	{
		if(isset($_POST['show']))
		{
			if (empty($name))
			{
				move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $filepath);									
				echo "Soubor ".($_FILES["fileToUpload"]["name"]). " byl nahrán do složky 'uploads'.";
				echo "<br>";
				echo "<img src=".$filepath." height=500 width=600 />";
			}
			else
			{
				move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $filepath);
				rename("$filepath","uploads/$name");			
				echo "Soubor ".$name. " byl nahrán do složky 'uploads'.";
				echo "<br>";
				echo '<img src="'.$path.$name.'" height=500 width=600>';
			}
		}		
		else		
		{
			if (empty($name))
			{
				move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $filepath);									
				echo "Soubor ".($_FILES["fileToUpload"]["name"]). " byl nahrán do složky 'uploads'.";
			}
			else
			{
				move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $filepath);
				rename("$filepath","uploads/$name");
				echo "Soubor ".$name. " byl nahrán do složky 'uploads'.";
			}
		}
	}
}
?>
