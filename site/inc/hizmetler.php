<?php
// ÜRETİLDİ: tools/build.mjs — elle düzenlemeler bir sonraki üretimde ezilir (açıklamalar hariç: bkz. inc/meta.php başı)
return [
  'servis' => [
    'yol' => '/hizmetler/',
    'ad' => 'Servis Hizmetleri',
    'alt' => [[
        'yol' => '/ariza-ve-onarim/',
        'ad' => 'Arıza ve Onarım',
        'ozet' => 'NAM-07 ve NAM-19 cihazlarının ve yedek parçalarının arızi bakımlarını üstleniyoruz.',
      ], [
        'yol' => '/periyodik-bakim/',
        'ad' => 'Periyodik Bakım',
        'ozet' => 'Satışını ve bakımlarını yaptığımız Alkolmetrelerin belirlenmiş periyotlar dahilinde bakımları yapılmaktadır.',
      ], [
        'yol' => '/kalibrasyon/',
        'ad' => 'Kalibrasyon',
        'ozet' => 'Kalibrasyon işleminde, ölçmede kullanılan test-ölçü aleti veya cihazlarının sapmaları belirlenir, hataları düzeltilir.',
      ]],
  ],
  'danismanlik' => [[
      'yol' => '/uts/',
      'ad' => 'ÜTS',
      'giris' => 'Kozmetik firma kaydı, sorumlu teknik eleman, kozmetik ürün bildirimi, ÜTS bilgi güncelleme ve tıbbi cihaz ÜTS geçişi.',
      'alt' => [[
          'yol' => '/uts/kozmetik-firma-kaydi/',
          'ad' => 'Kozmetik Firma Kaydı',
          'ozet' => '5324 sayılı Kozmetik Kanunu gereğince kozmetik ürünlerin piyasaya arz edilmeden önce Bakanlığa bildiriminin yapılması zorunludur.',
        ], [
          'yol' => '/uts/sorumlu-teknik-eleman/',
          'ad' => 'Sorumlu Teknik Eleman',
          'ozet' => 'Eczacı veya kozmetik alanında iki yıl fiilen çalışmış olduğunu belgelemek kaydıyla kimyager, biyokimyager, kimya mühendisi, biyolog veya mikrobiyolog sorumlu teknik eleman olarak görevlendirilebilir.',
        ], [
          'yol' => '/uts/kozmetik-urun-bildirimi/',
          'ad' => 'Kozmetik Ürün Bildirimi',
          'ozet' => 'Bir kozmetik ürün üretip satışa sunacaksanız ya da bir kozmetik ürün ithal edip Türkiye pazarına arz edecekseniz, öncesinde kozmetik kapsamında değerlendirilen tüm ürünleriniz için Sağlık Bakanlığı’na ürün bildirimi başvurusu yapmalısınız.',
        ], [
          'yol' => '/uts/uts-bilgi-guncelleme/',
          'ad' => 'ÜTS Bilgi Güncelleme',
          'ozet' => 'Özellikle CE sertifikaları (EC certificate) tahditli validasyona sahiptir. Yani belli bir süre sonra geçerliğini yitirir ve yenilenmesi gerekir (expiration / validation date).',
        ], [
          'yol' => '/uts/tibbi-cihaz-uts-gecisi/',
          'ad' => 'Tıbbi Cihaz ÜTS Geçişi',
          'ozet' => 'Türkiye İlaç ve Tıbbi Cihaz Kurumu tarafından yayımlanan duyuru gereğince, 01.10.2018 tarihi itibariyle de sınıf III ürün gruplarında tekil ürün hareketleri başlayacaktır.',
        ]],
    ], [
      'yol' => '/tibbi-cihaz/',
      'ad' => 'Tıbbi Cihaz',
      'giris' => 'Firma kaydı, firma bilgileri güncelleme, UBB e-imza, belge kaydı ve etiket düzenleme.',
      'alt' => [[
          'yol' => '/tibbi-cihaz/firma-kaydi/',
          'ad' => 'Firma Kaydı',
          'ozet' => 'Tıbbi cihaz üreticisi, ithalatçısı veya yetkili temsilcisi firmaların UBB/ÜTS firma kaydı ve faaliyet alanı seçimi.',
        ], [
          'yol' => '/tibbi-cihaz/firma-bilgileri-guncelleme/',
          'ad' => 'Firma Bilgileri Güncelleme',
          'ozet' => 'TİTUBB firma kayıt işlemlerinde verilen taahhütname gereği, TİTUBB’daki bilgi-belge değişiklikleri firma veya kurumlar tarafından gecikmeksizin sisteme yansıtılmalıdır.',
        ], [
          'yol' => '/tibbi-cihaz/ubb-e-imza/',
          'ad' => 'UBB E-İmza',
          'ozet' => 'Nitelikli Elektronik Sertifika’ya(NES) dayanılarak oluşturulan elektronik imza (e-İmza) güvenli elektronik imzadır. 5070 sayılı Elektronik İmza Kanunu uyarınca, “güvenli elektronik imza, elle atılan imzayla aynı hukuki sonucu doğurur”.',
        ], [
          'yol' => '/tibbi-cihaz/tibbi-cihaz-belge-kaydi/',
          'ad' => 'Tıbbi Cihaz Belge Kaydı',
          'ozet' => 'CE sertifikası, uygunluk beyanı, Türkçe etiket ve kullanım kılavuzu gibi belgelerle tıbbi cihaz belge kaydı.',
        ], [
          'yol' => '/tibbi-cihaz/etiket-duzenleme/',
          'ad' => 'Etiket Düzenleme',
          'ozet' => 'Tıbbi cihaz etiketi ve kullanım kılavuzunun yönetmeliklere uygun ve Türkçe olarak düzenlenmesi.',
        ]],
    ], [
      'yol' => '/saglik-bakanligi-islemleri/',
      'ad' => 'Sağlık Bakanlığı İşlemleri',
      'giris' => 'İlaç ruhsatlandırma, varyasyon, fiyatlandırma, biyosidal ruhsat, GMP, KÜB/KT ve okunabilirlik testi.',
      'alt' => [[
          'yol' => '/saglik-bakanligi-islemleri/ilac-ruhsatlandirma/',
          'ad' => 'İlaç Ruhsatlandırma',
          'ozet' => 'Beşeri tıbbi ürünlerin pazara sunulabilmesi için Türkiye İlaç ve Tıbbi Cihaz Kurumu\'ndan (TİTCK) ruhsat alınması.',
        ], [
          'yol' => '/saglik-bakanligi-islemleri/ilac-varyasyon/',
          'ad' => 'İlaç Varyasyon',
          'ozet' => 'Güncel varyasyon kılavuzu doğrultusunda varyasyon kapsamının (Tip IA, Tip IB, Tip II) belirlenmesi ve varyasyon dosyasının hazırlanması.',
        ], [
          'yol' => '/saglik-bakanligi-islemleri/ilac-fiyatlandirma/',
          'ad' => 'İlaç Fiyatlandırma',
          'ozet' => 'Avrupa Birliği (AB) üyeleri arasından en az 5, en fazla 10 ülke referans ülke olarak Sağlık Bakanlığınca belirlenir ve bir tebliğle duyurulur.',
        ], [
          'yol' => '/saglik-bakanligi-islemleri/biyosidal-ruhsatlandirma/',
          'ad' => 'Biyosidal Ruhsatlandırma',
          'ozet' => 'Kimyasal veya biyolojik açıdan herhangi bir zararlı organizma üzerinde kontrol edici etki gösteren veya hareketini kısıtlayan, zararsız kılan, yok eden aktif madde ve preparatlardır.',
        ], [
          'yol' => '/saglik-bakanligi-islemleri/gmp-basvurusu/',
          'ad' => 'GMP Başvurusu',
          'ozet' => 'CTD ruhsat başvurularında sunulması zorunlu GMP belgesi için başvuru ve yurt dışı üretim tesisi denetim süreçleri.',
        ], [
          'yol' => '/saglik-bakanligi-islemleri/kub-kt/',
          'ad' => 'KÜB/KT',
          'ozet' => 'Kısa Ürün Bilgisi (KÜB) ve Kullanma Talimatı (KT) değerlendirme başvurularının hazırlanması.',
        ], [
          'yol' => '/saglik-bakanligi-islemleri/okunabilirlik-testi/',
          'ad' => 'Okunabilirlik Testi',
          'ozet' => 'Ruhsat sürecindeki beşeri tıbbi ürünlerin kullanma talimatı için istenen okunabilirlik testi.',
        ]],
    ], [
      'yol' => '/diger-hizmetler/',
      'ad' => 'Diğer Hizmetler',
      'giris' => 'Permi belgesi, CE teknik dosya, takviye edici gıda ve kontrol belgesi.',
      'alt' => [[
          'yol' => '/diger-hizmetler/permi-belgesi/',
          'ad' => 'Permi Belgesi',
          'ozet' => 'Uyuşturucu ve psikotrop madde yapımında kullanılabilecek kimyasalların ithalatı için TİTCK\'den alınan permi belgesi.',
        ], [
          'yol' => '/diger-hizmetler/ce-teknik-dosya-hazirlanmasi/',
          'ad' => 'CE Teknik Dosya Hazırlanması',
          'ozet' => 'CE belgesi almak için başvuruda bulunan firmalar CE teknik dosyası hazırlamak zorundadır.',
        ], [
          'yol' => '/diger-hizmetler/takviye-edici-gida/',
          'ad' => 'Takviye Edici Gıda',
          'ozet' => 'Takviye edici gıdaların bileşim, vitamin-mineral limitleri ve kullanılan maddeler yönünden mevzuata uygunluğu.',
        ], [
          'yol' => '/diger-hizmetler/kontrol-belgesi/',
          'ad' => 'Kontrol Belgesi',
          'ozet' => 'Sağlık Bakanlığınca denetlenen ürünlerin ithalatında istenen kontrol belgesi ve uygunluk yazısı.',
        ]],
    ]],
  'ilac' => ['/saglik-bakanligi-islemleri/ilac-ruhsatlandirma/', '/saglik-bakanligi-islemleri/ilac-varyasyon/', '/saglik-bakanligi-islemleri/ilac-fiyatlandirma/', '/saglik-bakanligi-islemleri/kub-kt/', '/saglik-bakanligi-islemleri/okunabilirlik-testi/', '/saglik-bakanligi-islemleri/gmp-basvurusu/'],
];
