<?php
// Ortak üst bölüm: <head>, SEO meta, JSON-LD, site başlığı/menü ve sayfa başlık alanı (tek H1).
// Kullanım (sayfada): $yol = '/hakkimizda/'; [$sayfa = [...];] require .../inc/header.php;
require_once __DIR__ . '/config.php';
$META = require __DIR__ . '/meta.php';
$HIZMET = require __DIR__ . '/hizmetler.php';
$sayfa = $sayfa ?? [];
$yol = $yol ?? '/404/';
$m = $META[$yol] ?? $META['/404/'];
$canonical = SITE_URL . ($yol === '/404/' ? '/' : $yol);
$ogImg = SITE_URL . implode('/', array_map('rawurlencode', explode('/', $m['og'])));
if (empty($sayfa['etiket']) && !empty($m['ust']) && isset($META[$m['ust']])) $sayfa['etiket'] = $META[$m['ust']]['h1'];

// Breadcrumb zinciri (meta.php 'ust' alanından)
$zincir = [];
for ($p = $yol; $p && isset($META[$p]); $p = $META[$p]['ust']) array_unshift($zincir, [$p, $META[$p]['h1']]);
if ($yol !== '/') array_unshift($zincir, ['/', 'Anasayfa']);

// ---- JSON-LD ----
$org = [
  '@type' => 'Organization', '@id' => SITE_URL . '/#organization',
  'name' => $FIRMA['yasal_unvan'], 'legalName' => $FIRMA['yasal_unvan'], 'alternateName' => ['Egefe', 'Egefe Sağlık Bilişim A.Ş.'],
  'url' => SITE_URL . '/', 'logo' => ['@type' => 'ImageObject', 'url' => SITE_URL . '/img/logo.png', 'width' => 1843, 'height' => 921],
  'email' => $FIRMA['eposta'], 'telephone' => $FIRMA['telefon_uri'], 'faxNumber' => $FIRMA['faks_uri'], 'foundingDate' => (string)$FIRMA['kurulus'],
  'taxID' => $FIRMA['vkn'],
  'identifier' => [['@type' => 'PropertyValue', 'propertyID' => 'MERSIS', 'value' => $FIRMA['mersis']], ['@type' => 'PropertyValue', 'propertyID' => 'VKN', 'value' => $FIRMA['vkn'], 'description' => $FIRMA['vergi_dairesi']]],
  'address' => ['@type' => 'PostalAddress', 'streetAddress' => $FIRMA['adres_sokak'], 'postalCode' => $FIRMA['posta_kodu'], 'addressLocality' => $FIRMA['ilce'], 'addressRegion' => $FIRMA['il'], 'addressCountry' => 'TR'],
  'department' => [['@type' => 'Organization', 'name' => 'Egefe AR-GE Ofisi', 'address' => ['@type' => 'PostalAddress', 'streetAddress' => 'Kırıkkale Teknopark No: 3', 'addressLocality' => 'Yahşihan', 'addressRegion' => 'Kırıkkale', 'addressCountry' => 'TR']]],
  'sameAs' => [$FIRMA['linkedin']],
];
// Markamız: CROM TEST (cromtest.com Egefe'yi legalName olarak gösteriyor → iki yönlü ilişki). Yalnız marka aktifken.
if (!empty($MARKA['aktif'])) $org['brand'] = ['@type' => 'Brand', 'name' => $MARKA['ad'], 'url' => $MARKA['url'], 'logo' => SITE_URL . '/img/crom-test/crom-test-logo.svg'];
if ($FIRMA['harita_koordinat']) $org['location'] = ['@type' => 'Place', 'geo' => ['@type' => 'GeoCoordinates', 'latitude' => $FIRMA['harita_koordinat'][0], 'longitude' => $FIRMA['harita_koordinat'][1]]];
$tipler = ['/iletisim/' => 'ContactPage', '/hakkimizda/' => 'AboutPage', '/blog/' => 'CollectionPage', '/category/saglik/' => 'CollectionPage'];
$graph = [
  $org,
  ['@type' => 'WebSite', '@id' => SITE_URL . '/#website', 'url' => SITE_URL . '/', 'name' => 'Egefe Sağlık Bilişim A.Ş.', 'inLanguage' => 'tr', 'publisher' => ['@id' => SITE_URL . '/#organization']],
  ['@type' => $tipler[$yol] ?? 'WebPage', '@id' => $canonical . '#webpage', 'url' => $canonical, 'name' => $m['title'], 'description' => $m['desc'] ?: null, 'inLanguage' => 'tr',
   'isPartOf' => ['@id' => SITE_URL . '/#website'], 'breadcrumb' => ['@id' => $canonical . '#breadcrumb'], 'primaryImageOfPage' => ['@type' => 'ImageObject', 'url' => $ogImg]],
  ['@type' => 'BreadcrumbList', '@id' => $canonical . '#breadcrumb', 'itemListElement' => array_map(fn($z, $i) => ['@type' => 'ListItem', 'position' => $i + 1, 'name' => $z[1], 'item' => SITE_URL . $z[0]], $zincir ?: [['/', 'Anasayfa']], array_keys($zincir ?: [0]))],
];
if ($m['ogType'] === 'article') {
  $graph[] = ['@type' => 'BlogPosting', '@id' => $canonical . '#article', 'headline' => $m['h1'], 'description' => $m['desc'] ?: null, 'image' => $ogImg,
    'datePublished' => $m['yayin'], 'dateModified' => $m['guncel'] ?: $m['yayin'], 'articleSection' => 'Sağlık', 'inLanguage' => 'tr',
    'author' => ['@id' => SITE_URL . '/#organization'], 'publisher' => ['@id' => SITE_URL . '/#organization'], 'mainEntityOfPage' => ['@id' => $canonical . '#webpage']];
}
$graph = array_map(fn($g) => array_filter($g, fn($v) => $v !== null), $graph);

