<?php
$yol = '/danismanlik/';
require __DIR__ . '/../inc/header.php';
$GIRIS = require __DIR__ . '/../inc/hub-giris.php';
$hubGiris = $GIRIS[$yol];
$hubBaslik = '<em>Danışmanlık</em> Alanlarımız';
$hubKartlar = array_map(fn($h) => ['yol' => $h['yol'], 'ad' => $h['ad'], 'ozet' => $h['giris']], $HIZMET['danismanlik']);
$hubEk = ['baslik' => '<em>İlaç</em> Danışmanlığı', 'kartlar' => [['yol' => '/ilac/', 'ad' => 'İlaç', 'ozet' => $GIRIS['/ilac/']]]];
require __DIR__ . '/../inc/hub.php';
require __DIR__ . '/../inc/footer.php';
