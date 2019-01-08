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

if ((isset($_GET['Sname'])) && ($_GET['Sname'] != "")) {
  $deleteSQL = sprintf("DELETE FROM customer WHERE Sname=%s",
                       GetSQLValueString($_GET['Sname'], "text"));

  mysql_select_db($database_estatemgtdb, $estatemgtdb);
  $Result1 = mysql_query($deleteSQL, $estatemgtdb) or die(mysql_error());

  $deleteGoTo = "reports.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_delete = "-1";
if (isset($_GET['Sname'])) {
  $colname_delete = $_GET['Sname'];
}
mysql_select_db($database_estatemgtdb, $estatemgtdb);
$query_delete = sprintf("SELECT * FROM customer WHERE Sname = %s", GetSQLValueString($colname_delete, "text"));
$delete = mysql_query($query_delete, $estatemgtdb) or die(mysql_error());
$row_delete = mysql_fetch_assoc($delete);
$totalRows_delete = mysql_num_rows($delete);

mysql_select_db($database_estatemgtdb, $estatemgtdb);
$query_UPDATE = "SELECT * FROM customer";
$UPDATE = mysql_query($query_UPDATE, $estatemgtdb) or die(mysql_error());
$row_UPDATE = mysql_fetch_assoc($UPDATE);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UPDATE RECORDS</title>
</head>

<body>
<p><br />
</p>
<p><br />
</p>
<form method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Id:</td>
      <td><?php echo $row_UPDATE['id']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Sname:</td>
      <td><input type="text" name="Sname" value="<?php echo htmlentities($row_UPDATE['Sname'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Fname:</td>
      <td><input type="text" name="Fname" value="<?php echo htmlentities($row_UPDATE['Fname'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Mname:</td>
      <td><input type="text" name="Mname" value="<?php echo htmlentities($row_UPDATE['Mname'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Gender:</td>
      <td><input type="text" name="Gender" value="<?php echo htmlentities($row_UPDATE['Gender'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Mstatus:</td>
      <td><input type="text" name="Mstatus" value="<?php echo htmlentities($row_UPDATE['Mstatus'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">DOB:</td>
      <td><input type="text" name="DOB" value="<?php echo htmlentities($row_UPDATE['DOB'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Phone:</td>
      <td><input type="text" name="Phone" value="<?php echo htmlentities($row_UPDATE['Phone'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Email:</td>
      <td><input type="text" name="Email" value="<?php echo htmlentities($row_UPDATE['Email'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Address:</td>
      <td><input type="text" name="Address" value="<?php echo htmlentities($row_UPDATE['Address'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="delete record" /></td>
    </tr>
  </table>
  <input type="hidden" name="id" value="<?php echo $row_UPDATE['id']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($delete);
?>
