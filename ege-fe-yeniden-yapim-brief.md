# ege-fe.com — Yeniden Yapım Brief'i (Claude Code için)

## Amaç
ege-fe.com'un mevcut sitesini (WordPress + Yoast SEO) **sıfırdan, modern bir
stack ile** yeniden yapmak. Firma yasal ünvanı: **Egefe Bilişim Sağlık San. ve Tic. A.Ş.**
(site başlıkta "Egefe Sağlık Bilişim A.Ş." gösterir; footer/iletişim/yasal
metinlerde DOĞRU yasal ünvan kullanılacak). Sağlık/ilaç
mevzuatı, tıbbi cihaz, ÜTS ve Sağlık Bakanlığı işlemleri konusunda danışmanlık
veren bir şirket. Site bir **kurumsal/hizmet tanıtım (vitrin)** sitesidir;
aktif e-ticaret YOK (sitemap'te ürün yok; mağaza/sepet sayfaları eski tema
kalıntısı). Mevcut hosting'e erişim YOK; site canlı (bot koruması nedeniyle
wget/curl çalışmaz, gerçek tarayıcı erişir). İçerik ve SEO korunacak, tasarım
yenilenecek.

## Teknoloji kararı
- **Framework YOK. Saf HTML + kendi yazacağın özel CSS.** (Astro/Next/Tailwind
  KULLANMA.) Gerekçe: vitrin/içerik sitesi + paylaşımlı cPanel (GüzelHosting).
  Statik HTML dosyaları hızlı, en güçlü SEO, hiçbir build/Node süreci yok, cPanel'e
  sadece dosyaları yükleyip çalışır. Native modül (sharp vb.) derdi de olmaz.
- **CSS:** Tek bir düzenli `css/style.css` (veya birkaç mantıklı dosya) yaz.
  Renk/tipografi/spacing için `:root` altında CSS değişkenleri (custom properties)
  tanımla ve marka kurallarından (aşağıda eklenecek) türet. Hazır CSS framework
  (Bootstrap/Tailwind) KULLANMA — kendi sade, responsive CSS'ini yaz (flex/grid).
