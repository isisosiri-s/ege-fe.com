# ege-fe.com — Ham İçerik Özeti (tarama: 2026-09-29)

## Klasör yapısı
- `json/` — her sayfa için tam çıkarım (title, description, canonical, og:*, başlıklar, görseller, CSS arka planları, formlar, linkler, JSON-LD, gövde metni)
- `html/` — render sonrası tam HTML
- `sayfalar/*.md` — okunabilir özet (meta tablosu, başlıklar, sayaçlar, görseller, ⚠ bulgular, temiz gövde metni)
- `sayfalar/_ortak-iletisim-footer.md` — tüm sayfalarda tekrar eden iletişim bloğu
- `img/uploads/…` — indirilen görseller (orijinal boyut; 140 dosya, ~14 MB)
- `gorseller.json` — görsel → yerel yol → kullanıldığı sayfalar
- `rapor.json` — sayfa bazlı bulgular + envanter dışı linkler
- `scrape-log.json` / `scrape-run.txt` — tarama günlüğü

## Tarama sonucu
- 64/64 URL HTTP 200, ilk denemede (bot engeli yok, retry gerekmedi).
- Blog: brief "24 yazı" diyor; listede `/blog/` + **23 yazı** var (toplam 24 URL). Hepsi çekildi.
- `/blog/page/2/` ve `/category/saglik/page/2/` sayfalama sayfaları da var (200).
- Görseller: 146 benzersiz URL, 140 indirildi. İndirilemeyen 6 dosya `egefe.provega.com.tr` alan adında (DNS yok): 5 favicon + `ilac.jpg`.

## Genel bilgiler (canlı siteden)
- Title kalıbı: `<Sayfa> - Egefe Sağlık Bilişim A.Ş.`; og:site_name aynı.
- og:image (anasayfa): `/wp-content/uploads/2022/01/faceb.jpg` 1200×630.
- Search Console doğrulama: `google-site-verification = xl0TzVFv6lmPGghB_4b-lvpQYCHUVC1hLbzpiypKAVU`
- Analytics / GTM / Pixel: **bulunamadı**.
- JSON-LD (Rank Math): Organization + HealthAndBeautyBusiness, Place (geo), WebSite, WebPage, BlogPosting/Article, Person(admin), AboutPage, ContactPage, CollectionPage.
- İletişim: Merkez — Harbiye Mah. Hürriyet Cad. No:7/12 Çankaya/Ankara · AR-GE Ofis — Kırıkkale Teknopark No:18 Yahşihan/Kırıkkale · info@ege-fe.com · +90 312 482 54 51
- Çalışma saatleri (JSON-LD): Pzt–Paz 09:00–18:00
- LinkedIn: linkedin.com/company/egefe-bilişim-sağlık-a-ş · Teknik Servis Takip: ege-fedestek.com
- Anasayfa sayaçları: %99 Müşteri Memnuniyeti · %99 Doğruluk · 10+ Sektörel Tecrübe · 200+ Anlaşmalı Kurum
- Hizmet sayfası sayaçları: 100+ Kurumsal Müşteri · 10+ Sektörel Tecrübe

## Menü (canlı)
Anasayfa · Kurumsal (Hakkımızda, Hizmet Politikamız, Kalite Politikamız, Kariyer) · Hizmetler (Arıza ve Onarım, Periyodik Bakım, Kalibrasyon) · Danışmanlık → ÜTS (4 alt) · Tıbbi Cihaz (5 alt) · Sağlık Bakanlığı İşlemleri (7 alt) · Diğer Hizmetler (4 alt) · Mağaza · Blog · İletişim
- Not: `/uts/tibbi-cihaz-uts-gecisi/` menüde yok ama sayfa var. Menüdeki "Tıbbi Cihaz / Sağlık Bakanlığı İşlemleri / Diğer Hizmetler" üst öğeleri `#` linkli (hub sayfalarına gitmiyor).

## Formlar (Contact Form 7 — alıcı adresi sunucu tarafında, HTML'den okunamıyor)
| Sayfa | Alanlar |
|---|---|
| / ve /hakkimizda/ | ad-soyad, konu (select), telefon, mesaj |
| /iletisim/ | ad-soyad, e-posta, konu (select), mesaj |
| /kariyer/ | ad-soyad, adres, şehir, telefon, e-posta, **CV dosyası**, mesaj |
| /hizmetler/, /danismanlik/, /ilac/, /diger/ | bülten (yalnız e-posta) |
| 23 blog yazısı | WordPress yorum formu |
Konu seçenekleri: Teknik Destek · Muhasebe · Ürünler · Hizmetler · İnsan Kaynakları · Diğer

## ⚠ BULGULAR — değiştirilmedi, onayınızı bekliyor

