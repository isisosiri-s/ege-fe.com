// Yerel önizlemeyi doğrular: node tools/check.mjs [http://localhost:8080]
import { chromium } from 'playwright';
import fs from 'node:fs/promises';

const BASE = process.argv[2] || 'http://localhost:8080';
const sm = await fs.readFile('site/sitemap.xml', 'utf8');
const paths = [...sm.matchAll(/<loc>https:\/\/ege-fe\.com([^<]+)<\/loc>/g)].map((m) => m[1]);
const extra = ['/olmayan-sayfa/'];
const live = {};
for (const f of await fs.readdir('kaynak/json')) { const d = JSON.parse(await fs.readFile('kaynak/json/' + f, 'utf8')); live[new URL(d.url).pathname] = d; }

const browser = await chromium.launch();
const ctx = await browser.newContext({ viewport: { width: 1366, height: 900 } });
const sorun = []; const linkler = new Set(); const kaynaklar = new Set();
for (const p of [...paths, ...extra]) {
  const page = await ctx.newPage();
  const hatalar = [];
  page.on('console', (m) => m.type() === 'error' && hatalar.push(m.text()));
  page.on('pageerror', (e) => hatalar.push(e.message));
  const r = await page.goto(BASE + p, { waitUntil: 'load' });
  await page.evaluate(async () => { for (let y = 0; y <= document.body.scrollHeight; y += 500) { window.scrollTo(0, y); await new Promise((r) => setTimeout(r, 40)); } });
  await page.waitForLoadState('networkidle').catch(() => {});
  const d = await page.evaluate(() => ({
    title: document.title, desc: document.querySelector('meta[name=description]')?.content || '',
    canonical: document.querySelector('link[rel=canonical]')?.href, robots: document.querySelector('meta[name=robots]')?.content,
    h1: [...document.querySelectorAll('h1')].map((h) => h.innerText.trim()),
    links: [...document.querySelectorAll('a[href]')].map((a) => a.getAttribute('href')),
    imgs: [...document.querySelectorAll('img')].map((i) => ({ src: i.getAttribute('src'), ok: i.complete && i.naturalWidth > 0 })),
    html: document.documentElement.outerHTML,
    yatayTasma: document.documentElement.scrollWidth > window.innerWidth,
  }));
  const beklenen = p === '/olmayan-sayfa/' ? 404 : 200;
  if (r.status() !== beklenen) sorun.push([p, 'HTTP ' + r.status()]);
  if (d.h1.length !== 1) sorun.push([p, `${d.h1.length} H1: ${d.h1.join(' | ')}`]);
  const L = live[p];
  if (L && L.title !== d.title) sorun.push([p, `title farklı: "${d.title}" ≠ canlı "${L.title}"`]);
  if (L && L.canonical && L.canonical !== d.canonical) sorun.push([p, `canonical farklı: ${d.canonical} ≠ ${L.canonical}`]);
  if (/Phosfluorescently|Interactively|synergize|provega|\/urun\/|\/magaza|\/sepet|\/hesabim|Kategorisiz|facebook\.com|twitter\.com|Harbiye|Copyright by|No: ?1[78]|googleapis|gstatic|<iframe|\[[^\]<>"']{3,40}\]|Uyuşturu |birimkim|edebeceğ|orjinal|Fark-1/i.test(d.html.replace(/<!--[\s\S]*?-->/g, ''))) {
    const m = d.html.replace(/<!--[\s\S]*?-->/g, '').match(/Phosfluorescently|Interactively|synergize|provega|\/urun\/|\/magaza|\/sepet|\/hesabim|Kategorisiz|facebook\.com|twitter\.com|Harbiye|Copyright by|No: ?1[78]|googleapis|gstatic|<iframe|\[[^\]<>"']{3,40}\]|Uyuşturu |birimkim|edebeceğ|orjinal|Fark-1/i);
    sorun.push([p, 'yasaklı iz: ' + m[0]]);
  }
  if (!/noindex/.test(d.robots) && !d.desc && p !== '/category/saglik/') sorun.push([p, 'description yok']);
  d.imgs.filter((i) => !i.ok).forEach((i) => sorun.push([p, 'görsel yüklenmedi: ' + i.src]));
  d.links.filter((h) => h.startsWith('/')).forEach((h) => linkler.add(h.split('#')[0]));
  d.imgs.forEach((i) => kaynaklar.add(i.src));
  if (d.yatayTasma) sorun.push([p, 'yatay taşma (masaüstü)']);
  hatalar.filter((h) => !/maps|google|ERR_BLOCKED|favicon/i.test(h) && !(p === '/olmayan-sayfa/' && /404/.test(h))).forEach((h) => sorun.push([p, 'konsol: ' + h.slice(0, 120)]));
  await page.close();
}
// iç link kontrolü
const req = ctx.request;
for (const l of linkler) { const r = await req.get(BASE + l, { maxRedirects: 0 }); if (r.status() >= 400) sorun.push(['link', `${l} → ${r.status()}`]); else if (r.status() >= 300) sorun.push(['link', `${l} → yönlendirme ${r.status()} ${r.headers().location}`]); }
// mobil yatay taşma
const mob = await browser.newContext({ viewport: { width: 375, height: 800 }, isMobile: true });
for (const p of paths) { const pg = await mob.newPage(); await pg.goto(BASE + p); if (await pg.evaluate(() => document.documentElement.scrollWidth > window.innerWidth + 1)) sorun.push([p, 'yatay taşma (mobil)']); await pg.close(); }
await browser.close();
console.log(`${paths.length + extra.length} sayfa, ${linkler.size} iç link, ${kaynaklar.size} görsel kontrol edildi.`);
console.log(sorun.length ? sorun.map((s) => s.join(' → ')).join('\n') : 'SORUN YOK');
