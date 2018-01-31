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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "inserir_usuario.php")) {
  $insertSQL = sprintf("INSERT INTO usuarios (nome_completo, senha) VALUES (%s, %s)",
                       GetSQLValueString($_POST['nome_completo'], "text"),
                       GetSQLValueString($_POST['senha'], "text"));

  mysql_select_db($database_conalliance, $conalliance);
  $Result1 = mysql_query($insertSQL, $conalliance) or die(mysql_error());

  $insertGoTo = "usuarios.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conalliance, $conalliance);
$query_inserir = "SELECT * FROM usuarios";
$inserir = mysql_query($query_inserir, $conalliance) or die(mysql_error());
$row_inserir = mysql_fetch_assoc($inserir);
$totalRows_inserir = mysql_num_rows($inserir);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Inserir Usuario</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

<form method="POST" action="<?php echo $editFormAction; ?>" name="inserir_usuario.php" class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Inserir Usuario</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nome_completo">Nome</label>  
  <div class="col-md-4">
  <input id="nome" name="nome_completo" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="senha">Senha</label>
  <div class="col-md-4">
    <input id="btnsenha" name="senha" type="password" placeholder="" class="form-control input-md" required="">
    
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

<input type="submit" name="inserir_usuario.php" class="botao" value="Inserir">
<a href="usuarios.php" class="botao">Voltar</a>
</form>


	

	

</body>
</html>
<?php
mysql_free_result($inserir);
?>
