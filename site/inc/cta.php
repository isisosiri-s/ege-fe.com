<?php
// Sayfa sonu iletişim kartı (2026-10-01, kullanıcı seçimi: B + C).
// B: açık zemin üzerinde teal kart — solda kısa başlık + açıklama + Teklif Al, sağda 3 hızlı iletişim kutusu.
// C: başlık/metin sayfanın bölümüne göre değişir ($yol). Teklif formu ilgili konu seçili açılır.
$ctaYol = $yol ?? '/';
$servisYollari = ['/hizmetler/', '/ariza-ve-onarim/', '/kalibrasyon/', '/bilgi/'];
$danismanlikOnekleri = ['/danismanlik/', '/uts/', '/tibbi-cihaz/', '/saglik-bakanligi-islemleri/', '/diger-hizmetler/', '/ilac/'];
$ctaBolum = 'genel';
if (in_array($ctaYol, $servisYollari, true)) $ctaBolum = 'servis';
elseif ($ctaYol === '/urunler/') $ctaBolum = 'urun';
else foreach ($danismanlikOnekleri as $o) if (str_starts_with($ctaYol, $o)) { $ctaBolum = 'danismanlik'; break; }

$ctaMetin = [
  'servis'      => ['Servis', 'Cihazınızın bakım ya da kalibrasyon zamanı mı geldi?', 'Arıza, periyodik bakım ve kalibrasyon için bize ulaşın; cihazınızın servis sürecini başlatalım.', 'Teknik Destek'],
  'urun'        => ['Ürünler', 'Kurumunuz için alkolmetre mi arıyorsunuz?', 'NAM-19, NAM-E30 ve NAM-E30C alkolmetreler için fiyat teklifi alın.', 'Ürünler'],
  'danismanlik' => ['Danışmanlık', 'Başvurunuz için danışmanlık mı arıyorsunuz?', 'ÜTS, tıbbi cihaz ve Sağlık Bakanlığı işlemlerinizle ilgili ihtiyacınızı bize iletin, size dönüş yapalım.', 'Hizmetler'],
  'genel'       => ['Bize Ulaşın', 'Sorunuz mu var? Size yardımcı olalım.', DANISMANLIK_AKTIF ? 'Ürünler, servis ve danışmanlık hizmetlerimiz hakkında bilgi almak için bize ulaşın.' : 'Ürünlerimiz ve servis hizmetlerimiz hakkında bilgi almak için bize ulaşın.', ''],
][$ctaBolum];
[$ctaEtiket, $ctaBaslik, $ctaAciklama, $ctaKonu] = $ctaMetin;
$ctaForm = '/iletisim/' . ($ctaKonu !== '' ? '?konu=' . rawurlencode($ctaKonu) : '') . '#form';
?>
<section class="cta-bolum" aria-labelledby="cta-baslik">
  <div class="kap">
    <div class="cta-kart">
      <div class="cta-metin">
        <p class="etiket"><?= e($ctaEtiket) ?></p>
        <h2 id="cta-baslik"><?= e($ctaBaslik) ?></h2>
        <p class="cta-aciklama"><?= e($ctaAciklama) ?></p>
        <a class="dugme dugme-birincil" href="<?= e($ctaForm) ?>">Teklif Al</a>
        <p class="cta-guven"><strong>200+</strong> anlaşmalı kurumla çalışıyoruz.</p>
      </div>
      <ul class="cta-kanallar">
        <li><a class="cta-kanal" href="tel:<?= e($FIRMA['telefon_uri']) ?>">
          <span class="cta-kanal-ikon"><?= ikon('phone', 22) ?></span>
          <span class="cta-kanal-metin"><span class="cta-kanal-ad">Telefon</span><span class="cta-kanal-deger"><?= e($FIRMA['telefon']) ?></span></span>
        </a></li>
        <li><a class="cta-kanal" href="mailto:<?= e($FIRMA['eposta']) ?>">
          <span class="cta-kanal-ikon"><?= ikon('mail', 22) ?></span>
          <span class="cta-kanal-metin"><span class="cta-kanal-ad">E-posta</span><span class="cta-kanal-deger"><?= e($FIRMA['eposta']) ?></span></span>
        </a></li>
        <li><a class="cta-kanal" href="<?= e($ctaForm) ?>">
          <span class="cta-kanal-ikon"><?= ikon('file-text', 22) ?></span>
          <span class="cta-kanal-metin"><span class="cta-kanal-ad">Teklif formu</span><span class="cta-kanal-deger">Formu doldurun, size dönelim</span></span>
        </a></li>
      </ul>
    </div>
  </div>
</section>
