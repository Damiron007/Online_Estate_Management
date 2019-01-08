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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO building (property_id, no_of_floors, building_description, property_group, property_type, assessment_value) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['property_id'], "text"),
                       GetSQLValueString($_POST['no_of_floors'], "text"),
                       GetSQLValueString($_POST['building_description'], "text"),
                       GetSQLValueString($_POST['property_group'], "text"),
                       GetSQLValueString($_POST['property_type'], "text"),
                       GetSQLValueString($_POST['assessment_value'], "text"));

  mysql_select_db($database_estatemgtdb, $estatemgtdb);
  $Result1 = mysql_query($insertSQL, $estatemgtdb) or die(mysql_error());

  $insertGoTo = "buildings.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE building SET no_of_floors=%s, building_description=%s, property_group=%s, property_type=%s, assessment_value=%s WHERE property_id=%s",
                       GetSQLValueString($_POST['no_of_floors'], "text"),
                       GetSQLValueString($_POST['building_description'], "text"),
                       GetSQLValueString($_POST['property_group'], "text"),
                       GetSQLValueString($_POST['property_type'], "text"),
                       GetSQLValueString($_POST['assessment_value'], "text"),
                       GetSQLValueString($_POST['property_id'], "text"));

  mysql_select_db($database_estatemgtdb, $estatemgtdb);
  $Result1 = mysql_query($updateSQL, $estatemgtdb) or die(mysql_error());

  $updateGoTo = "buildings.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_GET['Id'])) && ($_GET['Id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM building WHERE Id=%s",
                       GetSQLValueString($_GET['Id'], "int"));

  mysql_select_db($database_estatemgtdb, $estatemgtdb);
  $Result1 = mysql_query($deleteSQL, $estatemgtdb) or die(mysql_error());

  $deleteGoTo = "buildings.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>Building.php</title>
<!-- TemplateEndEditable -->
<style type="text/css">
<!--
body {
	background-color: #999;
}
a:link {
	color: #FFF;
	text-decoration: none;
}
a {
	font-size: 14px;
	font-weight: bold;
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
<script type="text/javascript">
<!--
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
//-->
</script>
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
      <td width="666" height="308"><h1>BUILDINGS
        </h1>
        <p>We specify the type of building desired. The number of floors.The condition of the building.</p>
<form action="<?php echo $editFormAction; ?>" method="POST" name="form1" id="form1">
          <table align="center">
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Property_id:</td>
              <td><input type="text" name="property_id" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">No_of_floors:</td>
              <td><input name="no_of_floors" type="text" id="no_of_floors" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Building_description:</td>
              <td><input name="building_description" type="text" id="building_description" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Property_group:</td>
              <td><input name="property_group" type="text" id="property_group" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Property_type:</td>
              <td><input name="property_type" type="text" id="property_type" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">Assessment_value:</td>
              <td><input name="assessment_value" type="text" id="assessment_value" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">&nbsp;</td>
              <td><input type="submit" value="Add record" /></td>
            </tr>
          </table>
          <input type="hidden" name="MM_insert" value="form1" />
          <input type="hidden" name="MM_update" value="form1" />
</form>
        <p>&nbsp;</p>
<p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
      <p>&nbsp;</p></td>
      <td width="176" bgcolor="#0000FF" onmouseover="MM_validateForm('no_of_floors','','RisNum','building_description','','R','property_group','','R','property_type','','R','assessment_value','','R');return document.MM_returnValue"><p><strong><font color="#FFFFFF">Our Objective</font></strong></p>
        <p><font color="#FFFFFF">1. Creating a robust database that will help keep information about estates in Anambra State</font> </p>
      <p><font color="#FFFFFF">2. Create a robust application where building informaton (floors, flats, stores, kitchen, building picture etx)owners, tenants and payment can be easily accessed.. </font></p>
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