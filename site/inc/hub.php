<?php
// Hub sayfası gövdesi: kısa giriş + alt hizmet kartları (+ isteğe bağlı ikinci grup) + CTA.
// Girdi: $hubGiris (metin), $hubKartlar ([[yol, ad, ozet], ...]), $hubBaslik, [$hubEk = ['baslik'=>..., 'kartlar'=>[...]]]
?>
<section class="bolum bolum-ince">
  <div class="kap">
    <?php if (!empty($hubGiris)): ?><p class="hub-giris"><?= e($hubGiris) ?></p><?php endif; ?>
    <h2 class="bolum-baslik bolum-baslik-kucuk"><?= $hubBaslik ?></h2>
    <div class="kartlar kartlar-3">
      <?php foreach ($hubKartlar as $k): ?>
      <a class="kart" href="<?= e($k['yol']) ?>">
        <h3><?= e($k['ad']) ?></h3>
        <?php if (!empty($k['ozet'])): ?><p><?= e($k['ozet']) ?></p><?php endif; ?>
        <span class="ok-link">Detaylar</span>
      </a>
      <?php endforeach; ?>
    </div>
    <?php if (!empty($hubEk)): ?>
    <h2 class="bolum-baslik bolum-baslik-kucuk"><?= $hubEk['baslik'] ?></h2>
    <div class="kartlar kartlar-3">
      <?php foreach ($hubEk['kartlar'] as $k): ?>
      <a class="kart kart-sade" href="<?= e($k['yol']) ?>">
        <h3><?= e($k['ad']) ?></h3>
        <?php if (!empty($k['ozet'])): ?><p><?= e($k['ozet']) ?></p><?php endif; ?>
        <span class="ok-link">Detaylar</span>
      </a>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>
<?php require __DIR__ . '/cta.php'; ?>
