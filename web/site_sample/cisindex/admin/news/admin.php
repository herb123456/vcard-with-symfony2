<?php 
if (!isset($_SESSION)) {
  session_start();
}

if(isset($_SESSION['user']) && $_SESSION['user'] == "admin")
{
//����ɮ׸��|
$datafile = "../../news.dat";
//Ū����Ƥ��e
$content = file($datafile);
//�榡�Ƹ�Ƥ��e
  $j = 0;
  $k = 0;
for($i=0;$i<count($content);$i++)
{
  $temp = explode(" ",$content[$i]);

  if($temp[3] == "1")
  {
    $newsdata[$j][id] = $temp[0];
    $newsdata[$j][title] = $temp[1];
    $newsdata[$j][url] = $temp[2];
	$newsdata[$j][day] = $temp[4];
	$j++;
  }
  else if($temp[3] == "2")
  {
    $actdata[$k][id] = $temp[0];
    $actdata[$k][title] = $temp[1];
    $actdata[$k][url] = $temp[2];
	$actdata[$k][day] = $temp[4];
	$k++;
  }
}

$newCounter = 0;
$actCounter = 0;
$j--;
$k--;
?>
<body background="../../images/mainbg.png">
<a href=add.php>�s�W���i</a>
<br>
<table width="100%">
  <tr>
    <td width="120"><img src="../../images/blueicon.gif" width="20" height="17"><img src="../../images/main-1.png" width="80" height="20"></td>
    </tr>
</table>
<table width="500">
 <?php while($newCounter < count($newsdata) && $newCounter < 4){ ?> 
 <tr>
  
    <td width="100"><font size="2"><?php echo $newsdata[$j][day]; ?></font></td>
    <td><p><?php if($newsdata[$j][url] != "null"){?><a href="<?php echo $newsdata[$j][url]; ?>" target=_blank><?php }?><font color="#000066" size="2"><?php echo $newsdata[$j][title]; ?></font><?php if($newsdata[$j][url] != "null"){ echo "</a>"; }?>�U<a href="edit.php?id=<?php echo $newsdata[$j][id]; ?>">�ק�</a>�U<a href=del.php?id=<?php echo $newsdata[$j][id]; ?>>�R��</a></p>
    </td>
   
  </tr>
  <?php $newCounter++; $j--;}?>
  
 
</table>
<p>&nbsp;</p>
<p><img src="../../images/blueicon.gif" width="20" height="17"><img src="../../images/main-2.png" width="80" height="20"></p>
<table width="500">
  <?php while($actCounter < count($actdata) && $actCounter < 4){ ?>
  <tr> 
    <td width="100"><font size="2"><?php echo $actdata[$k][day]; ?></font></td>
    <td><?php if($actdata[$k][url] != "null"){?><a href="<?php echo $actdata[$k][url]; ?>" target=_blank><?php }?><font color="#000066" size="2"><?php echo $actdata[$k][title]; ?></font><?php if($newsdata[$j][url] != "null"){ echo "</a>"; }?>�U<a href="edit.php?id=<?php echo $actdata[$k][id]; ?>">�ק�</a>�U<a href=del.php?id=<?php echo $actdata[$k][id]; ?>>�R��</a>
    </td>
  </tr>
  <?php $actCounter++; $k--;}?>
</table>
</body>

<?php }else{
header ("Location: ../../main.php");
}?>