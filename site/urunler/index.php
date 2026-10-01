<?php
// Ürünler (elle yazılan sayfa, 2026-10-01). Metinler yalnız sitedeki mevcut bilgilerden (/bilgi/ SSS, blog) derlendi;
// görseller Armas Elektronik'ten (Egefe yetkili bayi ve servisi — kullanıcı onayı). NAM-19 ve UTC özellikleri kullanıcıdan bekleniyor.
$yol = '/urunler/';
$sayfa = [
  'etiket' => 'Armas Elektronik Yetkili Bayi ve Servisi',
  'altBaslik' => 'Armas Elektronik\'in yetkili bayi ve servisi olarak alkolmetre ve uyuşturucu tespit ürünlerinin satışını, bakımını ve kalibrasyonunu yapıyoruz.',
];
require __DIR__ . '/../inc/header.php';
$teklif = '/iletisim/?konu=' . rawurlencode('Ürünler') . '#form';
$urunler = [
  'Alkolmetreler' => [
    [
      'id' => 'nam-07', 'ad' => 'NAM-07', 'tur' => 'Delil sınıfı alkolmetre',
      'gorsel' => ['/img/urun/nam07.png', 640, 480],
      'ozellik' => [
        'Otomatik, Manuel ve Pasif ölçüm modları: yeterli nefes üfleyemeyen hasta ve baygın kişilerde de ölçüm',
        'Yüksek kapasiteli hafıza; kayıtlarda çeşitli kriterlere göre tarama',
        'Opsiyonel yazıcı ile geçmiş kayıtlardan rapor',
        'Verileri arşiv amacıyla bilgisayara aktarma (NAM-DATA)',
        '3 tuşla kullanım, dil seçeneği, ekranda yönlendirme ve cümlelerle ifade edilen uyarı mesajları',
        'CE uygunluğu',
      ],
    ],
    [
      'id' => 'nam-19', 'ad' => 'NAM-19', 'tur' => 'Delil sınıfı alkolmetre',
      'gorsel' => ['/img/urun/nam19.jpg', 640, 480],
      'ozellik' => [
        'Orijinal yedek parça temini',
        'Periyodik bakım ve kalibrasyon hizmeti',
        'CE uygunluğu',
      ],
    ],
  ],
  'Uyuşturucu Test Sistemi' => [
    [
      'id' => 'utk', 'ad' => 'UTK', 'tur' => 'Uyuşturucu tespit kiti',
      'gorsel' => ['/img/urun/utk.webp', 300, 240],
      'ozellik' => [
        'Ağız sıvısından (tükürük) alınan örnekle tespit',
        'Aynı anda 9 çeşit uyuşturucu madde; madde sayısı ve eşik değerleri talebe göre değişebilir',
        'Tek kullanımlık: test stripleri ve ağız sıvısı toplama seti',
        'Kullanımı için cihaz zorunluluğu yoktur',
      ],
      'not' => 'Ön tespit amaçlıdır; pozitif sonuçlara yaptırım uygulanmadan önce teyit gerekir.',
    ],
    [
      'id' => 'utc', 'ad' => 'UTC', 'tur' => 'Uyuşturucu tespit cihazı',
      'gorsel' => ['/img/urun/utc.webp', 300, 240],
      'ozellik' => [
        'UTK uyuşturucu tespit kiti ile birlikte tükürükten uyuşturucu madde testi',
        'Bakım, onarım ve teknik servis hizmeti',
      ],
    ],
  ],
];
?>
<section class="bolum bolum-ince">
  <div class="kap">
    <?php foreach ($urunler as $grup => $liste): ?>
    <h2 class="bolum-baslik bolum-baslik-kucuk"><?= e($grup) ?></h2>
    <div class="urunler">
      <?php foreach ($liste as $u): ?>
      <article class="urun" id="<?= e($u['id']) ?>">
        <div class="urun-gorsel"><img src="<?= e($u['gorsel'][0]) ?>" alt="<?= e($u['ad'] . ' ' . mb_strtolower($u['tur'], 'UTF-8')) ?>" width="<?= $u['gorsel'][1] ?>" height="<?= $u['gorsel'][2] ?>" loading="lazy" decoding="async"></div>
        <div class="urun-govde">
          <p class="urun-tur"><?= e($u['tur']) ?></p>
          <h3><?= e($u['ad']) ?></h3>
          <ul class="urun-ozellik">
            <?php foreach ($u['ozellik'] as $o): ?><li><?= ikon('check', 18) ?><span><?= e($o) ?></span></li><?php endforeach; ?>
          </ul>
          <?php if (!empty($u['not'])): ?><p class="urun-not"><?= e($u['not']) ?></p><?php endif; ?>
          <div class="dugme-grubu">
            <a class="dugme dugme-birincil" href="<?= e($teklif) ?>">Teklif Al</a>
            <a class="dugme dugme-cizgi" href="/bilgi/">Sık Sorulan Sorular</a>
          </div>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
    <?php if ($grup === 'Alkolmetreler'): ?>
    <div class="urun-ek" id="nam-data">
      <h3>NAM-DATA Veri Transfer Yazılımı</h3>
      <p>Alkolmetredeki verileri bilgisayara aktarır; iki seviyeli yetkilendirme sunar. Kullanıcılar verileri bilgisayara aktarabilir, arşivleyebilir, tarayabilir, sonuçları yazdırabilir ve farklı ortamlara kaydedebilir. Yetkili kişiler bunlara ek olarak cihaz hafızasını temizleme, program ayarları ve yetkilendirme işlemlerini yapabilir.</p>
    </div>
    <?php endif; ?>
    <?php endforeach; ?>

    <div class="urun-servis">
      <div>
        <p class="etiket">Satış Sonrası</p>
        <h2 class="bolum-baslik bolum-baslik-kucuk">Cihazınız için <em>yetkili servis</em></h2>
        <p>Satışını yaptığımız cihazların periyodik bakımını, arıza onarımını ve kalibrasyonunu yapıyor, orijinal yedek parça temin ediyoruz.</p>
      </div>
      <ul class="urun-servis-linkler">
        <li><a class="ok-link" href="/periyodik-bakim/">Periyodik Bakım</a></li>
        <li><a class="ok-link" href="/ariza-ve-onarim/">Arıza ve Onarım</a></li>
        <li><a class="ok-link" href="/kalibrasyon/">Kalibrasyon</a></li>
      </ul>
    </div>
  </div>
</section>
<?php require __DIR__ . '/../inc/cta.php'; ?>
<?php require __DIR__ . '/../inc/footer.php'; ?>
