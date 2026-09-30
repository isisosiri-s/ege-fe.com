// Tam sayfa ekran görüntüsü → "temporary screenshots/screenshot-N[-etiket].png"
// Kullanım: node screenshot.mjs http://localhost:3000[/yol/] [etiket] [--mobil]
// (Projede Puppeteer yerine kurulu olan Playwright kullanılır.)
import { chromium } from 'playwright';
import fs from 'node:fs/promises';

const args = process.argv.slice(2);
const mobil = args.includes('--mobil');
const [url = 'http://localhost:3000', etiket] = args.filter(a => a !== '--mobil');
const DIR = 'temporary screenshots';
await fs.mkdir(DIR, { recursive: true });

const nolar = (await fs.readdir(DIR)).map(f => +(/^screenshot-(\d+)/.exec(f)?.[1] ?? 0));
const n = Math.max(0, ...nolar) + 1;
const dosya = `${DIR}/screenshot-${n}${etiket ? '-' + etiket : ''}.png`;

const b = await chromium.launch();
const c = await b.newContext({ viewport: mobil ? { width: 390, height: 844 } : { width: 1366, height: 900 }, deviceScaleFactor: 1 });
const pg = await c.newPage();
await pg.goto(url, { waitUntil: 'networkidle' });
// Tembel görseller: yavaş kaydır, her adımda görünen görsellerin inmesini bekle
// (php -S tek iş parçacıklı; hepsini birden istemek kuyruğu tıkar)
const yukseklik = await pg.evaluate(() => document.body.scrollHeight);
for (let y = 0; y <= yukseklik; y += 500) {
  await pg.evaluate(y => scrollTo(0, y), y);
  await pg.waitForFunction(() => [...document.images].filter(i => { const r = i.getBoundingClientRect(); return r.bottom > -300 && r.top < innerHeight + 300; }).every(i => i.complete), null, { timeout: 15000 }).catch(() => {});
}
await pg.evaluate(() => scrollTo(0, 0));
await pg.waitForTimeout(800);
await pg.screenshot({ path: dosya, fullPage: true });
await b.close();
console.log(dosya);
