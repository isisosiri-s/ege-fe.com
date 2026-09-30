<?php // Blog kart listesi. Girdi: $YAZILAR ?>
<section class="bolum bolum-ince">
  <div class="kap">
    <div class="yazi-kartlari">
      <?php foreach ($YAZILAR as $y): ?>
      <article class="yazi-karti">
        <a class="yazi-karti-gorsel" href="<?= e($y['yol']) ?>" tabindex="-1" aria-hidden="true"><img src="<?= e(implode('/', array_map('rawurlencode', explode('/', $y['gorsel'])))) ?>" alt="" loading="lazy" decoding="async"></a>
        <div class="yazi-karti-govde">
          <p class="yazi-bilgi"><time datetime="<?= e(substr($y['tarih'], 0, 10)) ?>"><?= e($y['tarihTr']) ?></time> · <?= e($y['kategori']) ?></p>
          <h2><a href="<?= e($y['yol']) ?>"><?= e($y['baslik']) ?></a></h2>
          <p><?= e($y['ozet']) ?></p>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
