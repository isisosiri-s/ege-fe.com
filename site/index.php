<?php
// Anasayfa (2026-10-01 düzeni): açılış → üç ziyaretçi grubu için giriş kartları → ürün vitrini → Markamız CROM TEST (yalnız aktifken) → Neden Egefe → Bize Ulaşın
// Rakamlar kullanıcı kararıyla: "200+ anlaşmalı kurum", "2017'den beri"; %99 iddiaları kaldırıldı.
$yol = '/';
$sayfa = ['ozelBaslik' => true, 'govdeSinif' => 'anasayfa'];
require __DIR__ . '/inc/header.php';
$crom = !empty($MARKA['aktif']); // CROM TEST pasifken hiçbir yerde görünmez (config.php)
?>
<section class="acilis">
  <div class="kap acilis-ic">
    <div class="acilis-metin">
      <?php if ($crom): ?>
      <p class="etiket">Armas Yetkili Bayi · CROM TEST Markası</p>
      <h1>Alkolmetre, uyuşturucu testi ve <em>sağlık danışmanlığı</em></h1>
      <?php else: ?>
      <p class="etiket">Armas Elektronik Yetkili Bayi ve Servisi</p>
      <h1>Alkolmetre ve <em>sağlık danışmanlığı</em></h1>
      <?php endif; ?>
      <?php if ($crom): ?>
      <p class="giris">Armas Elektronik'in yetkili bayi ve servisi olarak alkolmetrelerin satışını, bakımını ve kalibrasyonunu yapıyoruz. Uyuşturucu madde taramasında kendi markamız CROM TEST'in yerli üretim test kitlerini sunuyor; tıbbi cihaz, ÜTS ve Sağlık Bakanlığı işlemlerinde danışmanlık veriyoruz.</p>
      <?php else: ?>
      <p class="giris">Armas Elektronik'in yetkili bayi ve servisi olarak alkolmetrelerin satışını, bakımını ve kalibrasyonunu yapıyoruz. Tıbbi cihaz, ÜTS ve Sağlık Bakanlığı işlemlerinde de danışmanlık veriyoruz.</p>
      <?php endif; ?>
      <div class="dugme-grubu">
        <a class="dugme dugme-birincil" href="/urunler/">Ürünleri İncele</a>
        <a class="dugme dugme-cizgi" href="/iletisim/#form">Teklif Al</a>
      </div>
    </div>
    <figure class="acilis-gorsel">
      <img src="/img/urun/nam19-saha.webp" alt="Trafik denetiminde NAM-19 alkolmetre ile ölçüm" width="800" height="525" fetchpriority="high">
    </figure>
  </div>
  <div class="kap">
    <h2 class="gizli">Ne arıyorsunuz?</h2>
    <ul class="giris-kartlari">
      <li>
        <a class="giris-karti" href="/urunler/">
          <span class="giris-karti-ikon"><?= ikon('device-mobile-check', 24) ?></span>
          <span class="giris-karti-etiket">Ürünler</span>
          <?php if ($crom): ?>
          <h3>Alkolmetre ve uyuşturucu testi</h3>
          <p>NAM-07 ve NAM-19 delil sınıfı alkolmetreler ve kendi markamız CROM TEST uyuşturucu madde tarama test kitleri.</p>
          <?php else: ?>
          <h3>Delil sınıfı alkolmetreler</h3>
          <p>NAM-07 ve NAM-19 alkolmetreler; satış, periyodik bakım ve kalibrasyon.</p>
          <?php endif; ?>
          <span class="ok-link">Ürünleri incele</span>
        </a>
      </li>
      <li>
        <a class="giris-karti" href="/hizmetler/">
          <span class="giris-karti-ikon"><?= ikon('tool', 24) ?></span>
          <span class="giris-karti-etiket">Servis</span>
          <h3>Bakım, onarım ve kalibrasyon</h3>
          <p>Cihazlarınızın periyodik bakımı, arıza onarımı ve kalibrasyonu; orijinal yedek parça temini.</p>
          <span class="ok-link">Servis hizmetleri</span>
        </a>
      </li>
      <li>
        <a class="giris-karti" href="/danismanlik/">
          <span class="giris-karti-ikon"><?= ikon('briefcase', 24) ?></span>
          <span class="giris-karti-etiket">Danışmanlık</span>
          <h3>Tıbbi cihaz, ÜTS ve Bakanlık işlemleri</h3>
          <p>Firma ve ürün kayıtları, ÜTS işlemleri, ilaç ruhsatlandırma ve diğer Sağlık Bakanlığı başvuruları.</p>
          <span class="ok-link">Danışmanlık alanları</span>
        </a>
      </li>
    </ul>
  </div>
