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

$maxRows_Reports = 10;
$pageNum_Reports = 0;
if (isset($_GET['pageNum_Reports'])) {
  $pageNum_Reports = $_GET['pageNum_Reports'];
}
$startRow_Reports = $pageNum_Reports * $maxRows_Reports;

mysql_select_db($database_estatemgtdb, $estatemgtdb);
$query_Reports = "SELECT * FROM customer";
$query_limit_Reports = sprintf("%s LIMIT %d, %d", $query_Reports, $startRow_Reports, $maxRows_Reports);
$Reports = mysql_query($query_limit_Reports, $estatemgtdb) or die(mysql_error());
$row_Reports = mysql_fetch_assoc($Reports);

if (isset($_GET['totalRows_Reports'])) {
  $totalRows_Reports = $_GET['totalRows_Reports'];
} else {
  $all_Reports = mysql_query($query_Reports);
  $totalRows_Reports = mysql_num_rows($all_Reports);
}
$totalPages_Reports = ceil($totalRows_Reports/$maxRows_Reports)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>Reports.php</title>
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
	font-weight: bold;
}
-->
</style>
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>

<body bgcolor="#FFFFFF">
<p>&nbsp;</p>
<div align="center">
  <table width="858" height="518" border="1" bgcolor="#FFFFFF">
    <tr>
      <td height="48" bgcolor="#0000FF"><a href="home.php">HOME</a> | <a href="customer.php">CUSTOMER </a>| <a href="location.php">LOCATION</a> | <a href="properties.php">PROPERTY</a> | <a href="charges.php">CHARGES</a> | <a href="reports.php">REPORTS</a> | <a href="index.php">LOGOUT</a></td>
    </tr>
    <tr>
      <td><img src="images/Estate_mgt_banner.jpg" width="850" height="120" alt="banner" /></td>
    </tr>
    <tr>
      <td width="666" height="308"><h1>REPORTS</h1>
        <p>A comprehensive report on the customers data is expected to entered here. The site gives provision for addition of more customers, update, delete records as well as searching for customers records.</p>
        <p>&nbsp;</p>
        <form id="reports" name="reports" method="post" action="">
          <table border="2">
            <tr>
              <td>id</td>
              <td>Sname</td>
              <td>Fname</td>
              <td>Mname</td>
              <td>Gender</td>
              <td>Mstatus</td>
              <td>DOB</td>
              <td>Phone</td>
              <td>Email</td>
              <td>Address</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <?php do { ?>
              <tr>
                <td><?php echo $row_Reports['id']; ?></td>
                <td><?php echo $row_Reports['Sname']; ?></td>
                <td><?php echo $row_Reports['Fname']; ?></td>
                <td><?php echo $row_Reports['Mname']; ?></td>
                <td><?php echo $row_Reports['Gender']; ?></td>
                <td><?php echo $row_Reports['Mstatus']; ?></td>
                <td><?php echo $row_Reports['DOB']; ?></td>
                <td><?php echo $row_Reports['Phone']; ?></td>
                <td><?php echo $row_Reports['Email']; ?></td>
                <td><?php echo $row_Reports['Address']; ?></td>
                <td bgcolor="#0000FF"><a href="add.php?Surname=<?php echo $row_Reports['Sname']; ?>">Insert</a></td>
                <td bgcolor="#0000FF"><a href="update.php?Surname=<?php echo $row_Reports['Sname']; ?>">Update</a></td>
                <td bgcolor="#0000FF"><a href="delete.php?<?php echo $row_Reports['Sname']; ?>="onclick="return confirm('Are you sure you want to delete?')"> delete</a></td>
              </tr>
              <?php } while ($row_Reports = mysql_fetch_assoc($Reports)); ?>
          </table>
        </form>
        <form method="POST" name="form1" id="form1">
        </form>
        <p>&nbsp;</p>
        <form id="form2" name="form2" method="post" action="results.php">
          <label>Find  customer record 
            <input type="text" name="Sname" id="Sname" accesskey="1" tabindex="1" />
          </label>
          <label>
            <input type="submit" name="submit" id="submit" value="Search" accesskey="2" tabindex="2" />
          </label>
        </form>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
      <p>&nbsp;</p></td>
    </tr>
    <tr>
      <td height="37"><div align="center">Copyright &copy; 2015 All rights reserved</div></td>
    </tr>
  </table>
</div>
</body>
</html>
<?php
mysql_free_result($Reports);
?>
