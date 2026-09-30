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
  document.addEventListener('keydown', function (e) {
    if (e.key !== 'Escape') return;
    document.querySelectorAll('.alt-var.acik').forEach(function (li) {
      li.classList.remove('acik');
      var b = li.querySelector('.alt-ac'); if (b) b.setAttribute('aria-expanded', 'false');
    });
  });
})();
