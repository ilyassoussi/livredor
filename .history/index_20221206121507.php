<?php
require 'class/Message.php';
$error = null;
    if(isset($_POST['titre'] , $_POST['message'])){
    $message = new message($_POST['titre'], $_POST['message']);
	if($message->IsValid()){

	}else{
		$error = $message->geterror();
	}
    }
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Livre d'or</title>
  <link rel="stylesheet" href="csss.css">
</head>
<body>
	<?php if(!empty($error)) : ?>
		<div class="alert alert-danger">
			Formulaire invalide
		</div>
	<?php endif?>
<div class="container">
	<form action="" method="post">
		<div class="field" tabindex="1">
			<label>
				<i class="far fa-user"></i>Titre*
			</label>
			<input name="titre" type="text" placeholder="e.g. abcd" required>
			<?php if (isset($error['titre'])) :?>
			<div class="invalid-feedback"></div>
			<?php endif?>
		</div>
		<div class="field" tabindex="2">
            <label>
				<i class="far fa-user"></i>Image
			</label>
			<input name="image" type="file" placeholder="">
		</div>
		<div class="field" tabindex="3">
			<label for="message">
				<i class="far fa-edit"></i>Message*
			</label>
			<textarea name="message" placeholder="Ton Message" required></textarea>
		</div>
		<button>ADD NEW TESTIMONIAL</button>
	</form>
</div>

<!-- This is not part of Pen -->
<a class="me" href="https://codepen.io/uzcho_/pens/popular/?grid_type=list" target="_blank" style="color:#000"></a>
</body>
</html>