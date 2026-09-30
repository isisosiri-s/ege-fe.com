<?php require_once __DIR__ . '/form.php'; ?>
<section class="bolum bolum-acik">
  <div class="kap kap-dar">
    <p class="etiket">Kariyer Başvurusu</p>
    <h2 class="bolum-baslik">Başvuru <em>Formu</em></h2>
    <form class="form" id="form" action="/form/gonder.php" method="post" enctype="multipart/form-data">
      <?= form_durum('kariyer') ?>
      <?= form_gizli_alanlar('kariyer') ?>
      <div class="form-izgara">
        <label>İsim Soyisim *<input type="text" name="ad" required maxlength="120" autocomplete="name"></label>
        <label>E-posta Adresi *<input type="email" name="eposta" required maxlength="160" autocomplete="email"></label>
        <label>Telefon *<input type="tel" name="telefon" required maxlength="40" autocomplete="tel"></label>
        <label>Şehir<input type="text" name="sehir" maxlength="80" autocomplete="address-level2"></label>
        <label class="tam">Adres<input type="text" name="adres" maxlength="250" autocomplete="street-address"></label>
        <label class="tam">Özgeçmiş (PDF, DOC, DOCX — en fazla <?= (int)$FORM['cv_max_mb'] ?> MB) *
          <input type="file" name="cv" required accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
        </label>
        <label class="tam">Mesajınız<textarea name="mesaj" rows="5" maxlength="5000"></textarea></label>
      </div>
      <?= form_kvkk_onay('kariyer') ?>
      <button class="dugme dugme-birincil" type="submit">Başvuruyu Gönder</button>
    </form>
  </div>
</section>
