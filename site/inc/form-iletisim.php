<?php
require_once __DIR__ . '/form.php';
// Konu: bağlantıdan gelebilir (ör. /iletisim/?konu=Ürünler#form); yoksa "Hizmetler"
$konular = ['Teknik Destek', 'Muhasebe', 'Ürünler', 'Hizmetler', 'İnsan Kaynakları', 'Diğer'];
$seciliKonu = in_array($_GET['konu'] ?? '', $konular, true) ? $_GET['konu'] : 'Hizmetler';
?>
<form class="form" id="form" action="/form/gonder.php" method="post">
  <?= form_durum('iletisim') ?>
  <?= form_gizli_alanlar('iletisim') ?>
  <div class="form-izgara">
    <label>İsim Soyisim *<input type="text" name="ad" required maxlength="120" autocomplete="name"></label>
    <label>E-posta Adresi *<input type="email" name="eposta" required maxlength="160" autocomplete="email"></label>
    <label>Telefon<input type="tel" name="telefon" maxlength="40" autocomplete="tel"></label>
    <label>Sormak istediğiniz nedir?
      <select name="konu">
        <?php foreach ($konular as $k): ?><option<?= $k === $seciliKonu ? ' selected' : '' ?>><?= e($k) ?></option><?php endforeach; ?>
      </select>
    </label>
    <label class="tam">Nasıl yardımcı olabiliriz? *<textarea name="mesaj" rows="5" required maxlength="5000"></textarea></label>
  </div>
  <?= form_kvkk_onay('iletisim') ?>
  <button class="dugme dugme-birincil" type="submit">Gönder</button>
</form>
