// logo.png'deki dalga-yelken sembolünden favicon seti üretir (eş oranlı, efekt yok)
import { chromium } from 'playwright';
import fs from 'node:fs/promises';
const logo = 'data:image/png;base64,' + (await fs.readFile('assets/img/logo.png')).toString('base64');
const [sx, sy, sw, sh] = (process.env.CROP || '80,70,880,560').split(',').map(Number); // sembol bölgesi (1843x921 üzerinde)
const b = await chromium.launch(); const p = await b.newPage();
const out = await p.evaluate(async ({ logo, sx, sy, sw, sh }) => {
  const img = new Image(); img.src = logo; await img.decode();
  const make = (size, pad, bg) => {
    const c = document.createElement('canvas'); c.width = c.height = size; const x = c.getContext('2d');
    if (bg) { x.fillStyle = bg; x.fillRect(0, 0, size, size); }
    const inner = size * (1 - pad * 2), s = Math.min(inner / sw, inner / sh);
    const w = sw * s, h = sh * s; x.imageSmoothingQuality = 'high';
    x.drawImage(img, sx, sy, sw, sh, (size - w) / 2, (size - h) / 2, w, h);
    return c.toDataURL('image/png').split(',')[1];
  };
  return { f16: make(16, 0, null), f32: make(32, 0.02, null), f48: make(48, 0.04, null), a180: make(180, 0.12, '#ffffff'), m192: make(192, 0.1, '#ffffff'), m512: make(512, 0.1, '#ffffff'), prev: make(256, 0.04, null) };
}, { logo, sx, sy, sw, sh });
await b.close();
const w = (n, d) => fs.writeFile('site/img/' + n, Buffer.from(d, 'base64'));
await w('favicon-16.png', out.f16); await w('favicon-32.png', out.f32); await w('favicon-48.png', out.f48);
await w('apple-touch-icon.png', out.a180); await w('icon-192.png', out.m192); await w('icon-512.png', out.m512);
await fs.writeFile(process.env.TEMP + '/fav-prev.png', Buffer.from(out.prev, 'base64'));
// favicon.ico: PNG gömülü ICO (16, 32, 48)
const imgs = [out.f16, out.f32, out.f48].map((d) => Buffer.from(d, 'base64')); const sizes = [16, 32, 48];
const head = Buffer.alloc(6); head.writeUInt16LE(0, 0); head.writeUInt16LE(1, 2); head.writeUInt16LE(imgs.length, 4);
let off = 6 + 16 * imgs.length; const dir = [];
imgs.forEach((im, i) => { const e = Buffer.alloc(16); e[0] = sizes[i]; e[1] = sizes[i]; e.writeUInt16LE(1, 4); e.writeUInt16LE(32, 6); e.writeUInt32LE(im.length, 8); e.writeUInt32LE(off, 12); off += im.length; dir.push(e); });
await fs.writeFile('site/favicon.ico', Buffer.concat([head, ...dir, ...imgs]));
console.log('favicon seti yazıldı');
