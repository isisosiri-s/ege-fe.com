<div class="kunye-kutu">
  <h2>Veri sorumlusu</h2>
  <dl>
    <div><dt>Unvan</dt><dd><?= e($FIRMA['yasal_unvan']) ?></dd></div>
    <div><dt>Merkez</dt><dd><?= e($FIRMA['adres']) ?></dd></div>
    <div><dt>AR-GE</dt><dd><?= e($FIRMA['arge_adres']) ?></dd></div>
    <div><dt>Vergi Dairesi / VKN</dt><dd><?= e($FIRMA['vergi_dairesi']) ?> / <?= e($FIRMA['vkn']) ?></dd></div>
    <div><dt>Mersis No</dt><dd><?= e($FIRMA['mersis']) ?></dd></div>
    <div><dt>Telefon · Faks</dt><dd><a href="tel:<?= e($FIRMA['telefon_uri']) ?>"><?= e($FIRMA['telefon']) ?></a> · <?= e($FIRMA['faks']) ?></dd></div>
    <div><dt>E-posta (KVKK başvuru)</dt><dd><a href="mailto:<?= e($FIRMA['eposta']) ?>"><?= e($FIRMA['eposta']) ?></a></dd></div>
    <div><dt>Web</dt><dd>ege-fe.com</dd></div>
  </dl>
</div>
