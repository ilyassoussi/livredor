<?php
if(isset($_POST['ajouter'])){
	if(!empty($_FILES['image']))
	{
		
		$nameFile = $_FILES['image']['name'];
		$typeFile = $_FILES['image']['type'];
		$sizeFile = $_FILES['image']['size'];
		$tmpFile = $_FILES['image']['tmp_name'];
		$errFile = $_FILES['image']['error'];
		
		// Extensions
		$extensions = ['png', 'jpg', 'jpeg', 'gif'];
		// Type d'image 
		$type = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];
		// On récupère
		$extension = explode('.', $nameFile);
		// Max size
		$max_size = 10000000000;


		// On vérifie que le type est autorisés
		if(in_array($typeFile, $type))
		{
			// On vérifie que il n'y a que deux extensions
			if(count($extension) <= 2 && in_array(strtolower(end($extension)), $extensions))
			{
				// On vérifie le poids de l'image
				if($sizeFile < $max_size)
				{
					// On bouge l'image uploadé dans le dossier upload
					if(move_uploaded_file($tmpFile, './upload/'.uniqid() . '.' . strtolower(end($extension) ) ) )
						echo '<center><h8 class="alert alert-success">This is uploaded!</h8></center>';
					else 
						echo "failed";
				}
				else 
				{
					echo '<center><h8 class="alert alert-success">Fichier trop lourd ou format incorrect</center></h8>';
				}
			}
			else 
			{
				echo '<center><h8 class="alert alert-success">Extension failed</center></h8>';
			}
		}   
		else 
		{
			echo "Type non autorisé";
		}


	}
  }

require 'class/message.php';
require 'class/savebooks.php';
$error = null;
$success = false;
$saved = new save(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'Messages');
    if(isset($_POST['titre'] , $_POST['message'])){
    $message = new message($_POST['titre'], $_POST['message']);
	if($message->IsValid()){		
		$saved->addmessage($message);
		$success = true;
		$_POST = [];
		}
		else{
		$error = $message->geterror();
			}
    }	
	$messages = $saved->getmsg(); 

?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Livre d'or</title>
  <link rel="stylesheet" href="css.css">
</head>
<body>
<div class="container">

	<form action=""  method="POST" enctype="multipart/form-data">
		<?php if(!empty($error)) : ?>
			<div class="alert alert-danger">
				Formulaire invalide
			</div>
		<?php endif?>
		<?php if($success) : ?>
			<div class="alert alert-success">
				MERCI !!
			</div>
		<?php endif?>
		<div class="field" tabindex="1">
			<label>
				<i class="far fa-user"></i>Titre*
			</label>
			<input value="<?= $_POST['titre'] ?? '' ?>" name="titre" type="text" placeholder="e.g. abcd" class="form-control <?= (isset($error['titre'])) ? 'is-invalid' : '' ?>" required>
			<?php if (isset($error['titre'])) :?>
			<div class="invalid-feedback"><?= $error['titre']  ?></div>
			<?php endif?>
		</div>
		<div class="field" tabindex="2">
            <label>
				<i class="far fa-user"></i>Image
			</label>
			<input name="image" type="file" placeholder="" >
		</div>
		<div class="field" tabindex="3">
			<label for="message">
				<i class="far fa-edit"></i>Message*
			</label>
			<textarea name="message" placeholder="Ton Message" class="form-control <?= (isset($error['message'])) ? 'is-invalid' : '' ?>" required><?= $_POST['message'] ?? '' ?></textarea>
			<?php if (isset($error['message'])) :?>
			<div id="validationServerUsernameFeedback" class="invalid-feedback"><?= $error['message']  ?></div>
			<?php endif?>
		</div>
		<button name="ajouter" type="submit">ADD NEW TESTIMONIAL</button>
	</form>

</div>

<?php if (!empty($messages)): ?>
	<h1 > Testimonials</h1>
	<?php foreach($messages as $message) :?>
		<?= $message->tohtml() ?>
	<?php endforeach ?>	
	<?php endif ?>
</body>
</html>