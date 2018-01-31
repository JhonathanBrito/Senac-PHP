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
$query_teste = "SELECT * FROM login";
$teste = mysql_query($query_teste, $conalliance) or die(mysql_error());
$row_teste = mysql_fetch_assoc($teste);
$totalRows_teste = mysql_num_rows($teste);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body class="body_index">
	<header class="header">
			<div class="logo"><a href="index.php"><img src="img/logo.png" alt=""></a></div>
		<div class="header_menu">
		<nav>
			<ul>
				<li><a href="Login.php">Login</a></li>
				<li><a href="CadastroClientes.php">Cadastrar</a></li>
          		<li><a href="Administracao.php">Administração</a></li>
			</ul>
		</nav>
		</div>
	</header>
	<section class="container">
		<div class="empresa">
			<h2>Nossa Empresa</h2>
			<br>
			<p>Nossa empresa foca em fabricação de moveis planejados, atendendo Campinas e Região.</p>
			<br>
			<h2>Conheça Nossos Trabalho</h2>
			<div class="imagem_cadeira"><a href=""><img src="img/cadeira.png" alt=""></a></div>
			
		
		</div>	
	</section>
	<footer class="footer">

		<div class="row container">
			<div class="endereco">
				<img src="img/endereco.png" alt="">
				<ul>
					<li>Rua:</li>
					<li>cidade</li>
					<li>bairro</li>
				</ul>
			</div>
			<div class="footer_contato">
				<img src="img/WhatsApp.png" alt="">
				<ul>
					<li>Tel</li>
					<li>Email:</li>
					<li>Whats</li>
				</ul>		
			</div>
			<div class="redes_socias">
				<img src="img/face.png" alt="">
			</div>
		</div>
	</footer>
</body>
</html>
<?php
mysql_free_result($teste);
?>
