<?php
// Cihaz karşılaştırma verisi (2026-10-02): yalnız satıştaki alkolmetreler, en fazla 3 cihaz (kullanıcı kararı).
// Değerler Armas Elektronik ürün sayfalarındaki teknik bilgilerden; kaynakta olmayan bilgi "—" gösterilir (uydurulmaz).
$KARSI_EN_FAZLA = 3;
$karsiSatirlar = ['Tür', 'Sensör', 'Ölçüm modları', 'Ölçüm aralığı', 'Hazırlanma süresi', 'Sonuç gösterme', 'Ekran', 'Veri girişi', 'Hafıza', 'Yazıcı', 'Kamera', 'QR kod / barkod okuyucu', 'GPS', 'Kablosuz bağlantı', 'Veri yazılımı', 'Çalışma sıcaklığı', 'Depolama sıcaklığı', 'Nefes hacmi', 'Batarya', 'Kalibrasyon yöntemi', 'Sertifikalar'];
$karsiCihaz = [
  'nam-19' => ['ad' => 'NAM-19', 'gorsel' => '/img/urun/nam19.jpg', 'deger' => [
    'Tür' => 'Delil sınıfı alkolmetre', 'Sensör' => 'Yeni nesil elektrokimyasal fuel cell', 'Ölçüm modları' => 'Otomatik / Manuel / Pasif / Ölçüm Retti',
    'Ölçüm aralığı' => '0,00 – 6,00 ‰ BAC', 'Hazırlanma süresi' => 'En fazla 5 sn', 'Sonuç gösterme' => 'En fazla 15 sn; alkol yokken hemen',
    'Ekran' => 'Güneşte görülebilir transreflektif renkli TFT', 'Veri girişi' => 'Alfanümerik tuş takımı', 'Hafıza' => '7.500 – 100.000 kayıt',
    'Yazıcı' => 'Bluetooth termal yazıcı (opsiyonel)', 'Kamera' => 'Yok', 'GPS' => 'Opsiyonel', 'Veri yazılımı' => 'NAM-DATAPro',
    'Çalışma sıcaklığı' => '−10 °C / +50 °C', 'Depolama sıcaklığı' => '−20 °C / +60 °C', 'Nefes hacmi' => 'En az 1,2 L',
    'Batarya' => '3,7 V lityum-iyon (opsiyonel alkalin ve Ni-MH)', 'Kalibrasyon yöntemi' => 'Kuru gaz ve/veya buhar',
    'Sertifikalar' => 'DOT/NHTSA Delil Sınıfı, EN 15964, EN 60068-2-2, EN 60068-2-27, CE (EMC, LVD)']],
  'nam-e30' => ['ad' => 'NAM-E30', 'gorsel' => '/img/urun/nam-e30.jpg', 'deger' => [
    'Tür' => 'Yazıcılı alkolmetre', 'Sensör' => 'Elektrokimyasal fuel cell', 'Ölçüm modları' => 'Otomatik / Manuel / Pasif / Ölçüm Reddi',
    'Ölçüm aralığı' => '0,00 – 6,00 ‰ BAC', 'Hazırlanma süresi' => 'En fazla 6 sn (0,00 ‰ için 2 sn)', 'Sonuç gösterme' => 'En fazla 15 sn; alkol yokken hemen',
    'Ekran' => '3,5 inç dokunmatik renkli TFT', 'Veri girişi' => '3 tuş ve dokunmatik ekran klavyesi', 'Hafıza' => 'Standart 7.500 kayıt',
    'Yazıcı' => 'Entegre termal yazıcı', 'Kamera' => 'Yok', 'QR kod / barkod okuyucu' => 'Var', 'GPS' => 'Opsiyonel',
    'Kablosuz bağlantı' => 'GSM, Bluetooth, Wi-Fi (opsiyonel)', 'Veri yazılımı' => 'NAM-DATAPro (100.000 kayda kadar)',
    'Çalışma sıcaklığı' => '−10 °C / +50 °C', 'Depolama sıcaklığı' => '−20 °C / +60 °C', 'Nefes hacmi' => 'En az 1,2 L (ayarlanabilir)',
    'Batarya' => '7,4 V lityum-iyon (opsiyonel alkalin ve Ni-MH)', 'Kalibrasyon yöntemi' => 'Kuru gaz ve/veya buhar']],
  'nam-e30c' => ['ad' => 'NAM-E30C', 'gorsel' => '/img/urun/nam-e30c.jpg', 'deger' => [
    'Tür' => 'Kameralı / yazıcılı alkolmetre', 'Sensör' => 'Elektrokimyasal fuel cell', 'Ölçüm modları' => 'Otomatik / Manuel / Pasif / Ölçüm Reddi',
    'Ölçüm aralığı' => '0,00 – 6,00 ‰ BAC', 'Hazırlanma süresi' => 'En fazla 6 sn (0,00 ‰ için 2 sn)', 'Sonuç gösterme' => 'En fazla 15 sn; alkol yokken hemen',
    'Ekran' => '3,5 inç dokunmatik renkli TFT', 'Veri girişi' => '3 tuş ve dokunmatik ekran klavyesi', 'Hafıza' => 'Standart 7.500 kayıt',
    'Yazıcı' => 'Entegre termal yazıcı', 'Kamera' => 'Entegre kamera (üfleyen kişinin yüz görüntüsü)', 'QR kod / barkod okuyucu' => 'Var', 'GPS' => 'Opsiyonel',
    'Kablosuz bağlantı' => 'GSM, Bluetooth, Wi-Fi (opsiyonel)', 'Veri yazılımı' => 'NAM-DATAPro (100.000 kayda kadar)',
    'Çalışma sıcaklığı' => '−10 °C / +50 °C', 'Depolama sıcaklığı' => '−20 °C / +60 °C', 'Nefes hacmi' => 'En az 1,2 L (ayarlanabilir)',
    'Batarya' => '7,4 V lityum-iyon (opsiyonel alkalin ve Ni-MH)', 'Kalibrasyon yöntemi' => 'Kuru gaz ve/veya buhar']],
];
