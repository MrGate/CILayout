<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<?php if(isset($header_description)) { echo '<meta name="description" content="'.$header_description.'">'; }else{ echo '<meta name="description" content="a free and open community for gamers and game lovers">'; }  ?>
		<?php if(isset($header_keywords)) { echo "" . $header_keywords . "<meta name='keywords' content='".$header_keywords."'>"; } ?>
		<?php if(isset($header_scripts)) { echo $header_scripts; }  ?>
	</head>
	<body>
