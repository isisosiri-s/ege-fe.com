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
  // SSS akordiyon: aynı anda tek cevap açık. Açılış CSS animasyonuyla (opacity + transform);
  // kapanışta önce .kapaniyor ile solup kayar, animasyon bitince details kapanır.
  var SSS_KAPANMA = 260; // ms — style.css'teki sss-kapa süresiyle aynı
  var hareketAz = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  function sssKapat(d) {
    if (!d.open || d.classList.contains('kapaniyor')) return;
    if (hareketAz) { d.open = false; return; }
    d.classList.add('kapaniyor');
    setTimeout(function () { d.open = false; d.classList.remove('kapaniyor'); }, SSS_KAPANMA);
  }
  document.addEventListener('click', function (e) {
    var ozet = e.target.closest && e.target.closest('details.sss > summary');
    if (!ozet) return;
    var d = ozet.parentElement;
    e.preventDefault(); // aç/kapa kontrolü bizde (kapanış animasyonu için)
    if (d.classList.contains('kapaniyor')) return;
    if (d.open) { sssKapat(d); return; }
    document.querySelectorAll('details.sss[open]').forEach(sssKapat);
    d.open = true;
  });
  document.addEventListener('keydown', function (e) {
    if (e.key !== 'Escape') return;
    document.querySelectorAll('.alt-var.acik').forEach(function (li) {
      li.classList.remove('acik');
      var b = li.querySelector('.alt-ac'); if (b) b.setAttribute('aria-expanded', 'false');
    });
  });
})();
