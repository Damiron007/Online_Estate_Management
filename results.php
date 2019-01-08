<?php require_once('Connections/estatemgtdb.php'); ?>
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

$maxRows_RsResult = 7;
$pageNum_RsResult = 0;
if (isset($_GET['pageNum_RsResult'])) {
  $pageNum_RsResult = $_GET['pageNum_RsResult'];
}
$startRow_RsResult = $pageNum_RsResult * $maxRows_RsResult;

$colname_RsResult = "-1";
if (isset($_POST['Sname'])) {
  $colname_RsResult = $_POST['Sname'];
}
mysql_select_db($database_estatemgtdb, $estatemgtdb);
$query_RsResult = sprintf("SELECT * FROM customer WHERE Sname = %s ORDER BY Fname ASC", GetSQLValueString($colname_RsResult, "text"));
$query_limit_RsResult = sprintf("%s LIMIT %d, %d", $query_RsResult, $startRow_RsResult, $maxRows_RsResult);
$RsResult = mysql_query($query_limit_RsResult, $estatemgtdb) or die(mysql_error());
$row_RsResult = mysql_fetch_assoc($RsResult);

if (isset($_GET['totalRows_RsResult'])) {
  $totalRows_RsResult = $_GET['totalRows_RsResult'];
} else {
  $all_RsResult = mysql_query($query_RsResult);
  $totalRows_RsResult = mysql_num_rows($all_RsResult);
}
$totalPages_RsResult = ceil($totalRows_RsResult/$maxRows_RsResult)-1;

$colname_rsResults = "-1";
if (isset($_POST['Sname'])) {
  $colname_rsResults = $_POST['Sname'];
}
mysql_select_db($database_estatemgtdb, $estatemgtdb);
$query_rsResults = sprintf("SELECT Sname, Fname,Phone,Email,Address FROM customer WHERE Sname LIKE %s", GetSQLValueString("%" . $colname_rsResults . "%", "text"));
$rsResults = mysql_query($query_rsResults, $estatemgtdb) or die(mysql_error());
$row_rsResults = mysql_fetch_assoc($rsResults);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SEARCH RESULT</title>
</head>

<body>
<form id="Results" name="Results" method="post" action="">
  <table width="1051" height="99" border="2">
    <tr>
      <td width="34" height="37">id</td>
      <td width="87">Sname</td>
      <td width="109">Fname</td>
      <td width="117">Mname</td>
      <td width="92">Gender</td>
      <td width="84">Mstatus</td>
      <td width="104">DOB</td>
      <td width="95">Phone</td>
      <td width="113">Email</td>
      <td width="150">Address</td>
    </tr>
    <?php do { ?>
      <tr>
        <td height="52"><?php echo $row_RsResult['id']; ?></td>
        <td><?php echo $row_RsResult['Sname']; ?></td>
        <td><?php echo $row_RsResult['Fname']; ?></td>
        <td><?php echo $row_RsResult['Mname']; ?></td>
        <td><?php echo $row_RsResult['Gender']; ?></td>
        <td><?php echo $row_RsResult['Mstatus']; ?></td>
        <td><?php echo $row_RsResult['DOB']; ?></td>
        <td><?php echo $row_RsResult['Phone']; ?></td>
        <td><?php echo $row_RsResult['Email']; ?></td>
        <td><?php echo $row_RsResult['Address']; ?></td>
      </tr>
      <?php } while ($row_RsResult = mysql_fetch_assoc($RsResult)); ?>
  </table>
</form>
</body>
</html>
<?php
mysql_free_result($RsResult);
?>
