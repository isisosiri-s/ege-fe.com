// Yerel önizleme: http://localhost:3000 — site/ klasörünü PHP yerleşik sunucusuyla
// ve canlıdaki .htaccess kurallarını taklit eden tools/dev-router.php ile sunar.
// Kullanım: node serve.mjs   (zaten çalışıyorsa ikinci kopya açılmaz)
import { spawn } from 'node:child_process';
import net from 'node:net';

const PORT = Number(process.env.PORT) || 3000;

const dolu = await new Promise(r => {
  const s = net.connect(PORT, '127.0.0.1', () => { s.end(); r(true); });
  s.on('error', () => r(false));
});
if (dolu) { console.log(`Sunucu zaten çalışıyor: http://localhost:${PORT}`); process.exit(0); }

const php = spawn('php', ['-S', `localhost:${PORT}`, '-t', 'site', 'tools/dev-router.php'], { stdio: 'inherit' });
console.log(`Sunucu: http://localhost:${PORT}`);
php.on('exit', c => process.exit(c ?? 0));
for (const s of ['SIGINT', 'SIGTERM']) process.on(s, () => php.kill());
