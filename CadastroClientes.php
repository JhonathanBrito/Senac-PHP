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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "CadastroCliente.php")) {
  $insertSQL = sprintf("INSERT INTO cadastro_cliente (id_cliente, nome_completo, senha, cpf, rg, endereco, cep, bairro, cidade, estado, data_nascimento, telefone, sexo, email) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_cliente'], "int"),
                       GetSQLValueString($_POST['nome_completo'], "text"),
                       GetSQLValueString($_POST['senha'], "text"),
                       GetSQLValueString($_POST['cpf'], "text"),
                       GetSQLValueString($_POST['rg'], "text"),
                       GetSQLValueString($_POST['endereco'], "text"),
                       GetSQLValueString($_POST['cep'], "text"),
                       GetSQLValueString($_POST['bairro'], "text"),
                       GetSQLValueString($_POST['cidade'], "text"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['data_nascimento'], "date"),
                       GetSQLValueString($_POST['telefone'], "text"),
                       GetSQLValueString($_POST['sexo'], "text"),
                       GetSQLValueString($_POST['email'], "text"));

  mysql_select_db($database_conalliance, $conalliance);
  $Result1 = mysql_query($insertSQL, $conalliance) or die(mysql_error());

  $insertGoTo = "Login.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conalliance, $conalliance);
$query_cad_cliente = "SELECT * FROM cadastro_cliente";
$cad_cliente = mysql_query($query_cad_cliente, $conalliance) or die(mysql_error());
$row_cad_cliente = mysql_fetch_assoc($cad_cliente);
$totalRows_cad_cliente = mysql_num_rows($cad_cliente);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cadastro de Cliente</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header class="header">
        <div class="logo"><a href="index.php"><img src="img/logo.png" alt=""></a></div>
      <div class="header_menu">
      <nav>
        <ul>
          
          <li><a href="Login.php">Login</a></li>
          <li><a href="Administracao.php">Administração</a></li>
          
        </ul>
      </nav>
      </div>
    </header>


    <form action="<?php echo $editFormAction; ?>" method="POST" name="CadastroCliente.php" class="form-horizontal">
    <fieldset>

<!-- Form Name -->
<legend class="cadastro">Cadastro</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtnome">Nome Completo</label>  
  <div class="col-md-5">
  <input id="txtnome" name="nome_completo" type="text" placeholder="Digite seu Nome Completo" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="inputsenha">Senha</label>
  <div class="col-md-4">
    <input id="inputsenha" name="senha" type="password" placeholder="" class="form-control input-md" required="">
    <span class="help-block">Max de 12 Dígitos Contendo Maiúscula e número</span>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtcpf">Cpf</label>  
  <div class="col-md-5">
  <input id="txtcpf" name="cpf" type="text" placeholder="" class="form-control input-md" required="">
  <span class="help-block">ex:000.000.000-00</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtrg">RG</label>  
  <div class="col-md-5">
  <input id="txtrg" name="rg" type="text" placeholder="" class="form-control input-md" required="">
  <span class="help-block">ex:00.000.000-0</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtendereco">Endereço Completo</label>  
  <div class="col-md-5">
  <input id="txtendereco" name="endereco" type="text" placeholder="Digite seu endereço" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtcep">CEP</label>  
  <div class="col-md-4">
  <input id="txtcep" name="cep" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtbairro">Bairro</label>  
  <div class="col-md-4">
  <input id="txtbairro" name="bairro" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtcidade">Cidade</label>  
  <div class="col-md-4">
  <input id="txtcidade" name="cidade" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtestado">Estado</label> 
  <div class="col-md-2">
  <input id="txtestado" name="estado" type="text" placeholder="" class="form-control input-md" required="" maxlength="2">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtdatanascimento">Data de Nascimento</label>  
  <div class="col-md-4">
  <input id="txtdatanascimento" name="data_nascimento" type="date" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txttelefone">Telefone</label>  
  <div class="col-md-5">
  <input id="txttelefone" name="telefone" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Multiple Radios -->
<div class="form-group">
  <label class="col-md-4 control-label" for="input">Sexo</label>
  <div class="col-md-4">
  <div class="radio">
    <label for="input-0">
      <input type="radio" name="sexo" id="input-0" value="M" checked="checked">
      Masculino
    </label>
  </div>
  <div class="radio">
    <label for="input-1">
      <input type="radio" name="sexo" id="input-1" value="F">
      Feminino
    </label>
  </div>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtemail">E-mail</label>  
  <div class="col-md-4">
  <input id="txtemail" name="email" type="text" placeholder="" class="form-control input-md" required="">
  <span class="help-block">Exemplo@hotmail.com</span>  
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="btnentrar"></label>
  <div class="col-md-8">
    <button id="btncadastrar" name="btncadastrar" class="btn btn-primary">Cadastrar</button>
    <a href="index.php" class="botao">Voltar</a>
  </div>
</div>


</fieldset>
    <input type="hidden" name="MM_insert" value="CadastroCliente.php">
</form>

  
</body>
</html>
<?php
mysql_free_result($cad_cliente);
?>
