<?php require_once('Connections/conalliance.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_conalliance, $conalliance);
$query_tb_usuario = "SELECT * FROM usuarios";
$tb_usuario = mysql_query($query_tb_usuario, $conalliance) or die(mysql_error());
$row_tb_usuario = mysql_fetch_assoc($tb_usuario);
$totalRows_tb_usuario = mysql_num_rows($tb_usuario);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Gerenciamento de Usuario</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <table border = 1>
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>senha</th>
      <th> Ação</th>
      <th> Ação</th>
      </tr>
    <?php do { ?>
     <tr>
      <td><?php echo $row_tb_usuario['id_usuario']; ?></td>
      <td><?php echo $row_tb_usuario['nome_completo']; ?></td>
      <td><?php echo $row_tb_usuario['senha']; ?></td>
      <td><input type="button" class="" value="Alterar" onClick="location. href='alterar.php?id_usuario=<?php echo $row_tb_usuario['id_usuario']; ?>'"></td>
     <td><input name="excluir" type="button" class="" value="Excluir" onClick="location. href='excluir.php?id_usuario=<?php echo $row_tb_usuario['id_usuario']; ?>'"></td>
    </tr>
      <?php } while ($row_tb_usuario = mysql_fetch_assoc($tb_usuario)); ?>
  </table>
  <br>
  
<a href="inserir_usuario.php" class="botao">Inserir</a>
	<a href="administracao.php" class="botao">Voltar</a>
  

</body>
</html>
<?php
mysql_free_result($tb_usuario);
?>
