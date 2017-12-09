<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Mineirar Informações do Twitter Api</title>
  <link rel="stylesheet" href="../css/style.css">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
  
  <link rel="stylesheet" href="../css/bootstrap-tagsinput.css">
  <link rel="stylesheet" href="../css/app.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  
  <script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="../js/controller.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.20/angular.min.js"></script>  
	
  <script src="../js/bootstrap-tagsinput.min.js"></script>
	
</head>

<body>
  
<div class="container">
	<div class="tutorial">
		<!--menu <!-->
		<ul>
			<a href="../index.html"><li>Home</li></a>
			<li>Exemplos<i class="fa fa-angle-down"></i>
				<ul>
					<a href="../examples/getGlobalTweetsExample.php">
						<li>Buscar Tweet por #</li>
					</a>
					<a href="../examples/getTweetFromGeocodeExample.php">
						<li>Buscar Tweet por Localização</li>
					</a>
					<a href="../examples/getUserExample.php">
						<li>Buscar Tweet por Usuário</li>
					</a>
					<a href="../examples/saveDataFirebaseExample.php">
						<li>Firebase</li>
					</a>
				</ul>
			</li>
			<li>Serviços <i class="fa fa-angle-down"></i>
				<ul>
					<a href=#">
						<li>Minerar Informação [Twitter]</li>
					</a>
					<a href="pages/resultados.php">
						<li>Resultados [Twitter]</li>
					</a>
				</ul>
			</li>
			<a href="#"><li>Contato</li></a> 
		</ul>
		<!--fim menu <!-->
		<form id="content" action="#" method="post">
			<input type="hidden" id="action" name="action"/>
			<input type="hidden" id="tags"   name="tags"/>
			
			<div class="slider">
				<br>
				<div class="col-sm-9 col-sm-offset-3 col-md-12 col-md-offset-0 main">
					<div class="row">
						<div class="form-group col-md-12">
							<label id="lblResultado"></label>
						</div>
					</div>
				</div>
			</div>
			<div class="information">
				<p>A simple, clean looking dropdown menu effect achieved using pure CSS. Simple functionality, method can be extended to create a secondary dropdown block with few edits.</p>
			</div>
	</div>
</div>
	<script language="javascript">
		$(document).ready(function(){	
			jQuery.ajax({
				type: "POST",
				url: "../lib/getResultados.php",
				data: {
				},
				success: function (data) {				
					$("#lblResultado").text(data);
				},
				error: function (data) {
					alert(data);	
				}
			});
		});
	</script>
</body>
</html>
