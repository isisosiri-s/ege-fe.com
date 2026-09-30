<?php
// Anasayfa — canlı sitenin bölüm sırası korunur: slider (3 mesaj) → İnovatif Sağlık → 1. Sınıf Hizmet → Bize Ulaşın
$yol = '/';
$sayfa = ['ozelBaslik' => true, 'govdeSinif' => 'anasayfa'];
require __DIR__ . '/inc/header.php';
?>
<section class="acilis">
  <div class="kap acilis-ic">
    <div class="acilis-metin">
      <p class="etiket">Egefe Bilişim Sağlık</p>
      <h1>Kısa sürede <em>Kesin</em> sonuçlar</h1>
      <p class="giris">Egefe, siz değerli müşterilerimiz için 2017 yılından beri her an her yerde en kısa sürede kesin sonuçlar alabilmenizi sağlayabilmek, Sağlığınız ve huzurunuz için adli ve yerinde test üretim çözümlerimiz ile hizmetinizdeyiz...</p>
      <div class="dugme-grubu">
        <a class="dugme dugme-birincil" href="/hizmetler/">Hizmetlerimiz</a>
        <a class="dugme dugme-cizgi" href="/iletisim/#form">Teklif Al</a>
      </div>
    </div>
    <figure class="acilis-gorsel">
      <img src="/wp-content/uploads/2022/01/hakkimizda.jpg" alt="Egefe — sağlık teknolojileri" width="1920" height="1080" fetchpriority="high">
    </figure>
  </div>
  <div class="kap">
    <ul class="acilis-seritler">
      <li>
        <h2>9 Uyuşturucu Madde Tespiti</h2>
        <p>Kısa Sürede Kesin Sonuçlar</p>
      </li>
      <li>
        <h2>Sorunsuz Teknik Destek</h2>
        <p>Egefe 10 yılı aşkın süredir; Uyuşturucu tespit cihazı, tespit kiti ve alkolmetrelerin hem satışını hem de yetkili servis hizmetini sizlere sunuyor...</p>
        <a class="ok-link" href="/hizmetler/">Hizmetlerimiz</a>
      </li>
    </ul>
  </div>
</section>

<section class="bolum">
  <div class="kap">
    <div class="bolum-ust">
      <p class="etiket">AR-GE · Hizmet · Danışmanlık</p>
      <h2 class="bolum-baslik">İnovatif <em>Sağlık</em></h2>
      <p class="bolum-aciklama">Daha iyi bir gelecek için sürekli geliştiriyoruz... AR-GE ofisimiz ve birimimizin yanında tecrübeli akademik danışmanlarımız ile birlikte en iyisi için sürekli mücadele ediyoruz...</p>
    </div>
    <div class="kartlar kartlar-3">
      <a class="kart" href="/hizmetler/">
        <h3>Bakım, Onarım, Kalibrasyon</h3>
        <p>Cihazlarınızın bakım, onarım ve kalibrasyon hizmetlerinin yanında doğrudan cihaz temin edebileceğiniz yetkili kuruluştur.</p>
        <span class="ok-link">Devamını oku</span>
      </a>
      <div class="kart">
        <h3>AR-GE Çözümleri</h3>
        <p>Teknopark bünyesinde açmış olduğumuz AR-GE ofisimiz ile yeni teknolojiler ve yeni hizmetleri sizlere sunmanın gayretindeyiz.</p>
      </div>
      <a class="kart" href="/danismanlik/">
        <h3>Sektörel Danışmanlık</h3>
        <p>10 yılı aşkın süredir sektörde bulunan Egefe, tecrübe ve bilgi birikimlerini sizlere aktarıyor. Sağlık sektöründeki öncü danışmanınız…</p>
        <span class="ok-link">Devamını oku</span>
      </a>
    </div>
  </div>
</section>

<section class="bolum bolum-koyu">
  <div class="kap kalite-izgara">
    <div>
      <p class="etiket">Kalite</p>
      <h2 class="bolum-baslik">1. Sınıf <em>Hizmet</em></h2>
      <p class="bolum-aciklama">Sunduğumuz ürünlerin yanında, verdiğimiz tüm hizmetlerimizde öncelikli noktamız "Kalite". Başladığımız günden bu zamana kadar yüzde 99 müşteri memnuniyeti ve hizmet kalitemiz ile sizinle tanışmaktan onur duyarız...</p>
    </div>
    <ul class="sayaclar sayaclar-buyuk" aria-label="Egefe rakamlarla">
      <li><strong>%99</strong><span>Müşteri Memnuniyeti</span></li>
      <li><strong>%99</strong><span>Doğruluk</span></li>
      <li><strong>10+</strong><span>Sektörel Tecrübe</span></li>
      <li><strong>200+</strong><span>Anlaşmalı Kurum</span></li>
    </ul>
  </div>
</section>

<?php require __DIR__ . '/inc/bize-ulasin.php'; ?>
<?php require __DIR__ . '/inc/footer.php'; ?>
