<?php
/*******************************************************
Veritabanına yeni kayıt eklemek için
ekle.txt isimli bir dosya oluşturup
içine şu formatta data ekleyebilirsiniz

Örnek format şu şekillerde olabilir

//cidr esaslı geniş banlamalar için
xxx.xxx.xxx.0/24|leaseweb|banlandı

//Tek ip adresi banlamak için
xxx.xxx.xxx.xxx|leaseweb|banlandı

*******************************************************/
	define('APP', '1');
	include 'inc/init.php';

	//dosyayı tek tek parse edip, ekrana basalım
	$file = fopen('ekle.txt','r');

	while(!feof($file))
	{
		$ploted = explode("|", fgets($file));
		//print_pre($ploted);
		//echo $ploted[1].'<br/>';
		$ploted[0] = trim($ploted[0]);
		$ploted[1] = trim($ploted[1]);
		$ploted[2] = trim($ploted[2]);
		//veritabanındaki kaydını alıp birleştirelim
		unset($sql1,$sql2);
		if($ploted[0] <> '' && $ploted[1] <> '')
		{
			//varsa önceki kaydını güncellemek amacıyla silelim
			$sql1 = 'DELETE FROM botlist WHERE ip = "'.$ploted[0].'";';
			$conn->Execute($sql1);

			//yeni kaydı ekleyelim
			$sql2 = 'INSERT INTO
						botlist
					SET
						ip = "'.$ploted[0].'",
						name = "'.$ploted[1].'",
						status = "'.$ploted[2].'"
					;';
			$conn->Execute($sql2);
			echo '. ';
		}
	}
	fclose($file);
