<?php
http_response_code(404);
$yol = '/404/';
require __DIR__ . '/inc/header.php';
?>
<div class="kap kap-dar">
  <article class="metin">
    <p class="giris">Aradığınız sayfa taşınmış veya kaldırılmış olabilir.</p>
    <div class="dugme-grubu">
      <a class="dugme dugme-birincil" href="/">Anasayfaya dön</a>
      <a class="dugme dugme-cizgi" href="/hizmetler/">Hizmetlerimiz</a>
      <a class="dugme dugme-cizgi" href="/iletisim/">İletişim</a>
    </div>
  </article>
</div>
<?php require __DIR__ . '/inc/footer.php'; ?>
