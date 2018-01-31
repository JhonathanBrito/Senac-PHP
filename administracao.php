<?php require_once('Connections/conalliance.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "Login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
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
$query_admm = "SELECT email, senha FROM cadastro_cliente";
$admm = mysql_query($query_admm, $conalliance) or die(mysql_error());
$row_admm = mysql_fetch_assoc($admm);
$totalRows_admm = mysql_num_rows($admm);$colname_admm = "-1";
if (isset($_GET['email'])) {
  $colname_admm = $_GET['email'];
}
mysql_select_db($database_conalliance, $conalliance);
$query_admm = sprintf("SELECT senha, email FROM cadastro_cliente WHERE email = %s", GetSQLValueString($colname_admm, "text"));
$admm = mysql_query($query_admm, $conalliance) or die(mysql_error());
$row_admm = mysql_fetch_assoc($admm);
$totalRows_admm = mysql_num_rows($admm);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Area Administrativa</title>
 <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
<header class="tb_adm">
	<h2>Administração</h2>
</header>
<section class="adm_btn">
	<a href="usuarios.php" class="botao">Usuarios</a>
	<a href="usuario_cliente.php" class="botao">Clientes</a>
	<a href="<?php echo $logoutAction ?>" class="botao">Voltar</a>
	
	<br>
	
</section>

</body>
</html>
<?php
mysql_free_result($admm);
?>
