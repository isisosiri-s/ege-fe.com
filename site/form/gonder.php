<?php
// Form işleyici: iletişim ve kariyer (CV ekli). Sonuç: geldiği sayfaya ?form=...&tur=... ile döner (PRG).
require_once __DIR__ . '/../inc/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); header('Allow: POST'); exit; }

$tur = $_POST['tur'] ?? '';
if (!in_array($tur, ['iletisim', 'kariyer'], true)) { http_response_code(400); exit; }

// Geri dönüş adresi: yalnız aynı sitedeki yol
$geri = '/iletisim/';
if (!empty($_SERVER['HTTP_REFERER'])) {
  $r = parse_url($_SERVER['HTTP_REFERER']);
  $refHost = ($r['host'] ?? '') . (isset($r['port']) ? ':' . $r['port'] : '');
  if (strcasecmp($refHost, $_SERVER['HTTP_HOST'] ?? '') === 0 &&!empty($r['path']) && $r['path'][0] === '/') $geri = $r['path'];
}
function don($durum) {
  global $geri, $tur;
  header('Location: ' . $geri . '?form=' . $durum . '&tur=' . $tur . '#form', true, 303);
  exit;
}

// Spam: honeypot dolu ise sessizce "başarılı" dön
if (!empty($_POST['web_sitesi'])) don('ok');
// Spam: imzalı zaman damgası (en az 3 sn, en fazla 1 gün)
[$t, $imza] = array_pad(explode('.', (string)($_POST['zaman'] ?? ''), 2), 2, '');
if (!ctype_digit($t) || !hash_equals(hash_hmac('sha256', $tur . '|' . $t, FORM_GIZLI), $imza)) don('hata');
$yas = time() - (int)$t;
if ($yas < 3) don('ok');
if ($yas > 86400) don('hata');

$temiz = fn($k, $max = 250) => trim(str_replace(["\r", "\n", "\0"], ' ', mb_substr((string)($_POST[$k] ?? ''), 0, $max)));
$ad = $temiz('ad', 120);
$eposta = $temiz('eposta', 160);
$telefon = $temiz('telefon', 40);
$mesaj = trim(str_replace("\0", '', mb_substr((string)($_POST['mesaj'] ?? ''), 0, 5000)));

if (empty($_POST['kvkk'])) don('kvkk');
if (!filter_var($eposta, FILTER_VALIDATE_EMAIL)) don($eposta === '' ? 'eksik' : 'eposta');

$ek = null;
if ($tur === 'iletisim') {
  if ($ad === '' || $mesaj === '') don('eksik');
  $konu = $temiz('konu', 60);
  $baslik = 'Web sitesi iletişim formu: ' . ($konu ?: 'Genel');
  $govde = "İsim Soyisim: $ad\nE-posta: $eposta\nTelefon: $telefon\nKonu: $konu\nSayfa: $geri\n\nMesaj:\n$mesaj\n";
  $alici = $FORM['alici'];
} else { // kariyer
  if ($ad === '' || $telefon === '') don('eksik');
  $f = $_FILES['cv'] ?? null;
  if (!$f || $f['error'] !== UPLOAD_ERR_OK) don($f && $f['error'] === UPLOAD_ERR_NO_FILE ? 'eksik' : 'dosya');
  $uz = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
  $izinli = ['pdf' => ['application/pdf'], 'doc' => ['application/msword', 'application/x-ole-storage', 'application/CDFV2'], 'docx' => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip']];
  if (!in_array($uz, $FORM['cv_uzantilar'], true) || $f['size'] > $FORM['cv_max_mb'] * 1024 * 1024 || $f['size'] === 0) don('dosya');
  // Dosya imzası (magic bytes) — fileinfo eklentisinden bağımsız her zaman kontrol edilir
  $bas = (string)file_get_contents($f['tmp_name'], false, null, 0, 8);
  $imzaOk = ['pdf' => str_starts_with($bas, '%PDF'), 'docx' => str_starts_with($bas, "PK\x03\x04"), 'doc' => str_starts_with($bas, "\xD0\xCF\x11\xE0\xA1\xB1\x1A\xE1")][$uz];
  if (!$imzaOk) don('dosya');
  $mime = function_exists('finfo_open') ? finfo_file(finfo_open(FILEINFO_MIME_TYPE), $f['tmp_name']) : null;
  if ($mime && !in_array($mime, $izinli[$uz], true)) don('dosya');
  $ek = ['ad' => 'ozgecmis-' . preg_replace('/[^a-z0-9]+/', '-', strtolower(iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $ad) ?: 'aday')) . '.' . $uz, 'veri' => file_get_contents($f['tmp_name']), 'mime' => $mime ?: 'application/octet-stream'];
  $baslik = 'Kariyer başvurusu: ' . $ad;
  $govde = "İsim Soyisim: $ad\nE-posta: $eposta\nTelefon: $telefon\nŞehir: " . $temiz('sehir', 80) . "\nAdres: " . $temiz('adres') . "\n\nMesaj:\n$mesaj\n\n(Özgeçmiş ektedir.)\n";
  $alici = $FORM['alici_kariyer'];
}
$govde .= "\n--\nGönderim: " . date('d.m.Y H:i') . " · IP: " . ($_SERVER['REMOTE_ADDR'] ?? '-') . "\n" . ['iletisim' => 'KVKK Aydınlatma Metni onayı verildi.', 'kariyer' => 'Özgeçmiş verileri için açık rıza verildi.'][$tur] . "\n";

