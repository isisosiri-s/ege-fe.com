// kaynak/json/*.json → kaynak/sayfalar/*.md + görsel indirme + kaynak/OZET.md
import { chromium } from 'playwright';
import fs from 'node:fs/promises';
import path from 'node:path';

const K = path.resolve('kaynak');
const UA = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36';
const files = (await fs.readdir(path.join(K, 'json'))).filter((f) => f.endsWith('.json'));
const pages = [];
for (const f of files) pages.push({ name: f.replace('.json', ''), ...JSON.parse(await fs.readFile(path.join(K, 'json', f), 'utf8')) });

// Ortak blokları (iletişim + footer) gövdeden ayır, sayaç rulolarını temizle
const FOOTER_MARK = '\nEGEFE Bilişim Sağlık\n';
const CONTACT_MARK = '\nBize Ulaşın\nMerkez\n';
function clean(t) {
  let body = t, contact = '', footer = '';
  const fi = body.indexOf(FOOTER_MARK); if (fi > -1) { footer = body.slice(fi); body = body.slice(0, fi); }
  let sidebar = '';
  for (const mk of ['\ntarafından admin', '\nBir Cevap bırakın', '\nSon Makaleler\n']) { const i = body.indexOf(mk); if (i > -1) { sidebar = body.slice(i) + sidebar; body = body.slice(0, i); } }
  const ci = body.indexOf(CONTACT_MARK); if (ci > -1) { contact = body.slice(ci); body = body.slice(0, ci); }
  const strip = (s) => s.split('\n').filter((l) => !/^\s*[0-9%+]\s*$/.test(l)).join('\n').replace(/\n{3,}/g, '\n\n').trim();
  return { body: strip(body), contact: strip(contact), footer: strip(footer) };
}

const FLAGS = [
  [/provega/i, 'Provega (ajans/şablon alan adı)'],
  [/lorem|ipsum|Phosfluorescently|Interactively|proactive|methodolog|synerg|Collaboratively|Dramatically|Objectively|Efficiently|Completely|Globally|Quickly|Seamlessly|Credibly|Holisticly|Uniquely/i, 'İngilizce lorem/şablon metni'],
  [/Archives|Categories|Recent Posts|Leave a Reply|Read More/i, 'İngilizce tema etiketi'],
  [/Egefe Sağlık Bilişim A\.?Ş|EGEFE Bilişim Sağlık(?! San)|Egefe Bilişim Sağlık A\.Ş/i, 'Kısa/yanlış firma ünvanı varyantı'],
  [/Kategorisiz/i, '"Kategorisiz" kategori etiketi'],
  [/Uyuşturu Madde/i, 'Yazım hatası ("Uyuşturu")'],
  [/birimkim/i, 'Yazım hatası ("birimkimlerini")'],
];

const bigVariant = (u) => u.replace(/-\d{2,4}x\d{2,4}(?=\.(jpe?g|png|webp|gif)$)/i, '');
const allImgs = new Map(); // orijinal url → sayfalar
const inventory = new Set(pages.map((p) => new URL(p.url).pathname));
const extraLinks = new Map();
const report = [];

await fs.mkdir(path.join(K, 'sayfalar'), { recursive: true });
let sharedContact = '', sharedFooter = '';

