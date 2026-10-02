// Sosyal medya / WhatsApp paylaşım görseli (og:image) üretir: site/img/paylasim.jpg (1200×630).
// Kullanım: node tools/paylasim.mjs   (sitenin kendi fontları, logosu ve fotoğrafıyla; dış kaynak yok)
// Metin değişirse bu dosyayı düzenleyip yeniden çalıştırın.
import fs from 'node:fs';
import path from 'node:path';
import { pathToFileURL } from 'node:url';
import { chromium } from 'playwright';

const S = path.resolve('site');
const dosya = (p) => pathToFileURL(path.join(S, p)).href;

const html = `<!doctype html><html lang="tr"><head><meta charset="utf-8"><style>
@font-face { font-family: 'DM Serif Display'; font-style: normal; src: url(${dosya('fonts/dm-serif-display-latin-3.woff2')}) format('woff2'); unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F; }
@font-face { font-family: 'DM Serif Display'; font-style: normal; src: url(${dosya('fonts/dm-serif-display-latin-ext-2.woff2')}) format('woff2'); unicode-range: U+0100-02BA, U+1E00-1EFF; }
@font-face { font-family: 'DM Serif Display'; font-style: italic; src: url(${dosya('fonts/dm-serif-display-italic-latin-1.woff2')}) format('woff2'); unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+2000-206F; }
@font-face { font-family: 'DM Serif Display'; font-style: italic; src: url(${dosya('fonts/dm-serif-display-italic-latin-ext-0.woff2')}) format('woff2'); unicode-range: U+0100-02BA, U+1E00-1EFF; }
@font-face { font-family: 'Nunito Sans'; font-weight: 200 1000; src: url(${dosya('fonts/nunito-sans-latin-5.woff2')}) format('woff2'); unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+2000-206F; }
@font-face { font-family: 'Nunito Sans'; font-weight: 200 1000; src: url(${dosya('fonts/nunito-sans-latin-ext-4.woff2')}) format('woff2'); unicode-range: U+0100-02BA, U+1E00-1EFF; }
* { box-sizing: border-box; margin: 0; }
/* Ortalı yerleşim: WhatsApp küçük önizlemede ortadan kare (630×630) kırpar → logo ve başlık ortadaki karede kalır */
body { width: 1200px; height: 630px; overflow: hidden; font-family: 'Nunito Sans', sans-serif; color: #fff; position: relative;
  background: url(${dosya('img/urun/nam19-saha.webp')}) 60% 40% / cover; }
body::before { content: ""; position: absolute; inset: 0;
  background:
    radial-gradient(ellipse 34% 62% at 50% 50%, rgba(14,82,102,.94) 0%, rgba(14,82,102,.82) 55%, rgba(14,82,102,.55) 100%),
    linear-gradient(150deg, rgba(14,82,102,.80) 0%, rgba(15,92,114,.62) 55%, rgba(29,125,149,.55) 100%); }
.icerik { position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); width: 580px; text-align: center; }
.logo { height: 128px; display: block; margin: 0 auto 24px; }
h1 { font-family: 'DM Serif Display', serif; font-weight: 400; font-size: 64px; line-height: 1.04; letter-spacing: -.03em; }
h1 em { color: #8fd3e2; }
.etiket { margin-top: 24px; font-size: 18px; font-weight: 800; letter-spacing: .16em; text-transform: uppercase; color: #8fd3e2; }
.adres { margin-top: 30px; display: inline-flex; align-items: center; gap: 10px; font-size: 22px; font-weight: 800; padding: 10px 22px; border: 1.5px solid rgba(255,255,255,.45); border-radius: 999px; }
.adres span { width: 9px; height: 9px; border-radius: 50%; background: #3aa8c1; }
</style></head><body>
<div class="icerik">
  <img class="logo" src="${dosya('img/logo-koyu.png')}" alt="">
  <h1>Alkolmetre ve <em>sağlık danışmanlığı</em></h1>
  <p class="etiket">Armas Elektronik Yetkili Bayi ve Servisi</p>
</div>
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
