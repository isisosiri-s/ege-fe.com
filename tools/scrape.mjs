// ege-fe.com içerik çekici — Playwright headless Chromium
// Kullanım: node tools/scrape.mjs [slug ...]   (argümansız: tüm envanter)
import { chromium } from 'playwright';
import fs from 'node:fs/promises';
import path from 'node:path';

const BASE = 'https://ege-fe.com';
const OUT = path.resolve('kaynak');
const UA = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36';

const URLS = [
  '/', '/hakkimizda/', '/hizmetler/', '/hizmet-politikamiz/', '/kalite-politikamiz/', '/kariyer/',
  '/iletisim/', '/bilgi/', '/danismanlik/', '/ilac/', '/diger/',
  '/saglik-bakanligi-islemleri/', '/saglik-bakanligi-islemleri/gmp-basvurusu/',
  '/saglik-bakanligi-islemleri/biyosidal-ruhsatlandirma/', '/saglik-bakanligi-islemleri/ilac-fiyatlandirma/',
  '/saglik-bakanligi-islemleri/ilac-ruhsatlandirma/', '/saglik-bakanligi-islemleri/kub-kt/',
  '/saglik-bakanligi-islemleri/ilac-varyasyon/', '/saglik-bakanligi-islemleri/okunabilirlik-testi/',
  '/tibbi-cihaz/', '/tibbi-cihaz/firma-kaydi/', '/tibbi-cihaz/tibbi-cihaz-belge-kaydi/',
  '/tibbi-cihaz/ubb-e-imza/', '/tibbi-cihaz/firma-bilgileri-guncelleme/', '/tibbi-cihaz/etiket-duzenleme/',
  '/uts/', '/uts/kozmetik-firma-kaydi/', '/uts/uts-bilgi-guncelleme/', '/uts/tibbi-cihaz-uts-gecisi/',
  '/uts/kozmetik-urun-bildirimi/', '/uts/sorumlu-teknik-eleman/',
  '/diger-hizmetler/', '/diger-hizmetler/ce-teknik-dosya-hazirlanmasi/', '/diger-hizmetler/permi-belgesi/',
  '/diger-hizmetler/kontrol-belgesi/', '/diger-hizmetler/takviye-edici-gida/',
  '/ariza-ve-onarim/', '/periyodik-bakim/', '/kalibrasyon/',
  '/blog/', '/eroin-bagimliligi/', '/eroin-nedir/', '/opiatlar-nedir/', '/kokain-bagimliligi-tedavisi/',
  '/uyusturucu-testi-nedir/', '/kokain-bagimliligi/', '/uyarici-madde-nedir/', '/esrar-bagimliligi-tedavisi/',
  '/esrar-bagimliligi/', '/esrar-nedir/', '/trafik-guvenligini-tehlikeye-sokma-sucu/', '/alkolmetre-nedir/',
  '/uyusturucu-madde-testi/', '/promil-nedir/', '/kokain-nedir/', '/ergenlerde-uyusturucu-kullanimi/',
  '/alkol-bagimliligi/', '/madde-bagimliligi-nedir/', '/madde-bagimliligi-tedavisi/', '/alkollu-arac-kullanmak/',
  '/ekstazi-nedir/', '/metamfetamin-nedir/', '/amfetamin-nedir/',
  '/category/saglik/',
];

