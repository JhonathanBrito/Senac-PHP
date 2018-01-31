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

if ((isset($_GET['id_usuario'])) && ($_GET['id_usuario'] != "")) {
  $deleteSQL = sprintf("DELETE FROM usuarios WHERE id_usuario=%s",
                       GetSQLValueString($_GET['id_usuario'], "int"));

  mysql_select_db($database_conalliance, $conalliance);
  $Result1 = mysql_query($deleteSQL, $conalliance) or die(mysql_error());

  $deleteGoTo = "usuarios.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_excluir = "-1";
if (isset($_GET['id_usuario'])) {
  $colname_excluir = $_GET['id_usuario'];
}
mysql_select_db($database_conalliance, $conalliance);
$query_excluir = sprintf("SELECT * FROM usuarios WHERE id_usuario = %s", GetSQLValueString($colname_excluir, "int"));
$excluir = mysql_query($query_excluir, $conalliance) or die(mysql_error());
$row_excluir = mysql_fetch_assoc($excluir);
$totalRows_excluir = mysql_num_rows($excluir);
?>

<?php
mysql_free_result($excluir);
?>
