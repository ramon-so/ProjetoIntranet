<?php
    include_once("conexao.php");
    $id=$_POST['idNoticia'];
    if(isset($_POST['titulo'])){
        $titulo = $_POST['titulo'];
        $sql="UPDATE noticias SET titulo = '$titulo' WHERE id_noticia = '$id'";
        $sql = $conn->query($sql) or die($conn->error);
    }
    if(isset($_POST['conteudo'])){
        $conteudo = $_POST['conteudo'];
        $sql="UPDATE noticias SET conteudo = '$conteudo' WHERE id_noticia = '$id'";
        $sql = $conn->query($sql) or die($conn->error);
    }
    if(isset($_POST['dtInicial'])){
        $dtInicial = $_POST['dtInicial'];
        $sql="UPDATE noticias SET dtInicio = '$dtInicial' WHERE id_noticia = '$id'";
        $sql = $conn->query($sql) or die($conn->error);
    }
    if(isset($_POST['dtFim'])){
        $dtFim = $_POST['dtFim'];
        $sql="UPDATE noticias SET dtFim = '$dtFim' WHERE id_noticia = '$id'";
        $sql = $conn->query($sql) or die($conn->error);
    }
    $img = $_FILES['ref'];
    if($img['error'] == 0){
        $dir = "img/up/";
        $name = $img['name'];
        if(move_uploaded_file($img['tmp_name'], $dir.$name)){
            $loc = $dir.$name;
            $sql="UPDATE noticias SET imagemr = '$loc' WHERE id_noticia = '$id'";
            $sql = $conn->query($sql) or die($conn->error);
        }
    } 
    $img = $_FILES['img'];
    if($img['error'] == 0){
        $dir = "img/up/";
        $name = $img['name'];
        if(move_uploaded_file($img['tmp_name'], $dir.$name)){
            $loc = $dir.$name;
            $conteudo = $textoTrocado = str_ireplace("imagem1","$loc","$conteudo");
            $sql="UPDATE noticias SET conteudo = '$conteudo' WHERE id_noticia = '$id'";
            $sql = $conn->query($sql) or die($conn->error);
            $sql="UPDATE noticias SET imagem1 = '$loc' WHERE id_noticia = '$id'";
            $sql = $conn->query($sql) or die($conn->error);
        }
    } 
    $img = $_FILES['img1'];
    if($img['error'] == 0){
        $dir = "img/up/";
        $name = $img['name'];
        if(move_uploaded_file($img['tmp_name'], $dir.$name)){
            $loc = $dir.$name;
            $conteudo = $textoTrocado = str_ireplace("imagem2","$loc","$conteudo");
            $sql="UPDATE noticias SET conteudo = '$conteudo' WHERE id_noticia = '$id'";
            $sql = $conn->query($sql) or die($conn->error);
            $sql="UPDATE noticias SET imagem2 = '$loc' WHERE id_noticia = '$id'";
            $sql = $conn->query($sql) or die($conn->error);
        }
    } 
    $img = $_FILES['img2'];
    if($img['error'] == 0){
        $dir = "img/up/";
        $name = $img['name'];
        if(move_uploaded_file($img['tmp_name'], $dir.$name)){
            $loc = $dir.$name;
            $conteudo = $textoTrocado = str_ireplace("imagem3","$loc","$conteudo");
            $sql="UPDATE noticias SET conteudo = '$conteudo' WHERE id_noticia = '$id'";
            $sql = $conn->query($sql) or die($conn->error);
            $sql="UPDATE noticias SET imagem3 = '$loc' WHERE id_noticia = '$id'";
            $sql = $conn->query($sql) or die($conn->error);
        }
    } 
?>
<script>
alert("atualizado com sucesso!");
window.location.href = "home.php";
</script>