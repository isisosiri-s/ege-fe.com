// kaynak/ → site/ üretici. Veri dosyaları + içerik sayfaları üretir; ELLE yazılan sayfalara dokunmaz.
// Kullanım: node tools/build.mjs
import fs from 'node:fs/promises';
import fss from 'node:fs';
import path from 'node:path';

const K = path.resolve('kaynak');
const S = path.resolve('site');
const J = (n) => JSON.parse(fss.readFileSync(path.join(K, 'json', n + '.json'), 'utf8'));
const B = (n) => JSON.parse(fss.readFileSync(path.join(K, 'icerik', n + '.json'), 'utf8'));
const nameOf = (p) => (p === '/' ? 'anasayfa' : p.replace(/^\/|\/$/g, '').replace(/\//g, '__'));

// ---------- Site yapısı ----------
const HUBS = [
  { yol: '/uts/', ad: 'ÜTS', alt: ['/uts/kozmetik-firma-kaydi/', '/uts/sorumlu-teknik-eleman/', '/uts/kozmetik-urun-bildirimi/', '/uts/uts-bilgi-guncelleme/', '/uts/tibbi-cihaz-uts-gecisi/'] },
  { yol: '/tibbi-cihaz/', ad: 'Tıbbi Cihaz', alt: ['/tibbi-cihaz/firma-kaydi/', '/tibbi-cihaz/firma-bilgileri-guncelleme/', '/tibbi-cihaz/ubb-e-imza/', '/tibbi-cihaz/tibbi-cihaz-belge-kaydi/', '/tibbi-cihaz/etiket-duzenleme/'] },
  { yol: '/saglik-bakanligi-islemleri/', ad: 'Sağlık Bakanlığı İşlemleri', alt: ['/saglik-bakanligi-islemleri/ilac-ruhsatlandirma/', '/saglik-bakanligi-islemleri/ilac-varyasyon/', '/saglik-bakanligi-islemleri/ilac-fiyatlandirma/', '/saglik-bakanligi-islemleri/biyosidal-ruhsatlandirma/', '/saglik-bakanligi-islemleri/gmp-basvurusu/', '/saglik-bakanligi-islemleri/kub-kt/', '/saglik-bakanligi-islemleri/okunabilirlik-testi/'] },
  { yol: '/diger-hizmetler/', ad: 'Diğer Hizmetler', alt: ['/diger-hizmetler/permi-belgesi/', '/diger-hizmetler/ce-teknik-dosya-hazirlanmasi/', '/diger-hizmetler/takviye-edici-gida/', '/diger-hizmetler/kontrol-belgesi/'] },
];
const SERVIS = { yol: '/hizmetler/', ad: 'Hizmetler', alt: ['/ariza-ve-onarim/', '/periyodik-bakim/', '/kalibrasyon/'] };
const ILAC_ALT = ['/saglik-bakanligi-islemleri/ilac-ruhsatlandirma/', '/saglik-bakanligi-islemleri/ilac-varyasyon/', '/saglik-bakanligi-islemleri/ilac-fiyatlandirma/', '/saglik-bakanligi-islemleri/kub-kt/', '/saglik-bakanligi-islemleri/okunabilirlik-testi/', '/saglik-bakanligi-islemleri/gmp-basvurusu/'];
// Menüdeki kısa adlar (canlı menüden)
const MENU_AD = {
  '/uts/kozmetik-firma-kaydi/': 'Kozmetik Firma Kaydı', '/uts/sorumlu-teknik-eleman/': 'Sorumlu Teknik Eleman', '/uts/kozmetik-urun-bildirimi/': 'Kozmetik Ürün Bildirimi', '/uts/uts-bilgi-guncelleme/': 'ÜTS Bilgi Güncelleme', '/uts/tibbi-cihaz-uts-gecisi/': 'Tıbbi Cihaz ÜTS Geçişi',
  '/tibbi-cihaz/firma-kaydi/': 'Firma Kaydı', '/tibbi-cihaz/firma-bilgileri-guncelleme/': 'Firma Bilgileri Güncelleme', '/tibbi-cihaz/ubb-e-imza/': 'UBB E-İmza', '/tibbi-cihaz/tibbi-cihaz-belge-kaydi/': 'Tıbbi Cihaz Belge Kaydı', '/tibbi-cihaz/etiket-duzenleme/': 'Etiket Düzenleme',
  '/saglik-bakanligi-islemleri/ilac-ruhsatlandirma/': 'İlaç Ruhsatlandırma', '/saglik-bakanligi-islemleri/ilac-varyasyon/': 'İlaç Varyasyon', '/saglik-bakanligi-islemleri/ilac-fiyatlandirma/': 'İlaç Fiyatlandırma', '/saglik-bakanligi-islemleri/biyosidal-ruhsatlandirma/': 'Biyosidal Ruhsatlandırma', '/saglik-bakanligi-islemleri/gmp-basvurusu/': 'GMP Başvurusu', '/saglik-bakanligi-islemleri/kub-kt/': 'KÜB/KT', '/saglik-bakanligi-islemleri/okunabilirlik-testi/': 'Okunabilirlik Testi',
  '/diger-hizmetler/permi-belgesi/': 'Permi Belgesi', '/diger-hizmetler/ce-teknik-dosya-hazirlanmasi/': 'CE Teknik Dosya Hazırlanması', '/diger-hizmetler/takviye-edici-gida/': 'Takviye Edici Gıda', '/diger-hizmetler/kontrol-belgesi/': 'Kontrol Belgesi',
  '/ariza-ve-onarim/': 'Arıza ve Onarım', '/periyodik-bakim/': 'Periyodik Bakım', '/kalibrasyon/': 'Kalibrasyon',
};
const BLOG = ['/eroin-bagimliligi/', '/eroin-nedir/', '/opiatlar-nedir/', '/kokain-bagimliligi-tedavisi/', '/uyusturucu-testi-nedir/', '/kokain-bagimliligi/', '/uyarici-madde-nedir/', '/esrar-bagimliligi-tedavisi/', '/esrar-bagimliligi/', '/esrar-nedir/', '/trafik-guvenligini-tehlikeye-sokma-sucu/', '/alkolmetre-nedir/', '/uyusturucu-madde-testi/', '/promil-nedir/', '/kokain-nedir/', '/ergenlerde-uyusturucu-kullanimi/', '/alkol-bagimliligi/', '/madde-bagimliligi-nedir/', '/madde-bagimliligi-tedavisi/', '/alkollu-arac-kullanmak/', '/ekstazi-nedir/', '/metamfetamin-nedir/', '/amfetamin-nedir/'];
const KURUMSAL = ['/hakkimizda/', '/hizmet-politikamiz/', '/kalite-politikamiz/', '/kariyer/', '/bilgi/'];
// Elle yazılan sayfalar (üretici dokunmaz, yalnız meta üretir)
const ELLE = ['/', '/iletisim/', '/hizmetler/', '/danismanlik/', '/ilac/', '/uts/', '/tibbi-cihaz/', '/saglik-bakanligi-islemleri/', '/diger-hizmetler/', '/blog/', '/category/saglik/'];
const ALL = [...ELLE, ...KURUMSAL, ...SERVIS.alt, ...HUBS.flatMap((h) => h.alt), ...BLOG];

// Üst sayfa (breadcrumb)
const UST = {};
HUBS.forEach((h) => { UST[h.yol] = '/danismanlik/'; h.alt.forEach((a) => (UST[a] = h.yol)); });
SERVIS.alt.forEach((a) => (UST[a] = '/hizmetler/'));
BLOG.forEach((b) => (UST[b] = '/blog/'));
UST['/category/saglik/'] = '/blog/'; UST['/ilac/'] = '/danismanlik/'; // /diger/ → /diger-hizmetler/ 301 (.htaccess)

// ---------- Metin yardımcıları ----------
const LOREM = /Phosfluorescently|Interactively|Completely synergize|Efficiently unleash|Appropriately empower|Distinctively re-engineer|Credibly reintermediate/;
const DECO = /bgn-|floater-|white-curve|blue-curve|corner|\/2017\/04\/|logs\.png|img-consultancy-excellence|img-first-class|img-about-us|egefeback|provega/;
const esc = (s) => String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
const phpq = (s) => "'" + String(s).replace(/\\/g, '\\\\').replace(/'/g, "\\'") + "'";
const bigVariant = (u) => u.replace(/-\d{2,4}x\d{2,4}(?=\.(jpe?g|png|webp|gif)$)/i, '');
const localImg = (u) => { const m = bigVariant(u || '').match(/wp-content\/uploads\/(.+)$/); if (!m) return null; let r = m[1]; try { r = decodeURIComponent(r); } catch {} return '/wp-content/uploads/' + r.normalize('NFD'); };
const imgUrl = (li) => encodeURI(li); // HTML'de yüzde kodlu (canlıdaki URL ile birebir)
const srcFile = (li) => { const rel = li.replace('/wp-content/uploads/', ''); for (const c of [rel, rel.normalize('NFC'), encodeURI(rel)]) { const f = path.join(K, 'img', 'uploads', c); if (fss.existsSync(f)) return f; } return null; };
const usedImgs = new Set();
const known = new Set(ALL);
const stripTitle = (t) => t.replace(/\s+-\s+Egefe Sağlık Bilişim A\.Ş\.$/, '').trim();
const plain = (h) => h.replace(/<[^>]+>/g, '').replace(/&amp;/g, '&').replace(/&lt;/g, '<').replace(/&quot;/g, '"').replace(/\s+/g, ' ').trim();
const norm = (s) => s.toLocaleLowerCase('tr').replace(/[^\p{L}\p{N}]+/gu, ' ').trim();

// Kurallı metin düzeltmeleri (kullanıcı kararı: kuruluş yılı 2017)
const FIXES = [
  [/2015 yılında kurulmuştur/g, '2017 yılında kurulmuştur'],
  [/2015 yılından beri/g, '2017 yılından beri'],
  // Onaylı yazım düzeltmeleri (2026-09-30)
  [/Uyuşturu Madde/g, 'Uyuşturucu Madde'],
  [/birimkimlerini/g, 'birikimlerini'],
  [/edebeceğiniz/g, 'edebileceğiniz'],
  [/orjinal/g, 'orijinal'],
  [/Orjinal/g, 'Orijinal'],
  [/alkometre/g, 'alkolmetre'],
  [/bir çok örnek/g, 'birçok örnek'],
  [/olan yada olmayan/g, 'olan ya da olmayan'],
  [/Firma kayıdı/g, 'Firma kaydı'],
  [/firma , bu/g, 'firma, bu'],
  [/firmaların,Türkiye/g, 'firmaların, Türkiye'],
  [/kopyası,konsolosluk/g, 'kopyası, konsolosluk'],
  [/kaynaklanmaktadır\.İlaçla/g, 'kaynaklanmaktadır. İlaçla'],
  [/İlaç,CTD/g, 'İlaç, CTD'],
  [/türedi:methyl/g, 'türedi: methyl'],
  [/bilgi içeriği içeriği/g, 'bilgi içeriği'],
  // Revizyon 2 (kullanıcı kararı, 2026-09-30)
  [/NAM-17/g, 'NAM-19'],
  [/Lütfen online mağazamıza giriş yaparak görüntüleyebilir ve sipariş verebilirsiniz\./g, 'Teklif almak için <a href="/iletisim/#form">bizimle iletişime geçebilirsiniz</a>.'],
  [/^Evet\. Web sitemizden online olarak sipariş verebilirsiniz\.$/g, 'Evet. Teklif almak için <a href="/iletisim/#form">bizimle iletişime geçebilirsiniz</a>.'],
  [/^Tarafımıza ulaşan cihazların seri numarası ve kurum iletişim bilgilerine göre destek\.ege-fe\.com adresine kayıtları yapılarak cihazınızın sürecini ve faturalarınızı anlık olarak görebilirsiniz\.$/g,
    'Teknik servise gönderdiğiniz cihazın durumunu öğrenmek için cihazın seri numarası ve kurum iletişim bilgilerinizle <a href="mailto:servis@ege-fe.com">servis@ege-fe.com</a> adresine e-posta gönderebilirsiniz.'],
];
// Kaldırılacak SSS maddeleri (kullanıcı kararı: NAM-07/NAM-19 kalibrasyon süre ve ücret bilgisi gösterilmeyecek)
const SIL_SSS = /^(Kalibrasyon (süresi|ücreti) ne kadardır|NAM-07 ve NAM-19 cihazları arasındaki farklar nelerdir)\?$/;
const applyFixes = (s) => FIXES.reduce((a, [re, to]) => a.replace(re, to), s);

// Link yeniden yazımı: iç linkler göreli + sonda /, provega/ürün/mağaza/yazar linkleri kaldırılır (metin kalır)
const linkLog = [];
function fixLinks(html, from) {
  return html.replace(/<a href="([^"]*)">([\s\S]*?)<\/a>/g, (m, href, inner) => {
    let u;
    try { u = new URL(href, 'https://ege-fe.com/'); } catch { return inner; }
    if (/provega/.test(u.hostname) || /^\/(urun|urun-kategori|magaza|sepet|hesabim|odeme|author)\b/.test(u.pathname) && /ege-fe\.com$/.test(u.hostname)) { linkLog.push([from, 'kaldırıldı', href]); return inner; }
    if (/(^|\.)ege-fe\.com$/.test(u.hostname)) {
      let p = u.pathname; if (!p.endsWith('/') && !/\.\w+$/.test(p)) p += '/';
      if (!known.has(p)) linkLog.push([from, 'bilinmeyen iç link', href]);
      return `<a href="${p}${u.hash || ''}">${inner}</a>`;
    }
    if (/^(mailto|tel):/.test(href)) return `<a href="${href}">${inner}</a>`;
    return `<a href="${esc(u.href)}" target="_blank" rel="noopener">${inner}</a>`;
  });
}

