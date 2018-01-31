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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "alterar_usuario")) {
  $updateSQL = sprintf("UPDATE usuarios SET nome_completo=%s, senha=%s WHERE id_usuario=%s",
                       GetSQLValueString($_POST['nome_completo'], "text"),
                       GetSQLValueString($_POST['senha'], "text"),
                       GetSQLValueString($_POST['id_usuario'], "int"));

  mysql_select_db($database_conalliance, $conalliance);
  $Result1 = mysql_query($updateSQL, $conalliance) or die(mysql_error());

  $updateGoTo = "usuarios.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_alterar = "-1";
if (isset($_GET['id_usuario'])) {
  $colname_alterar = $_GET['id_usuario'];
}
mysql_select_db($database_conalliance, $conalliance);
$query_alterar = sprintf("SELECT * FROM usuarios WHERE id_usuario = %s", GetSQLValueString($colname_alterar, "int"));
$alterar = mysql_query($query_alterar, $conalliance) or die(mysql_error());
$row_alterar = mysql_fetch_assoc($alterar);
$totalRows_alterar = mysql_num_rows($alterar);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>alterar Dados</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
<form method="POST" action="<?php echo $editFormAction; ?>" name="alterar_usuario" class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Alterar Usuario</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nome_completo">Nome</label>  
  <div class="col-md-4">
  <input id="nome" name="nome_completo" type="text" placeholder="" class="form-control input-md" required="" value="<?php echo $row_alterar['nome_completo']; ?>">
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="senha">Senha</label>
  <div class="col-md-4">
    <input id="btnsenha" name="senha" type="password" placeholder="" class="form-control input-md" required="" value="<?php echo $row_alterar['senha']; ?>">
    
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="btntipousuario">Tipo Usuario</label>
  <div class="col-md-4">
    <select id="btntipousuario" name="btntipousuario" class="form-control">
      <option value="1">Normal</option>
      <option value="2">Administrador</option>
    </select>
  </div>
</div>



</fieldset>
<input type="hidden" name="MM_insert" value="form">
<input type="hidden" name="MM_insert" value="inserir_usuario.php">

	<input type="hidden" value="<?php echo $row_alterar['id_usuario']; ?>" name="id_usuario">

<div class="form-group">
  <label class="col-md-4 control-label" for="btnentrar"></label>
  <div class="col-md-8">
    <input class="botao" type="submit" name="alterar" value="Alterar">
    <a href="administracao.php" class="botao">Voltar</a>
  </div>
</div>
<input type="hidden" name="MM_update" value="inserir_usuario.php">
<input type="hidden" name="MM_update" value="alterar_usuario">
</form>


</body>
</html>
<?php
mysql_free_result($alterar);
?>
