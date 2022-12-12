
<?php
require 'class/Message.php';
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
		}else{
		$error = $message->geterror();
			}
    }
$messages = $saved->getmsg(); 
if(!empty($_FILES['image']))
    {
        
        $nameFile = $_FILES['image']['name'];
        $typeFile = $_FILES['image']['type'];
        $sizeFile = $_FILES['image']['size'];
        $tmpFile = $_FILES['image']['tmp_name'];
        $errFile = $_FILES['image']['error'];
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

	<form action=""  method="post">
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
		<button>ADD NEW TESTIMONIAL</button>
		<?php
        require 'uploadimg/upload.php';
		?>
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