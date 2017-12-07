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
				<div class="col-sm-9 col-sm-offset-3 col-md-12 col-md-offset-0 main">
					<div class="row">
						<div class="form-group col-md-10">
							<label for="lbl-filtro">Filtro</label>
							<input type="text" id="filtro" name="filtro" data-role="tagsinput" />
						</div>
						<div id="actions" class="row">
							<div class="col-md-2">
								<button type="button" id="btn-mining" class="btn btn-primary btn-miing">Mineirar</button>								
							</div>
						</div>							
					</div>
					<div class="row">
						<div class="form-group col-md-4">
							<label for="lbl-periodo-ini">Período Inicial</label>
							<input type="date" class="form-control" id="dt-periodo-ini" required>
						</div>
						<div class="form-group col-md-4">
							<label for="lbl-periodo-final">Período Final</label>
							<input type="date" class="form-control" id="dt-periodo-final" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12 col-xs-12">
							<label for="lbl-console">Console</label>				
							<div class="form-group">
								<textarea class="form-control" rows="15" id="txtConsole"></textarea>				
							</div>						
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
			var periodoFinal = new Date();
			var periodoInicial = new Date();
			periodoInicial.setDate(periodoInicial.getDate() - 7);
			
			$("#dt-periodo-ini").val(periodoInicial.getFullYear() + "-" + periodoInicial.getMonth() + "-" + periodoInicial.getDate());
			$("#dt-periodo-final").val(periodoFinal);
		});
	
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
