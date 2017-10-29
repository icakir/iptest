# Sabri'nin İp Test Aracı

## NE İŞE YARAR?

İp adresinin daha önce sisteme kayıtlı olup olmadığını sorgulamaya yarar.

Google, Yandex, Bing, Yahoo arama motorlarına ait bir çok ip adresi kayıtlı durumdadır.

İp adreslerinin çoğu, "Robot whitelist" listesinden alınmıştır. Bir kısım ip adresi "Apache ultimate bad bot blocker" kaynaklıdır. Çok az ip adresi ise apache access_log analizlerime dayanmaktadır.

## KAÇ IP ADRESİ KAYITLI?

Kayıtlı olan data sayısı 9 bin sayısının üstündedir. Adresler CIDR değeri olarak kayıtlı olması sebebiyle bu sayı milyonlarca ip adresinin tek tek kayıtlı olması ile eş değerdir!

## VERİTABANI YAPISI NASILDIR?

Veritabanı yapısı şu alanları barındırmaktadır:
**id**: 	Auto Increment default değerdir, özel bir anlamı yoktur.
**ip**: 	İsteğin ip adres değeri. Bu kısım saf ip (xxx.xxx.xxx.xxx) şeklinde olabileceği gibi CIDR değeri (xxx.xxx.xxx.x/xx) şeklinde de olabilir.
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

## Kullanılan Kütüphaneler

* AdoDB: http://adodb.org
* IPv4 Subnet Calculator : https://github.com/markrogoyski/ipv4-subnet-calculator-php

### Kullanılan Kaynaklar

* Robot whitelist: https://www.ip2location.com/free/robot-whitelist
* Apache ultimate bad bot blocker: https://github.com/mitchellkrogza/apache-ultimate-bad-bot-blocker

## Kullanılan Yazılım Araçları

* Kate
* GitG

##### TODO: Demo ;)

##### NOTLAR

* CIDR: https://en.wikipedia.org/wiki/Classless_Inter-Domain_Routing
