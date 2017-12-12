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
					<a href="mining_data.php">
						<li>Minerar Informação [Twitter]</li>
					</a>
					<a href="#">
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
							<canvas id="bar-chart" width="450" height="200"></canvas>
							<canvas id="pie-chart" width="450" height="200"></canvas>
						</div>
					</div>
				</div>
			</div>
			<div class="information">
				<p>A simple, clean looking dropdown menu effect achieved using pure CSS. Simple functionality, method can be extended to create a secondary dropdown block with few edits.</p>
			</div>
	</div>
</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
	<script language="javascript">
		function montagraficolinha(data){
			var atletismo = parseInt(data["Atletismo"])  * 10;
			var basquete  = parseInt(data["Basquete"])   * 10;
			var esports   = parseInt(data["ESports"])    * 10;
			var futebol   = parseInt(data["Futebol"])    * 15;
			var futebolamericano = parseInt(data["FutebolAmericano"]) * 5;
			var voleibol = parseInt(data["Voleibol"])    * 10;
			var tenis     = parseInt(data["Tenis"])      * 10;
			
			var total = atletismo + basquete + esports + futebol + futebolamericano + voleibol;
		
			$("#lblResultado").text("A pesquisa aqui apresentada tem como base " + total + " tweets!");
			
			new Chart(document.getElementById("bar-chart"), {
				type: 'bar',
				data: {
				  labels: ["Atletismo", "Basquete", "ESports", "Futebol", "FutebolAmericano", "Voleibol"],
				  datasets: [
					{
					  label: "Quantidade de Tweets",
					  backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
					  data: [atletismo,basquete,esports,futebol,futebolamericano,voleibol]
					}
				  ]
				},
				options: {
				  legend: { display: false },
				  title: {
					display: true,
					text: 'Resultados por categoria (Barra)'
				  }
				}
			});
		}
		
		function montagraficopizza(data){
			var atletismo = parseInt(data["Atletismo"]) * 10;
			var basquete  = parseInt(data["Basquete"])  * 10;
			var esports   = parseInt(data["ESports"])   * 10;
			var futebol   = parseInt(data["Futebol"])   * 15;
			var futebolamericano = parseInt(data["FutebolAmericano"]) * 5;
			var voleibol  = parseInt(data["Voleibol"])  * 10;
			var tenis     = parseInt(data["Tenis"])     * 10;
			
			var total = atletismo + basquete + esports + futebol + futebolamericano + voleibol;
			// Percentual
			atletismo = (atletismo * 100 / total).toFixed(2);
			basquete  = (basquete * 100 / total).toFixed(2);
			esports   = (esports * 100 / total).toFixed(2);
			futebol   = (futebol * 100 / total).toFixed(2);
			futebolamericano = (futebolamericano * 100 / total).toFixed(2);
			voleibol = (voleibol * 100 / total).toFixed(2);
			tenis    = (tenis * 100 / total).toFixed(2);
		
			new Chart(document.getElementById("pie-chart"), {
				type: 'pie',
				data: {
				  labels: ["Atletismo", "Basquete", "ESports", "Futebol", "Futebol Americano", "Voleibol"],
				  datasets: [
					{
					  label: "Porcentagem dos tweets",
					  backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
					  data: [atletismo,basquete,esports,futebol,futebolamericano,voleibol]
					}
				  ]
				},
				options: {
				  title: {
					display: true,
					text: 'Resultados por categoria (Pizza)'
				  }
				}
			});
		}
		
		$(document).ready(function(){
			jQuery.ajax({
				type: "GET",
				url: "../lib/getResultados.php",
				success: function (data) {				
					montagraficolinha(data);
					montagraficopizza(data);
					$(".slider").height(800);
				},
				dataType:"json"
				// error: function (data) {
					// alert(data);	
				// }
			});
		});
		
		
		
	</script>
</body>
</html>
