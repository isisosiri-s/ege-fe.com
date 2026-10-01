<?php
// Blog kart listesi. Girdi: $YAZILAR
// Konu filtresi (Tümü / Alkol / Uyuşturucu) JS ile çalışır; JS yoksa tüm yazılar görünür.
// Yayın tarihleri görünmez (kullanıcı kararı 2026-10-01); sıralama yine yeniden eskiye.
$sayilar = array_count_values(array_column($YAZILAR, 'konu'));
$filtreler = ['tumu' => ['Tümü', count($YAZILAR)], 'alkol' => ['Alkol', $sayilar['alkol'] ?? 0], 'uyusturucu' => ['Uyuşturucu ve Madde', $sayilar['uyusturucu'] ?? 0]];
?>
<section class="bolum bolum-ince">
  <div class="kap">
    <div class="blog-filtre" role="group" aria-label="Konuya göre filtrele" hidden>
      <?php foreach ($filtreler as $k => [$ad, $n]): ?>
      <button type="button" class="blog-filtre-dugme" data-filtre="<?= $k ?>" aria-pressed="<?= $k === 'tumu' ? 'true' : 'false' ?>"><?= e($ad) ?> <span><?= $n ?></span></button>
      <?php endforeach; ?>
    </div>
    <div class="yazi-kartlari">
      <?php foreach ($YAZILAR as $y): ?>
      <article class="yazi-karti" data-konu="<?= e($y['konu']) ?>">
        <a class="yazi-karti-gorsel" href="<?= e($y['yol']) ?>" tabindex="-1" aria-hidden="true"><img src="<?= e($y['gorselWebp']) ?>" alt="" loading="lazy" decoding="async"></a>
        <div class="yazi-karti-govde">
          <p class="yazi-bilgi"><?= e($y['konu'] === 'alkol' ? 'Alkol' : 'Uyuşturucu ve Madde') ?></p>
          <h2><a href="<?= e($y['yol']) ?>"><?= e($y['baslik']) ?></a></h2>
          <p><?= e($y['ozet']) ?></p>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
