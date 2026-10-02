// Mobil menü ve alt menü aç/kapa (içerik ve menü HTML'de hazır; JS yalnız etkileşim içindir)
(function () {
  var dugme = document.querySelector('.menu-dugme');
  var menu = document.getElementById('ana-menu');
  if (dugme && menu) {
    dugme.addEventListener('click', function () {
      var acik = dugme.getAttribute('aria-expanded') === 'true';
      dugme.setAttribute('aria-expanded', String(!acik));
      menu.classList.toggle('acik', !acik);
      document.body.classList.toggle('menu-acik', !acik);
    });
  }
  document.querySelectorAll('.alt-ac').forEach(function (b) {
    b.addEventListener('click', function () {
      var li = b.closest('li');
      var acik = li.classList.toggle('acik');
      b.setAttribute('aria-expanded', String(acik));
    });
  });
  // SSS akordiyon: aynı anda tek cevap açık; kutu yumuşakça uzar/kısalır, yazı solarak belirir/kaybolur.
  // İSTİSNA (kullanıcı isteği 2026-10-01): kural "yalnız transform/opacity" — burada kutu yüksekliği de
  // Web Animations ile canlandırılır (yalnız açılış/kapanış anında, kısa süre).
  var SSS_SURE = 380; // ms
  var SSS_EGRI = 'cubic-bezier(.22, 1, .36, 1)'; // --yumusak
  var hareketAz = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  function kapaliYukseklik(d) {
    var kenar = d.offsetHeight - d.clientHeight; // üst + alt kenarlık
    return d.querySelector('summary').offsetHeight + kenar;
  }
  function sssAnimasyon(d, bas, son, bitince) {
    if (d._sssAnim) d._sssAnim.cancel();
    d.style.overflow = 'hidden';
    var a = d.animate([{ height: bas + 'px' }, { height: son + 'px' }], { duration: SSS_SURE, easing: SSS_EGRI });
    d._sssAnim = a;
    a.onfinish = function () { d._sssAnim = null; d.style.overflow = ''; if (bitince) bitince(); };
  }
  function sssKapat(d) {
    if (!d.open || d.classList.contains('kapaniyor')) return;
    if (hareketAz || !d.animate) { d.open = false; return; }
    d.classList.add('kapaniyor');
    sssAnimasyon(d, d.offsetHeight, kapaliYukseklik(d), function () { d.open = false; d.classList.remove('kapaniyor'); });
  }
  function sssAc(d) {
    if (hareketAz || !d.animate) { d.open = true; return; }
    var bas = d.offsetHeight;
    d.open = true;
    sssAnimasyon(d, bas, d.offsetHeight);
  }
  document.addEventListener('click', function (e) {
    var ozet = e.target.closest && e.target.closest('details.sss > summary');
    if (!ozet) return;
    var d = ozet.parentElement;
    e.preventDefault(); // aç/kapa kontrolü bizde (animasyon için)
    if (d.classList.contains('kapaniyor')) return;
    if (d.open) { sssKapat(d); return; }
    document.querySelectorAll('details.sss[open]').forEach(sssKapat);
    sssAc(d);
  });
  // Blog konu filtresi (JS yoksa filtre gizli kalır, tüm yazılar görünür)
  var filtre = document.querySelector('.blog-filtre');
  if (filtre) {
    filtre.hidden = false;
    filtre.addEventListener('click', function (e) {
      var b = e.target.closest('.blog-filtre-dugme'); if (!b) return;
      var k = b.getAttribute('data-filtre');
      filtre.querySelectorAll('.blog-filtre-dugme').forEach(function (x) { x.setAttribute('aria-pressed', String(x === b)); });
      document.querySelectorAll('.yazi-karti[data-konu]').forEach(function (y) { y.hidden = k !== 'tumu' && y.getAttribute('data-konu') !== k; });
    });
  }
  // Cihaz karşılaştırma (ürünler): seçim çipleriyle cihaz seçilir;
  // en fazla N cihaz; seçilmeyen sütunlar gizlenir; "yalnızca farklar" eşit satırları gizler. JS yoksa tablo tam görünür.
  var karsi = document.getElementById('karsilastir');
  if (karsi) {
    var enFazla = parseInt(karsi.getAttribute('data-en-fazla'), 10) || 3;
    var kutular = function () { return document.querySelectorAll('[data-karsi-sec]'); };
    var secililer = function () {
      var s = []; karsi.querySelectorAll('[data-karsi-sec]').forEach(function (k) { if (k.checked) s.push(k.value); }); return s;
    };
    var fark = karsi.querySelector('[data-karsi-fark]');
    var uyari = karsi.querySelector('[data-karsi-uyari]');
    var tablo = karsi.querySelector('.karsi-kaydir');
    var guncelle = function () {
      var s = secililer();
      kutular().forEach(function (k) {
        k.checked = s.indexOf(k.value) > -1;
        k.disabled = !k.checked && s.length >= enFazla; // sınır dolunca seçilmeyenler pasif
        k.closest('label').classList.toggle('secili', k.checked);
      });
      karsi.querySelectorAll('[data-cihaz]').forEach(function (h) { h.hidden = s.indexOf(h.getAttribute('data-cihaz')) < 0; });
      uyari.hidden = s.length >= 2;
      karsi.style.setProperty('--karsi-sutun', Math.max(s.length, 1)); // mobil tablo genişliği seçili sütun sayısına göre
      tablo.hidden = s.length < 1;
      karsi.querySelectorAll('tbody tr').forEach(function (tr) {
        var d = []; tr.querySelectorAll('td').forEach(function (td) { if (!td.hidden) d.push(td.textContent.trim()); });
        tr.hidden = fark.checked && d.length > 1 && d.every(function (v) { return v === d[0]; });
      });
    };
    document.addEventListener('change', function (e) {
      var k = e.target;
      if (k.matches && k.matches('[data-karsi-sec]')) {
        karsi.querySelectorAll('[data-karsi-sec][value="' + k.value + '"]').forEach(function (x) { x.checked = k.checked; });
        guncelle();
      } else if (k === fark) guncelle();
    });
    guncelle();
  }
  // Mobil menü: Danışmanlık grupları ayrı ayrı açılır (masaüstünde düğme gizli, liste hep açık)
  document.querySelectorAll('.grup-ac').forEach(function (b) {
    b.addEventListener('click', function () {
      var k = b.closest('.mega-kolon');
      var acik = k.classList.toggle('acik');
      b.setAttribute('aria-expanded', String(acik));
    });
  });
  document.addEventListener('keydown', function (e) {
    if (e.key !== 'Escape') return;
    document.querySelectorAll('.alt-var.acik').forEach(function (li) {
      li.classList.remove('acik');
      var b = li.querySelector('.alt-ac'); if (b) b.setAttribute('aria-expanded', 'false');
    });
  });
})();
