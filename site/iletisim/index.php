<?php
$yol = '/iletisim/';
require __DIR__ . '/../inc/header.php';
$baslikEtiketi = 'h2';
$iletisimGiris = 'Aşağıda bulunan iletişim formumuz ile bize 7/24 ulaşabilirsiniz.';
require __DIR__ . '/../inc/bize-ulasin.php';
?>
<section class="bolum bolum-ince">
  <div class="kap kap-dar yasal-kutu">
    <p><strong><?= e($FIRMA['yasal_unvan']) ?></strong><br><?= e($FIRMA['adres']) ?><br>
      Vergi Dairesi: <?= e($FIRMA['vergi_dairesi']) ?> · VKN: <?= e($FIRMA['vkn']) ?> · Mersis No: <?= e($FIRMA['mersis']) ?><br>
      Tel: <?= e($FIRMA['telefon']) ?> · Faks: <?= e($FIRMA['faks']) ?> · <?= e($FIRMA['eposta']) ?></p>
  </div>
</section>
<?php require __DIR__ . '/../inc/footer.php'; ?>
