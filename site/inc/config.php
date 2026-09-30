<?php
// Site genel ayarları — firma bilgileri tek yerden yönetilir.
if (defined('KOK')) return;
define('KOK', dirname(__DIR__));
define('SITE_URL', 'https://ege-fe.com');

$FIRMA = [
  'yasal_unvan' => 'Egefe Bilişim Sağlık San. ve Tic. A.Ş.',
  'kisa_ad'     => 'Egefe',
  'kurulus'     => 2017,
  'adres'       => 'Yıldızevler Mah. Turan Güneş Blv. 708 Sok. No:14/1, 06550 Çankaya/Ankara',
  'adres_sokak' => 'Yıldızevler Mah. Turan Güneş Blv. 708 Sok. No:14/1',
  'posta_kodu'  => '06550',
  'ilce'        => 'Çankaya',
  'il'          => 'Ankara',
  'arge_adres'  => 'Kırıkkale Teknopark No: 3 Yahşihan/Kırıkkale',
  'telefon'     => '+90 312 482 54 51',
  'telefon_uri' => '+903124825451',
  'faks'        => '0 312 480 54 53',
  'faks_uri'    => '+903124805453',
  'eposta'      => 'info@ege-fe.com',
  'vergi_dairesi' => 'Ulus V.D.',
  'vkn'         => '5590520620',
  'mersis'      => '0559052062000001',
  'linkedin'    => 'https://www.linkedin.com/company/egefe-bili%C5%9Fim-sa%C4%9Fl%C4%B1k-a-%C5%9F/',
  // Harita: koordinat teyit edilene kadar adres sorgusuyla gösterilir, JSON-LD'ye geo yazılmaz.
  'harita_koordinat' => null, // ör. [39.90, 32.80]
  'slogan'      => 'Sağlık sektöründe yaptığı inovatif çözümler ile güven, kalite ve memnuniyetin öncüsü...',
];

// Form ayarları
$FORM = [
  'alici'        => 'info@ege-fe.com',   // iletişim, anasayfa
  'alici_kariyer'=> 'info@ege-fe.com',   // kariyer / CV
  'gonderen'     => 'info@ege-fe.com',   // From (SPF için alan adındaki gerçek bir kutu olmalı)
  'cv_max_mb'    => 5,
  'cv_uzantilar' => ['pdf', 'doc', 'docx'],
  // SMTP: host boşsa PHP mail() kullanılır. GüzelHosting'de kutu oluşturulunca doldurun.
  'smtp' => [
    'host' => '',            // ör. mail.ege-fe.com
    'port' => 465,           // 465 = SSL, 587 = STARTTLS
    'kullanici' => '',
    'sifre' => '',
  ],
];

// Form zaman damgası imzası için gizli anahtar (spam koruması). Yayında değiştirilebilir.
define('FORM_GIZLI', '70eb7b660ea7d01d0d81efae906dd513437878cdaaf30e08');

// Search Console doğrulaması — kullanıcı onaylayana kadar KAPALI (header.php'de yorum satırı olarak basılır)
define('GSC_DOGRULAMA', 'xl0TzVFv6lmPGghB_4b-lvpQYCHUVC1hLbzpiypKAVU');
define('GSC_AKTIF', false);

function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

// İkonlar: yalnız Tabler Icons (https://tabler.io/icons, MIT) — img/ikon/<ad>.svg dosyasını satır içi basar
function ikon($ad, $boyut = 20, $sinif = '') {
  static $onbellek = [];
  $svg = $onbellek[$ad] ??= trim(preg_replace('/\s+/', ' ', file_get_contents(KOK . '/img/ikon/' . basename($ad) . '.svg')));
  $svg = preg_replace(['/width="24"/', '/height="24"/', '/class="[^"]*"/'], ['width="' . (int)$boyut . '"', 'height="' . (int)$boyut . '"', 'class="ikon ' . e($sinif) . '"'], $svg, 1);
  return str_replace('<svg ', '<svg aria-hidden="true" focusable="false" ', $svg);
}
