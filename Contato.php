<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Contato</title>
	<link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="body_contato">
    <header class="header">
        <div class="logo"><a href="index.php"><img src="img/logo.png" alt=""></a></div>
      <div class="header_menu">
      <nav>
        <ul>
          <li><a href="">Quem Somos</a></li>
          <li><a href="Orcamento.php">Orçamento</a></li>
          <li><a href="Login.php">Login</a></li>
          <li><a href="CadastroClientes.php">Cadastrar</a></li>
        </ul>
      </nav>
      </div>
    </header>

	<form action="usuarios.php" method="post" name="Contato.php" class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend class="contato">Contato</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtnome">Nome Completo</label>  
  <div class="col-md-4">
  <input id="txtnome" name="txtnome" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtemail">E-mail</label>  
  <div class="col-md-5">
  <input id="txtemail" name="txtemail" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtassunto">Assunto</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="txtassunto" name="txtassunto">texto</textarea>
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="btnentrar"></label>
  <div class="col-md-8">
    <button id="btnentrar" name="btnentrar" class="btn btn-primary">Entrar</button>
    <a href="index.php" class="botao">Voltar</a>
  </div>
</div>
	
</body>
</html>