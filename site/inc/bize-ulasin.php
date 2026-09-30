<?php
// "Bize Ulaşın" bölümü: iletişim bilgileri + form (anasayfa, hakkımızda, iletişim)
$baslikEtiketi = $baslikEtiketi ?? 'h2';
?>
<section class="bolum iletisim-bolum">
  <div class="kap iletisim-izgara">
    <div class="iletisim-bilgi">
      <p class="etiket">İletişim</p>
      <<?= $baslikEtiketi ?> class="bolum-baslik">Bize <em>Ulaşın</em></<?= $baslikEtiketi ?>>
      <?php if (!empty($iletisimGiris)): ?><p><?= e($iletisimGiris) ?></p><?php endif; ?>
      <dl class="iletisim-liste">
        <div><dt>Merkez</dt><dd><?= e($FIRMA['adres']) ?></dd></div>
        <div><dt>AR-GE Ofis</dt><dd><?= e($FIRMA['arge_adres']) ?></dd></div>
        <div><dt>Telefon</dt><dd><a href="tel:<?= e($FIRMA['telefon_uri']) ?>"><?= e($FIRMA['telefon']) ?></a></dd></div>
        <div><dt>E-posta</dt><dd><a href="mailto:<?= e($FIRMA['eposta']) ?>"><?= e($FIRMA['eposta']) ?></a></dd></div>
      </dl>
    </div>
    <div class="iletisim-form">
      <h3>Bize Yazın</h3>
      <?php require __DIR__ . '/form-iletisim.php'; ?>
    </div>
  </div>
</section>