const slugName = (u) => (u === '/' ? 'anasayfa' : u.replace(/^\/|\/$/g, '').replace(/\//g, '__'));

async function extract(page) {
  return page.evaluate(() => {
    const q = (s) => document.querySelector(s);
    const attr = (s, a) => q(s)?.getAttribute(a) ?? null;
    const meta = {};
    document.querySelectorAll('meta').forEach((m) => {
      const k = m.getAttribute('property') || m.getAttribute('name');
      if (k) meta[k] = m.getAttribute('content');
    });
    const heads = [...document.querySelectorAll('h1,h2,h3,h4')].map((h) => ({
      tag: h.tagName.toLowerCase(), text: h.innerText.trim(), inMain: !h.closest('.mainHeader,.btVerticalHeaderTop,nav'),
    }));
    const imgs = new Set();
    document.querySelectorAll('img').forEach((i) => {
      [i.currentSrc, i.src, i.getAttribute('data-src'), i.getAttribute('data-lazy-src')].forEach((s) => s && imgs.add(new URL(s, location.href).href));
      (i.getAttribute('srcset') || '').split(',').forEach((p) => { const s = p.trim().split(' ')[0]; if (s) imgs.add(new URL(s, location.href).href); });
    });
    const bgs = new Set();
    document.querySelectorAll('*').forEach((el) => {
      for (const pseudo of [null, '::before', '::after']) {
        const bg = getComputedStyle(el, pseudo).backgroundImage;
        if (bg && bg !== 'none') for (const m of bg.matchAll(/url\(["']?([^"')]+)["']?\)/g)) bgs.add(new URL(m[1], location.href).href);
      }
    });
    const icons = [...document.querySelectorAll('link[rel*="icon"]')].map((l) => ({ rel: l.rel, href: l.href, sizes: l.getAttribute('sizes') }));
    const jsonld = [...document.querySelectorAll('script[type="application/ld+json"]')].map((s) => s.textContent);
    const scripts = [...document.querySelectorAll('script')].map((s) => s.src || s.textContent.slice(0, 400));
    const analytics = scripts.filter((s) => /gtag|googletagmanager|google-analytics|UA-\d|G-[A-Z0-9]{6,}|GTM-|fbq|yandex|hotjar|clarity/i.test(s));
    const verify = Object.entries(meta).filter(([k]) => /verification|verify/i.test(k));
    const forms = [...document.querySelectorAll('form')].map((f) => ({
      action: f.action, method: f.method, id: f.id, cls: f.className,
      fields: [...f.querySelectorAll('input,textarea,select')].map((i) => ({ name: i.name, type: i.type, ph: i.placeholder, req: i.required })),
    }));
    const iframes = [...document.querySelectorAll('iframe')].map((f) => f.src);
    const links = [...document.querySelectorAll('a[href]')].map((a) => ({ href: a.href, text: a.innerText.trim().slice(0, 80) }));
    const navEl = q('nav, .main-navigation, #site-navigation, header');
    const nav = navEl ? [...navEl.querySelectorAll('a')].map((a) => ({ href: a.href, text: a.innerText.trim(), depth: (() => { let d = 0, p = a.parentElement; while (p && p !== navEl) { if (p.tagName === 'UL') d++; p = p.parentElement; } return d; })() })) : [];
    const mainEl = q('.btContentWrap') || q('.btContent') || document.body;
    const counters = [...document.querySelectorAll('.bt_bb_counter_holder')].map((c) => ({ value: [...c.querySelectorAll('[data-digit]')].map((d) => d.dataset.digit).join(''), ctx: c.parentElement?.innerText.replace(/[0-9\s]+/g, ' ').trim().slice(0, 80) }));
    const pageHead = q('.btPageHeadline, .bt_bb_section.btPageHeadline')?.innerText ?? null;
    const postMeta = [...document.querySelectorAll('.btArticleDate, .btArticleAuthor, .btArticleCategories, .btArticleComments, .btMediaBox img, time')].map((e) => ({ cls: e.className, text: e.innerText?.trim(), src: e.src || null, dt: e.getAttribute('datetime') }));
    const footerEl = q('footer, .site-footer, #colophon');
    const headerEl = q('.mainHeader') || q('header');
    return {
      url: location.href, title: document.title, lang: document.documentElement.lang,
      description: meta['description'] ?? null, canonical: attr('link[rel="canonical"]', 'href'),
      robots: meta['robots'] ?? null,
      og: Object.fromEntries(Object.entries(meta).filter(([k]) => k.startsWith('og:') || k.startsWith('article:'))),
      twitter: Object.fromEntries(Object.entries(meta).filter(([k]) => k.startsWith('twitter:'))),
      headings: heads, images: [...imgs], backgrounds: [...bgs], icons, jsonld, analytics, verification: verify,
      forms, iframes, nav, links,
      mainText: mainEl.innerText, mainHTML: mainEl.innerHTML,
      headerText: headerEl?.innerText ?? '', counters, pageHead, postMeta, footerText: footerEl?.innerText ?? '',
      bodyText: document.body.innerText,
    };
  });
}

async function visit(browser, u, attempt) {
  const ctx = await browser.newContext(attempt === 0 ? {} : { userAgent: UA, locale: 'tr-TR', viewport: { width: 1440, height: 900 } });
  const page = await ctx.newPage();
  try {
    const res = await page.goto(BASE + u, { waitUntil: attempt === 0 ? 'load' : 'networkidle', timeout: 60000 });
    const status = res?.status() ?? 0;
    if (status === 403 || status >= 500) throw new Error('HTTP ' + status);
    // lazy-load görselleri tetiklemek için sayfayı kaydır
    await page.evaluate(async () => { for (let y = 0; y < document.body.scrollHeight; y += 600) { window.scrollTo(0, y); await new Promise((r) => setTimeout(r, 120)); } });
    await page.waitForTimeout(800);
    const data = await extract(page);
    data.status = status; data.finalUrl = page.url(); data.attempt = attempt;
    const html = await page.content();
    return { data, html };
  } finally { await ctx.close(); }
}

const list = process.argv.slice(2).length ? process.argv.slice(2) : URLS;
await fs.mkdir(path.join(OUT, 'html'), { recursive: true });
await fs.mkdir(path.join(OUT, 'json'), { recursive: true });
const browser = await chromium.launch();
const log = [];
for (const u of list) {
  let ok = false;
  for (let attempt = 0; attempt < 3 && !ok; attempt++) {
    try {
      const { data, html } = await visit(browser, u, attempt);
      const n = slugName(u);
      await fs.writeFile(path.join(OUT, 'html', n + '.html'), html);
      await fs.writeFile(path.join(OUT, 'json', n + '.json'), JSON.stringify(data, null, 2));
      log.push({ u, status: data.status, final: data.finalUrl, attempt, title: data.title });
      console.log('OK ', data.status, u, '→', data.title);
      ok = true;
    } catch (e) {
      console.log('ERR', u, 'attempt', attempt, e.message.split('\n')[0]);
      if (attempt === 2) log.push({ u, error: e.message.split('\n')[0] });
    }
  }
}
await browser.close();
const logPath = path.join(OUT, 'scrape-log.json');
let prev = [];
try { prev = JSON.parse(await fs.readFile(logPath, 'utf8')); } catch {}
const merged = [...prev.filter((p) => !log.find((l) => l.u === p.u)), ...log];
await fs.writeFile(logPath, JSON.stringify(merged, null, 2));
