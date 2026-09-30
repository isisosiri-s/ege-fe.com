<?php
$yol = '/uts/';
require __DIR__ . '/../inc/header.php';
$GIRIS = require __DIR__ . '/../inc/hub-giris.php';
$grup = current(array_filter($HIZMET['danismanlik'], fn($h) => $h['yol'] === $yol));
$hubGiris = $GIRIS[$yol];
$hubBaslik = '<em>' . e($grup['ad']) . '</em> Hizmetlerimiz';
$hubKartlar = $grup['alt'];
require __DIR__ . '/../inc/hub.php';
require __DIR__ . '/../inc/footer.php';
