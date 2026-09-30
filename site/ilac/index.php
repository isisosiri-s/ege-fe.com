<?php
$yol = '/ilac/';
require __DIR__ . '/../inc/header.php';
$GIRIS = require __DIR__ . '/../inc/hub-giris.php';
$hubGiris = $GIRIS[$yol];
$hubBaslik = '<em>İlaç</em> Hizmetleri';
$tum = array_merge(...array_column($HIZMET['danismanlik'], 'alt'));
$hubKartlar = array_values(array_filter($tum, fn($h) => in_array($h['yol'], $HIZMET['ilac'], true)));
require __DIR__ . '/../inc/hub.php';
require __DIR__ . '/../inc/footer.php';
