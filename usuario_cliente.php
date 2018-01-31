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
$query_clientes = "SELECT * FROM cadastro_cliente";
$clientes = mysql_query($query_clientes, $conalliance) or die(mysql_error());
$row_clientes = mysql_fetch_assoc($clientes);
$totalRows_clientes = mysql_num_rows($clientes);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Clientes Cadastrados</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
<h2>Clientes Cadastrado</h2>

<table border = 1>
    <tr>
      <th>Nome</th>
      <th>Cpf</th>
      <th>Rg</th>
      <th>Cidade</th>
      <th>Estado</th>
      <th>Telefone</th>
      <th>Email</th>
  </tr>
   <?php do { ?>
   <tr>
   	<td><?php echo $row_clientes['nome_completo']; ?></td>
   	<td><?php echo $row_clientes['cpf']; ?></td>
   	<td><?php echo $row_clientes['rg']; ?></td>
   	<td><?php echo $row_clientes['cidade']; ?></td>
   	<td><?php echo $row_clientes['estado']; ?></td>
   	<td><?php echo $row_clientes['telefone']; ?></td>
   	<td><?php echo $row_clientes['email']; ?></td>
 
   </tr>
   <?php } while ($row_clientes = mysql_fetch_assoc($clientes)); ?>
   
</table>
<br>
<a href="administracao.php" class="botao">Voltar</a>
</body>
</html>
<?php
mysql_free_result($clientes);
?>
