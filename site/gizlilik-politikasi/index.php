<?php
// Gizlilik ve Çerez Politikası — kaynak: ege-fe-kvkk-gizlilik-taslak.md (2. bölüm). Sitede analytics yok.
$yol = '/gizlilik-politikasi/';
require __DIR__ . '/../inc/header.php';
?>
<div class="kap kap-dar">
  <article class="metin yasal">
    <p class="giris"><strong><?= e($FIRMA['yasal_unvan']) ?></strong> olarak ege-fe.com ziyaretçilerinin gizliliğine önem veriyoruz. Bu politika, sitemizde hangi verilerin toplandığını ve nasıl kullanıldığını açıklar.</p>

    <?php require __DIR__ . '/../inc/veri-sorumlusu.php'; ?>

    <h2>a) Topladığımız veriler</h2>
    <ul>
      <li><strong>Sizin ilettikleriniz:</strong> iletişim/teklif ve kariyer formları ile gönderdiğiniz ad-soyad, e-posta, telefon, mesaj ve CV bilgileri; bülten formu ile ilettiğiniz e-posta adresi.</li>
      <li><strong>Otomatik toplanan teknik veriler:</strong> IP adresi, tarayıcı/cihaz bilgisi ve ziyaret edilen sayfalar gibi, sunucu kayıtlarında (log) tutulan veriler.</li>
    </ul>

    <h2>b) Kullanım amacı</h2>
    <p>Talep ve başvurularınızı yanıtlamak, hizmet sunmak, siteyi güvenli tutmak ve geliştirmek, yasal yükümlülükleri yerine getirmek.</p>

    <h2>c) Çerezler (Cookies)</h2>
    <p>Sitemiz kendi çerezini kullanmamaktadır. Sitede analitik, reklam veya takip amaçlı çerez ya da benzeri bir ölçüm kodu bulunmamaktadır.</p>
    <p>Sayfalarımızdaki harita, siz "Haritayı göster" düğmesine basmadıkça yüklenmez. Haritayı açtığınızda içerik Google Haritalar hizmetinden yüklenir ve Google kendi çerezlerini kullanabilir; bu çerezler Google'ın gizlilik koşullarına tabidir.</p>
    <p>Tarayıcı ayarlarınızdan çerezleri reddedebilir veya silebilirsiniz.</p>

    <h2>d) Saklama süresi</h2>
    <p>Kişisel verileriniz, işleme amacının gerektirdiği süre ve ilgili yasal saklama süreleri boyunca saklanır; süre sonunda silinir, yok edilir veya anonim hâle getirilir.</p>

    <h2>e) Üçüncü taraflar</h2>
    <p>Verileriniz, hizmet aldığımız barındırma sağlayıcısı ve yasal olarak yetkili kurumlar dışında üçüncü taraflarla paylaşılmaz, satılmaz. Sitede üçüncü taraf bağlantıları bulunabilir; bu sitelerin gizlilik uygulamalarından Şirketimiz sorumlu değildir.</p>

    <h2>f) Güvenlik</h2>
    <p>Verilerinizin güvenliği için makul teknik ve idari tedbirler (SSL şifreleme, erişim kısıtlamaları, spam koruması vb.) uygulanır.</p>

    <h2>g) Haklarınız ve iletişim</h2>
    <p>KVKK m.11 kapsamındaki haklarınız için <a href="mailto:<?= e($FIRMA['eposta']) ?>"><?= e($FIRMA['eposta']) ?></a> adresinden bize ulaşabilirsiniz. Ayrıntı için <a href="/kvkk/">KVKK Aydınlatma Metni</a>'ne bakınız.</p>
  </article>
</div>
<?php require __DIR__ . '/../inc/footer.php'; ?>
