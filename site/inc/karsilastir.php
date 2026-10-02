<?php
// Cihaz karşılaştırma bölümü (ürünler sayfası). Girdi: inc/karsilastir-veri.php ($karsiCihaz, $karsiSatirlar, $KARSI_EN_FAZLA), $teklif.
// JS yoksa tüm cihazlar yan yana görünür; JS seçime göre sütunları gizler/gösterir ve "yalnızca farklar" süzgecini uygular (js/site.js).
?>
<section class="karsi" id="karsilastir" aria-labelledby="karsi-baslik" data-en-fazla="<?= (int)$KARSI_EN_FAZLA ?>">
  <div class="karsi-ust">
    <div>
      <h2 class="bolum-baslik bolum-baslik-kucuk" id="karsi-baslik">Cihazları <em>Karşılaştır</em></h2>
      <p class="karsi-aciklama">Karşılaştırmak istediğiniz cihazları seçin (en fazla <?= (int)$KARSI_EN_FAZLA ?>).</p>
    </div>
    <label class="karsi-fark"><input type="checkbox" data-karsi-fark> Yalnızca farkları göster</label>
  </div>
  <div class="karsi-secim" role="group" aria-label="Karşılaştırılacak cihazlar">
    <?php foreach ($karsiCihaz as $id => $c): ?>
    <label class="karsi-cip"><input type="checkbox" value="<?= e($id) ?>" data-karsi-sec checked> <?= e($c['ad']) ?></label>
    <?php endforeach; ?>
  </div>
  <p class="karsi-uyari" data-karsi-uyari hidden>Karşılaştırma için en az 2 cihaz seçin.</p>
  <p class="karsi-ipucu">Diğer cihazları görmek için tabloyu yana kaydırın.</p>
  <div class="karsi-kaydir">
    <table class="karsi-tablo">
      <thead>
        <tr>
          <th scope="col" class="karsi-ozellik">Özellik</th>
          <?php foreach ($karsiCihaz as $id => $c): ?>
          <th scope="col" data-cihaz="<?= e($id) ?>">
            <img src="<?= e($c['gorsel']) ?>" alt="" width="640" height="480" loading="lazy" decoding="async">
            <a class="karsi-ad" href="#<?= e($id) ?>"><?= e($c['ad']) ?></a>
          </th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($karsiSatirlar as $s): ?>
        <tr>
          <th scope="row" class="karsi-ozellik"><?= e($s) ?></th>
          <?php foreach ($karsiCihaz as $id => $c): ?><td data-cihaz="<?= e($id) ?>"><?= e($c['deger'][$s] ?? '—') ?></td><?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <th scope="row" class="karsi-ozellik"></th>
          <?php foreach ($karsiCihaz as $id => $c): ?><td data-cihaz="<?= e($id) ?>"><a class="dugme dugme-birincil" href="<?= e($teklif) ?>">Teklif Al</a></td><?php endforeach; ?>
        </tr>
      </tfoot>
    </table>
  </div>
</section>
