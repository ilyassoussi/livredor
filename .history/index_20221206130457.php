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
<div class="container">

	<form action="" method="post">
		<?php if(!empty($error)) : ?>
			<div class="alert alert-danger">
				Formulaire invalide
			</div>
		<?php endif?>
		<div class="field" tabindex="1">
			<label>
				<i class="far fa-user"></i>Titre*
			</label>
			<input value="<?= $_post['titre'] ?>" name="titre" type="text" placeholder="e.g. abcd" class="form-control <?= (isset($error['titre'])) ? 'is-invalid' : '' ?>">
			<?php if (isset($error['titre'])) :?>
			<div class="invalid-feedback"><?= $error['titre']  ?></div>
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
			<textarea name="message" placeholder="Ton Message" class="form-control <?= (isset($error['message'])) ? 'is-invalid' : '' ?>"></textarea>
			<?php if (isset($error['message'])) :?>
			<div id="validationServerUsernameFeedback" class="invalid-feedback"><?= $error['message']  ?></div>
			<?php endif?>
		</div>
		<button>ADD NEW TESTIMONIAL</button>
	</form>
</div>
</body>
</html>