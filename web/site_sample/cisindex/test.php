<?php
$datafile = "news.dat";

$dataindex = fopen($datafile,"a+");

//�n�g�J���r��
$writeStr = "���D url
";
//�N�r��g�Jnews.data�ɧ�
$writeTF = fwrite($dataindex,$writeStr);
//�P�_�g�J�O�_���\
if($writeTF != 0)
{
 echo "�r��g�J��";
 readfile($datafile);
}
else
{
 echo "�r��g�J����";
}


?>