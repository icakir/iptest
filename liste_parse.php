<?php
/************************************************************************************
Log dosyanızdan ip listesi oluşturmak için aşağıdaki komutu kullanabilirsiniz.
cat test.log | awk '{ print $1 }' | sort | uniq -c | sort -n >> ip.txt

Tek tek tüm İp adresleri yerine sitenin trafiğine göre örnek olarak
100'den fazla istek göndermiş kişilere odaklanabilirsiniz

cidr formatında ip kabul etmiyoruz, çünkü ip adresinin
cidr değerlerini kendimiz zaten buluyoruz

ip.txt dosyasının örnek şekli aşağıdaki gibi olmalıdır

sayı ip_adresi
200 xxx.xxx.xxx.xxx

************************************************************************************/
	define('APP', '1');
	include 'inc/init.php';
	include 'inc/SubnetCalculator.php';

	//dosyayı tek tek parse edip, ekrana basalım
	$file = fopen('ip.txt','r');

	function create_sql($ip, $cidr)
	{
		$sub		= new IPv4\SubnetCalculator( $ip, $cidr);
		$cidr_ip	= $sub->getNetworkPortion().'/'.$cidr;
		$sql		= 'OR ip = "'.$cidr_ip.'"';
		return $sql;
	}

	while(!feof($file))
	{
		unset ( $sql, $ip, $expl, $sayi);

		$expl 	= explode(" ", fgets($file));
		$sayi 	= intval($expl[0]);
		$ip 	= trim($expl[1]);

		//ip hatalıysa hiç uğraşmayalım
		if(filter_var($ip, FILTER_VALIDATE_IP))
		{
			$sql = 'SELECT
						ip,
						name,
						status,
						note
					FROM
						botlist
					WHERE
						ip = "'.$ip.'"
						'.create_sql($ip, 8).'
						'.create_sql($ip, 9).'
						'.create_sql($ip, 10).'
						'.create_sql($ip, 11).'
						'.create_sql($ip, 12).'
						'.create_sql($ip, 13).'
						'.create_sql($ip, 14).'
						'.create_sql($ip, 15).'
						'.create_sql($ip, 16).'
						'.create_sql($ip, 17).'
						'.create_sql($ip, 18).'
						'.create_sql($ip, 19).'
						'.create_sql($ip, 20).'
						'.create_sql($ip, 21).'
						'.create_sql($ip, 22).'
						'.create_sql($ip, 23).'
						'.create_sql($ip, 24).'
						'.create_sql($ip, 25).'
						'.create_sql($ip, 26).'
						'.create_sql($ip, 27).'
						'.create_sql($ip, 28).'
						'.create_sql($ip, 29).'
						'.create_sql($ip, 30).'
						'.create_sql($ip, 31).'
						'.create_sql($ip, 32).'
					;';
			//echo $sql.'<br/>';
			$sonuc = $conn->GetRow($sql);
			if($sonuc)
			{
				$_Hitted[$ip] = $sayi.' '.$sonuc['name'].' '.$sonuc['status'].' '.trim($sonuc['note']);
				if($sonuc['status'] == 'banlandı')
				{
					unset($_Hitted[$ip]);
					$_banlandi[$ip] = $sayi.' '.$sonuc['name'].' '.$sonuc['status'].' '.trim($sonuc['note']);
				}

				if($sonuc['status'] == 'warning')
				{
					unset($_Hitted[$ip]);
					$_warned[$ip] = $sayi.' '.$sonuc['name'].' '.$sonuc['status'].' '.trim($sonuc['note']);
				}

				if($sonuc['status'] == 'allowed')
				{
					unset($_Hitted[$ip]);
					$_allowed[$ip] = $sayi.' '.$sonuc['name'].' '.$sonuc['status'].' '.trim($sonuc['note']);
				}
			}
			else
			{
				echo $sayi.' '.$ip.'<br/>';
			}
		}
		else
		{
			$_Wronged[$ip];
		}
	}
	fclose($file);

	echo '<hr/>warning';
	print_pre($_warned);

	echo '<hr/>banlandı';
	print_pre($_banlandi);

	echo '<hr/>allowed';
	print_pre($_allowed);

	echo '<hr/>diğer';
	print_pre($_Hitted);
	//print_pre($_Missing);
	//print_pre($_Wronged);

