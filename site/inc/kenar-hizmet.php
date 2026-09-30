<?php
// Hizmet alt sayfalarında kenar çubuğu: aynı gruptaki hizmetler + iletişim kutusu. $hub = grup yolu.
$grup = $hub === '/hizmetler/' ? $HIZMET['servis'] : current(array_filter($HIZMET['danismanlik'], fn($h) => $h['yol'] === $hub));
?>
<aside class="kenar">
  <nav class="kenar-kutu" aria-label="<?= e($grup['ad']) ?> hizmetleri">
    <h2 class="kenar-baslik"><a href="<?= e($grup['yol']) ?>"><?= e($grup['ad']) ?></a></h2>
    <ul>
      <?php foreach ($grup['alt'] as $h): ?>
      <li><a href="<?= e($h['yol']) ?>"<?= $h['yol'] === $yol ? ' aria-current="page"' : '' ?>><?= e($h['ad']) ?></a></li>
      <?php endforeach; ?>
    </ul>
  </nav>
  <div class="kenar-kutu kenar-iletisim">
    <h2 class="kenar-baslik">Bize Ulaşın</h2>
    <p><a href="tel:<?= e($FIRMA['telefon_uri']) ?>"><?= e($FIRMA['telefon']) ?></a><br><a href="mailto:<?= e($FIRMA['eposta']) ?>"><?= e($FIRMA['eposta']) ?></a></p>
    <a class="dugme dugme-birincil" href="/iletisim/#form">Teklif Al</a>
  </div>
</aside>
