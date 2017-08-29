<!DOCTYPE html>
<html lang="ru">
	<head>
	  <meta charset="UTF-8">
	  <link href="/style/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	  <link href="/style/style.css" rel="stylesheet" type="text/css"/>
	  <script type="text/javascript" src="/js/jquery-3.1.1.min.js"></script>
	  <script type="text/javascript" src="/js/bootstrap.min.js"></script>
	  <meta name="viewport" content="width=device-width, initial-scale = 1.0">
	  <link type="text/css" rel="stylesheet" href="/style/bootstrap-responsive.css">
	</head>
	<body>
	<div class="row-fluid" id="header">
		<div class="span12" id="box12">
			<?php require_once __DIR__ . "/header.php"; ?>
		</div>
	</div>

	<div class="container-fluid">
	  <div class="row-fluid">
	    <div class="span2" id="box4" id="menu"> 
			<?php require_once __DIR__ . "/menu.php"; ?>
		</div>

		<div class="span10" id="box8">
			<div>
				<h1>Your news line</h1>
			</div>
			<div>
			    <?php require_once __DIR__ . $path . $page_name.'.php'; ?> 
			</div>
		</div>
	  </div>
  	</div>

	<div class="row-fluid" id="footer">
		<div class="span12" id="box12">
			<?php require_once __DIR__ . "/footer.php"; ?>
		</div>
	</div>
	</body>
</html>