don(eposta_gonder($alici, $baslik, $govde, $eposta, $ek) ? 'ok' : 'gonderim');

// ---- Gönderim: SMTP (ayarlıysa) veya mail() ----
function eposta_gonder($alici, $konu, $metin, $yanitla, $ek = null) {
  global $FORM, $FIRMA;
  $sinir = 'egefe-' . bin2hex(random_bytes(8));
  $konuEnc = '=?UTF-8?B?' . base64_encode($konu) . '?=';
  $basliklar = [
    'From: =?UTF-8?B?' . base64_encode('Egefe Web Sitesi') . '?= <' . $FORM['gonderen'] . '>',
    'Reply-To: ' . $yanitla,
    'MIME-Version: 1.0',
    'Date: ' . date('r'),
    'Message-ID: <' . bin2hex(random_bytes(12)) . '@ege-fe.com>',
  ];
  if ($ek) {
    $basliklar[] = 'Content-Type: multipart/mixed; boundary="' . $sinir . '"';
    $govde = "--$sinir\r\nContent-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: base64\r\n\r\n" . chunk_split(base64_encode($metin))
      . "--$sinir\r\nContent-Type: {$ek['mime']}; name=\"{$ek['ad']}\"\r\nContent-Transfer-Encoding: base64\r\nContent-Disposition: attachment; filename=\"{$ek['ad']}\"\r\n\r\n" . chunk_split(base64_encode($ek['veri'])) . "--$sinir--\r\n";
  } else {
    $basliklar[] = 'Content-Type: text/plain; charset=UTF-8';
    $basliklar[] = 'Content-Transfer-Encoding: base64';
    $govde = chunk_split(base64_encode($metin));
  }
  if (!empty($FORM['smtp']['host'])) return smtp_gonder($alici, $konuEnc, $basliklar, $govde);
  return @mail($alici, $konuEnc, $govde, implode("\r\n", $basliklar), '-f' . $FORM['gonderen']);
}

function smtp_gonder($alici, $konuEnc, $basliklar, $govde) {
  global $FORM;
  $s = $FORM['smtp'];
  $ssl = (int)$s['port'] === 465;
  $fp = @stream_socket_client(($ssl ? 'ssl://' : 'tcp://') . $s['host'] . ':' . $s['port'], $no, $str, 15);
  if (!$fp) return false;
  stream_set_timeout($fp, 15);
  $oku = function () use ($fp) { $r = ''; while (($l = fgets($fp, 515)) !== false) { $r .= $l; if (isset($l[3]) && $l[3] === ' ') break; } return $r; };
  $yaz = function ($k, $bek) use ($fp, $oku) { if ($k !== null) fwrite($fp, $k . "\r\n"); $r = $oku(); return strpos($r, (string)$bek) === 0; };
  $ok = $yaz(null, 220) && $yaz('EHLO ege-fe.com', 250);
  if ($ok && !$ssl) { $ok = $yaz('STARTTLS', 220) && stream_socket_enable_crypto($fp, true, STREAM_CRYPTO_METHOD_TLS_CLIENT) && $yaz('EHLO ege-fe.com', 250); }
  $ok = $ok && $yaz('AUTH LOGIN', 334) && $yaz(base64_encode($s['kullanici']), 334) && $yaz(base64_encode($s['sifre']), 235)
    && $yaz('MAIL FROM:<' . $FORM['gonderen'] . '>', 250) && $yaz('RCPT TO:<' . $alici . '>', 250) && $yaz('DATA', 354);
  if ($ok) {
    $veri = 'To: <' . $alici . ">\r\nSubject: " . $konuEnc . "\r\n" . implode("\r\n", $basliklar) . "\r\n\r\n" . $govde;
    $veri = preg_replace('/^\./m', '..', str_replace(["\r\n", "\n"], ["\n", "\r\n"], $veri));
    $ok = $yaz($veri . "\r\n.", 250);
  }
  @fwrite($fp, "QUIT\r\n"); fclose($fp);
  return $ok;
}