### A. Şablon kalıntısı / İngilizce lorem
1. **43 sayfanın meta description'ı İngilizce lorem** ("Phosfluorescently engage worldwide methodologies…", "Interactively procrastinate…", "Completely synergize…" vb.). Etkilenenler: tüm hizmet hub + alt sayfaları, /hakkimizda/, /hizmetler/, /hizmet-politikamiz/, /kalite-politikamiz/, /kariyer/, /iletisim/, /bilgi/, /danismanlik/, /ilac/, /diger/, /ariza-ve-onarim/, /periyodik-bakim/, /kalibrasyon/, /blog/. Aynı lorem sayfa başlığı altında görünen giriş cümlesi olarak da gövdede var.
2. `/danismanlik/`, `/ilac/`, `/diger/` gövdeleri **büyük ölçüde İngilizce tema demo içeriği** ("Avantage Services", "Financial Consultancy", "HR Consultancy", "Successful Innovative Cosultancy", "Strategy Management"…).
3. `/hizmetler/` gövdesi yalnızca kart linkleri + "Posta Bültenine Kayıt Olun" (≈400 karakter).
4. Blog kenar çubuğunda İngilizce tema etiketleri: "Archives", "Categories".
5. **`egefe.provega.com.tr`** (ajans/geliştirme alan adı) kalıntıları: favicon'ların tamamı, `ilac.jpg`, hizmet kartlarındaki 4 "Detaylar" linki, 23 blogda yazar linki. Bu alan adı artık çözümlenmiyor → favicon canlı sitede de kırık.

### B. Boş / eksik içerik
6. `/bilgi/`: "NAM-07 cihazlarının kalibrasyon süresi:", "NAM-19:" ve ücret tarifesi değerleri **boş**.
7. `/iletisim/` gövdesi çok kısa (≈450 karakter; sadece iletişim bilgileri + form).
8. `/kalibrasyon/` (≈570), `/periyodik-bakim/` (≈780), `/ilac-varyasyon/` (≈540), `/sorumlu-teknik-eleman/` (≈770) çok kısa.
9. `/category/saglik/` meta description yok.

### C. Tekrarlanan içerik
10. **4 hub sayfası** (`/uts/`, `/tibbi-cihaz/`, `/saglik-bakanligi-islemleri/`, `/diger-hizmetler/`) giriş kısmı hariç **birebir aynı ÜTS metnini** taşıyor (≈6.100 karakter, "Ürün Takip Sistemi Projesi Nedir?" vb.).

### D. Firma bilgisi tutarsızlıkları
11. Ünvan varyantları: "Egefe Sağlık Bilişim A.Ş." (title, og:site_name, JSON-LD), "EGEFE Bilişim Sağlık" (footer), "Egefe Bilişim Sağlık A.Ş." (hakkımızda) → yasal ünvan: **Egefe Bilişim Sağlık San. ve Tic. A.Ş.**
12. **Harita koordinatı çelişkisi:** iletişim sayfasındaki harita 39.8313, 32.7397; JSON-LD ve anasayfa haritası 39.8954, 32.8368 (Harbiye/Çankaya ile uyumlu olan ikincisi).
13. JSON-LD adresinde yazım: "Harbie Mahallesi" (sayfada "Harbiye").
14. Kuruluş/tecrübe çelişkisi: Hakkımızda "sektörde 20 yıllık tecrübe ile 2015'te kuruldu"; anasayfa "2015 yılından beri", "10 yılı aşkın"; marka rehberi "kuruluş 2017".
15. Footer "Copyright by Egefe. All rights reserved." (İngilizce).
16. Sosyal ikonlar genel `facebook.com/` ve `twitter.com/` adreslerine gidiyor (gerçek hesap değil).

### E. Kırık / e-ticaret kalıntısı linkler
17. Footer: Hesabım, Siparişlerim, Sipariş Takip, Online Mağaza (e-ticaret); "Gizlilik Sözleşmesi" → **404**; "Mesafeli Satış Sözleşmesi", "Ödeme, İade ve Garanti", "KVKK" link değil (sayfa yok).
18. İçerik içinde ürün linkleri **404**: `/urun/utk-uyusturucu-test-kiti/` (anasayfa "TEST KİTİ", blog), `/urun/utc-uyusturucu-tespit-cihazi/`, `/urun-kategori/cihazlar/` (alkolmetre-nedir).

### F. SEO yapı sorunları
19. H1 yok: `/`, `/hakkimizda/`, `/hizmet-politikamiz/`, `/kalite-politikamiz/`.
20. Birden fazla H1: 4 hub (4'er), `/kontrol-belgesi/` (5), `/firma-kaydi/` (4), `/biyosidal-ruhsatlandirma/`, `/ilac-ruhsatlandirma/`, `/ubb-e-imza/` (3'er), `/etiket-duzenleme/`, `/tibbi-cihaz-belge-kaydi/` (2'şer).
21. `/category/saglik/` H1'i title ile aynı ("Sağlık - Egefe Sağlık Bilişim A.Ş.").
22. 5 blog yazısı "Kategorisiz" kategorisinde (eroin-bagimliligi, eroin-nedir, opiatlar-nedir, kokain-bagimliligi-tedavisi, uyusturucu-testi-nedir); bunlar /category/saglik/ listesinde yok.

### G. Yazım hataları (metin korunuyor, bilgi için)
23. "9 Uyuşturu Madde Tespiti" (anasayfa), "bilgi birimkimlerini" (anasayfa description), "Cosultancy".

### H. Görsel lisans riski (bilgi için)
24. Bazı blog görsellerinin dosya adları stok/üçüncü taraf kaynak işaret ediyor (AdobeStock_…, gettyimages-…, TorontoDUI…, Incidente-stradale…, 6089…_n.jpg Facebook). Lisans durumunu doğrulamanızı öneririm.
