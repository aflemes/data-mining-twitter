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
					<li>Minerar Informação [Twitter]</li>
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
				<div class="fields">
					<br>
					<div class="lbl-filtro">
						Filtro
						<input type="text" id="filtro" name="filtro" data-role="tagsinput" />
						<input id="btn-mining" class="btn-mining" type="button" value="Mineirar"/>
					</div>			
				</div>
				<div class="console">
					Console
					<textarea class="textarea" id="txtConsole"></textarea>				
				</div>
			</div>
			<div class="information">
				<p>A simple, clean looking dropdown menu effect achieved using pure CSS. Simple functionality, method can be extended to create a secondary dropdown block with few edits.</p>
			</div>
	</div>
</div>
	<script language="javascript">
		$("#btn-mining").click(function(){
			$("#action").val("minning");

			var tags = ($("#filtro").val()).split(",");			
			for (i = 0; i < tags.length; i++){
				minning(tags[i]);
			}
		});
		
		function minning(tag){		
			jQuery.ajax({
				type: "POST",
				url: "../examples/getUserExample.php",
				data: {
					action: 'minning',
					tag: tag
				},
				success: function (data) {				
					$("#txtConsole").append(data);
				},
				error: function (data) {
					alert(data);	
				}
			});		
		}		
	</script>
</body>
</html>
