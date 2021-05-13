<?php
include_once("conexao.php");
session_start();
$user = $_SESSION['lusuario'];
if(isset($_SESSION['guardaNoticia'])){
$dados = $_SESSION['guardaNoticia'];
$titulo = $dados['titulo'];
$conteudo = $dados['conteudo'];
}else{
	$titulo = "";
	$conteudo = "";
}


 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Via Expressa Intranet - Postar Noticia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/postarnoticia.css">
	<style>
	body{
	background-image: url("img/t3.png");
	background-size: 100vw 100vh;
	}
	</style>
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
	<div class="all">
		<script src="ckeditor/ckeditor.js"></script>
     <script>
      CKEDITOR.replace('conteudo');
      </script>
	  <div class="postarNoticia">
		<h3>Noticía</h3>
		<form enctype="multipart/form-data" action="processanoticia.php" method="post">
			<div class="form-group">
			<input type="text" class="form-control" value="<?php echo $titulo ?>" name="titulo" id="exampleFormControlInput1" placeholder="Titulo">
			</div>
			<div class="form-group">
      <textarea  id="conteudo" class="form-control" name="conteudo" id="exampleFormControlTextarea1" placeholder="Conteudo" rows="10"><?php echo $conteudo ?></textarea>
			</div>
			<label for="exampleFormControlFile1">Imagem de capa</label>
			<div class="form-group">
			<div class="teste">
			<input type="file" name="picr" class="form-control-file" id="exampleFormControlFile1">
			</div>
			</div>
			<label for="exampleFormControlFile1">Imagens do texto</label>
			<div class="teste">
			
			<input type="file" onchange="mostra1()" name="pic" class="form-control-file" id="exampleFormControlFile1">
			</div>
			<div class="teste">
			<input  name="pic2" onchange="mostra2()" style="display: none;" type="file" class="form-control-file" id="pic2">
			</div>
			<div class="teste">
			<input  name="pic3" style="display: none;" type="file" class="form-control-file" id="pic3">
			</div>
			<br>
			
			Data Inicio: <input type="date" name="dtInicio" value=""> Data fim: <input type="date" name="dtFim" value="">
			
			<br><br>
			
			<button type="submit" class="btn btn-primary btn-lg btn-block">Confirmar</button>
		</form>
		</div>
	</div>
	<script src="ckeditor/ckeditor.js"></script>
        <script>
                CKEDITOR.replace( 'conteudo' );
        </script>
    <script>
      function mostra1() {
        visivel = document.getElementById("pic2");
        visivel.style.display = 'block';

      }
    </script>
    <script>
      function mostra2() {
        visivel = document.getElementById("pic3");
        visivel.style.display = 'block';

      }
    </script>
	
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