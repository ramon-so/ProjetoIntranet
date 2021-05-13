<?php
session_start();
if (isset($_POST['email'])) {
  include_once("conexao.php");
  $email=$_POST['email'];
  $senha=md5($_POST['senha']);

  $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
  $sql2 = $conn->query($sql) or die($conn->error);
  $dado = $sql2->fetch_array();
    if ($dado['id_usuario'] > 0) {
      $expira = time() + ( 60 * 60 * 24 * 30 );
      $_SESSION['lusuario']=$dado;
      $cookie = $dado['email'];
      setcookie('login2', $cookie, $expira);
      ?>
      <script type="text/javascript">
        window.location.href = "home.php";
      </script>
      <?php

    }
    else {
      ?>
        <script type="text/javascript">
          alert("Não Cadastrado.");
          window.location.href = "index.php";
        </script>
        <?php
    }
    }
if(isset($_POST["sair"])){
	unset($_SESSION['lusuario']);
	setcookie('login2', -1);
	?>
        <script type="text/javascript">
          window.location.href = "index.php";
        </script>
    <?php
}

 ?>
