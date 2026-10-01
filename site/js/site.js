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
  document.addEventListener('keydown', function (e) {
    if (e.key !== 'Escape') return;
    document.querySelectorAll('.alt-var.acik').forEach(function (li) {
      li.classList.remove('acik');
      var b = li.querySelector('.alt-ac'); if (b) b.setAttribute('aria-expanded', 'false');
    });
  });
})();