</section>

<section class="bolum">
  <div class="kap">
    <div class="bolum-ust bolum-ust-yatay">
      <div>
        <p class="etiket">Ürünler</p>
        <h2 class="bolum-baslik">Öne Çıkan <em>Ürünler</em></h2>
      </div>
      <a class="ok-link" href="/urunler/">Tüm ürünler</a>
    </div>
    <ul class="urun-vitrin<?= $crom ? '' : ' urun-vitrin-2' ?>">
      <li><a href="/urunler/#nam-07"><span class="urun-vitrin-gorsel"><img src="/img/urun/nam07.png" alt="NAM-07 alkolmetre" width="640" height="480" loading="lazy" decoding="async"></span><span class="urun-vitrin-ad">NAM-07</span><span class="urun-vitrin-tur">Delil sınıfı alkolmetre</span></a></li>
      <li><a href="/urunler/#nam-19"><span class="urun-vitrin-gorsel"><img src="/img/urun/nam19.jpg" alt="NAM-19 alkolmetre" width="640" height="480" loading="lazy" decoding="async"></span><span class="urun-vitrin-ad">NAM-19</span><span class="urun-vitrin-tur">Delil sınıfı alkolmetre</span></a></li>
      <?php if ($crom): ?>
      <li><a href="/urunler/#crom-test"><span class="urun-vitrin-gorsel"><img src="/img/crom-test/coklu-panel.webp" alt="CROM TEST çok panelli uyuşturucu test kiti" width="640" height="640" loading="lazy" decoding="async"></span><span class="urun-vitrin-ad">CROM TEST Çok Panelli</span><span class="urun-vitrin-tur">Uyuşturucu test kiti · 16 panele kadar</span></a></li>
      <li><a href="/urunler/#crom-test"><span class="urun-vitrin-gorsel"><img src="/img/crom-test/numune-saflik.webp" alt="CROM TEST numune saflık testi" width="640" height="640" loading="lazy" decoding="async"></span><span class="urun-vitrin-ad">CROM TEST Numune Saflık</span><span class="urun-vitrin-tur">İdrar numunesi doğrulama testi</span></a></li>
      <?php endif; ?>
    </ul>
  </div>
</section>

<?php $markaTur = 'bant'; require __DIR__ . '/inc/marka-crom.php'; ?>

<section class="bolum bolum-koyu">
  <div class="kap kalite-izgara">
    <div>
      <p class="etiket">Neden Egefe</p>
      <h2 class="bolum-baslik">1. Sınıf <em>Hizmet</em></h2>
      <p class="bolum-aciklama">Sunduğumuz ürünlerin yanında, verdiğimiz tüm hizmetlerimizde öncelikli noktamız "Kalite". Kırıkkale Teknopark bünyesindeki AR-GE ofisimiz ile yeni teknolojiler ve yeni hizmetleri sizlere sunmanın gayretindeyiz.</p>
      <a class="ok-link ok-link-acik" href="/hakkimizda/">Hakkımızda</a>
    </div>
    <ul class="sayaclar sayaclar-buyuk" aria-label="Egefe rakamlarla">
      <li><strong>200+</strong><span>Anlaşmalı Kurum</span></li>
      <li><strong>Armas</strong><span>Yetkili Bayi ve Servis</span></li>
      <li><strong>CE</strong><span>Uygunluklu Cihazlar</span></li>
      <?php if ($crom): ?><li><strong>CROM TEST</strong><span>Yerli Üretim Test Kiti Markamız</span></li><?php endif; ?>
    </ul>
  </div>
</section>

<?php require __DIR__ . '/inc/bize-ulasin.php'; ?>
<?php require __DIR__ . '/inc/footer.php'; ?>
