<?php 
//����ɮ׸��|
$datafile = "news.dat";
//Ū����Ƥ��e
$content = file($datafile);
//�榡�Ƹ�Ƥ��e
for($i=0;$i<count($content);$i++)
{
  $temp = explode(" ",$content[$i]);
  $newsdata[$i][title] = $temp[0];
  $newsdata[$i][url] = $temp[1];
}

print_r($newsdata);


?>

 <script language="JavaScript">
document.write("<?php echo $newsdata[0][1]; ?>");

 </script> 