for (const p of pages) {
  const { body, contact, footer } = clean(p.mainText || '');
  if (contact && contact.length > sharedContact.length) sharedContact = contact;
  if (footer && footer.length > sharedFooter.length) sharedFooter = footer;
  const imgs = [...new Set([...p.images, ...p.backgrounds].filter((u) => /wp-content\/uploads/.test(u)).map(bigVariant))];
  imgs.forEach((u) => { if (!allImgs.has(u)) allImgs.set(u, new Set()); allImgs.get(u).add(p.name); });
  for (const l of p.links) {
    try {
      const x = new URL(l.href);
      if (/ege-fe\.com$/.test(x.hostname) && !inventory.has(x.pathname) && !/wp-content|\/feed|\/wp-json|#/.test(x.pathname + x.hash)) {
        const k = x.pathname; if (!extraLinks.has(k)) extraLinks.set(k, { text: l.text, from: new Set() }); extraLinks.get(k).from.add(p.name);
      } else if (!/ege-fe\.com$/.test(x.hostname) && /^https?:/.test(x.protocol)) {
        const k = x.origin + x.pathname; if (!extraLinks.has(k)) extraLinks.set(k, { text: l.text, from: new Set(), ext: true }); extraLinks.get(k).from.add(p.name);
      }
    } catch {}
  }
  const flags = [];
  const hay = [p.description, body, p.pageHead || ''].join('\n');
  for (const [re, label] of FLAGS) { const m = hay.match(re); if (m) flags.push(`${label}: "…${hay.slice(Math.max(0, m.index - 40), m.index + 60).replace(/\n/g, ' ')}…"`); }
  const h1 = p.headings.filter((h) => h.inMain && h.tag === 'h1');
  if (h1.length === 0) flags.push('H1 yok');
  if (h1.length > 1) flags.push(`${h1.length} adet H1 var`);
  if (body.replace(/\s/g, '').length < 300) flags.push(`İçerik çok kısa/boş (${body.length} karakter)`);
  if (!p.description) flags.push('Meta description yok');
  if (p.status !== 200) flags.push('HTTP ' + p.status);
  if (new URL(p.finalUrl).pathname !== new URL(p.url).pathname) flags.push('Yönlendirme → ' + p.finalUrl);
  if (p.canonical && new URL(p.canonical).pathname !== new URL(p.url).pathname) flags.push('Canonical farklı → ' + p.canonical);
  if (/noindex/i.test(p.robots || '')) flags.push('robots: ' + p.robots);
  report.push({ name: p.name, path: new URL(p.url).pathname, title: p.title, len: body.length, h1: h1.map((h) => h.text).join(' | '), flags, imgs: imgs.length });

  const md = [
    `# ${p.title}`, '',
    '| Alan | Değer |', '|---|---|',
    `| URL | ${new URL(p.url).pathname} |`, `| HTTP | ${p.status} (deneme ${p.attempt}) |`,
    `| Title | ${p.title} |`, `| Description | ${p.description ?? '—'} |`, `| Canonical | ${p.canonical ?? '—'} |`,
    `| Robots | ${p.robots ?? '—'} |`,
    ...Object.entries(p.og).map(([k, v]) => `| ${k} | ${v} |`),
    '', '## Başlıklar', ...p.headings.filter((h) => h.inMain).map((h) => `- ${h.tag.toUpperCase()}: ${h.text.replace(/\n/g, ' ')}`),
    ...(p.pageHead ? ['', '## Sayfa başlık alanı (breadcrumb/üst bilgi)', '```', p.pageHead, '```'] : []),
    ...(p.counters.length ? ['', '## Sayaçlar', ...p.counters.map((c) => `- ${c.value} — ${c.ctx.replace(/^[%+]\s*/, '')}`)] : []),
    ...(p.postMeta.length ? ['', '## Yazı meta', ...p.postMeta.map((m) => `- ${m.cls}: ${m.text ?? ''} ${m.src ?? ''}`)] : []),
    '', '## Görseller (orijinal boyut)', ...imgs.map((u) => `- ${u}`),
    ...(p.forms.filter((f) => f.method === 'post').length ? ['', '## Formlar', ...p.forms.filter((f) => f.method === 'post').map((f) => `- ${f.action} → alanlar: ${f.fields.filter((x) => x.type !== 'hidden').map((x) => `${x.name}(${x.type}${x.ph ? ': ' + x.ph : ''})`).join(', ')}`)] : []),
    ...(flags.length ? ['', '## ⚠ Bulgular', ...flags.map((f) => '- ' + f)] : []),
    '', '## Gövde metni', '', body, '',
  ].join('\n');
  await fs.writeFile(path.join(K, 'sayfalar', p.name + '.md'), md);
}
await fs.writeFile(path.join(K, 'sayfalar', '_ortak-iletisim-footer.md'), `# Ortak bloklar\n\n## İletişim bloğu\n\n${sharedContact}\n\n## Footer\n\n${sharedFooter}\n`);

// Görselleri indir (tarayıcı istek bağlamı ile)
const home = pages.find((p) => p.name === 'anasayfa');
const extras = [home?.og['og:image'], ...(home?.icons.map((i) => i.href) ?? [])].filter(Boolean);
for (const p of pages) if (p.og['og:image']) extras.push(p.og['og:image']);
const jsonldLogo = (home?.jsonld.join('') .match(/https:\/\/ege-fe\.com\/wp-content\/uploads\/[^"]+/g)) ?? [];
[...extras, ...jsonldLogo].forEach((u) => { const b = bigVariant(u); if (!allImgs.has(b)) allImgs.set(b, new Set(['meta'])); });

const browser = await chromium.launch();
const ctx = await browser.newContext({ userAgent: UA });
const dl = [];
for (const [u, from] of allImgs) {
  const rel = u.replace(/^https?:\/\/[^/]+\//, '').replace(/^wp-content\//, '');
  const dest = path.join(K, 'img', /provega/.test(u) ? 'provega-' + path.basename(rel) : rel);
  let r = await ctx.request.get(u).catch((e) => ({ status: () => 'ERR ' + e.message.split('\n')[0] }));
  let status = r.status?.();
  let used = u;
  // büyük sürüm yoksa sayfada görülen ilk varyanta düş
  if (status !== 200) {
    const alt = [...pages.flatMap((p) => [...p.images, ...p.backgrounds])].find((x) => bigVariant(x) === u && x !== u);
    if (alt) { const r2 = await ctx.request.get(alt).catch(() => null); if (r2?.status() === 200) { r = r2; status = 200; used = alt; } }
  }
  if (status === 200) { await fs.mkdir(path.dirname(dest), { recursive: true }); await fs.writeFile(dest, await r.body()); }
  dl.push({ url: used, local: path.relative(K, dest).replace(/\\/g, '/'), status, pages: [...from] });
}
await browser.close();
await fs.writeFile(path.join(K, 'gorseller.json'), JSON.stringify(dl, null, 2));
await fs.writeFile(path.join(K, 'rapor.json'), JSON.stringify({ report, extraLinks: [...extraLinks].map(([k, v]) => ({ path: k, text: v.text, ext: !!v.ext, from: [...v.from].slice(0, 5), count: v.from.size })) }, null, 2));
console.log('sayfa', pages.length, 'görsel', dl.length, 'indirilemeyen', dl.filter((d) => d.status !== 200).length);