- **Tekrar eden parçalar (header/footer/menü) — PHP include kullan:** Çok sayıda
  sayfa var; navbar/footer TEK kaynaktan yönetilmeli. cPanel PHP+Apache çalıştırdığı
  için her sayfada `<?php include 'inc/header.php'; ?>` / `include 'inc/footer.php'`
  kullan. Sunucu parçaları birleştirip TAM HTML gönderir → SEO tam, JS'e bağımlı değil,
  build/araç yok, framework yok. Sayfalar `.php` olur ama URL yapısı korunur
  (`/iletisim/index.php` → `/iletisim/` olarak servis edilir; gerekiyorsa .htaccess ile).
  (JS ile header/footer çekme YÖNTEMİNİ KULLANMA — menü ilk HTML'de olmaz, SEO zayıflar.)
- **Vitrin modu:** mağaza/sepet/ödeme/hesabım sayfalarını KURMA. Hizmet sayfaları
  içerik + "Teklif Al / Bize Ulaşın" (form veya iletişim linki) ile bitsin.
- **Çıktı:** doğrudan cPanel'e yüklenebilecek statik dosyalar (html + css + görseller).

## MARKA KURALLARI (resmî Şirket Kimlik Rehberi'nden — birebir uygula)
Tasarımı tahmin etme; aşağıdaki resmî marka sistemini kullan. CSS'i bu tokenlarla kur.

### Renk paleti (CSS değişkenleri — `:root`'a koy)
```css
:root{
  --teal:#1D7D95;        /* Egefe Teal — BİRİNCİL marka rengi, logo dalgası */
  --teal-light:#3AA8C1;  /* Vurgu · CTA · hover */
  --teal-deep:#0E5266;   /* Hero arka planı · koyu vurgu */
  --teal-pale:#E4F5F9;   /* Kart arka planı · hafif vurgu */
  --slate-dark:#2E4050;  /* Birincil koyu · başlık metni */
  --slate:#5A6E7C;       /* İkincil / gövde metni */
  --slate-light:#C2D0D8; /* Border · ayırıcı çizgi */
  --off-white:#F7F9FA;   /* Sayfa zemini */
  --ink:#1A2E3B; --mid:#4A6070; --mist:#8FA4B0;
  --success:#1A7A4A;     /* pozitif/onay */
  --warn:#C45C14;        /* dikkat/kritik */
  --ff-display:"DM Serif Display", serif;  /* başlıklar */
  --ff-body:"Nunito Sans", sans-serif;     /* gövde/UI */
}
```
Marka paleti dışında renk KULLANMA.

### Tipografi
- Fontlar Google Fonts'tan: `DM Serif Display` (başlık/display; regular + italic) ve
  `Nunito Sans` (gövde/UI; ağırlıklar 300·400·600·700). `<head>`'e ekle:
  `https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Nunito+Sans:opsz,wght@6..12,300;6..12,400;6..12,600;6..12,700&display=swap`
  (istersen woff2'leri indirip self-host edebilirsin — tercihen.)
- **Başlıklar (H1/H2/H3):** DM Serif Display. H1 ~2.8rem (`clamp(2rem,4vw,3.2rem)`),
  H2 ~1.9rem, H3 ~1.3rem **teal-dark + italic**. Gövde: Nunito Sans, ~0.97rem,
  line-height 1.8, weight 300, renk `--mid`/`--slate`.
- UI etiketleri: küçük (~0.65rem), weight 700, `letter-spacing:.18em`, UPPERCASE, teal.

### Logo
- Zemin varyantları: **beyaz**, **açık teal** (`--teal-pale`), **koyu slate** (`--slate-dark`).
  Her zeminde doğru logo versiyonunu kullan.
- Kurallar: etrafında min. boşluk = logo yüksekliğinin %25'i; dijitalde SVG/yüksek çöz. PNG;
  gölge/outline/degrade EKLEME; oranları bozma (yalnız eş oranlı ölçekle); marka rengi dışına çıkma.
- **Logo dosyası:** guideline'da referans var ama gerçek logo dosyasını (SVG/PNG) kullanıcı
  verecek VEYA canlı ege-fe.com header'ından çekilen logoyu kullan. Emin değilsen kullanıcıya sor.

### Kurumsal ses tonu (metin/başlık üslubu)
- **Uzman & Güvenilir:** iddialar somut veri/belgeye dayanır, bilimsel doğruluk.
- **Kurumsal & Saygılı:** devlet/özel hastanelerle protokole uygun, net, resmî dil.
- **Çözüm Odaklı:** yerelden uluslararası projeye ihtiyaca en doğru çözüm.
Mevcut sayfa metinlerini KORU (SEO); üslup/başlık düzenlerken bu tona sadık kal, metni uydurma.

### Marka hiyerarşisi (ÖNEMLİ)
Egefe **şirkettir**, Cromtest® bir **markadır**. Egefe logosunu Cromtest® ile eş düzeyde
konumlandırma; birlikte geçtiğinde Egefe'yi şirket kimliği olarak üstte konumla.
(Portföy: Cromtest® hızlı test kitleri, Armas alkolmetre distribütörlüğü, Abbott Sotoxa,
yurt dışı hastane kurulumu — kuruluş 2017, AR-GE Kırıkkale Teknopark.)


Site 2019'dan beri indeksli. Sıralamayı kaybetmemek için:
1. **URL yapısını BİREBİR koru** — aşağıdaki tüm slug'lar aynen kalacak
   (özellikle çok sayıda hizmet alt-sayfası ve blog var). URL değişirse eski→yeni
   **301 redirect** kur.
2. Her sayfanın **`<title>`, `<meta name="description">`, `<link rel="canonical">`,
   `og:*`** değerlerini canlı siteden çekip birebir taşı.
3. **H1/H2 başlık yapısını** ve gövde metnini koru (tasarımı değiştir, metni değil).
4. Yeni sitede **sitemap.xml** ve **robots.txt** üret; yayına alınca Google Search
   Console'a yeni sitemap gönder.
5. **https + geçerli SSL** olmadan yayına alma.

## İÇERİK ÇEKME YÖNTEMİ (bot korumasını aşan)
wget/curl bloklanır. **Playwright (headless Chromium)** ile çek:
```
npm i -D playwright && npx playwright install chromium
```
Her URL için: render sonrası HTML, title, meta description, canonical, og:*,
H1/H2/H3, gövde metni, tüm görsel URL'leri (CSS background dahil), favicon.
Görselleri indirip yerelleştir. 403/timeout gelirse gerçek Chrome user-agent +
`waitUntil: 'networkidle'` ile tekrar dene. Çektiğin ham içeriği `./kaynak/`
altına düzenli kaydet (her sayfa için url/title/description/canonical/metin/
görsel listesi) ve yeniden yapıma başlamadan önce bana özetle.

## TAM URL ENVANTERİ (Yoast sitemap'ten)

### Kurumsal sayfalar
- `/`  (Anasayfa)
- `/hakkimizda/`
- `/hizmetler/`
- `/hizmet-politikamiz/`
- `/kalite-politikamiz/`
- `/kariyer/`
- `/iletisim/`   (adres + telefon + e-posta + form alıcısını çek)
- `/bilgi/`
- `/danismanlik/`
- `/ilac/`
- `/diger/`

### Sağlık Bakanlığı İşlemleri (hub + alt sayfalar)
- `/saglik-bakanligi-islemleri/`
- `/saglik-bakanligi-islemleri/gmp-basvurusu/`
- `/saglik-bakanligi-islemleri/biyosidal-ruhsatlandirma/`
- `/saglik-bakanligi-islemleri/ilac-fiyatlandirma/`
- `/saglik-bakanligi-islemleri/ilac-ruhsatlandirma/`
- `/saglik-bakanligi-islemleri/kub-kt/`
- `/saglik-bakanligi-islemleri/ilac-varyasyon/`
- `/saglik-bakanligi-islemleri/okunabilirlik-testi/`

### Tıbbi Cihaz (hub + alt sayfalar)
- `/tibbi-cihaz/`
- `/tibbi-cihaz/firma-kaydi/`
- `/tibbi-cihaz/tibbi-cihaz-belge-kaydi/`
- `/tibbi-cihaz/ubb-e-imza/`
- `/tibbi-cihaz/firma-bilgileri-guncelleme/`
- `/tibbi-cihaz/etiket-duzenleme/`

### ÜTS (hub + alt sayfalar)
- `/uts/`
- `/uts/kozmetik-firma-kaydi/`
- `/uts/uts-bilgi-guncelleme/`
- `/uts/tibbi-cihaz-uts-gecisi/`
- `/uts/kozmetik-urun-bildirimi/`
- `/uts/sorumlu-teknik-eleman/`

### Diğer Hizmetler (hub + alt sayfalar)
- `/diger-hizmetler/`
- `/diger-hizmetler/ce-teknik-dosya-hazirlanmasi/`
- `/diger-hizmetler/permi-belgesi/`
- `/diger-hizmetler/kontrol-belgesi/`
- `/diger-hizmetler/takviye-edici-gida/`

### Cihaz servis sayfaları
- `/ariza-ve-onarim/`
- `/periyodik-bakim/`
- `/kalibrasyon/`

### Blog (24 yazı — hepsini çek, URL'leri koru)
`/blog/`, `/eroin-bagimliligi/`, `/eroin-nedir/`, `/opiatlar-nedir/`,
`/kokain-bagimliligi-tedavisi/`, `/uyusturucu-testi-nedir/`, `/kokain-bagimliligi/`,
`/uyarici-madde-nedir/`, `/esrar-bagimliligi-tedavisi/`, `/esrar-bagimliligi/`,
`/esrar-nedir/`, `/trafik-guvenligini-tehlikeye-sokma-sucu/`, `/alkolmetre-nedir/`,
`/uyusturucu-madde-testi/`, `/promil-nedir/`, `/kokain-nedir/`,
`/ergenlerde-uyusturucu-kullanimi/`, `/alkol-bagimliligi/`, `/madde-bagimliligi-nedir/`,
`/madde-bagimliligi-tedavisi/`, `/alkollu-arac-kullanmak/`, `/ekstazi-nedir/`,
`/metamfetamin-nedir/`, `/amfetamin-nedir/`

### Kategori
- `/category/saglik/`   (koru; `/category/kategorisiz/` ATLA — boş "kategorisiz")

### ATLA (tema demo / kullanılmayan)
- `/magaza/`, `/magaza/cart/`, `/magaza/product-categories/`, `/magaza/checkout/`,
  `/odeme/`, `/hesabim/`, `/sepet/`  → WooCommerce kalıntısı, ürün yok, vitrin modunda kurulmayacak
- `/footer/`  → tema parçası
- `/tibbi-cihaz22/`  → yinelenen/hatalı sayfa
- `/single-service/`, `/blog-single/`  → 2019 tema şablon demoları

## KAÇIRILMAMASI GEREKENLER (kolayca unutulur)
- **favicon** ve **og:image**
- **JSON-LD / schema** (Organization) varsa
- **Google Analytics / Tag Manager / Search Console doğrulama** kodu → ID'yi not al,
  kullanıcı doğrulamadan yeni sitede AKTİF ETME (yorum satırında bırak)
- **İletişim formu + varsa kariyer/başvuru formu** hangi adrese gidiyor → yeni sitede
  SMTP + doğru alıcı ayarı (mailler artık GüzelHosting'de)
- **Google Maps embed** — ofis koordinatı (İletişim sayfası)
- **Sertifika/rozet görselleri** (ISO vb. güven unsurları) varsa
- **CSS arka plan görselleri** (Playwright computed style'dan çek)
- **Menü yapısı** — çok sayıda hub/alt-sayfa var; navigasyonu doğru kur

## İÇERİK NOTU (yayından önce kullanıcı doğrulaması)
- **Firma yasal ünvanı: Egefe Bilişim Sağlık San. ve Tic. A.Ş.** Sitede geçen
  "Egefe Sağlık Bilişim A.Ş." gibi varyantları footer/iletişim/yasal metinlerde
  bu doğru ünvanla değiştir. Tam adres/vergi/Mersis bilgilerini kullanıcı
  doğrulamalı; başka yanlış/şablon kalıntısı (Provega, örnek adres, İngilizce
  lorem) varsa DEĞİŞTİRME, önce liste halinde kullanıcıya raporla.
- **Boş sayfa** bulursan uydurma; kullanıcıya bildir.
- Emin olmadığın kararlarda kullanıcıya sor.

## TEKNİK NOT (bu makinedeki kısıt)
Framework kullanmadığımız için (saf HTML + CSS) Astro/sharp gibi native modül
engeli bu projede sorun olmaz. Eğer görselleri optimize etmek (WebP'ye çevirmek)
için bir araç kullanacaksan ve bu makinedeki Application Control politikası native
modülü (sharp vb.) engellerse, Playwright/Chromium ile dönüştür ya da optimizasyonu
atla; site yine saf HTML olarak sorunsuz çalışır.

## YAYINA ALMA (yeniden yapım bitince — ayrı aşama)
1. Yeni siteyi GüzelHosting cPanel'de kur (ege-fe.com bu hesaba eklenecek).
2. URL'ler + meta veriler yerinde, https/SSL aktif, sitemap/robots hazır → test et.
3. **En son:** registrar İHS'de NS'i GüzelHosting'e çevir (mail tarafıyla birlikte).
4. Google Search Console: yeni sitemap gönder, sıralamayı izle.

## NOT
Mail tarafı (ege-fe.com e-postaları) bu işten bağımsız; Uzman Posta'dan imapsync
ile ayrıca taşınacak (greenmed.uk yöntemi).
