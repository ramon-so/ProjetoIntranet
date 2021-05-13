<?php
include_once("conexao.php");
session_start();
$user = $_SESSION['lusuario'];
 ?>	
 
<?php
		$dataHoje = date('Y-m-d');	
		$grafico = "['titulos', 'Visualizações']";
        $sql="SELECT * FROM noticias ORDER BY id_noticia DESC";
        $sql2 = $conn->query($sql) or die($conn->error);
        while($dado = $sql2->fetch_array()){
          $dataBancoI=date('Y-m-d',strtotime($dado['dtInicio']));
          $dataBancoF=date('Y-m-d',strtotime($dado['dtFim']));
          if ($dataHoje >= $dataBancoI && $dataHoje <= $dataBancoF ) {
			  $id = $dado['id_noticia'];
			  $viu = 0;
			  $sql5 = "SELECT * FROM leu WHERE noticiaid = '$id'";
			  $sql5 = $conn->query($sql5) or die($conn->error);
			  while($dado2 = $sql5->fetch_array()){
				  $viu = $viu + 1;
			  }
			  
			  $grafico .= ",['".$dado['titulo']."', ".$viu."]";
			  $viu = 0;
          }
        }
         ?>
		 
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<title>Via Expressa Intranet - Relatorio de Noticias</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/relatorioNoticia.css">
	<style>
	body{
	background-image: url("img/t3.png");
	background-size: 100vw 100vh;
	}
	</style>
	
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          <?php echo $grafico ?>
        ]);

        var options = {
          title : 'Visualização das Noticias',
          vAxis: {title: 'Quantidade de visualizações'},
          hAxis: {title: 'Noticia'},
          seriesType: 'bars',
          series: {5: {type: 'line'}}        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
	
</head>
<body>
<header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" target="_blank" href="https://viaexpressa.com/">Via expressa</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(página atual)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" target="_blank" href="http://192.168.1.212/portal/">Intranet antiga</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" target="_blank" href="http://viaexpressaapp.com/glpi/">GLPI</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Menu
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php if ($user['Tipo_Usuario'] == "Admin"): ?>
          <a class="dropdown-item" href="gerenciarUsuario.php">Gerenciar Usuário</a>
          <a class="dropdown-item" href="cadastrarUsuario.php">Cadastrar Usuario</a>
          <?php endif; ?>
          <?php if ($user['Tipo_Usuario'] == "Admin" || $user['not'] == 1): ?>
          <a class="dropdown-item" href="postarNoticia.php">Postar Noticia</a>
          <a class="dropdown-item" href="relatorioNoticias.php">Relatório de noticias</a>
          <a class="dropdown-item" href="editarNoticia.php">Editar Noticia</a>
          <?php endif; ?>
          <?php if ($user['Tipo_Usuario'] == "Admin" || $user['RLNotas'] == 1): ?>
          <a class="dropdown-item" target="_blank" href="https://viaexpressaapp.com/appscanner/webviaexpressa/">Notas</a>
          <?php endif; ?>
          <?php if ($user['Tipo_Usuario'] == "Admin" || $user['RLPerformance'] == 1): ?>
          <a class="dropdown-item" target="_blank" href="http://192.168.1.219/PerformanceClienteTeste/">Performance</a>
          <?php endif; ?>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="processa.php" method="post">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Sair</button>
    </form>
  </div>
</nav>
    </header>

<nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
			
			<?php  
			include_once("conexao.php");
			$sql = "SELECT * FROM noticias ORDER BY id_noticia DESC";
			$sql2 = $conn->query($sql) or die($conn->error);
			while($dado = $sql2->fetch_array()){
			?>
			
              <li class="nav-item">
				<form action = "" method = "POST" >
                <button type="submit" style="width: 20vw; font-size: 12px;" name="idDaNoticia" value="<?php echo $dado['id_noticia']; ?>" class="btn btn-light btn-block"><?php echo $dado['titulo']; ?></button>
				<hr>
				</form>
              </li>
			  <?php } ?>
            </ul>

            
          </div>
        </nav>
		
		<div class="grafico" id = "divGrafico">
		<?php if(!isset($_POST["idDaNoticia"])){ ?>
		<div id="chart_div" style="width: 100%; height: 500px"></div>
		<?php } ?>
		<?php if(isset($_POST["idDaNoticia"])){ 
		$id = $_POST["idDaNoticia"];
		$linha = 0;
		?>
		<div class="grafico">
			<table class = "table table-dark table-bordered" >
				<thead>
					<tr>
						<td>
							Pessoas que leram a noticia
						</td>
					</tr>
				</thead>
				<tbody>
					<?php
						include_once("conexao.php");
						$conta = 0;
						$sql = "SELECT * FROM leu WHERE noticiaid = '$id'";
						$sql2 = $conn->query($sql) or die($conn->error);
						while ($dado = $sql2->fetch_array()) {
						if ($conta == 0) {
						?>
						<tr>
						</tr><?php } ?>
						<td><?php echo $dado['pessoa']; ?></td>

							<?php
						$conta = $conta+1;
						if ($conta == 5) {
						$conta = 0;
						}
						}
					?>
				</tbody>
			</table>
		</div>
		<?php } ?>
		</div>
		
		<script>
	imagens = [ 't1.JPG',  't2.JPG',  't4.JPG',  'Foto.png', 't3.png' ];
	var i = 0;
	elBody = document.getElementsByTagName("body")[0];
	elBody.classList.add('corpo');
	setInterval( function() {
	elBody.style.backgroundImage = 'url(img/' + imagens[i] + ')';
	elBody.style.transition = 'all 3s ease';
		if ( i < 4 ) {
			i = i + 1;
		}else{
		i=0;
		}
	}, 7000);
	<?php $usuario = $_SESSION['lusuario']; ?>
</script>
		
</body>
</html>