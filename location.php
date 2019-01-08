<?php require_once('Connections/estatemgtdb.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO location (Id, Name, LGA, `State`, `primary key`) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Id'], "int"),
                       GetSQLValueString($_POST['Name'], "text"),
                       GetSQLValueString($_POST['LGA'], "text"),
                       GetSQLValueString($_POST['State'], "text"),
                       GetSQLValueString($_POST['primary_key'], "int"));

  mysql_select_db($database_estatemgtdb, $estatemgtdb);
  $Result1 = mysql_query($insertSQL, $estatemgtdb) or die(mysql_error());

  $insertGoTo = "location.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>locations.php</title>
<!-- TemplateEndEditable -->
<style type="text/css">
<!--
body {
	background-color: #999;
}
a {
	font-size: 14px;
	color: #FFF;
	font-weight: bold;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #FFF;
}
a:hover {
	text-decoration: none;
	color: #F00;
}
a:active {
	text-decoration: none;
	color: #FFF;
}
-->
</style>
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>

<body bgcolor="#FFFFFF">
<div align="center">
  <table width="858" height="518" border="1" bgcolor="#FFFFFF">
    <tr>
      <td height="48" colspan="2" bgcolor="#0000FF"><a href="home.php">HOME</a> | <a href="customer.php">CUSTOMER </a>| <a href="location.php">LOCATION</a> | <a href="properties.php">PROPERTY</a> | <a href="charges.php">CHARGES</a> | <a href="reports.php">REPORTS</a> | <a href="index.php">LOGOUT</a></td>
    </tr>
    <tr>
      <td colspan="2"><img src="images/Estate_mgt_banner.jpg" width="850" height="120" alt="banner" /></td>
    </tr>
    <tr>
      <td width="666" height="308"><h1>LOCATIONS</h1>
        <p>This page is where the customer has to enter the location of the building, where the building is situated for easy access.</p>
        <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
          <table align="center">
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Id:</td>
              <td><input type="text" name="Id" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Name:</td>
              <td><input type="text" name="Name" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">LGA:</td>
              <td><input type="text" name="LGA" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">State:</td>
              <td><input type="text" name="State" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Primary key:</td>
              <td><input type="text" name="primary_key" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">&nbsp;</td>
              <td><input type="submit" value="Insert record" /></td>
            </tr>
          </table>
          <input type="hidden" name="MM_insert" value="form2" />
        </form>
        <p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
      <p>&nbsp;</p></td>
      <td width="176" bgcolor="#0000FF"><p><strong><font color="#FFFFFF">Our Objective</font></strong></p>
        <p><font color="#FFFFFF">1. Creating a robust database that will help keep information about estates in Anambra State</font></p>
      <p><font color="#FFFFFF">2. Create a robust application where building informaton (floors, flats, stores, kitchen, building picture etx)owners, tenants and payment can be easily accessed.. </font></p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
<p>&nbsp;</p></td>
    </tr>
    <tr>
      <td height="37" colspan="2"><div align="center">Copyright &copy; 2015 All rights reserved</div></td>
    </tr>
  </table>
</div>
</body>
</html>