// ---------- Blok → HTML ----------
function render(blocks, { h1, from, firstImgSkip }) {
  const out = [];
  const seenImg = new Set(firstImgSkip ? [firstImgSkip] : []);
  let cards = [];
  let faqOpen = false;
  const flushCards = () => {
    if (!cards.length) return;
    out.push('<div class="kartlar">' + cards.map((c) => {
      const href = c.href && !/^#?$/.test(c.href) ? fixLinks(`<a href="${c.href}">x</a>`, from).match(/href="([^"]*)"/)?.[1] : null;
      const body = c.text && c.text !== c.title ? `<p>${esc(applyFixes(c.text.replace(c.title, '').trim()))}</p>` : '';
      const inner = `<h3>${esc(applyFixes(c.title))}</h3>${body}`;
      return href && !/provega/.test(c.href) ? `<a class="kart" href="${href}">${inner}</a>` : `<div class="kart">${inner}</div>`;
    }).join('') + '</div>');
    cards = [];
  };
  const closeFaq = () => { if (faqOpen) { out.push('</div></details>'); faqOpen = false; } };
  let lastH = '';
  let atla = false;
  const gorulenSss = new Set();
  for (const b of blocks) {
    if (b.t === 'h') {
      const q = b.text.replace(/\s+/g, ' ').trim();
      atla = !!(b.faq && (SIL_SSS.test(q) || gorulenSss.has(q))); // tekrar eden SSS maddesi de atlanır
      if (b.faq) gorulenSss.add(q);
    }
    if (atla) continue;
    if (b.t !== 'card') flushCards();
    if (b.t === 'h') {
      const text = b.text.replace(/\s+/g, ' ').trim();
      if (b.faq) { closeFaq(); out.push(`<details class="sss"><summary>${esc(text)}</summary><div class="sss-icerik">`); faqOpen = true; continue; }
      if (norm(text) === norm(h1) && out.length < 3) continue; // sayfa adıyla aynı ilk başlık → H1 zaten var
      if (/^Bize Ulaşın$/i.test(text)) continue;
      if (norm(text) === lastH) continue;
      lastH = norm(text);
      const lv = b.lv <= 2 ? 2 : b.lv === 3 ? 3 : 4;
      out.push(`<h${lv}>${esc(applyFixes(text))}</h${lv}>`);
    } else if (b.t === 'p') {
      const h = fixLinks(applyFixes(b.html), from);
      out.push(b.sub ? `<p class="giris">${h}</p>` : `<p>${h}</p>`);
    } else if (b.t === 'ul' || b.t === 'ol') {
      const items = b.items.filter((i) => plain(i) && !/^\d+$/.test(plain(i)) && !/^(Terrain|Labels|Satellite|Map)$/.test(plain(i)));
      if (items.length) out.push(`<${b.t}>${items.map((i) => `<li>${fixLinks(applyFixes(i), from)}</li>`).join('')}</${b.t}>`);
    } else if (b.t === 'quote') out.push(`<blockquote><p>${fixLinks(b.html, from)}</p></blockquote>`);
    else if (b.t === 'table') {
      if (b.rows.flat().some((c) => /Move left|Zoom in/.test(c))) continue; // Google Maps kısayol tablosu
      const rows = b.rows.filter((r) => r.some((c) => plain(c)));
      if (rows.length) out.push('<div class="tablo"><table>' + rows.map((r) => '<tr>' + r.map((c) => `<td>${fixLinks(c, from)}</td>`).join('') + '</tr>').join('') + '</table></div>');
    } else if (b.t === 'img') {
      if (!b.src || DECO.test(b.src)) continue;
      const li = localImg(b.src); if (!li || seenImg.has(li)) continue; seenImg.add(li); usedImgs.add(li);
      out.push(`<figure class="gorsel"><img src="${imgUrl(li)}" alt="${esc(b.alt || h1)}" loading="lazy" decoding="async"${dims(li)}>${b.cap ? `<figcaption>${esc(b.cap)}</figcaption>` : ''}</figure>`);
    } else if (b.t === 'card') {
      if (/^(Merkez|AR-GE Ofis|E-?posta|Telefon|Adres)$/i.test(b.title) || /info@|^\+90|Teknopark|Mahallesi/.test(b.title + ' ' + b.text)) continue; // eski iletişim kartları (güncel bilgi footer/iletişimde)
      cards.push(b);
    } else if (b.t === 'btn') {
      if (!b.href || /^#?$/.test(b.href) || /urun|provega|magaza/.test(b.href) || /purchase/i.test(b.text)) continue;
      const h = fixLinks(`<a href="${b.href}">${esc(b.text)}</a>`, from).replace('<a ', '<a class="dugme dugme-ikincil" ');
      out.push(`<p>${h}</p>`);
    }
  }
  flushCards(); closeFaq();
  return out.join('\n');
}

// Görsel boyutları (CLS için)
function dims(li) {
  try {
    const buf = fss.readFileSync(srcFile(li));
    if (buf[0] === 0x89) return ` width="${buf.readUInt32BE(16)}" height="${buf.readUInt32BE(20)}"`;
    let i = 2; while (i < buf.length) { if (buf[i] !== 0xff) break; const mk = buf[i + 1], len = buf.readUInt16BE(i + 2); if (mk >= 0xc0 && mk <= 0xc3) return ` width="${buf.readUInt16BE(i + 7)}" height="${buf.readUInt16BE(i + 5)}"`; i += 2 + len; }
  } catch {}
  return '';
}

// Özet: sayfanın kendi metninden ilk anlamlı paragraf(lar), kelime sınırında kesilir
function ozet(blocks, max = 155) {
  const ps = blocks.filter((b) => b.t === 'p' || b.t === 'ul' || b.t === 'ol').map((b) => plain(applyFixes(b.html || b.items.join('. '))))
    .filter((t) => t.length > 25 && !LOREM.test(t) && !/^(Sayın Yetkili|Danışmanlık ve bilgi için)/.test(t));
  let s = '';
  for (const p of ps) { s = s ? s + ' ' + p : p; if (s.length >= 110) break; }
  if (s.length <= max) return s;
  const cut = s.slice(0, max); const dot = cut.lastIndexOf('. ');
  if (dot > 90) return cut.slice(0, dot + 1);
  return cut.slice(0, cut.lastIndexOf(' ')).replace(/[,;:(\-–]+$/, '') + '…';
}

// ---------- Meta verisi ----------
const TR_AY = ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'];
const trDate = (iso) => { const d = new Date(iso); return `${d.getUTCDate()} ${TR_AY[d.getUTCMonth()]} ${d.getUTCFullYear()}`; };
const meta = {}; const descLog = [];
// Hub ve elle kurulan sayfalar için yeni yazılmış giriş metinleri (kullanıcı onayına sunulacak) — sayfalarda da aynı metin kullanılır
const DESC_DUZELT = JSON.parse(fss.readFileSync(path.resolve('tools/description-duzelt.json'), 'utf8'));
const HUB_GIRIS = JSON.parse(fss.readFileSync(path.resolve('tools/hub-giris.json'), 'utf8'));

for (const p of ALL) {
  const d = J(nameOf(p));
  const blocks = B(nameOf(p));
  const h1raw = d.headings.find((h) => h.inMain && h.tag === 'h1')?.text;
  let h1 = stripTitle(d.title);
  if (p === '/category/saglik/') h1 = 'Sağlık';
  if (BLOG.includes(p) && h1raw) h1 = h1raw.replace(/\s+/g, ' ').trim();
  let desc = applyFixes(d.description || '');
  let descKaynak = 'canlı';
  if (LOREM.test(desc) || /[A-Za-z]+ly [a-z]+ [a-z]+/.test(desc) && !/[ğüşıöçĞÜŞİÖÇ]/.test(desc)) {
    if (DESC_DUZELT[p]) { desc = DESC_DUZELT[p].aciklama; descKaynak = DESC_DUZELT[p].kaynak; }
    else if (HUB_GIRIS[p]) { desc = HUB_GIRIS[p].aciklama; descKaynak = HUB_GIRIS[p].kaynak; }
    else { desc = ozet(blocks); descKaynak = 'sayfa metninden'; }
    descLog.push({ yol: p, eski: d.description, yeni: desc, kaynak: descKaynak });
  }
  const og = localImg(d.og['og:image'] || '') ;
  if (og) usedImgs.add(og);
  meta[p] = {
    title: d.title, desc, h1, ust: UST[p] || null,
    og: og || '/wp-content/uploads/2022/01/faceb.jpg',
    ogType: BLOG.includes(p) ? 'article' : 'website',
    yayin: d.og['article:published_time'] || null, guncel: d.og['article:modified_time'] || null,
  };
}
usedImgs.add('/wp-content/uploads/2022/01/faceb.jpg');
meta['/kvkk/'] = { title: 'KVKK Aydınlatma Metni - Egefe Sağlık Bilişim A.Ş.', desc: '6698 sayılı KVKK kapsamında Egefe Bilişim Sağlık San. ve Tic. A.Ş. tarafından web sitesi formları aracılığıyla işlenen kişisel verilere ilişkin aydınlatma metni.', h1: 'KVKK Aydınlatma Metni', ust: null, og: '/wp-content/uploads/2022/01/faceb.jpg', ogType: 'website', yasal: true };
meta['/gizlilik-politikasi/'] = { title: 'Gizlilik ve Çerez Politikası - Egefe Sağlık Bilişim A.Ş.', desc: 'ege-fe.com gizlilik ve çerez politikası: toplanan veriler, kullanım amaçları, çerezler, saklama, üçüncü taraflar ve haklarınız.', h1: 'Gizlilik ve Çerez Politikası', ust: null, og: '/wp-content/uploads/2022/01/faceb.jpg', ogType: 'website', yasal: true };
meta['/404/'] = { title: 'Sayfa Bulunamadı - Egefe Sağlık Bilişim A.Ş.', desc: '', h1: 'Sayfa bulunamadı', ust: null, og: '/wp-content/uploads/2022/01/faceb.jpg', ogType: 'website', noindex: true };

// ---------- PHP veri dosyaları ----------
const phpArr = (o, ind = '  ') => {
  if (o === null || o === undefined) return 'null';
  if (typeof o === 'boolean') return o ? 'true' : 'false';
  if (typeof o === 'number') return String(o);
  if (typeof o === 'string') return phpq(o);
  if (Array.isArray(o)) return '[' + o.map((x) => phpArr(x, ind + '  ')).join(', ') + ']';
  return '[\n' + Object.entries(o).map(([k, v]) => `${ind}${phpq(k)} => ${phpArr(v, ind + '  ')},`).join('\n') + `\n${ind.slice(2)}]`;
};
const hdr = '<?php\n// ÜRETİLDİ: tools/build.mjs — elle düzenlemeler bir sonraki üretimde ezilir (açıklamalar hariç: bkz. inc/meta.php başı)\n';
await fs.mkdir(path.join(S, 'inc'), { recursive: true });
await fs.writeFile(path.join(S, 'inc', 'meta.php'), hdr + 'return ' + phpArr(meta) + ';\n');

// Hizmet verisi (menü, hub kartları, kenar çubuğu)
const hizmetOzet = (p) => ozet(B(nameOf(p)), 150);
const hizmetler = {
  servis: { yol: SERVIS.yol, ad: 'Hizmetler', alt: SERVIS.alt.map((a) => ({ yol: a, ad: MENU_AD[a], ozet: hizmetOzet(a) })) },
  danismanlik: HUBS.map((h) => ({ yol: h.yol, ad: h.ad, giris: HUB_GIRIS[h.yol]?.kisa || '', alt: h.alt.map((a) => ({ yol: a, ad: MENU_AD[a], ozet: hizmetOzet(a) })) })),
  ilac: ILAC_ALT,
};
await fs.writeFile(path.join(S, 'inc', 'hizmetler.php'), hdr + 'return ' + phpArr(hizmetler) + ';\n');

await fs.writeFile(path.join(S, 'inc', 'hub-giris.php'), hdr + 'return ' + phpArr(Object.fromEntries(Object.entries(HUB_GIRIS).map(([k, v]) => [k, v.giris]))) + ';\n');

// Blog verisi (yeniden eskiye)
const posts = BLOG.map((p) => {
  const d = J(nameOf(p));
  return { yol: p, baslik: meta[p].h1, tarih: d.og['article:published_time'], tarihTr: trDate(d.og['article:published_time']), gorsel: meta[p].og, ozet: ozet(B(nameOf(p)), 170), kategori: 'Sağlık' };
}).sort((a, b) => b.tarih.localeCompare(a.tarih));
await fs.writeFile(path.join(S, 'inc', 'blog.php'), hdr + 'return ' + phpArr(posts) + ';\n');

// ---------- Sayfa dosyaları ----------
const depth = (p) => p.split('/').filter(Boolean).length;
const req = (p, f) => `require __DIR__ . '${'/..'.repeat(depth(p))}/inc/${f}';`;
async function writePage(p, body, extra = {}) {
  const dir = path.join(S, ...p.split('/').filter(Boolean));
  await fs.mkdir(dir, { recursive: true });
  const opts = Object.keys(extra).length ? `$sayfa = ${phpArr(extra)};\n` : '';
  const src = `<?php\n// ÜRETİLDİ: tools/build.mjs\n$yol = ${phpq(p)};\n${opts}${req(p, 'header.php')}\n?>\n${body}\n<?php ${req(p, 'footer.php')} ?>\n`;
  await fs.writeFile(path.join(dir, 'index.php'), src);
}

// Kurumsal + hizmet alt sayfaları
for (const p of [...KURUMSAL, ...SERVIS.alt, ...HUBS.flatMap((h) => h.alt)]) {
  const blocks = B(nameOf(p));
  const isHizmet = !KURUMSAL.includes(p);
  // hizmet sayfalarında banner görseli ayrı gösterilir
  const banner = isHizmet ? blocks.find((b) => b.t === 'img' && b.src && !DECO.test(b.src)) : null;
  const bannerLocal = banner ? localImg(banner.src) : null;
  if (bannerLocal) usedImgs.add(bannerLocal);
  const html = render(blocks, { h1: meta[p].h1, from: p, firstImgSkip: bannerLocal });
  let body;
  if (isHizmet) {
    const hub = HUBS.find((h) => h.alt.includes(p)) || SERVIS;
    body = `<div class="kap icerik-duzen">
  <article class="metin">
${bannerLocal ? `    <figure class="banner"><img src="${imgUrl(bannerLocal)}" alt="${esc(meta[p].h1)}"${dims(bannerLocal)} decoding="async"></figure>\n` : ''}${html}
  </article>
  <?php $hub = ${phpq(hub.yol)}; require __DIR__ . '${'/..'.repeat(depth(p))}/inc/kenar-hizmet.php'; ?>
</div>
<?php require __DIR__ . '${'/..'.repeat(depth(p))}/inc/cta.php'; ?>`;
  } else {
    body = `<div class="kap kap-dar">\n  <article class="metin">\n${html}\n  </article>\n</div>`;
    if (p === '/hakkimizda/') body += `\n<?php require __DIR__ . '/../inc/bize-ulasin.php'; ?>`;
    else if (p === '/kariyer/') body += `\n<?php require __DIR__ . '/../inc/form-kariyer.php'; ?>`;
    else body += `\n<?php require __DIR__ . '/../inc/cta.php'; ?>`;
  }
  await writePage(p, body);
}

// Blog yazıları
for (let i = 0; i < posts.length; i++) {
  const post = posts[i]; const p = post.yol;
  const html = render(B(nameOf(p)), { h1: meta[p].h1, from: p, firstImgSkip: post.gorsel });
  const onceki = posts[i + 1], sonraki = posts[i - 1];
  const body = `<div class="kap kap-dar">
  <article class="metin yazi">
    <p class="yazi-bilgi"><time datetime="${post.tarih.slice(0, 10)}">${post.tarihTr}</time> · <a href="/category/saglik/">Sağlık</a></p>
    <figure class="banner"><img src="${imgUrl(post.gorsel)}" alt="${esc(post.baslik)}"${dims(post.gorsel)} decoding="async"></figure>
${html}
  </article>
  <nav class="yazi-gezinme" aria-label="Diğer yazılar">
    ${onceki ? `<a class="onceki" href="${onceki.yol}"><span>Önceki yazı</span>${esc(onceki.baslik)}</a>` : '<span></span>'}
    ${sonraki ? `<a class="sonraki" href="${sonraki.yol}"><span>Sonraki yazı</span>${esc(sonraki.baslik)}</a>` : '<span></span>'}
  </nav>
</div>
<?php require __DIR__ . '/../inc/cta.php'; ?>`;
  await writePage(p, body);
}

// ---------- Görselleri kopyala ----------
let kop = 0, eksik = [];
for (const li of usedImgs) {
  const src = srcFile(li);
  const dst = path.join(S, li);
  if (!src) { eksik.push(li); continue; }
  await fs.mkdir(path.dirname(dst), { recursive: true });
  await fs.copyFile(src, dst); kop++;
}

// ---------- sitemap.xml ----------
const lastmod = (p) => (meta[p].guncel || meta[p].yayin || new Date().toISOString()).slice(0, 10);
const smPaths = [...ALL.filter((p) => !meta[p].noindex), '/kvkk/', '/gizlilik-politikasi/'];
const sm = `<?xml version="1.0" encoding="UTF-8"?>\n<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">\n` +
  smPaths.map((p) => `  <url><loc>https://ege-fe.com${p}</loc><lastmod>${lastmod(p)}</lastmod></url>`).join('\n') + '\n</urlset>\n';
await fs.writeFile(path.join(S, 'sitemap.xml'), sm);

await fs.writeFile(path.join(K, 'description-degisiklikleri.json'), JSON.stringify(descLog, null, 2));
await fs.writeFile(path.join(K, 'link-degisiklikleri.json'), JSON.stringify(linkLog, null, 2));
console.log(`meta ${Object.keys(meta).length} · sayfa üretildi ${KURUMSAL.length + SERVIS.alt.length + HUBS.flatMap((h) => h.alt).length + posts.length} · görsel ${kop} kopyalandı · eksik ${eksik.length} ${eksik.join(' ')} · yeni description ${descLog.length} · link değişikliği ${linkLog.length} · sitemap ${smPaths.length} URL`);
