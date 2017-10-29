# Sabri'nin İp Test Aracı

## NE İŞE YARAR?

İp adresinin daha önce sisteme kayıtlı olup olmadığını sorgulamaya yarar.

Google, Yandex, Bing, Yahoo arama motorlarına ait bir çok ip adresi şu an kayıtlı durumdadır.

İlgili adreslerin bir kısmı şu kaynağa dayanmaktadır: https://www.ip2location.com/free/robot-whitelist
Diğer kısımları kendi siteme gelen isteklerin access_log analizinden çıkartılmıştır

## VERİTABANI YAPISI NASILDIR?

Veritabanı yapısı şu alanları barındırmaktadır:
**id**: 	Auto Increment default değerdir, özel bir anlamı yoktur.
**ip**: 	İsteğin ip adres değeri. Bu kısım saf ip şeklinde olabileceği gibi cidr değeri şeklinde de olabilir.
**name**: 	IP Adresinin karşılık geldiği bir isim varsa onu belirtir.
**status**:  İlgili IP adresine yönelik tavrımı gösterir
**note**: Varsa özel not alanıdır. Banlanan ip adresleri için sebebi bu kısma girmekteyim.

Kurulum için sql dosyası **setup/** klasörünün içindedir.
Veritabanı bağlantısı için **inc/init.php** dosyasına bakınız.

## NASIL KULLANILIR?

Öncelikli olarak sunucudan access_loglarınızı indirmeniz veya uygun bir konumda şu komutu çalıştırmanız gerekmektedir
**cat test.log | awk '{ print $1 }' | sort | uniq -c | sort -n >> ip.txt**

sonra ilgili dosyadan 100'den az istekte bulunmuş ip adreslerini silin, listeyi tamamen sola dayalı hale getiriniz, yani sayıların önündeki boşlukları siliniz.

**ip.txt** dosyasının içine dataları kopyalayıp **liste_parse.php** dosyasını çalıştırınız. İp adreslerinin bilinenlerini ve bilinmeyenleri ayrı ayrı listeleyecektir.

## NASIL YENİ İP ADRESİ EKLENİR?

**ekle.txt** dosyasında verilen örneğe uygun şekilde IP adreslerini ve bilgileri giriniz, sonrasında **liste_ekle.php** dosyasını çalıştırınız. Yeni ip adreslerini ve ilgili yorumları sisteme kayıt edecektir.

## BAĞIMLILIKLAR

* PHP
* MariaDB / MySQL
* AdoDB: http://adodb.org
* IPv4 Subnet Calculator : https://github.com/markrogoyski/ipv4-subnet-calculator-php

## KULLANILAN ARAÇLAR

* Kate
* GitG
