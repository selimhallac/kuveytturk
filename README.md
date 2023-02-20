
Install with composer

```bash
composer require phpdev/kuveytturk

## Kullanım/Örnekler

```php

Use Phpdev\Kuveytturk;

$entegrasyon = new Kuveytturk('kullanıcı adı','parola',"müşterinumarası",'var ise hesap kodu örn: 001');


// Aşağıdaki örnekte gibi tarih aralığı verdiğiniz taktirde hareketler dizi dönecektir.
$response = $entegrasyon->hesap_hareketleri('2023-02-01','2023-02-20');


```

  
