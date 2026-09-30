// Google Fonts'u self-host eder (rehberdeki aynı aile/ağırlıklar). Yalnız latin + latin-ext alt kümeleri (Türkçe için yeterli).
import fs from 'node:fs/promises';
const URL = 'https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Nunito+Sans:opsz,wght@6..12,300;6..12,400;6..12,600;6..12,700&display=swap';
const UA = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36';
const css = await (await fetch(URL, { headers: { 'User-Agent': UA } })).text();
const bloklar = [...css.matchAll(/\/\* ([\w-]+) \*\/\s*(@font-face \{[\s\S]*?\})/g)].filter((m) => ['latin', 'latin-ext'].includes(m[1]));
await fs.mkdir('site/fonts', { recursive: true });
const indirilen = new Map(); let out = '/* Self-host: DM Serif Display + Nunito Sans (Google Fonts, SIL Open Font License). Kaynak: ' + URL + ' */\n';
for (const [, alt, blok] of bloklar) {
  const u = blok.match(/url\((https:[^)]+\.woff2)\)/)[1];
  const aile = /DM Serif/.test(blok) ? 'dm-serif-display' : 'nunito-sans';
  const stil = /font-style: italic/.test(blok) ? '-italic' : '';
  if (!indirilen.has(u)) {
    const ad = `${aile}${stil}-${alt}-${indirilen.size}.woff2`;
    await fs.writeFile('site/fonts/' + ad, Buffer.from(await (await fetch(u)).arrayBuffer()));
    indirilen.set(u, ad);
  }
  out += `/* ${alt} */\n` + blok.replace(u, '/fonts/' + indirilen.get(u)) + '\n';
}
await fs.writeFile('site/css/fonts.css', out);
console.log('font-face', bloklar.length, 'dosya', indirilen.size, [...indirilen.values()].join(' '));
