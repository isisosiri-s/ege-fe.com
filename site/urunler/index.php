<?php
// Ürünler (elle yazılan sayfa). Kaynaklar: sitedeki /bilgi/ SSS + Armas Elektronik ürün sayfalarındaki teknik bilgiler
// (Egefe Armas yetkili bayi ve servisi; görsel ve teknik bilgi kullanım izni kullanıcıdan, 2026-10-01).
// Yalnız Egefe'nin sattığı modeller: NAM-07, NAM-19, UTK, UTC (diğer Armas modelleri eklenmeyecek — kullanıcı kararı).
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
        'Yeni nesil elektrokimyasal sensör ile hassas ve güvenilir ölçüm',
        'Otomatik, Manuel ve Pasif ölçüm modları: yeterli nefes üfleyemeyen hasta ve baygın kişilerde de ölçüm',
        '3 tuşla kullanım, dil seçeneği, ekranda yönlendirme ve cümlelerle ifade edilen uyarı mesajları',
        '4.500–20.000 kayıtlık hafıza; kayıtlarda tarama ve rapor alma',
        'Opsiyonel termal veya dot-matrix yazıcı ve harici tuş takımı',
        'NAM-DATA yazılımı ile bilgisayara veri aktarımı (opsiyonel)',
      ],
      'teknik' => [
        'Sensör' => 'Yeni nesil elektrokimyasal',
        'Ölçüm modu' => 'Otomatik / Manuel / Pasif',
        'Ölçüm aralığı' => '0,00 – 5,00 ‰',
        'Hassasiyet' => '0,00 – 1,00 ‰ aralığında ±0,005 ‰ BAC; 1,00 – 5,00 ‰ aralığında ölçülen değerin ±%5\'i',
        'Standart sapma' => '< 0,008 ‰',
        'Hazırlanma süresi' => 'Cihaz açıldıktan sonra 8 sn\'den az',
        'Sonuç gösterme' => 'Örnek alımından yaklaşık 20 sn sonra',
        'Çalışma sıcaklığı' => '−10 °C / +50 °C',
        'Minimum nefes hacmi' => '1,2 L (ayarlanabilir)',
        'Ekran' => 'Aydınlatmalı, kontrast ayarlı tam grafik LCD (128×64)',
        'Hafıza' => 'Kaydedilen veriye göre 4.500 – 20.000 kayıt',
        'Ağızlık' => 'Tek kullanımlık, tek tek paketlenmiş',
        'Menü dili' => 'Türkçe, İngilizce, Rusça',
        'Kalibrasyon' => 'Her 6 ayda bir; kuru gaz (otomatik yükseklik ayarlı) veya buhar',
        'CE uygunluğu' => 'Var',
      ],
    ],
    [
      'id' => 'nam-19', 'ad' => 'NAM-19', 'tur' => 'Delil sınıfı alkolmetre',
      'gorsel' => ['/img/urun/nam19.jpg', 640, 480],
      'ozellik' => [
        'Yeni nesil elektrokimyasal (fuel cell) sensör; DOT/NHTSA delil sınıfı ve EN 15964 sertifikaları',
        'Otomatik, Manuel, Pasif ve Ölçüm Retti modları: ölçüm yaptırmak istemeyenler de kayıt altına alınır',
        'Alfanümerik tuş takımı ile veri girişi; güneşte okunabilen renkli TFT ekran',
        '7.500–100.000 kayıtlık hafıza; kayıtlarda tarama ve yazıcıyla raporlama',
        'NAM-DATAPro ile bilgisayara aktarım; opsiyonel Bluetooth termal yazıcı ve GPS',
        'Tek kullanımlık hijyenik ağızlık; opsiyonel pasif ağızlık ile temassız ölçüm',
      ],
      'teknik' => [
        'Sensör' => 'Yeni nesil elektrokimyasal fuel cell',
        'Ölçüm modu' => 'Otomatik / Manuel / Pasif / Ölçüm Retti',
        'Ölçüm aralığı' => '0,00 – 6,00 ‰ BAC',
        'Hazırlanma süresi' => 'Cihaz açıldıktan sonra en fazla 5 sn',
        'Sonuç gösterme' => 'Alkol varken örnek alımından en fazla 15 sn sonra; alkol yokken hemen',
        'Çalışma sıcaklığı' => '−10 °C / +50 °C',
        'Depolama sıcaklığı' => '−20 °C / +60 °C',
        'Nefes hacmi' => 'En az 1,2 L',
        'Üfleme süresi' => 'En fazla 6 sn',
        'Ekran' => 'Güneşte görülebilir transreflektif renkli TFT',
        'Hafıza' => 'Girilen veriye göre 7.500 – 100.000 kayıt',
        'Veri girişi' => 'Alfanümerik tuş takımı',
        'GPS' => 'Opsiyonel',
        'Batarya' => '3,7 V lityum-iyon (opsiyonel alkalin ve Ni-MH pil)',
        'Dil seçenekleri' => 'Türkçe, İngilizce, Rusça, Hırvatça, İspanyolca',
        'Kalibrasyon' => 'Kuru gaz ve/veya buhar',
        'Sertifikalar' => 'DOT/NHTSA Delil Sınıfı, EN 15964, EN 60068-2-2 (şok), EN 60068-2-27 (titreşim), CE (EMC, LVD)',
      ],
    ],
  ],
  'Uyuşturucu Test Sistemi' => [
    [
      'id' => 'utk', 'ad' => 'UTK', 'tur' => 'Uyuşturucu tespit kiti',
      'gorsel' => ['/img/urun/utk.webp', 300, 240],
      'ozellik' => [
        'Tek bir ağız sıvısı (tükürük) örneğiyle aynı anda 9 çeşide kadar uyuşturucu madde (standart kitte 7)',
        'Test edilecek madde sayısı ve eşik değerleri talebe göre değiştirilebilir',
        'Tek kullanımlık; ağız sıvısı toplama pedi kit üzerinde tümleşik veya ayrı ünite',
        'Opsiyonel RFID kimlik etiketi: madde türleri, eşik değerleri, kullanım durumu, lot ve seri numarası; UTC cihazı kiti otomatik tanır',
        'Kullanımı için cihaz zorunluluğu yoktur',
      ],
      'not' => 'Ön tespit amaçlıdır; pozitif sonuçlara yaptırım uygulanmadan önce teyit gerekir.',
    ],
    [
      'id' => 'utc', 'ad' => 'UTC', 'tur' => 'Uyuşturucu tespit cihazı',
      'gorsel' => ['/img/urun/utc.webp', 300, 240],
      'ozellik' => [
        'Tek bir ağız sıvısı örneğiyle aynı anda 9 çeşit uyuşturucu madde tespiti',
        'UTK uyuşturucu tespit kitiyle çalışır; RFID etiketli kitleri otomatik tanıyarak kullanıcı hatalarını önler',
        'İş yerleri, hastaneler, polis kontrol noktaları ve trafik denetimlerinde kullanım',
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
          <?php if (!empty($u['teknik'])): ?>
          <details class="urun-teknik">
            <summary>Teknik özellikler</summary>
            <div class="tablo">
              <table>
                <?php foreach ($u['teknik'] as $k => $v): ?><tr><th scope="row"><?= e($k) ?></th><td><?= e($v) ?></td></tr><?php endforeach; ?>
              </table>
            </div>
          </details>
          <?php endif; ?>
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
      <h3>NAM-DATA ve NAM-DATAPro Veri Transfer Yazılımları</h3>
      <p>NAM-07'deki veriler NAM-DATA, NAM-19'daki veriler NAM-DATAPro yazılımıyla bilgisayara aktarılır. NAM-DATA iki seviyeli yetkilendirme sunar: kullanıcılar verileri bilgisayara aktarabilir, arşivleyebilir, tarayabilir, sonuçları yazdırabilir ve farklı ortamlara kaydedebilir; yetkili kişiler bunlara ek olarak cihaz hafızasını temizleme, program ayarları ve yetkilendirme işlemlerini yapabilir.</p>
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
