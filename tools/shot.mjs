import { chromium } from 'playwright';
const [out, ...paths] = process.argv.slice(2);
const b = await chromium.launch();
for (const [ad, vp] of [['m', { width: 1366, height: 900 }], ['k', { width: 390, height: 844 }]]) {
  const c = await b.newContext({ viewport: vp, deviceScaleFactor: 1 });
  for (const p of paths) {
    const pg = await c.newPage(); await pg.goto('http://localhost:8080' + p, { waitUntil: 'networkidle' }).catch(() => {});
    await pg.evaluate(async () => { for (let y = 0; y <= document.body.scrollHeight; y += 600) { scrollTo(0, y); await new Promise(r => setTimeout(r, 30)); } scrollTo(0, 0); });
    await pg.waitForTimeout(2500);
    await pg.screenshot({ path: `${out}/${ad}-${(p.replace(/\//g, '_') || 'x')}.png`, fullPage: true }); await pg.close();
  }
  await c.close();
}
await b.close();
