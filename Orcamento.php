<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Orçamento</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header class="header">
        <div class="logo"><a href="index.php"><img src="img/logo.png" alt=""></a></div>
      <div class="header_menu">
      <nav>
        <ul>
          <li><a href="">Quem Somos</a></li>
          <li><a href="Contato.php">Contato</a></li>
          <li><a href="Login.php">Login</a></li>
          <li><a href="CadastroClientes.php">Cadastrar</a></li>
        </ul>
      </nav>
      </div>
    </header>

	<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend class="orcamento">Orçamento</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtnome">Nome Completo</label>  
  <div class="col-md-4">
  <input id="txtnome" name="txtnome" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtendereco">Endereço</label>  
  <div class="col-md-5">
  <input id="txtendereco" name="txtendereco" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="btnarquivo">Imagem da Planta Baixa</label>
  <div class="col-md-4">
    <input id="btnarquivo" name="btnarquivo" class="input-file" type="file">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtcep">CEP</label>  
  <div class="col-md-4">
  <input id="txtcep" name="txtcep" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtambiente">Ambiente que Deseja Planejar</label>  
  <div class="col-md-5">
  <input id="txtambiente" name="txtambiente" type="text" placeholder="" class="form-control input-md" required="">
  <span class="help-block">ex:sala,cozinha etc</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtcidade">Cidade</label>  
  <div class="col-md-4">
  <input id="txtcidade" name="txtcidade" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtagendamento">Agendar um Dia de Visita</label>  
  <div class="col-md-4">
  <input id="txtagendamento" name="txtagendamento" type="text" placeholder="" class="form-control input-md" required="">
  <span class="help-block">Dia e Hora</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txttelefone">Telefone</label>  
  <div class="col-md-4">
  <input id="txttelefone" name="txttelefone" type="tel" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtinformacoes">Outras Informações</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="txtinformacoes" name="txtinformacoes"></textarea>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtbairro">Bairro</label>  
  <div class="col-md-4">
  <input id="txtbairro" name="txtbairro" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="txtemail">E-mail</label>  
  <div class="col-md-2">
  <input id="txtemail" name="txtemail" type="email" placeholder="" class="form-control input-md" required="">
    
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


</fieldset>
</form>

	
</body>
</html>