<?php
// Markamız: CROM TEST bloğu. $markaTur = 'bant' (anasayfa, Hakkımızda — tam bölüm) | 'kutu' (blog yazısı sonu — kısa).
// Metinler ve bağlantılar config.php → $MARKA.
if (empty($MARKA['aktif'])) return; // marka pasif → hiçbir şey basılmaz
$markaTur = $markaTur ?? 'bant';
$dis = ' target="_blank" rel="noopener"';
?>
<?php if ($markaTur === 'kutu'): ?>
<aside class="marka-kutu" aria-label="Markamız: CROM TEST">
  <img class="marka-logo" src="/img/crom-test/crom-test-logo.svg" alt="CROM TEST" width="362" height="152" loading="lazy">
  <div>
    <p class="marka-kutu-baslik">Uyuşturucu madde taraması için yerli üretim test kitleri</p>
    <p><?= e($MARKA['detay']) ?></p>
    <div class="dugme-grubu">
      <a class="dugme dugme-birincil" href="<?= e($MARKA['urunler']) ?>"<?= $dis ?>>CROM TEST Ürünleri <?= ikon('external-link', 16) ?></a>
      <a class="dugme dugme-cizgi" href="/urunler/#crom-test">Egefe Ürünleri</a>
    </div>
  </div>
</aside>
<?php else: ?>
<section class="bolum bolum-ince marka-bant" id="crom-test-markamiz">
  <div class="kap marka-bant-ic">
    <div class="marka-bant-logo">
      <img class="marka-logo" src="/img/crom-test/crom-test-logo.svg" alt="CROM TEST" width="362" height="152" loading="lazy">
    </div>
    <div>
      <p class="etiket">Markamız</p>
      <h2 class="bolum-baslik bolum-baslik-kucuk">Yerli üretim uyuşturucu test kitleri: <em>CROM TEST</em></h2>
      <p><?= e($MARKA['tanim']) ?> <?= e($MARKA['detay']) ?></p>
      <ul class="urun-ozellik marka-ozellik">
        <?php foreach ($MARKA['ozellik'] as $o): ?><li><?= ikon('check', 18) ?><span><?= e($o) ?></span></li><?php endforeach; ?>
      </ul>
      <div class="dugme-grubu">
        <a class="dugme dugme-birincil" href="<?= e($MARKA['url']) ?>"<?= $dis ?>>cromtest.com <?= ikon('external-link', 16) ?></a>
        <a class="dugme dugme-cizgi" href="/urunler/#crom-test">Test Kiti Çeşitleri</a>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
