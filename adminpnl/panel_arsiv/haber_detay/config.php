<?
$kategori='Haber Detay';
$title='Haber Detay';		
$uzaklik="../../";
$resim_dizini=$uzaklik."rsmlr/haber_detay/";
$ustkategori_resim_dizini=$uzaklik."rsmlr/haberler/";
$thumb_resim_dizini=$uzaklik."rsmlr/haber_thumb/";
$kategori_thumb_resim_dizini=$uzaklik."rsmlr/haber_detay_thumb/";
$tablo_ismi='haber_detay';
$bir_sayfadaki_toplam_kayit_sayisi=20;
$max_file_size=500000;
$ustkategori_tablo_ismi='haberler';
$default_resim='resimyok.gif';
$byk_m_w=800;		
$byk_m_h=600;		
$height_of_image=184;
$width_of_image=138;	
$kck_m_w=600;
$kck_m_h=450;		
switch ($link_inherit) 
	{
		case 'ekle_islem.php': $insert='1'; break;	
		case 'duzenle_islem.php': $insert='0'; break;	
	}
?>