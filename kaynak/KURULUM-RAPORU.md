# ege-fe.com — Kurulum Raporu (2026-09-30)

Önizleme: `npm run dev` → http://localhost:8080  (php -S + tools/dev-router.php)
Yüklenecek klasör: `site/` içeriği → cPanel `public_html/`

## 1. Onayınıza sunulan meta description'lar (39 sayfa — eski değerler İngilizce lorem idi)
Kaynak sütunu: "sayfa metninden" = sayfanın kendi cümlelerinden kısaltıldı; "YENİ METİN" = mevcut metin yoktu, yazıldı.
Düzenlemek için: `tools/hub-giris.json` (hub'lar) veya `tools/description-duzelt.json` (tekil) → `npm run build`.

| # | Sayfa | Yeni description | Kaynak |
|---|---|---|---|
| 1 | `/iletisim/` | Egefe iletişim bilgileri: Çankaya/Ankara merkez ofis adresi, telefon, e-posta ve iletişim formu. Formumuz ile bize 7/24 ulaşabilirsiniz. | YENİ METİN — sayfadaki iletişim bilgilerinden derlendi |
| 2 | `/hizmetler/` | Uyuşturucu tespit cihazı, tespit kiti ve alkolmetreler için yetkili servis: arıza ve onarım, periyodik bakım ve kalibrasyon hizmetleri. | mevcut metin (anasayfa 'Sorunsuz Teknik Destek' ve 'Bakım, Onarım, Kalibrasyon' kartı) |
| 3 | `/danismanlik/` | ÜTS, tıbbi cihaz, Sağlık Bakanlığı işlemleri, permi, CE teknik dosya, takviye edici gıda ve kontrol belgesi süreçlerinde sektörel danışmanlık. | mevcut metin (anasayfa 'Sektörel Danışmanlık' kartı) |
| 4 | `/ilac/` | İlaç danışmanlığı: ilaç ruhsatlandırma, varyasyon ve fiyatlandırma başvuruları, KÜB/KT, okunabilirlik testi ve GMP başvurusu süreçleri. | YENİ METİN — onayınıza sunulacak |
| 5 | `/diger/` | Diğer danışmanlık hizmetleri: permi belgesi, CE teknik dosya hazırlanması, takviye edici gıda ve kontrol belgesi başvuruları. | YENİ METİN — onayınıza sunulacak |
| 6 | `/uts/` | ÜTS (Ürün Takip Sistemi) danışmanlığı: kozmetik firma kaydı, sorumlu teknik eleman, kozmetik ürün bildirimi, ÜTS bilgi güncelleme ve tıbbi cihaz ÜTS geçişi. | mevcut metin (ÜTS sayfasının kendi tanım paragrafları) |
| 7 | `/tibbi-cihaz/` | Tıbbi cihaz danışmanlığı: UBB/TİTUBB firma kaydı, firma bilgileri güncelleme, UBB e-imza, tıbbi cihaz belge kaydı ve etiket düzenleme işlemleri. | YENİ METİN — onayınıza sunulacak |
| 8 | `/saglik-bakanligi-islemleri/` | Sağlık Bakanlığı işlemleri: ilaç ruhsatlandırma, varyasyon, fiyatlandırma, biyosidal ruhsatlandırma, GMP başvurusu, KÜB/KT ve okunabilirlik testi. | YENİ METİN — onayınıza sunulacak |
| 9 | `/diger-hizmetler/` | Permi belgesi, CE teknik dosya hazırlanması, takviye edici gıda ve kontrol belgesi başvurularında danışmanlık hizmeti. | YENİ METİN — onayınıza sunulacak |
| 10 | `/blog/` | Madde bağımlılığı, uyuşturucu testleri, alkolmetre ve promil hakkında Egefe blog yazıları. | YENİ METİN — onayınıza sunulacak |
| 11 | `/hakkimizda/` | Yenilikçi vizyonu ile teknolojinin trendlerini sağlık sektöründe öne çıkaran Egefe, 2017 yılında kurulmuştur; yurt içinde ve yurt dışında hizmet vermektedir. | sayfa metninden |
| 12 | `/hizmet-politikamiz/` | Erişilebilirlik: Şirketimiz tarafından sunulan çeşitli iletişim kanallarıyla müşterilerimiz şikayetlerini, bilgi taleplerini, öneri ya da memnuniyetlerini… | sayfa metninden |
| 13 | `/kalite-politikamiz/` | Sadece kaliteli, akredite kuruluşlar tarafından onaylı, yasal koşulları tam olarak sağlayan, Egefe kalite prosedürlerine uygun, sağlıklı ve güvenli… | sayfa metninden |
| 14 | `/kariyer/` | Egefe insan kaynakları politikası, adil, şeffaf ve söz hakkı tanıyan, çalışanların potansiyellerini ortaya koyma fırsatları bulduğu, her bir çalışanın… | sayfa metninden |
| 15 | `/bilgi/` | Kalibrasyon süresi ve ücreti, periyodik bakım, teknik servisteki cihazın durumu, yedek parça temini ve yeni alınan cihaz hakkında sık sorulan sorular. | sayfadaki soru başlıklarından derlendi |
| 16 | `/ariza-ve-onarim/` | UTS, NAM-07 ve NAM-17 cihazların ve yedek parçalarının arızi bakımlarını üstleniyoruz. Ürününüzün garantisi devam ederken; ürününüzde herhangi bir arıza… | sayfa metninden |
| 17 | `/periyodik-bakim/` | Satışını ve bakımlarını yaptığımız Alkolmetrelerin belirlenmiş periyotlar dahilinde bakımları yapılmaktadır. | sayfa metninden |
| 18 | `/kalibrasyon/` | Kalibrasyon işleminde, ölçmede kullanılan test-ölçü aleti veya cihazlarının sapmaları belirlenir, hataları düzeltilir. | sayfa metninden |
| 19 | `/uts/kozmetik-firma-kaydi/` | 5324 sayılı Kozmetik Kanunu gereğince kozmetik ürünlerin piyasaya arz edilmeden önce Bakanlığa bildiriminin yapılması zorunludur. | sayfa metninden |
| 20 | `/uts/sorumlu-teknik-eleman/` | Eczacı veya kozmetik alanında iki yıl fiilen çalışmış olduğunu belgelemek kaydıyla kimyager, biyokimyager, kimya mühendisi, biyolog veya mikrobiyolog… | sayfa metninden |
| 21 | `/uts/kozmetik-urun-bildirimi/` | Bir kozmetik ürün üretip satışa sunacaksanız ya da bir kozmetik ürün ithal edip Türkiye pazarına arz edecekseniz, öncesinde kozmetik kapsamında… | sayfa metninden |
| 22 | `/uts/uts-bilgi-guncelleme/` | Özellikle CE sertifikaları (EC certificate) tahditli validasyona sahiptir. Yani belli bir süre sonra geçerliğini yitirir ve yenilenmesi gerekir… | sayfa metninden |
| 23 | `/uts/tibbi-cihaz-uts-gecisi/` | Türkiye İlaç ve Tıbbi Cihaz Kurumu tarafından yayımlanan duyuru gereğince, 01.10.2018 tarihi itibariyle de sınıf III ürün gruplarında tekil ürün… | sayfa metninden |
| 24 | `/tibbi-cihaz/firma-kaydi/` | Türkiye Cumhuriyeti sınırları içinde, ilaç ve/veya tıbbi cihaz üretimi, ithalatı, ihracatı yapan veya bir yabancı firmanın Türkiye yetkili temsilcisi… | sayfa metninden |
| 25 | `/tibbi-cihaz/firma-bilgileri-guncelleme/` | TİTUBB firma kayıt işlemlerinde verilen taahhütname gereği, TİTUBB’daki bilgi-belge değişiklikleri firma veya kurumlar tarafından gecikmeksizin sisteme… | sayfa metninden |
| 26 | `/tibbi-cihaz/ubb-e-imza/` | Nitelikli Elektronik Sertifika’ya(NES) dayanılarak oluşturulan elektronik imza (e-İmza) güvenli elektronik imzadır. | sayfa metninden |
| 27 | `/tibbi-cihaz/tibbi-cihaz-belge-kaydi/` | Firmaların sisteme kaydının onaylanması için gerekli evraklar: CE Sertifikası, Uygunluk Beyanı, Kullanım Kılavuzu, Etiket Örneği, Ürün Kataloğu, Yetki Belgesi. | sayfa metninden |
| 28 | `/tibbi-cihaz/etiket-duzenleme/` | Tıbbi Cihaz Yönetmeliğinin (93/42/EEC), Vücuda Yerleştirilebilir Aktif Tıbbi Cihazlar Yönetmeliğinin (90/385/EEC) ve Vücut Dışında Kullanılan Tıbbi Tanı… | sayfa metninden |
| 29 | `/saglik-bakanligi-islemleri/ilac-ruhsatlandirma/` | 02.11.2011 tarihli ve 28103 sayılı Resmi Gazetede yayımlanan “Sağlık Bakanlığı ve Bağlı Kuruluşlarının Teşkilat ve Görevleri Hakkında Kanun Hükmünde… | sayfa metninden |
| 30 | `/saglik-bakanligi-islemleri/ilac-varyasyon/` | Güncel varyasyon kılavuzu doğrultusunda varyasyon kapsamının (Tip IA, Tip IB, Tip II) belirlenmesi ve varyasyon dosyasının hazırlanması | sayfa metninden |
| 31 | `/saglik-bakanligi-islemleri/ilac-fiyatlandirma/` | Avrupa Birliği (AB) üyeleri arasından en az 5, en fazla 10 ülke referans ülke olarak Sağlık Bakanlığınca belirlenir ve bir tebliğle duyurulur. | sayfa metninden |
| 32 | `/saglik-bakanligi-islemleri/biyosidal-ruhsatlandirma/` | Kimyasal veya biyolojik açıdan herhangi bir zararlı organizma üzerinde kontrol edici etki gösteren veya hareketini kısıtlayan, zararsız kılan, yok eden… | sayfa metninden |
| 33 | `/saglik-bakanligi-islemleri/gmp-basvurusu/` | Bilindiği üzere 01.03.2010 tarihinden itibaren yapılan CTD ruhsat başvurularında ön inceleme sırasında Bakanlığımızca denetlenerek verilmiş olan GMP… | sayfa metninden |
| 34 | `/saglik-bakanligi-islemleri/kub-kt/` | Farmakolojik Değerlendirme Birimi’ne yapılacak tüm başvurularla ( ruhsatlı ürünler için ilk başvuru veya cevap) ilgili olarak; 03.04.2017 tarihinden… | sayfa metninden |
| 35 | `/saglik-bakanligi-islemleri/okunabilirlik-testi/` | Bilindiği üzere; 25.04.2017 tarih ve 30048 sayılı Resmi Gazetede yayımlanarak yürürlüğe giren Beşeri Tıbbi Ürünlerin Ambalaj Bilgileri, Kullanma Talimatı… | sayfa metninden |
| 36 | `/diger-hizmetler/permi-belgesi/` | 2018/4 sayılı Sağlık Bakanlığının Özel İznine Tabi Maddelerin İthalat Denetimi Tebliği kapsamında yer alan; Uyuşturucu ve Psikotrop madde yapımında… | sayfa metninden |
| 37 | `/diger-hizmetler/ce-teknik-dosya-hazirlanmasi/` | CE belgesi almak için başvuruda bulunan firmalar CE teknik dosyası hazırlamak zorundadır. Süreç içerisinde danışmanlık hizmetinin alındığı firma , bu… | sayfa metninden |
| 38 | `/diger-hizmetler/takviye-edici-gida/` | Takviye edici gıda normal beslenmeyi takviye etmek amacıyla; vitamin, mineral, protein, karbonhidrat, lif, yağ asidi, amino asit gibi besin ögelerinin… | sayfa metninden |
| 39 | `/diger-hizmetler/kontrol-belgesi/` | İlgili tebliğde bulunan listelerde yer alan maddelerin, karşılarında belirtilen amaçlarla kullanılmak üzere ithal edilmeleri halinde, insan sağlığı ve… | sayfa metninden |

## 2. Onayınıza sunulan YENİ görünür metinler (hub girişleri)
| Sayfa | Metin |
|---|---|
| /tibbi-cihaz/ | Tıbbi cihaz üreticisi, ithalatçısı ve yetkili temsilcisi firmaların firma kaydı, firma bilgileri güncelleme, UBB e-imza, tıbbi cihaz belge kaydı ve etiket düzenleme işlemlerinde danışmanlık hizmeti veriyoruz. |
| /saglik-bakanligi-islemleri/ | İlaç ruhsatlandırma, ilaç varyasyon, ilaç fiyatlandırma, biyosidal ruhsatlandırma, GMP başvurusu, KÜB/KT ve okunabilirlik testi başvurularınızın hazırlanması ve takibinde danışmanlık hizmeti veriyoruz. |
| /diger-hizmetler/ ve /diger/ | Permi belgesi, CE teknik dosya hazırlanması, takviye edici gıda ve kontrol belgesi başvurularınızın hazırlanması ve takibinde danışmanlık hizmeti veriyoruz. |
| /ilac/ | İlaç ruhsatlandırma, ilaç varyasyon, ilaç fiyatlandırma, KÜB/KT, okunabilirlik testi ve GMP başvurusu süreçlerinde danışmanlık hizmeti veriyoruz. |
| /hizmetler/ "Bilgi" kartı | Kalibrasyon, periyodik bakım, teknik servis ve yedek parça hakkında sık sorulan sorular. |

Mevcut metinden alınan girişler: /uts/ (ÜTS tanım paragrafları), /hizmetler/ ve /danismanlik/ (anasayfa kart metinleri).
Hub kartlarındaki özetler, ilgili alt sayfanın ilk paragrafından kısaltılmıştır.

## 3. Yapılan değişiklikler
**İçerik**
- /danismanlik/, /ilac/, /diger/ tema demo içeriği (Financial/HR Consultancy, "Purchase now" fiyat tabloları vb.) kaldırıldı → giriş + alt hizmet kartları.
- 4 hub'daki kopya ÜTS metni kaldırıldı → giriş + kartlar.
- Tüm gövdelerdeki İngilizce lorem giriş cümleleri kaldırıldı.
- Her sayfada tek H1 (sayfa adı). Anasayfa H1: "Kısa sürede Kesin sonuçlar" (canlıdaki ilk slayt başlığı). Fazla H1'ler H2'ye düşürüldü.
- Kuruluş yılı 2017 ile tutarlı: Hakkımızda "2015 yılında kurulmuştur" → "2017", anasayfa "2015 yılından beri" → "2017".
- 5 "Kategorisiz" yazı Sağlık kategorisine alındı; /category/kategorisiz/ → /category/saglik/ 301.
- Title'lar canlıdakiyle birebir (64/64 doğrulandı); canonical'lar birebir.
- Yasal ünvan footer, iletişim sayfası ve JSON-LD'de: Egefe Bilişim Sağlık San. ve Tic. A.Ş.
- Yeni adres (Yıldızevler) üst şerit, footer, iletişim, JSON-LD'de; eski Harbiye adresi tüm sayfalardan kaldırıldı.
- Blog yorumları, yazar "admin" linkleri, İngilizce kenar çubuğu etiketleri kaldırıldı.

**Temizlik**
- provega: favicon, 4 "Detaylar" linki, 23 yazar linki kaldırıldı; provega görselleri kullanılmadı.
- /urun/… (3 link) ve /magaza/ (3 link) linkleri silindi (yazı metni korunarak); footer'daki Hesabım/Siparişlerim/Sipariş Takip/Online Mağaza kaldırıldı.
- Sahte Facebook/Twitter linkleri kaldırıldı; yalnız LinkedIn.
- Çalışmayan "Teknik Servis Takip" linkleri (ege-fedestek.com: SSL hatası; destek.ege-fe.com: DNS yok) kaldırıldı.
- Tema demo görselleri (2017/04 blog-post-*, 2020/04-05 stok/dekor) ve eski logo görseli (egefeback.jpg) kullanılmadı.

**Teknik**
- Saf PHP + özel CSS; inc/header.php + inc/footer.php include; /klasor/index.php; URL'ler birebir.
- Görseller `/wp-content/uploads/…` yolunda korundu (Google Görseller için); -640x427 gibi boyutlu varyantlar .htaccess ile orijinale 301.
- .htaccess: https + www'suz, index.php gizleme, sonda /, 404, /blog/page/N ve /category/saglik/page/N → /blog/ 301, inc/ erişimi kapalı, önbellek/sıkıştırma.
- sitemap.xml (64 URL; KVKK/Gizlilik noindex ve hariç), robots.txt.
- JSON-LD: Organization (yasal ünvan, adres, 2017, LinkedIn), WebSite, WebPage/ContactPage/AboutPage/CollectionPage, BreadcrumbList, BlogPosting.
- Favicon seti logo.png'deki dalga-yelken sembolünden (ico + png + apple-touch + manifest).
- Search Console etiketi header'da yorum satırında (`config.php` → GSC_AKTIF=true ile açılır). Analytics kodu canlıda yoktu.
- Formlar: iletişim (anasayfa/hakkımızda/iletişim), kariyer (CV: PDF/DOC/DOCX, ≤5 MB, uzantı + dosya imzası + MIME kontrolü), bülten (hizmetler/danışmanlık/ilaç/diğer). Honeypot + imzalı zaman damgası, KVKK onay kutusu zorunlu. Alıcı: info@ege-fe.com. SMTP bilgileri `inc/config.php` → `$FORM['smtp']` (boşsa PHP mail()).
- Harita: adres sorgulu Google Maps embed (koordinat verilmedi; JSON-LD'de geo yok).

## 4. Açık konular (sizin kararınız / bilginiz gerekiyor)
1. **AR-GE ofis adresi:** Anasayfada "Kırıkkale Teknopark No: 18 Yahşihan/Kırıkkale", Hakkımızda'da "No:17 Kırıkkale". Şimdilik No:18 kullanıldı (`config.php`).
2. **Posta kodu:** Google yeni adres için 06550 gösteriyor; teyit ederseniz JSON-LD'ye eklenir.
3. **/bilgi/ boş değerleri:** NAM-07/NAM-19 kalibrasyon süresi ve ücret alanları canlıdaki gibi boş bırakıldı.
4. **Yazım hataları (dokunulmadı):** "9 Uyuşturu Madde Tespiti", "bilgi birimkimlerini", "temin edebeceğiniz". Onaylarsanız düzeltirim.
5. **Tecrübe ifadeleri:** "10 yılı aşkın", "sektörde 20 yıllık tecrübe" (2017 kuruluşla birlikte okununca) korunuyor — onaylıyor musunuz?
6. **Sağlık Bakanlığı amblemi** (`Basliksiz-1.jpg`) SB/diğer hizmet sayfalarında banner olarak duruyor (canlıdaki gibi); kurum logosunun kullanım izni konusunu değerlendirmenizi öneririm. ÜTS logosu (`uts-1.jpg`) için de aynı.
7. **/diger/ ↔ /diger-hizmetler/** aynı içeriği listeliyor; /diger/ menüde yok. İsterseniz /diger/ → /diger-hizmetler/ 301 yapılabilir.
8. **Blog description'ları** çoğu yalnız başlığı tekrarlıyor ("ALKOL BAĞIMLILIĞI" vb.) — lorem olmadığı için birebir taşındı.
9. **Çalışma saatleri** (eski JSON-LD: her gün 09–18) yeni JSON-LD'ye alınmadı; doğru saatleri verirseniz eklenir.
10. **KVKK ve Gizlilik metinleri:** /kvkk/ ve /gizlilik-politikasi/ sayfaları "hazırlanmaktadır" notuyla kuruldu (noindex).
11. **Stok görsel lisansları** (blog: AdobeStock, Getty, Facebook kaynaklı dosyalar) — değişmedi.
12. **Yayın öncesi:** SSL aktif olmadan yayına almayın (.htaccess https'e yönlendirir ve HSTS başlığı gönderir). Sunucu PHP ≥ 8.0 olmalı.

---
## Revizyon 1 (2026-09-30)
- Merkez adres: "Yıldızevler Mah. Turan Güneş Blv. 708 Sok. No:14/1, 06550 Çankaya/Ankara" (tüm sayfalar, harita, footer, JSON-LD postalCode 06550).
- AR-GE: "Kırıkkale Teknopark No: 3 Yahşihan/Kırıkkale" (No:17/No:18 kaldırıldı).
- Künye (footer + iletişim + KVKK/Gizlilik + JSON-LD): Ulus V.D. / VKN 5590520620, Mersis 0559052062000001, Faks 0 312 480 54 53. JSON-LD: legalName, taxID, faxNumber, identifier (MERSIS/VKN), AR-GE department.
- /kvkk/ ve /gizlilik-politikasi/ taslaktan dolduruldu, yayına açıldı (index + sitemap). Yer tutucu yok; KEP ve özel saklama süresi çıkarıldı; çerez bölümü: sitenin kendi çerezi yok, analitik yok, harita yalnız tıklanınca.
- Onay kutuları: iletişim (zorunlu onay), kariyer (açık rıza), bülten (açık rıza) — taslak metinleri.
- Fontlar self-host (/fonts, latin + latin-ext, 172 KB); Google Haritalar tıklayınca yüklenir → sayfa açılışında hiçbir dış istek yok.
- /bilgi/: "Kalibrasyon süresi ne kadardır?" ve "Kalibrasyon ücreti ne kadardır?" SSS maddeleri tümüyle kaldırıldı; /bilgi/ description'ı ve /hizmetler/ Bilgi kartı buna göre güncellendi.
- /diger/ → /diger-hizmetler/ 301 (sayfa kaldırıldı, sitemap'ten çıktı).
- Yazım düzeltmeleri: Uyuşturu→Uyuşturucu; birimkimlerini→birikimlerini; edebeceğiniz→edebileceğiniz; orjinal/Orjinallik→orijinal/Orijinallik; alkometre→alkolmetre; "bir çok örnek"→"birçok örnek"; "yada"→"ya da"; "Firma kayıdı"→"Firma kaydı"; "bilgi içeriği içeriği"→"bilgi içeriği"; noktalama boşlukları ("firma , bu", "firmaların,Türkiye", "kopyası,konsolosluk", "kaynaklanmaktadır.İlaçla", "İlaç,CTD", "türedi:methyl").

### Açık sorular (Revizyon 1)
1. /bilgi/ "NAM-07 ve NAM-19 cihazları arasındaki farklar nelerdir?" cevabı şablon: "Fark-1. Fark-2. Fark-3. Fark-4." — kaldırılsın mı, gerçek farkları verecek misiniz?
2. /bilgi/ "Ölçüm modları nelerdir?" sorusu iki kez var (aynı cevap) — biri silinsin mi?
3. /bilgi/ e-ticaret ifadeleri: "Lütfen online mağazamıza giriş yaparak görüntüleyebilir ve sipariş verebilirsiniz." ve "Web sitemizden online olarak sipariş verebilirsiniz." — vitrin sitesiyle çelişiyor; nasıl değişsin?
4. /bilgi/ "destek.ege-fe.com adresine kayıtları yapılarak…" — bu adres şu an çalışmıyor (DNS yok).
5. /ariza-ve-onarim/ "UTS, NAM-07 ve NAM-17 cihazların…" — diğer sayfalarda NAM-19 geçiyor; NAM-17 doğru mu?

## Revizyon 2 (2026-09-30)
- /bilgi/: tekrar eden "Ölçüm modları nelerdir?" maddesinin ikincisi kaldırıldı.
- /bilgi/: e-ticaret cümleleri teklif yönlendirmesine çevrildi ("Teklif almak için bizimle iletişime geçebilirsiniz." → /iletisim/#form) — yedek parça ve "UTK ürününü tek alma şansımız var mı?" cevapları.
- /bilgi/: destek.ege-fe.com cümlesi → cihaz durumu için seri numarası ve kurum bilgileriyle servis@ege-fe.com adresine e-posta.
- NAM-17 → NAM-19 (/ariza-ve-onarim/ metni ve description'ı).
- Açık: /bilgi/ "Fark-1…Fark-4" şablon cevabı (1. madde yanıtsız kaldı).
- /bilgi/: "NAM-07 ve NAM-19 cihazları arasındaki farklar nelerdir?" (Fark-1…4 şablonu) kaldırıldı.

## Revizyon 3 (2026-09-30) — Navbar, footer, ikonlar

### Navbar (`inc/header.php`)
- Üst şerit (adres · telefon · e-posta) kaldırıldı; bilgiler footer'da ve /iletisim/'de var.
- "Anasayfa" menü öğesi kaldırıldı; logo anasayfaya gider (breadcrumb'daki "Anasayfa" duruyor).
- Mega menü (Danışmanlık) ve Hizmetler > Bilgi korunuyor — ikisinin de tasarımı sonra yenilenecek.

### Footer (`inc/footer.php`)
- Künye şeridi (unvan, V.D./VKN, Mersis, tel, faks, e-posta) kaldırıldı. V.D./VKN/faks /iletisim/ yasal kutusunda ve KVKK/Gizlilik "Veri sorumlusu" kutusunda duruyor.
- Unvan yalnızca © satırında, yalnız içinde bulunulan yıl: "© 2026 Egefe Bilişim Sağlık San. ve Tic. A.Ş. Tüm hakları saklıdır."
- Mersis No © satırının yanında küçük yazıyla bırakıldı (TTK md. 39 gereği sitede bulunmalı).
- Slogan korunuyor. Logonun altındaki unvan satırı kaldırıldı.
- AR-GE adresi footer'dan kaldırıldı; /iletisim/ "Bize Ulaşın" listesinde zaten var.
- Logo: beyaz kutu kaldırıldı; marka rehberindeki "Koyu Zemin" varyantı kullanılıyor → `site/img/logo-koyu.png` (rehberden birebir çıkarıldı, 1568×756, saydam).
- LinkedIn yazısı yerine ikon (Tabler `brand-linkedin`), logonun altında.
- **Bülten tamamen kaldırıldı** (kullanıcı kararı): footer formu, eski hub blokları, `inc/form-bulten.php`, CSS, `form.php` onay/mesaj metinleri ve `form/gonder.php`'deki `bulten` türü (artık 400 döner).
- Kurumsal sütunu (6 link) ve Hizmetler sütunu değişmedi.

### İkonlar — kural
- **Sitedeki tüm ikonlar yalnızca Tabler Icons'tan alınır: https://tabler.io/icons** (MIT lisans; şu an v3.48.0, outline set).
- Dosyalar `site/img/ikon/<ad>.svg` olarak kendi sunucumuzda durur (CDN'e canlıda istek yok → "yurt dışına aktarım yok" ilkesi korunur). Yeni ikon: `https://cdn.jsdelivr.net/npm/@tabler/icons@<sürüm>/icons/outline/<ad>.svg` indirilip bu klasöre konur.
- Kullanım: PHP'de satır içi `<?= ikon('ad', boyut, 'sinif') ?>` (`inc/config.php`); CSS'te `--ikon-<ad>` değişkeni + `mask` (renk `currentColor`/`background` ile verilir).
- Emoji, metin karakteri (→, +, /) veya başka ikon kütüphanesi ikon olarak kullanılmaz. Dekoratif çizgiler (etiket çizgisi, CTA dalga motifi) ikon sayılmaz.

| Yer | Önce | Tabler ikonu |
|---|---|---|
| Footer LinkedIn | "LinkedIn" yazısı → Simple Icons SVG | `brand-linkedin` |
| Menü açılır ok | CSS kenarlık oku | `chevron-down` (açıkken 180° döner) |
| Mobil menü düğmesi | CSS çizgileri | `menu-2` / `x` |
| Breadcrumb ayıracı | "/" | `chevron-right` |
| "Detaylar" linkleri | " →" | `arrow-right` |
| SSS aç/kapa | "+" / "–" | `plus` / `minus` |

### Harita
- "Bize Ulaşın" altındaki harita önizlemesi ve harita bölümü tamamen kaldırıldı (anasayfa, /hakkimizda/, /iletisim/): `inc/bize-ulasin.php`, `js/site.js` harita kodu, `.harita*` CSS. Sitede artık Google'a hiçbir bağlantı yok. (`harita_koordinat` ayarı JSON-LD için config'de duruyor.)

### Açık (Revizyon 3)
- **KVKK ve Gizlilik metinleri güncel değil:** /kvkk/ bülten aboneliğini (veri, amaç, açık rıza — 3 madde) ve Google Haritalar'ı anlatıyor; /gizlilik-politikasi/ bülten verisini ve "Haritayı göster" bölümünü anlatıyor. Bu hizmetler artık yok — metinler onayınızla güncellenecek.
- Ticaret Sicil No sitede yok (TTK md. 39) — numara gelince © satırına eklenecek.
- Bilgi Toplumu Hizmetleri sayfası yok (TTK md. 1524) — sicil no, sermaye, yönetim kurulu bilgileri gerekiyor.
- Sıradaki: mega menü ve /bilgi/ tasarımı.

---
## Revizyon 4 (2026-10-01) — Kullanıcı deneyimi (öneri 1. bölüm)
Kullanıcı kararları: Egefe = Armas Elektronik yetkili bayi ve servisi (NAM-07/NAM-19 dahil, görsel kullanım izni var); kurum sayısı her yerde "200+ anlaşmalı kurum"; "10+ yıl / 10 yılı aşkın" → "2017'den beri"; iki "%99" iddiası kaldırıldı; form başarı mesajında süre yok (değişmedi).

- **Anasayfa:** yeni açılış metni + NAM-19 saha fotoğrafı (Armas); üç giriş kartı (Ürünler / Servis / Danışmanlık); "Öne Çıkan Ürünler" vitrini; "Neden Egefe" rakamları: 2017 · 200+ · Armas · CE. Eski "9 Uyuşturucu Madde Tespiti" / "Sorunsuz Teknik Destek" şeritleri ve "İnovatif Sağlık" kartları kaldırıldı (içerikleri giriş kartlarına ve "Neden Egefe" metnine taşındı).
- **Yeni sayfa /urunler/:** NAM-07, NAM-19, NAM-DATA, UTK, UTC. Metinler yalnız /bilgi/ SSS ve blogdaki mevcut bilgilerden; görseller Armas'tan (`site/img/urun/`). Teklif Al → /iletisim/?konu=Ürünler#form (form konusu otomatik seçilir).
- **Menü:** Ürünler · Servis · Danışmanlık · Kurumsal · Blog · İletişim ("Hizmetler" → "Servis"; /hizmetler/ H1 "Servis Hizmetleri", URL aynı). **Footer** aynı yapıda: Ürünler ve Servis / Danışmanlık / Kurumsal / İletişim.
- **Kesik metinler:** anasayfa, /hizmetler/ ve /danismanlik/ girişleri, footer sloganı ("…" kaldırıldı); hizmet kartı özetleri artık tam cümle (15 kart). 10 kartta ilk cümle çok uzun mevzuat cümlesi olduğu için hâlâ "…" ile kısalıyor — kısa açıklama yazılması onaya bağlı.
- **CTA bandı:** 100+ Kurumsal Müşteri / 10+ Sektörel Tecrübe → 200+ Anlaşmalı Kurum / 2017 Kuruluş.
- **Mobil:** altta sabit "Ara / Teklif Al" çubuğu; rakamlar 2×2; footer bağlantıları iki sütun.
- Anasayfa meta description yenilendi (canlıdaki "10 yılı aşkın…" yarım cümleydi).

### Onayınıza sunulan YENİ metinler (Revizyon 4)
1. Açılış etiketi: "Armas Elektronik Yetkili Bayi ve Servisi"
2. Açılış başlığı: "Alkolmetre, uyuşturucu testi ve sağlık danışmanlığı"
3. Açılış metni: "Armas Elektronik'in yetkili bayi ve servisi olarak alkolmetre ve uyuşturucu tespit ürünlerinin satışını, bakımını ve kalibrasyonunu yapıyoruz. Tıbbi cihaz, ÜTS ve Sağlık Bakanlığı işlemlerinde de danışmanlık veriyoruz."
4. Giriş kartları: "Alkolmetre ve uyuşturucu testi" / "Bakım, onarım ve kalibrasyon" / "Tıbbi cihaz, ÜTS ve Bakanlık işlemleri" + birer cümle açıklama
5. /urunler/ ürün özellik maddeleri ve NAM-DATA açıklaması (mevcut SSS cevaplarından yeniden yazıldı)
6. Anasayfa ve /urunler/ meta description'ları

### Açık (Revizyon 4)
- NAM-19 ve UTC için özellik bilgisi yok (sitede yalnız NAM-07 ve UTK anlatılıyor). Blogda "uyuşturucu tespit cihazı 7 farklı madde" geçiyor, UTK için "9 madde" — hangisi hangi ürüne ait?
- Armas'ın sattığı diğer modeller (NAM-E30, NAM-19S, NAM-C20 vb.) Egefe'de de var mı?
- Hakkımızda: "sektörde 20 yıllık tecrübesi ile birlikte, 2017 yılında kurulmuş" ifadesi korunuyor.
- Güven unsurları: ISO/yetkili servis belgeleri, referans kurumlar (izinli), gerçek ekip/cihaz fotoğrafları.

## Revizyon 5 (2026-10-01) — Armas teknik bilgileri
Kullanıcı kararı: Armas ürün sayfalarındaki teknik bilgiler kullanılabilir; diğer Armas modelleri (NAM-E30, NAM-19S, NAM-C20 vb.) eklenmeyecek.
- /urunler/: NAM-07 ve NAM-19 özellik maddeleri + açılır "Teknik özellikler" tablosu (Armas ürün sayfalarından); UTK ve UTC maddeleri Armas metinleriyle tamamlandı (RFID etiket, kullanım alanları). NAM-19'un yazılımı NAM-DATAPro olarak düzeltildi.
- "7 mi 9 mu" çözüldü: UTK tek ağız sıvısı örneğiyle 9 maddeye kadar test eder, standart kitte 7 madde vardır (Armas). Blogdaki "7 farklı madde" standart kiti anlatıyor — değişiklik yok. Anasayfa vitrini: "9 maddeye kadar".
- Açık: 10 danışmanlık kartı için kısa açıklama (hâlâ "…" ile kısalıyor) — kullanıcı cevabı bekleniyor.

- 2026-10-01: "2017 / Kuruluş" rakam kutusu kaldırıldı (anasayfa "Neden Egefe" + CTA bandı) — kullanıcı kararı.

## Revizyon 6 (2026-10-01) — CROM TEST (markamız) ve uyuşturucu bölümü
Kullanıcı kararları: CROM TEST (cromtest.com) Egefe'nin yerli üretim uyuşturucu test kiti markası; uyuşturucu testinde yalnız CROM TEST (Armas UTK/UTC kaldırıldı, Armas yalnız alkolmetrelerde); bağlantı ürünler + anasayfa + uyuşturucu blog yazıları + footer/Hakkımızda/JSON-LD; Ticaret Sicil No eklenmeyecek.
- Tek kaynak: `inc/config.php` → `$MARKA`; ortak blok `inc/marka-crom.php` (bant / kutu).
- /urunler/: "Uyuşturucu Test Kitleri" bölümü — çok panelli, tekli panel, numune saflık, özel panel → cromtest.com (products.html#coklu|#tekli, idrar-butunluk-testi, ozel-panel-talebi). Görseller cromtest.com'dan (`img/crom-test/`, küçültülmüş WebP).
- Anasayfa: açılış etiketi/metni, ürün giriş kartı, vitrinde 2 CROM TEST ürünü, "Markamız" bandı, "Neden Egefe"de CROM TEST kutusu.
- Hakkımızda: "Markamız" bandı. Footer: "Markamız" + beyaz CROM TEST logosu. JSON-LD Organization.brand = CROM TEST.
- 18 uyuşturucu/madde blog yazısının sonunda CROM TEST kutusu (alkol yazılarında yok).
- Blog düzeltmeleri (build.mjs FIXES): uyusturucu-madde-testi ve uyusturucu-testi-nedir'deki UTC/UTK cümleleri CROM TEST'e çevrildi; "tükürük testi cihazları yüksek oranda hata payı içermektedir" cümlesi kaldırıldı; "fiyatları 2022" → "fiyatları".

### Açık (Revizyon 6)
- /bilgi/ SSS'de "Uyuşturucu Test Kiti" (UTK) bölümü duruyor — kaldırılsın mı / CROM TEST'e göre mi yazılsın?
- /hizmetler/ girişi: "uyuşturucu tespit cihazı, tespit kiti ve alkolmetrelerin satışı ve yetkili servisi" — UTC servisi devam ediyor mu?
- cromtest.com "15+ yıllık deneyim" ve "%99,6 doğruluk" yazıyor; ege-fe.com'da kuruluş 2017 ve %99 iddiaları kaldırıldı — iki site tutarsız.

## Revizyon 7 (2026-10-01) — Armas UTC/UTK sitede hiç geçmez
Kullanıcı kararı: Armas'ın UTC cihazı ve UTK kitiyle ilgili her şey kaldırılsın.
- /bilgi/: "Uyuşturucu Test Kiti" SSS bölümü (5 soru + görsel) ve sayfa başındaki UTC fotoğrafı (1282794.jpg) kaldırıldı; description güncellendi.
- /hizmetler/: giriş metni ve description'dan "uyuşturucu tespit cihazı, tespit kiti" çıkarıldı; paylaşım görseli UTC fotoğrafıydı (kapakfoto-3.jpg) → NAM-19 saha fotoğrafı.
- /ariza-ve-onarim/: "UTS, NAM-07 ve NAM-19 cihazların" → "NAM-07 ve NAM-19 cihazlarının" (kart özeti ve description dahil).
- Dosyalar silindi: utk-uyusturucu-test-kiti.jpg, 1282794.jpg, kapakfoto-3.jpg, img/urun/utk.webp, utc.webp. build.mjs: YASAK_GORSEL filtresi.
- Kontrol: site/ altında UTC/UTK/"tespit cihazı"/"test sistemi" geçen metin, görsel veya dosya yok.

## Revizyon 8 (2026-10-01) — CROM TEST PASİF
Kullanıcı kararı: konu netleşene kadar CROM TEST sitenin hiçbir yerinde görünmeyecek; kullanıcı "aktife al" diyene kadar pasif.
- Tek anahtar: `site/inc/config.php` → `$MARKA['aktif'] = false`. `tools/build.mjs` aynı satırı okur (CROM_AKTIF).
- Pasifken: anasayfa (etiket "Armas Elektronik Yetkili Bayi ve Servisi", başlık "Alkolmetre ve sağlık danışmanlığı", ürün kartı "Delil sınıfı alkolmetreler", vitrinde yalnız NAM-07/NAM-19, Markamız bandı ve CROM TEST kutusu yok), /urunler/ (CROM TEST bölümü yok), Hakkımızda bandı, 18 blog kutusu, footer logosu, JSON-LD brand, blog içi CROM TEST cümleleri ve meta açıklamalar — hiçbiri basılmaz.
- Görseller (`img/crom-test/`) sunucuda duruyor ama hiçbir sayfadan bağlantı yok.
- Aktife almak: `'aktif' => true` → `node tools/build.mjs` → commit + push.
- Kontrol: sitemap'teki 66 sayfa + 404 tarandı, "crom" geçen sayfa yok.

## Revizyon 9 (2026-10-01) — UI önerileri (2. bölüm, kullanıcı onaylı 5 madde)
1. Kart başlıkları düz yazı (italik yalnız büyük başlıklarda kaldı) — `.kart h3`.
2. "Detaylar" → "Hizmeti incele"; grup kartlarında "Hizmetleri incele"; Bilgi kartında "Soruları incele".
3. Hub kartları ortalanmış satırlar (`.hub-kartlar`) → son satırda boş hücre yok; 3'lü satırda 2 kart artarsa "Aradığınız hizmeti bulamadınız mı? / İhtiyacınızı bize iletin, size dönüş yapalım. / Bize ulaşın" kartı (şu an Tıbbi Cihaz ve ÜTS).
4. İletişim formu konu alanı boş "Seçiniz" ile açılır (boş gönderilirse e-posta konusu "Genel"); ?konu=Ürünler bağlantısı yine ön seçim yapar.
5. Alkol konulu 5 blog yazısının sonunda alkolmetre kutusu (`inc/urun-kutu.php`): "Kurumunuz için alkolmetre mi arıyorsunuz?" → /urunler/#nam-19 + Teklif Al.
Açık: hizmet sayfalarına süreç / gerekli belgeler / süre / SSS — içerik kullanıcıdan bekleniyor.

- 2026-10-01: SSS akordiyon — bir soru açılınca diğer açık sorular kapanır (site.js).
- 2026-10-01: SSS akordiyon animasyonu — açılış 0,42 sn (solarak + kayarak), kapanış 0,26 sn; yalnız opacity/transform; hareket azaltma tercihinde animasyonsuz.
- 2026-10-01: SSS kutusu da yumuşak açılır/kapanır (yükseklik animasyonu 380 ms, Web Animations) — "yalnız transform/opacity" kuralına kullanıcı isteğiyle istisna, yalnız SSS.

## Revizyon 10 (2026-10-01) — UI revizeleri (kullanıcı: "hepsini yap")
1. Gövde yazısı 300 → 400 (tüm ince metinler).
2. Hakkımızda "Neler Yaparız?": tıklanmayan kutular → bağlantılı liste (Bakım Onarım → /ariza-ve-onarim/, Kalibrasyon → /kalibrasyon/, Yedek Parça → /bilgi/, Eğitim Danışmanlık ve ÜTS/Tıbbi Cihaz/İlaç → /danismanlik/; AR-GE Çözümleri düz metin).
3. Paragraf/madde sonundaki "…" / "..." → nokta (Hakkımızda misyon/vizyon, blog "tıklayınız…" cümleleri vb.).
4. Blog fotoğraf altyazısı yazı başlığını tekrar ediyorsa gösterilmez.
5. Blog: Tümü / Alkol (5) / Uyuşturucu ve Madde (18) filtresi; "ALKOL BAĞIMLILIĞI" → "Alkol Bağımlılığı"; blog kart özetleri tam cümle.
6. Mobil menü: Danışmanlık grupları ayrı ayrı açılır.
7. Hizmet sayfalarında soru biçimli başlıklar akordiyon. Hata düzeltmesi: soru olmayan başlık önceki cevabın içine düşüyordu (/bilgi/ "Cihazlar" görünmüyordu).
8. Sayfada gösterilen 65 fotoğraf WebP (en çok 1600 px): 9,1 MB → 3,3 MB. og:image JPEG kaldı.
9. Hizmet sayfalarında ÜTS logosu ve T.C. Sağlık Bakanlığı amblemi üst görsel olarak kullanılmıyor (20 sayfa); paylaşım görseli → faceb.jpg.
10. 10 hizmet kartına kısa açıklama (`tools/kart-ozet.json`, YENİ METİN — onaya sunuldu).
11. Blog yayın tarihleri görünmüyor (JSON-LD'de duruyor); kartlarda tarih yerine konu etiketi.
- /bilgi/ sonundaki "Danışmanlık ve bilgi için…" başlığı kaldırıldı (CTA bandıyla aynı cümle).
Açık: 12 — hizmet sayfalarına süreç / belgeler / süre / SSS içeriği (kullanıcıdan).
- 2026-10-01: Sayfa sonu bandı yeniden tasarlandı (B+C): açık zemin üzerinde teal kart, solda bölüme göre başlık/metin + Teklif Al, sağda Telefon / E-posta / Teklif formu kutuları; teklif formu bölüme göre konu seçili açılır (servis → Teknik Destek, ürünler → Ürünler, danışmanlık → Hizmetler). Yeni metinler: "Cihazınızın bakım ya da kalibrasyon zamanı mı geldi?", "Kurumunuz için alkolmetre mi arıyorsunuz?", "Başvurunuz için danışmanlık mı arıyorsunuz?", "Sorunuz mu var? Size yardımcı olalım." Servis yan menü başlığı → "Servis Hizmetleri".

## Revizyon 11 (2026-10-02) — NAM-E30 ve NAM-E30C
Kullanıcı kararı: Armas profesyonel alkolmetrelerden NAM-E30 (yazıcılı) ve NAM-E30C (kameralı/yazıcılı) eklendi; görseller ve teknik bilgiler armaselektronik.com ürün sayfalarından.
- /urunler/: iki yeni ürün kartı (özellikler + açılır teknik tablo); NAM-DATAPro açıklaması güncellendi; teknik tablo açılınca yan kart uzamıyor.
- Anasayfa: vitrinde 4 alkolmetre; ürün giriş kartı metni 4 modeli sayıyor.
- Sayfa sonu bandı (ürünler), alkol blog kutusu, /urunler/ meta description: 4 model.
- Değişmedi (kullanıcıya soruldu): servis/SSS metinlerindeki "NAM-07 ve NAM-19" ifadeleri (Arıza ve Onarım, Bilgi).

## Revizyon 12 (2026-10-02) — Periyodik Bakım + Kalibrasyon birleşti, periyot 6 ay
- Tek sayfa: /kalibrasyon/ "Periyodik Bakım ve Kalibrasyon" (Cihaz Kalibrasyonu + Periyodik Bakım bölümleri). /periyodik-bakim/ → 301 /kalibrasyon/ (.htaccess + dev-router).
- Bakım periyodu yalnız 6 ay: "3 aylık, 6 aylık ve 12 aylık" ve /bilgi/ "3-6-12-24 ve 36 ay … sözleşmeler" ifadeleri kaldırıldı → "6 ayda bir".
- Menü, footer, Servis kartları, Ürünler "Satış Sonrası" bağlantıları tek madde; kart özeti ve meta yeni.

## Revizyon 13 (2026-10-02) — Paylaşım önizlemesi (WhatsApp vb.)
- Yeni 1200×630 marka paylaşım görseli: site/img/paylasim.jpg (87 KB), üretimi `node tools/paylasim.mjs` (site fontları, koyu logo, NAM-19 saha fotoğrafı). Eski logo-kare faceb.jpg yerine varsayılan og:image.
- Anasayfa başlığı: "Egefe Sağlık Bilişim A.Ş. | Alkolmetre, Servis ve Sağlık Danışmanlığı" (eski: "Anasayfa - …").
- og:image:width/height/type/alt ve twitter:image eklendi (tüm sayfalar).
- Blog paylaşım açıklamaları: "… için tıklayınız…" / başlık tekrarı olanlar yazının ilk tam cümleleriyle değişti.
- 2026-10-02: Paylaşım görseli ortalı yeniden tasarlandı (WhatsApp küçük önizlemede ortadan kare kırpar → logo + başlık ortadaki karede); og:image adresine sürüm eki (?v=dosya tarihi).
- 2026-10-02: Kullanıcı tercihi — paylaşım görselinde önceki (solda yazı, sağda fotoğraf) tasarıma dönüldü; sürüm eki korunuyor.

## Revizyon 14 (2026-10-02) — DANIŞMANLIK PASİF
Kullanıcı kararı: danışmanlık bölümü kullanıcı "aktife al" diyene kadar hiçbir yerde görünmez.
- Tek anahtar: site/inc/config.php → define('DANISMANLIK_AKTIF', false). tools/build.mjs (DAN_AKTIF) ve tools/paylasim.mjs aynı satırı okur.
- Pasifken: menüde Danışmanlık (mega menü) yok; footer Danışmanlık sütunu yok (4 sütun); anasayfa başlığı "Alkolmetrede yetkili satış ve servis", Danışmanlık giriş kartı yok (2 kart); Servis sayfasında "Danışmanlık Hizmetleri" yok; Hakkımızda "Eğitim Danışmanlık" ve "ÜTS, Tıbbi Cihaz, İlaç" maddeleri yok; sayfa sonu bandı "Ürünlerimiz ve servis hizmetlerimiz"; anasayfa title/description ve paylaşım görseli danışmanlıksız.
- /danismanlik/, /uts/, /tibbi-cihaz/, /saglik-bakanligi-islemleri/, /diger-hizmetler/, /ilac/ ve alt sayfaları → 302 anasayfa; site haritasından çıktı (65 → 38 URL). Dosyalar sunucuda duruyor.
- Aktife almak: true yap → node tools/build.mjs → node tools/paylasim.mjs → commit + push.
- 2026-10-02: Anasayfa etiketi "Armas Elektronik Yetkili Bayi ve Servisi" → "Armas Elektronik Yetkili Satış ve Teknik Servis" (kullanıcı).
- 2026-10-02: NAM-07 üretimi yok → satışta değil, yalnız periyodik bakım ve kalibrasyon: anasayfa vitrininden çıktı (3 ürün); /urunler/ kartı listenin sonunda "Üretimi sona erdi · Yalnızca periyodik bakım ve kalibrasyon" etiketiyle, düğmeler "Bakım / Kalibrasyon Talebi" (Teknik Destek) ve "Periyodik Bakım ve Kalibrasyon"; satış metinleri (anasayfa kartı ve açıklaması, ürünler açıklaması, CTA, alkol blog kutusu, paylaşım görseli) NAM-19 / NAM-E30 / NAM-E30C. "CE Uygunluklu Cihazlar" → "CE Uyumlu Cihazlar".
