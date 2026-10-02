<?php
$yol = '/hizmetler/';
require __DIR__ . '/../inc/header.php';
$GIRIS = require __DIR__ . '/../inc/hub-giris.php';
$hubGiris = $GIRIS[$yol];
$hubBaslik = 'Cihaz <em>Servis</em> Hizmetleri';
$hubKartlar = $HIZMET['servis']['alt'];
$hubKartlar[] = ['yol' => '/bilgi/', 'ad' => 'Bilgi', 'ozet' => 'Periyodik bakım, teknik servis, yedek parça ve NAM-07/NAM-19 cihazları hakkında sık sorulan sorular.', 'link' => 'Soruları incele'];
if (DANISMANLIK_AKTIF) $hubEk = ['baslik' => '<em>Danışmanlık</em> Hizmetleri', 'kartlar' => array_map(fn($h) => ['yol' => $h['yol'], 'ad' => $h['ad'], 'ozet' => $h['giris']], $HIZMET['danismanlik'])];
require __DIR__ . '/../inc/hub.php';
require __DIR__ . '/../inc/footer.php';