// Menü aktifliği
function aktif($hedef, $yol) { return ($hedef === '/' ? $yol === '/' : str_starts_with($yol, $hedef)) ? ' aria-current="page"' : ''; }
$danismanlikYollari = array_merge(['/danismanlik/', '/ilac/'], array_column($HIZMET['danismanlik'], 'yol'));
$danismanlikAktif = (bool)array_filter($danismanlikYollari, fn($d) => str_starts_with($yol, $d));
$kurumsalAktif = in_array($yol, ['/hakkimizda/', '/hizmet-politikamiz/', '/kalite-politikamiz/', '/kariyer/'], true);
$hizmetAktif = in_array($yol, array_merge(['/hizmetler/', '/bilgi/'], array_column($HIZMET['servis']['alt'], 'yol')), true);
$blogAktif = $yol === '/blog/' || $yol === '/category/saglik/' || ($m['ogType'] ?? '') === 'article';
?><!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($m['title']) ?></title>
<?php if ($m['desc']): ?><meta name="description" content="<?= e($m['desc']) ?>">
<?php endif; ?>
<meta name="robots" content="<?= !empty($m['noindex']) ? 'noindex, follow' : 'index, follow, max-image-preview:large' ?>">
<link rel="canonical" href="<?= e($canonical) ?>">
<meta property="og:locale" content="tr_TR">
<meta property="og:type" content="<?= e($m['ogType']) ?>">
<meta property="og:title" content="<?= e($m['title']) ?>">
<?php if ($m['desc']): ?><meta property="og:description" content="<?= e($m['desc']) ?>">
<?php endif; ?>
<meta property="og:url" content="<?= e($canonical) ?>">
<meta property="og:site_name" content="Egefe Sağlık Bilişim A.Ş.">
<meta property="og:image" content="<?= e($ogImg) ?>">
<?php if (!empty($m['ogW'])): ?><meta property="og:image:width" content="<?= (int)$m['ogW'] ?>">
<meta property="og:image:height" content="<?= (int)$m['ogH'] ?>">
<?php endif; ?>
<meta property="og:image:type" content="<?= str_ends_with(strtolower($m['og']), '.png') ? 'image/png' : (str_ends_with(strtolower($m['og']), '.webp') ? 'image/webp' : 'image/jpeg') ?>">
<meta property="og:image:alt" content="<?= e($m['title']) ?>">
<meta name="twitter:image" content="<?= e($ogImg) ?>">
<?php if ($m['ogType'] === 'article' && $m['yayin']): ?><meta property="article:published_time" content="<?= e($m['yayin']) ?>">
<meta property="article:modified_time" content="<?= e($m['guncel'] ?: $m['yayin']) ?>">
<meta property="article:section" content="Sağlık">
<?php endif; ?>
<meta name="twitter:card" content="summary_large_image">
<?php if (GSC_AKTIF): ?><meta name="google-site-verification" content="<?= e(GSC_DOGRULAMA) ?>">
<?php else: ?><!-- Search Console doğrulaması (onay bekliyor): <meta name="google-site-verification" content="<?= e(GSC_DOGRULAMA) ?>"> -->
<?php endif; ?>
<!-- Analytics: canlı sitede analytics/GTM kodu bulunmadı. -->
<link rel="icon" href="/favicon.ico" sizes="48x48">
<link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16.png">
<link rel="apple-touch-icon" href="/img/apple-touch-icon.png">
<link rel="manifest" href="/site.webmanifest">
<meta name="theme-color" content="#1d7d95">
<!-- Fontlar: rehberdeki Google Fonts ailesi/ağırlıkları kendi sunucumuzdan (yurt dışına IP aktarımı olmasın diye) -->
<link rel="preload" href="/fonts/nunito-sans-latin-5.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="/fonts/dm-serif-display-latin-3.woff2" as="font" type="font/woff2" crossorigin>
<link rel="stylesheet" href="/css/fonts.css?v=<?= filemtime(KOK . '/css/fonts.css') ?>">
<link rel="stylesheet" href="/css/style.css?v=<?= filemtime(KOK . '/css/style.css') ?>">
<script type="application/ld+json"><?= json_encode(['@context' => 'https://schema.org', '@graph' => $graph], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
</head>
<body class="<?= e($sayfa['govdeSinif'] ?? '') ?>">
<a class="atla" href="#icerik">İçeriğe geç</a>

<header class="site-baslik">
  <div class="kap site-baslik-ic">
    <a class="logo" href="/" aria-label="Egefe — Anasayfa">
      <img src="/img/logo.png" alt="Egefe" width="1843" height="921">
    </a>
    <button class="menu-dugme" type="button" aria-expanded="false" aria-controls="ana-menu">
      <?= ikon('menu-2', 24, 'menu-dugme-ac') ?><?= ikon('x', 24, 'menu-dugme-kapat') ?><span class="gizli">Menü</span>
    </button>
    <nav class="ana-menu" id="ana-menu" aria-label="Ana menü">
      <ul class="menu">
        <li><a href="/urunler/"<?= aktif('/urunler/', $yol) ?>>Ürünler</a></li>
        <li class="alt-var<?= $hizmetAktif ? ' aktif' : '' ?>">
          <a href="/hizmetler/">Servis</a>
          <button class="alt-ac" type="button" aria-expanded="false" aria-label="Servis alt menüsü"></button>
          <ul class="alt-menu">
            <?php foreach ($HIZMET['servis']['alt'] as $h): ?>
            <li><a href="<?= e($h['yol']) ?>"<?= aktif($h['yol'], $yol) ?>><?= e($h['ad']) ?></a></li>
            <?php endforeach; ?>
            <li><a href="/bilgi/"<?= aktif('/bilgi/', $yol) ?>>Bilgi</a></li>
          </ul>
        </li>
        <li class="alt-var mega<?= $danismanlikAktif ? ' aktif' : '' ?>">
          <a href="/danismanlik/">Danışmanlık</a>
          <button class="alt-ac" type="button" aria-expanded="false" aria-label="Danışmanlık alt menüsü"></button>
          <div class="alt-menu mega-menu">
            <?php foreach ($HIZMET['danismanlik'] as $hub): ?>
            <div class="mega-kolon">
              <a class="mega-baslik" href="<?= e($hub['yol']) ?>"<?= aktif($hub['yol'], $yol) ?>><?= e($hub['ad']) ?></a>
              <button class="grup-ac" type="button" aria-expanded="false" aria-label="<?= e($hub['ad']) ?> hizmetleri"></button>
              <ul>
                <?php foreach ($hub['alt'] as $h): ?>
                <li><a href="<?= e($h['yol']) ?>"<?= aktif($h['yol'], $yol) ?>><?= e($h['ad']) ?></a></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <?php endforeach; ?>
          </div>
        </li>
        <li class="alt-var<?= $kurumsalAktif ? ' aktif' : '' ?>">
          <a href="/hakkimizda/">Kurumsal</a>
          <button class="alt-ac" type="button" aria-expanded="false" aria-label="Kurumsal alt menüsü"></button>
          <ul class="alt-menu">
            <li><a href="/hakkimizda/"<?= aktif('/hakkimizda/', $yol) ?>>Hakkımızda</a></li>
            <li><a href="/hizmet-politikamiz/"<?= aktif('/hizmet-politikamiz/', $yol) ?>>Hizmet Politikamız</a></li>
            <li><a href="/kalite-politikamiz/"<?= aktif('/kalite-politikamiz/', $yol) ?>>Kalite Politikamız</a></li>
            <li><a href="/kariyer/"<?= aktif('/kariyer/', $yol) ?>>Kariyer</a></li>
          </ul>
        </li>
        <li><a href="/blog/"<?= $blogAktif ? ' aria-current="page"' : '' ?>>Blog</a></li>
        <li><a href="/iletisim/"<?= aktif('/iletisim/', $yol) ?>>İletişim</a></li>
      </ul>
      <a class="dugme dugme-birincil menu-cta" href="/iletisim/#form">Teklif Al</a>
    </nav>
  </div>
</header>

<main id="icerik">
<?php if (empty($sayfa['ozelBaslik'])): ?>
<section class="sayfa-bas">
  <div class="kap">
    <nav class="kirinti" aria-label="Sayfa konumu">
      <ol>
        <?php foreach ($zincir as $i => $z): ?>
        <li><?php if ($i < count($zincir) - 1): ?><a href="<?= e($z[0]) ?>"><?= e($z[1]) ?></a><?php else: ?><span aria-current="page"><?= e($z[1]) ?></span><?php endif; ?></li>
        <?php endforeach; ?>
      </ol>
    </nav>
    <?php if (!empty($sayfa['etiket'])): ?><p class="etiket"><?= e($sayfa['etiket']) ?></p><?php endif; ?>
    <h1><?= e($m['h1']) ?></h1>
    <?php if (!empty($sayfa['altBaslik'])): ?><p class="sayfa-bas-alt"><?= $sayfa['altBaslik'] ?></p><?php endif; ?>
  </div>
</section>
<?php endif; ?>
