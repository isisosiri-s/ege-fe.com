<?php
// Hub sayfası gövdesi: kısa giriş + alt hizmet kartları (+ isteğe bağlı ikinci grup) + CTA.
// Girdi: $hubGiris (metin), $hubKartlar ([[yol, ad, ozet, (link)], ...]), $hubBaslik, [$hubEk = ['baslik'=>..., 'kartlar'=>[...]]]
// Kartlar ortalanmış satırlarla dizilir (son satırda boş hücre kalmaz). 3'lü satırda 2 kart artarsa
// son yer "Bize ulaşın" kartıyla tamamlanır (kullanıcı onayı 2026-10-01).
$hubKart = function ($k, $sinif, $varsayilan) { ?>
      <a class="kart <?= $sinif ?>" href="<?= e($k['yol']) ?>">
        <h3><?= e($k['ad']) ?></h3>
        <?php if (!empty($k['ozet'])): ?><p><?= e($k['ozet']) ?></p><?php endif; ?>
        <span class="ok-link"><?= e($k['link'] ?? $varsayilan) ?></span>
      </a>
<?php };
?>
<section class="bolum bolum-ince">
  <div class="kap">
    <?php if (!empty($hubGiris)): ?><p class="hub-giris"><?= e($hubGiris) ?></p><?php endif; ?>
    <h2 class="bolum-baslik bolum-baslik-kucuk"><?= $hubBaslik ?></h2>
    <div class="kartlar hub-kartlar">
      <?php foreach ($hubKartlar as $k) $hubKart($k, '', 'Hizmeti incele'); ?>
      <?php if (count($hubKartlar) % 3 === 2): ?>
      <a class="kart kart-iletisim" href="/iletisim/#form">
        <h3>Aradığınız hizmeti bulamadınız mı?</h3>
        <p>İhtiyacınızı bize iletin, size dönüş yapalım.</p>
        <span class="ok-link">Bize ulaşın</span>
      </a>
      <?php endif; ?>
    </div>
    <?php if (!empty($hubEk)): ?>
    <h2 class="bolum-baslik bolum-baslik-kucuk"><?= $hubEk['baslik'] ?></h2>
    <div class="kartlar hub-kartlar">
      <?php foreach ($hubEk['kartlar'] as $k) $hubKart($k, 'kart-sade', 'Hizmetleri incele'); ?>
    </div>
    <?php endif; ?>
  </div>
</section>
<?php require __DIR__ . '/cta.php'; ?>
