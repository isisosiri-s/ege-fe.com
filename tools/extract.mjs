// kaynak/html/*.html → kaynak/icerik/*.json (temiz içerik blokları)
import { chromium } from 'playwright';
import fs from 'node:fs/promises';
import path from 'node:path';

const SRC = path.resolve('kaynak/html');
const OUT = path.resolve('kaynak/icerik');
await fs.mkdir(OUT, { recursive: true });
const names = process.argv.slice(2).length ? process.argv.slice(2) : (await fs.readdir(SRC)).map((f) => f.replace('.html', ''));

const browser = await chromium.launch();
const page = await browser.newPage();
await page.route('**/*', (r) => r.abort()); // yalnız DOM, ağ yok
for (const n of names) {
  await page.setContent(await fs.readFile(path.join(SRC, n + '.html'), 'utf8'), { waitUntil: 'domcontentloaded' });
  const blocks = await page.evaluate(() => {
    const LOREM = /Phosfluorescently|Interactively|Completely synergize|Efficiently unleash|Appropriately empower|Distinctively re-engineer|Credibly reintermediate|Capitalize on low|Podcasting operational|Dynamically innovate|Seamlessly visualize|Globally myocardinate|Enthusiastically mesh|Energistically|Collaboratively|Objectively|Proactively|Holisticly|Uniquely|Continually|Dramatically|Rapidiously|Monotonectally|Intrinsically|Professionally fashion|Quickly (cultivate|maximize)/;
    const root = document.querySelector('.btArticleContent') || document.querySelector('.btContent');
    const out = [];
    const txt = (e) => e.innerText.replace(/ /g, ' ').replace(/[ \t]+\n/g, '\n').trim();
    // inline HTML: yalnız a/strong/b/em/i/br/sup/sub korunur
    const inline = (el) => {
      const walk = (n) => {
        if (n.nodeType === 3) return n.textContent.replace(/ /g, ' ').replace(/&/g, '&amp;').replace(/</g, '&lt;');
        if (n.nodeType !== 1) return '';
        const t = n.tagName.toLowerCase();
        const inner = [...n.childNodes].map(walk).join('');
        if (t === 'br') return '<br>';
        if (t === 'a') return `<a href="${n.getAttribute('href') || ''}">${inner}</a>`;
        if (t === 'strong' || t === 'b') return inner.trim() ? `<strong>${inner}</strong>` : inner;
        if (t === 'em' || t === 'i') return inner.trim() ? `<em>${inner}</em>` : inner;
        if (t === 'sup' || t === 'sub') return `<${t}>${inner}</${t}>`;
        if (t === 'img') return '';
        return inner;
      };
      return [...el.childNodes].map(walk).join('').replace(/\s+/g, ' ').replace(/(<br>\s*)+$/, '').trim();
    };
    const imgSrc = (img) => img.getAttribute('data-src') || img.getAttribute('src');
    // Atlanacak bloklar: sayfa başlık alanı, ortak iletişim kolonu, form/bülten, yalnız sayaç içeren satırlar
    const skipEl = (s) => {
      const cl = s.classList, t = s.innerText || '';
      if (cl.contains('btPageHeadline')) return true;
      if ((cl.contains('bt_bb_column') || cl.contains('bt_bb_column_inner') || s.tagName === 'SECTION') && /info@ege-fe\.com/.test(t) && /(Merkez|Adres|Telefon)\s*\n/.test(t) && t.length < 900) return true;
      if ((cl.contains('bt_bb_column') || cl.contains('bt_bb_column_inner')) && s.querySelector('.wpcf7') && t.replace(/\s/g, '').length < 400) return true;
      if (/Posta Bültenine/.test(t) && t.length < 400) return true;
      if (s.querySelector('.bt_bb_counter_holder') && t.replace(/[\d\s%+]/g, '').length < 60) return true;
      return false;
    };
    const pushText = (el) => {
      // doğrudan metin düğümü içeren blok (ör. <div>metin</div>) → paragraf
      if (el.childNodes && [...el.childNodes].some((n) => n.nodeType === 3 && n.textContent.trim()) && ![...el.children].some((c) => /^(P|UL|OL|H[1-6]|TABLE|DIV|BLOCKQUOTE)$/.test(c.tagName))) {
        const h = inline(el); if (h.replace(/<[^>]+>/g, '').trim()) out.push({ t: 'p', html: h }); return;
      }
      for (const c of el.children) {
        const t = c.tagName.toLowerCase();
        if (/^h[1-6]$/.test(t)) { const s = txt(c); if (s) out.push({ t: 'h', lv: +t[1], text: s.replace(/\s*\n\s*/g, ' ') }); }
        else if (t === 'p') {
          const imgs = c.querySelectorAll('img'); imgs.forEach((i) => out.push({ t: 'img', src: imgSrc(i), alt: i.alt || '' }));
          const h = inline(c); if (h.replace(/<[^>]+>/g, '').trim()) out.push({ t: 'p', html: h });
        }
        else if (t === 'ul' || t === 'ol') out.push({ t, items: [...c.querySelectorAll(':scope > li')].map(inline).filter(Boolean) });
        else if (t === 'blockquote') out.push({ t: 'quote', html: inline(c) });
        else if (t === 'table') out.push({ t: 'table', rows: [...c.rows].map((r) => [...r.cells].map(inline)) });
        else if (t === 'figure' || t === 'img') { const i = t === 'img' ? c : c.querySelector('img'); if (i) out.push({ t: 'img', src: imgSrc(i), alt: i.alt || '', cap: c.querySelector('figcaption')?.innerText || '' }); }
        else if (t === 'div' || t === 'span' || t === 'section') pushText(c);
      }
    };
    const visit = (el) => {
      for (const c of el.children) {
        if (c.closest('.slick-cloned')) continue;
        const cl = c.classList;
        if (skipEl(c)) continue;
        if (cl.contains('bt_bb_accordion_item')) {
          const tt = c.querySelector('.bt_bb_accordion_item_title'); if (tt) out.push({ t: 'h', lv: 3, text: txt(tt), faq: true });
          const ct = c.querySelector('.bt_bb_accordion_item_content'); if (ct) pushText(ct);
          continue;
        }
        if (cl.contains('bt_bb_headline')) {
          const tag = c.querySelector('h1,h2,h3,h4,h5,h6');
          const text = (c.querySelector('.bt_bb_headline_content') || tag)?.innerText.replace(/\s*\n\s*/g, ' ').trim();
          if (text) out.push({ t: 'h', lv: tag ? +tag.tagName[1] : 3, text });
          const sub = c.querySelector('.bt_bb_headline_subheadline'); if (sub && txt(sub)) out.push({ t: 'p', html: inline(sub), sub: true });
        } else if (cl.contains('bt_bb_text')) pushText(c);
        else if (cl.contains('bt_bb_service')) {
          const a = c.querySelector('a[href]');
          out.push({ t: 'card', title: txt(c.querySelector('.bt_bb_service_content_title') || c).split('\n')[0], text: txt(c.querySelector('.bt_bb_service_content_text') || c), href: a?.getAttribute('href') || '' });
        } else if (cl.contains('bt_bb_image')) { const i = c.querySelector('img'); if (i) out.push({ t: 'img', src: imgSrc(i), alt: i.alt || '', deco: true }); }
        else if (cl.contains('bt_bb_button')) { const a = c.querySelector('a'); if (a) out.push({ t: 'btn', text: txt(a), href: a.getAttribute('href') }); }
        else if (cl.contains('bt_bb_counter_holder') || cl.contains('bt_bb_separator_v2') || c.tagName === 'FORM' || cl.contains('wpcf7')) continue;
        else if (c.tagName === 'IFRAME' || c.tagName === 'SCRIPT' || c.tagName === 'STYLE') continue;
        else if (/^(P|UL|OL|H[1-6]|BLOCKQUOTE|TABLE|FIGURE)$/.test(c.tagName)) pushText({ children: [c] });
        else visit(c);
      }
    };
    if (root) visit(root);
    // lorem ve tekrarları temizle
    return out.filter((b) => !(b.t === 'p' && LOREM.test(b.html)) && !(b.t === 'card' && LOREM.test(b.text)));
  });
  await fs.writeFile(path.join(OUT, n + '.json'), JSON.stringify(blocks, null, 1));
  console.log(n.padEnd(50), blocks.length, 'blok', blocks.filter((b) => b.t === 'h').map((b) => 'h' + b.lv).join(''));
}
await browser.close();
