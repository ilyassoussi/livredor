<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Livre d'or</title>
  <link rel="stylesheet" href="css.css">
</head>
<body>
<div class="container">
	<form action="" method="post">
		<div class="field" tabindex="1">
			<label for="username">
				<i class="far fa-user"></i>Your Name
			</label>
			<input name="username" type="text" placeholder="e.g. john doe" required>
		</div>
		<div class="field" tabindex="2">
			<label for="email">
				<i class="far fa-envelope"></i>Your Email
			</label>
			<input name="email" type="text" placeholder="email@domain.com" required>
		</div>
		<div class="field" tabindex="3">
			<label for="message">
				<i class="far fa-edit"></i>Your Message
			</label>
			<textarea name="message" placeholder="type here" required></textarea>
		</div>
		<button type="reset">Send Me Message</button>
	</form>
</div>

<!-- This is not part of Pen -->
<a class="me" href="https://codepen.io/uzcho_/pens/popular/?grid_type=list" target="_blank" style="color:#000"></a>
</body>