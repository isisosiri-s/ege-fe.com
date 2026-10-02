// Sosyal medya / WhatsApp paylaşım görseli (og:image) üretir: site/img/paylasim.jpg (1200×630).
// Kullanım: node tools/paylasim.mjs   (sitenin kendi fontları, logosu ve fotoğrafıyla; dış kaynak yok)
// Metin değişirse bu dosyayı düzenleyip yeniden çalıştırın.
import fs from 'node:fs';
import path from 'node:path';
import { pathToFileURL } from 'node:url';
import { chromium } from 'playwright';

const S = path.resolve('site');
// Danışmanlık açık/kapalı: site/inc/config.php → DANISMANLIK_AKTIF (pasifken görselde danışmanlık geçmez)
const DAN_AKTIF = /define('DANISMANLIK_AKTIF',s*true)/.test(fs.readFileSync(path.join(S, 'inc', 'config.php'), 'utf8'));
const baslik = DAN_AKTIF ? 'Alkolmetre ve <em>sağlık danışmanlığı</em>' : 'Alkolmetrede <em>yetkili satış ve servis</em>';
const altMetin = DAN_AKTIF ? 'Satış, periyodik bakım ve kalibrasyon · ÜTS, tıbbi cihaz ve Sağlık Bakanlığı işlemleri' : 'Satış, periyodik bakım ve kalibrasyon · NAM-07, NAM-19, NAM-E30 ve NAM-E30C alkolmetreler';
const dosya = (p) => pathToFileURL(path.join(S, p)).href;

const html = `<!doctype html><html lang="tr"><head><meta charset="utf-8"><style>
@font-face { font-family: 'DM Serif Display'; font-style: normal; src: url(${dosya('fonts/dm-serif-display-latin-3.woff2')}) format('woff2'); unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F; }
@font-face { font-family: 'DM Serif Display'; font-style: normal; src: url(${dosya('fonts/dm-serif-display-latin-ext-2.woff2')}) format('woff2'); unicode-range: U+0100-02BA, U+1E00-1EFF; }
@font-face { font-family: 'DM Serif Display'; font-style: italic; src: url(${dosya('fonts/dm-serif-display-italic-latin-1.woff2')}) format('woff2'); unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+2000-206F; }
@font-face { font-family: 'DM Serif Display'; font-style: italic; src: url(${dosya('fonts/dm-serif-display-italic-latin-ext-0.woff2')}) format('woff2'); unicode-range: U+0100-02BA, U+1E00-1EFF; }
@font-face { font-family: 'Nunito Sans'; font-weight: 200 1000; src: url(${dosya('fonts/nunito-sans-latin-5.woff2')}) format('woff2'); unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+2000-206F; }
@font-face { font-family: 'Nunito Sans'; font-weight: 200 1000; src: url(${dosya('fonts/nunito-sans-latin-ext-4.woff2')}) format('woff2'); unicode-range: U+0100-02BA, U+1E00-1EFF; }
* { box-sizing: border-box; margin: 0; }
body { width: 1200px; height: 630px; overflow: hidden; font-family: 'Nunito Sans', sans-serif; color: #fff;
  background:
    radial-gradient(ellipse 55% 80% at 0% 100%, rgba(58,168,193,.30) 0%, transparent 60%),
    radial-gradient(ellipse 50% 60% at 40% 0%, rgba(255,255,255,.06) 0%, transparent 60%),
    linear-gradient(150deg, #0e5266 0%, #0f5c72 55%, #1d7d95 100%); }
.foto { position: absolute; top: 0; right: 0; width: 560px; height: 630px; background: url(${dosya('img/urun/nam19-saha.webp')}) 38% center / cover; -webkit-mask-image: linear-gradient(90deg, transparent 0%, #000 42%); mask-image: linear-gradient(90deg, transparent 0%, #000 42%); }
.foto::before { content: ""; position: absolute; inset: 0; background: #0e5266; mix-blend-mode: multiply; opacity: .25; }
.metin { position: absolute; left: 72px; top: 64px; width: 660px; }
.logo { height: 96px; display: block; margin-bottom: 40px; }
.etiket { font-size: 17px; font-weight: 800; letter-spacing: .16em; text-transform: uppercase; color: #3aa8c1; display: flex; align-items: center; gap: 14px; margin-bottom: 18px; }
.etiket::before { content: ""; width: 36px; height: 3px; background: #3aa8c1; }
h1 { font-family: 'DM Serif Display', serif; font-weight: 400; font-size: 70px; line-height: 1.04; letter-spacing: -.03em; }
h1 em { color: #8fd3e2; }
.alt { margin-top: 26px; font-size: 24px; line-height: 1.45; color: rgba(255,255,255,.86); }
.adres { position: absolute; left: 72px; bottom: 52px; font-size: 22px; font-weight: 800; letter-spacing: .02em; color: #fff; display: flex; align-items: center; gap: 12px; }
.adres span { width: 10px; height: 10px; border-radius: 50%; background: #3aa8c1; }
</style></head><body>
<div class="foto"></div>
<div class="metin">
  <img class="logo" src="${dosya('img/logo-koyu.png')}" alt="">
  <p class="etiket">Armas Elektronik Yetkili Bayi ve Servisi</p>
  <h1>${baslik}</h1>
  <p class="alt">${altMetin}</p>
</div>
<p class="adres"><span></span>ege-fe.com</p>
</body></html>`;

const gecici = path.join(S, '..', 'tools', '.paylasim-gecici.html');
fs.writeFileSync(gecici, html);
const tarayici = await chromium.launch();
const sekme = await tarayici.newPage({ viewport: { width: 1200, height: 630 } });
await sekme.goto(pathToFileURL(gecici).href, { waitUntil: 'load' });
await sekme.evaluate(() => document.fonts.ready);
const hedef = path.join(S, 'img', 'paylasim.jpg');
await sekme.screenshot({ path: hedef, type: 'jpeg', quality: 86 });
await tarayici.close();
fs.unlinkSync(gecici);
console.log('paylaşım görseli:', hedef, Math.round(fs.statSync(hedef).size / 1024) + ' KB');
