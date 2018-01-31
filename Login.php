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
$query_ca_cliente = "SELECT * FROM cadastro_cliente";
$ca_cliente = mysql_query($query_ca_cliente, $conalliance) or die(mysql_error());
$row_ca_cliente = mysql_fetch_assoc($ca_cliente);
$totalRows_ca_cliente = mysql_num_rows($ca_cliente);$colname_ca_cliente = "-1";
if (isset($_GET['email'])) {
  $colname_ca_cliente = $_GET['email'];
}
mysql_select_db($database_conalliance, $conalliance);
$query_ca_cliente = sprintf("SELECT * FROM cadastro_cliente WHERE email = %s", GetSQLValueString($colname_ca_cliente, "text"));
$ca_cliente = mysql_query($query_ca_cliente, $conalliance) or die(mysql_error());
$row_ca_cliente = mysql_fetch_assoc($ca_cliente);
$totalRows_ca_cliente = mysql_num_rows($ca_cliente);
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['email'])) {
  $loginUsername=$_POST['email'];
  $password=$_POST['senha'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "administracao.php";
  $MM_redirectLoginFailed = "Login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_conalliance, $conalliance);
  
  $LoginRS__query=sprintf("SELECT email, senha FROM cadastro_cliente WHERE email=%s AND senha=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $conalliance) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="body_login">

    <header class="header">
        <div class="logo"><a href="index.php"><img src="img/logo.png" alt=""></a></div>
      <div class="header_menu">
      <nav>
        <ul>
          <li><a href="CadastroClientes.php">Cadastrar</a></li>
          <li><a href="Administracao.php">Administração</a></li>
        </ul>
      </nav>
      </div>
    </header>

	<form action="<?php echo $loginFormAction; ?>" method="POST" name="Login" class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend class="login">Login</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtemail">E-mail</label>  
  <div class="col-md-2">
  <input id="txtemail" name="email" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="inputsenha">Senha</label>
  <div class="col-md-4">
    <input id="inputsenha" name="senha" type="password" placeholder="Digite sua senha " class="form-control input-md" required="">
    
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="btnentrar"></label>
  <div class="col-md-8">
    <button id="btnentrar" name="Login" class="btn btn-primary">Entrar</button>
    
    
  </div>
</div>

</fieldset>
</form>
<a href="<?php echo $logoutAction ?>" class="botao">Voltar</a>
	
</body>
</html>
<?php
mysql_free_result($ca_cliente);
?>
