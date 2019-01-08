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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>home.php</title>
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
a {
	font-size: 14px;
	font-weight: bold;
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
      <td colspan="2"><img src="images/Estate_mgt_banner.jpg" width="850" height="120" /></td>
    </tr>
    <tr>
      <td width="666" height="308"><form id="form1" name="form1" method="post" action="">
        <h2>Welcome to our Estate Management System </h2>
        <p align="justify">Estate Management covers many varied issues, although is essentially about managing tenancies to ensure all tenants have quiet enjoyment of their home within a safe and secure environment. Estate management services are not just simply about looking after buildings and the physical environment, it can contribute to creating desirable, sustainable communities by providing an environment which is attractive, well maintained and without undue disturbance</p>
        <p align="justify">&nbsp;</p>
        <h4 align="justify"><strong>Our Objective </strong></h4>
        <p align="justify">1. Creating a robust database that will help keep information about estates in Anambra State</p>
        <p align="justify">2. Creating a robust application where building information (floors, flat, stores, kitchen, building pictures etc) owners, tenants and payment can be easily accessed.</p>
        <p>&nbsp;</p>
      </form>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
        <p>&nbsp;</p>
      <p>&nbsp;</p></td>
      <td width="176" bgcolor="#0000CC"><p><strong><font color="#FFFFFF">Our Objective</font></strong></p>
        <p><font color="#FFFFFF">1. Creating a robust database that will help keep information about estates in Anambra State</font></p>
      <p><font color="#FFFFFF">2. Create a robust application where building informaton (floors, flats, stores, kitchen, building picture etx)owners, tenants and payment can be easily accessed.. </font></p>
      <p><font color="#FFFFFF">Click to access </font><a href="buildings.php">Building </a></p>
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