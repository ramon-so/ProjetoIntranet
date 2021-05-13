<?php
include_once("conexao.php");
session_start();
$user = $_SESSION['lusuario'];
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Via Expressa Intranet - Gerenciar Usuarios</title>
	<link rel="stylesheet" href="css/estiloGerenciar.css" >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
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
  <div class="usuariosAjuste">
  <h3>Usuarios cadastrados</h3>
    <table class="table table-dark">
      <thead>
        <td>Nome</td>
        <td>Email</td>
        <td>Senha</td>
        <td>Tipo de acesso</td>
        <td>Relatorio de performance</td>
        <td>Relatorio de notas</td>
        <td>Sistema de noticias</td>
        <td></td>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM usuarios";
        $sql = $conn->query($sql) or die($conn->error);
        while($dado = $sql->fetch_array()){
         ?>
         <form class="" action="index.html" method="post">
           <tr>
         <td> <input class="form-control" type="text" name="" value="<?php echo $dado['nome']; ?>"> </td>
         <td> <input class="form-control" type="text" name="" value="<?php echo $dado['email']; ?>"> </td>
         <td> <input class="form-control" type="password" name="" value=""> </td>
         <td> <select class="form-control" name="">
              <option class="form-control" value="">Admin</option>
              <option class="form-control" value="">Funcionario</option>
              <option class="form-control" value="">Cliente</option>
              <option class="form-control" value="">Fornecedor</option>
         </select> </td>
         <td> <select class="form-control" name="">
              <option class="form-control" value="">Sim</option>
              <option class="form-control" value="">Não</option>
         </select> </td>
         <td> <select class="form-control" name="">
			  <option class="form-control" value="">Sim</option>
			  <option class="form-control" value="">Não</option>
         </select> </td>
         <td> <select class="form-control" name="">
			  <option class="form-control" value="">Sim</option>
			  <option class="form-control" value="">Não</option>
         </select> </td>
         <td> <button class="btn btn-primary" type="submit" name="button">Confirmar</button> </td>
       </tr>
     </form>
       <?php } ?>
      </tbody>
    </table>
  </div>

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
