<?php 
$daytime = date("Y.m.d");

//����ɮ׸��|
$datafile = "../../news.dat";
//Ū����Ƥ��e
$content = file($datafile);
//�榡�Ƹ�Ƥ��e
$lastpoint = count($content) - 1;
$temp = explode(" ",$content[$lastpoint]);
$lastdata[id] = $temp[0];

$insertYoN = true;
if(isset($_POST['submit']) && $_POST['submit'] == "�e�X")
{
  
  $id = $lastdata[id] + 1;
  if($_POST['title'] == ""){
    $msg .= "����g���D";
	$insertYoN = false;
  }else{
    $title = $_POST['title'];
  }
  
  if($_POST['url'] == ""){
    $url = "null";
  }else{
    $url = $_POST['url'];
  }
  
  $type = $_POST['type'];
  
  $insertStr = "
".$id." ".$title." ".$url." ".$type." ".$daytime;
  
  if($insertYoN)
  {
    $dataindex = fopen($datafile,"a+");
	$writeTF = fwrite($dataindex,$insertStr);
	if($writeTF != 0){
	  fclose($dataindex);
 	  header ("Location: ./admin.php");
	}else{
 	   echo "�s�W����";
	}
  }
  
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<title>�s�W���i</title>
<style type="text/css">
<!--
.font1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style>
</head>

<body>
<?php if(isset($msg))echo $msg;?>
<form id="form1" name="form1" method="post" action="">
  <table width="0" border="0" align="center" cellpadding="1" cellspacing="0" class="font1">
    <tr>
      <td class="font1">���i���D</td>
      <td width="160"><label>
        <input type="text" name="title" id="title" />
      </label></td>
    </tr>
    <tr>
      <td>�����s��</td>
      <td><label>
        <input type="text" name="url" id="url" />
      </label></td>
    </tr>
    <tr>
      <td>���i����</td>
      <td><label>
        <select name="type" id="type">
          <option value="1">�̷s����</option>
          <option value="2">���ʰT��</option>
        </select>
      </label></td>
    </tr>
    <tr>
      <td>���i�ɶ�</td>
      <td><?php echo $daytime;?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
      <input type="submit" name="submit" id="button" value="�e�X" />
      </label></td>
    </tr>
  </table>
</form>
</body>
</html>