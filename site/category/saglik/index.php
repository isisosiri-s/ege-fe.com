<?php
$yol = '/category/saglik/';
$sayfa = ['etiket' => 'Kategori'];
require __DIR__ . '/../../inc/header.php';
$YAZILAR = array_values(array_filter(require __DIR__ . '/../../inc/blog.php', fn($y) => $y['kategori'] === 'Sağlık'));
require __DIR__ . '/../../inc/blog-liste.php';
require __DIR__ . '/../../inc/cta.php';
require __DIR__ . '/../../inc/footer.php';
