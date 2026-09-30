</main>

<footer class="site-alt">
  <div class="kap site-alt-ic">
    <div class="site-alt-marka">
      <a class="logo-alan" href="/" aria-label="Egefe — Anasayfa"><img src="/img/logo-koyu.png" alt="Egefe" width="1568" height="756"></a>
      <p class="site-alt-slogan"><?= e($FIRMA['slogan']) ?></p>
      <a class="site-alt-sosyal" href="<?= e($FIRMA['linkedin']) ?>" target="_blank" rel="noopener" aria-label="LinkedIn">
        <?= ikon('brand-linkedin', 20) ?>
      </a>
    </div>
    <div>
      <h2 class="site-alt-baslik">Kurumsal</h2>
      <ul>
        <li><a href="/hakkimizda/">Hakkımızda</a></li>
        <li><a href="/hizmet-politikamiz/">Hizmet Politikamız</a></li>
        <li><a href="/kalite-politikamiz/">Kalite Politikamız</a></li>
        <li><a href="/kariyer/">Kariyer</a></li>
        <li><a href="/blog/">Blog</a></li>
        <li><a href="/iletisim/">İletişim</a></li>
      </ul>
    </div>
    <div>
      <h2 class="site-alt-baslik">Hizmetler</h2>
      <ul>
        <li><a href="/hizmetler/">Bakım, Onarım, Kalibrasyon</a></li>
        <?php foreach ($HIZMET['danismanlik'] as $hub): ?>
        <li><a href="<?= e($hub['yol']) ?>"><?= e($hub['ad']) ?></a></li>
        <?php endforeach; ?>
        <li><a href="/bilgi/">Bilgi</a></li>
      </ul>
    </div>
    <div>
      <h2 class="site-alt-baslik">İletişim</h2>
      <address>
        <?= e($FIRMA['adres']) ?><br>
        <a href="tel:<?= e($FIRMA['telefon_uri']) ?>"><?= e($FIRMA['telefon']) ?></a><br>
        <a href="mailto:<?= e($FIRMA['eposta']) ?>"><?= e($FIRMA['eposta']) ?></a>
      </address>
    </div>
  </div>
  <div class="kap site-alt-taban">
    <p>© <?= date('Y') ?> <?= e($FIRMA['yasal_unvan']) ?> Tüm hakları saklıdır. <span>Mersis No: <?= e($FIRMA['mersis']) ?></span></p>
    <ul>
      <li><a href="/kvkk/">KVKK Aydınlatma Metni</a></li>
      <li><a href="/gizlilik-politikasi/">Gizlilik Politikası</a></li>
    </ul>
  </div>
</footer>
<script src="/js/site.js?v=<?= filemtime(KOK . '/js/site.js') ?>" defer></script>
</body>
</html>
