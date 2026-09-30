<?php
// KVKK Aydınlatma Metni — kaynak: ege-fe-kvkk-gizlilik-taslak.md (1. bölüm)
$yol = '/kvkk/';
require __DIR__ . '/../inc/header.php';
?>
<div class="kap kap-dar">
  <article class="metin yasal">
    <p class="giris">6698 sayılı Kişisel Verilerin Korunması Kanunu ("KVKK") uyarınca, veri sorumlusu sıfatıyla <strong><?= e($FIRMA['yasal_unvan']) ?></strong> ("Şirket") tarafından kişisel verilerinizin işlenmesine ilişkin olarak sizi bilgilendirmek isteriz.</p>

    <?php require __DIR__ . '/../inc/veri-sorumlusu.php'; ?>

    <h2>a) İşlenen kişisel veriler</h2>
    <p>Web sitemizdeki formlar aracılığıyla, işleme amacına göre aşağıdaki veriler işlenir:</p>
    <ul>
      <li><strong>İletişim/Teklif formu:</strong> ad-soyad, e-posta, telefon, mesaj içeriği.</li>
      <li><strong>Kariyer/İş başvuru formu:</strong> ad-soyad, e-posta, telefon ve özgeçmiş (CV) içinde yer verdiğiniz eğitim, iş deneyimi vb. bilgiler.</li>
      <li><strong>Bülten aboneliği:</strong> e-posta adresi.</li>
      <li><strong>Teknik veriler:</strong> site kullanımına ilişkin sunucu kayıtları (log) (bkz. <a href="/gizlilik-politikasi/">Gizlilik ve Çerez Politikası</a>).</li>
    </ul>

    <h2>b) İşleme amaçları</h2>
    <ul>
      <li>Taleplerinizin ve teklif isteklerinizin karşılanması, sizinle iletişim kurulması,</li>
      <li>İş başvurularının değerlendirilmesi ve işe alım süreçlerinin yürütülmesi,</li>
      <li>Talep etmeniz hâlinde bülten/duyuruların gönderilmesi,</li>
      <li>Web sitesinin güvenliği, iyileştirilmesi ve yasal yükümlülüklerin yerine getirilmesi.</li>
    </ul>

    <h2>c) Hukuki sebep (KVKK m.5)</h2>
    <ul>
      <li>İletişim/teklif ve iş başvurusu: bir sözleşmenin kurulması/ifası ile ilgili olması ve Şirketin meşru menfaati; gerektiğinde <strong>açık rızanız</strong>.</li>
      <li>Özgeçmiş içindeki veriler ve bülten: <strong>açık rızanız</strong>.</li>
      <li>Yasal kayıt/log tutma: hukuki yükümlülük.</li>
    </ul>

    <h2>d) Aktarım</h2>
    <p>Kişisel verileriniz; yalnızca yukarıdaki amaçlarla sınırlı olarak, <strong>web/e-posta barındırma hizmeti sağlayıcımıza</strong> (sunucularımızın bulunduğu hizmet sağlayıcı) ve yasal olarak yetkili kamu kurum/kuruluşlarına, KVKK m.8-9 kapsamında aktarılabilir. Yurt dışına aktarım yapılmamaktadır.</p>
    <p>Sitemizdeki harita, yalnızca "Haritayı göster" düğmesine bastığınızda Google Haritalar hizmetinden yüklenir; bu durumda tarayıcınız doğrudan Google ile bağlantı kurar ve bu bağlantı Google'ın gizlilik koşullarına tabidir.</p>

    <h2>e) Toplama yöntemi</h2>
    <p>Kişisel verileriniz, web sitemizdeki formları doldurmanız ve elektronik ortamda iletişim kurmanız yoluyla otomatik ve kısmen otomatik yöntemlerle toplanır.</p>

    <h2>f) İlgili kişi hakları (KVKK m.11)</h2>
    <p>Kanun'un 11. maddesi uyarınca; kişisel verilerinizin işlenip işlenmediğini öğrenme, işlenmişse buna ilişkin bilgi talep etme, işleme amacını ve amacına uygun kullanılıp kullanılmadığını öğrenme, eksik/yanlış işlenmişse düzeltilmesini, KVKK'da öngörülen şartlarla silinmesini/yok edilmesini, işlemenin yalnızca otomatik sistemlerle analizi sonucu aleyhinize bir sonucun ortaya çıkmasına itiraz etme ve zarara uğramanız hâlinde giderilmesini talep etme haklarına sahipsiniz.</p>

    <h2>g) Başvuru</h2>
    <p>Haklarınıza ilişkin taleplerinizi <a href="mailto:<?= e($FIRMA['eposta']) ?>"><?= e($FIRMA['eposta']) ?></a> adresine veya yukarıdaki posta adresine yazılı olarak iletebilirsiniz. Başvurular en geç 30 gün içinde sonuçlandırılır.</p>
  </article>
</div>
<?php require __DIR__ . '/../inc/footer.php'; ?>
