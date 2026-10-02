<?php
// Yerel önizleme için router (php -S). Canlıda .htaccess aynı işi yapar.
$root = $_SERVER['DOCUMENT_ROOT'];
$uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
if (preg_match('#^/(blog|category/saglik)/page/\d+/?$#', $uri)) { header('Location: /blog/', true, 301); return true; }
if (preg_match('#^/diger/?$#', $uri)) { header('Location: /diger-hizmetler/', true, 301); return true; }
if (preg_match('#^/periyodik-bakim/?$#', $uri)) { header('Location: /kalibrasyon/', true, 301); return true; }
if (preg_match('#^/category/kategorisiz(/.*)?$#', $uri)) { header('Location: /category/saglik/', true, 301); return true; }
if (str_starts_with($uri, '/inc/')) { http_response_code(403); return true; }
if (preg_match('#^(.*/)index\.php$#', $uri, $m)) { header('Location: ' . $m[1], true, 301); return true; }
$f = $root . $uri;
if (is_dir($f)) {
  if (!str_ends_with($uri, '/')) { header('Location: ' . $uri . '/', true, 301); return true; }
  if (is_file($f . 'index.php')) { require $f . 'index.php'; return true; }
}
if (is_file($f)) return false;
if (preg_match('#^(/wp-content/uploads/.+)-\d+x\d+\.(jpe?g|png|gif|webp)$#i', $uri, $m) && is_file($root . $m[1] . '.' . $m[2])) { header('Location: ' . $m[1] . '.' . $m[2], true, 301); return true; }
require $root . '/404.php';
return true;
