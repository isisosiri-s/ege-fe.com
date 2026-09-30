<?php
// Form yardımcıları: spam koruması (honeypot + imzalı zaman damgası) ve durum mesajı.
require_once __DIR__ . '/config.php';

function form_gizli_alanlar($tur) {
  $t = time();
  $imza = hash_hmac('sha256', $tur . '|' . $t, FORM_GIZLI);
  return '<input type="hidden" name="tur" value="' . e($tur) . '">'
    . '<input type="hidden" name="zaman" value="' . $t . '.' . $imza . '">'
    . '<div class="bal-kupu" aria-hidden="true"><label>Web siteniz<input type="text" name="web_sitesi" tabindex="-1" autocomplete="off"></label></div>';
}

function form_durum($tur) {
  if (($_GET['tur'] ?? '') !== $tur || empty($_GET['form'])) return '';
  if ($_GET['form'] === 'ok') {
    $msg = $tur === 'kariyer' ? 'Başvurunuz alındı. Teşekkür ederiz.' : 'Mesajınız alındı. En kısa sürede size dönüş yapacağız.';
    return '<p class="form-mesaj basarili" role="status">' . $msg . '</p>';
  }
  $h = [
    'eksik' => 'Lütfen zorunlu alanları doldurun.',
    'eposta' => 'Lütfen geçerli bir e-posta adresi girin.',
    'kvkk' => 'Devam etmek için onay kutusunu işaretlemeniz gerekir.',
    'dosya' => 'Özgeçmiş dosyası PDF, DOC veya DOCX biçiminde ve en fazla 5 MB olmalıdır.',
    'gonderim' => 'Mesajınız şu anda gönderilemedi. Lütfen ' . $GLOBALS['FIRMA']['eposta'] . ' adresine e-posta ile ulaşın.',
  ][$_GET['form']] ?? 'Form gönderilemedi. Lütfen tekrar deneyin.';
  return '<p class="form-mesaj hata" role="alert">' . e($h) . '</p>';
}

// Onay kutusu metinleri: ege-fe-kvkk-gizlilik-taslak.md, 3. bölüm
function form_kvkk_onay($tur = 'iletisim') {
  $link = '<a href="/kvkk/" target="_blank">KVKK Aydınlatma Metni</a>';
  $metin = [
    'iletisim' => $link . '\'ni okudum; kişisel verilerimin bu kapsamda işlenmesini kabul ediyorum.',
    'kariyer'  => 'Özgeçmişimde yer alan kişisel verilerimin, iş başvurumun değerlendirilmesi amacıyla ' . $link . ' kapsamında işlenmesine açık rıza veriyorum.',
  ][$tur];
  return '<label class="onay"><input type="checkbox" name="kvkk" value="1" required> <span>' . $metin . '</span></label>';
}
