<? session_start();
$link_inherit="duzenle_islem.php";
include("config.php");
if (isset($_SESSION['yonet']))
   {
		$ad=$_POST["ad"];
		$ozet=$_POST["ozet"];
		$icerik=$_POST["icerik"];
		//$dil=$_POST["dil"];
		$htaccess_etiket=$_POST["htaccess_etiket"];
		//$puan=$_POST["puan"];
		include($uzaklik."inc_s/baglanti.php");
		//$syonetim=$_SESSION["siteyonetici"];
		//include("boyut_ogren.php");
		
		$numara=$_POST["gizli"];
		if  ($_POST["ad"]<>'' && $_POST["icerik"]<>''  && $_POST["ozet"]<>'') 	
   		    { 	  	 
				include($uzaklik."inc_s/resim_islem.php");
		    } 
		else 
		   { 
				$err="eksik_veri"; 
		   }	
		////////////////////////////////////// Geri D�n�lecekse Onlari Ayarla.. (s)
  		if (isset($err))
		   {
				$_SESSION[$tablo_ismi.'ad']=$ad;
				$_SESSION[$tablo_ismi.'icerik']=$icerik;
				$_SESSION[$tablo_ismi.'ozet']=$ozet;
				//$_SESSION[$tablo_ismi.'dil']=$dil;
				$_SESSION[$tablo_ismi.'htaccess_etiket']=$htaccess_etiket;
				header("Location:duzenle.php?err=$err&numara=$numara"); 
			}
		else
	        {
				unset($_SESSION[$tablo_ismi.'ad']);
				unset($_SESSION[$tablo_ismi.'icerik']);
				unset($_SESSION[$tablo_ismi.'ozet']);
				//unset($_SESSION[$tablo_ismi.'dil']);
				unset($_SESSION[$tablo_ismi.'htaccess_etiket']);
				if  (isset($_FILES["resim"]) && $_FILES["resim"]["size"]>0) 
					{
						if  ($insert==0)
							{
								$b_numara=$_POST['gizli'];
							} 
					   else 
					   	    {
							    $numara_bul_sql="Select max(numara) from $tablo_ismi";
							    $numara_bul_sql_calistir=@$baglanti->query($numara_bul_sql)->fetchAll(PDO::FETCH_ASSOC);
						        $b_numara=$numara_bul_sql_calistir[0]["max(numara)"];
					        }
					   $resim_ogren=@$baglanti->query("Select * from $tablo_ismi where numara=$b_numara")->fetchAll(PDO::FETCH_ASSOC);
					   if (count($resim_ogren)>0)	
						  {
								$buyuk_resim=$resim_ogren[0]["resim_adres"];
								if  ($buyuk_resim<>"")
									{
										include($uzaklik."inc_s/thumbnail.php");
										// thumb u olusturmak icin //////////////////////////////////////////////////////////// (s)
									    if  (file_exists($thumb_resim_dizini.$buyuk_resim))     
											{  
												@chmod($thumb_resim_dizini.$buyuk_resim,0777); @unlink($thumb_resim_dizini.$buyuk_resim);
											}
										Thumbnail($resim_dizini,$buyuk_resim,$thumb_resim_dizini,$kck_m_w,$kck_m_h);
										// thumb u olusturmak icin //////////////////////////////////////////////////////////// (f)					
									} // Eger gecerli bir resim eklenmisse bu resmin thumb u olusturuluyor(f)
								// Eger buyuk ve kucuk resim ayni boyuttaysa buyuk resim siliniyor (s)
								if  (file_exists($resim_dizini.$buyuk_resim) && $resim_dizini.$buyuk_resim<>$resim_dizini && file_exists($thumb_resim_dizini.$buyuk_resim) && $thumb_resim_dizini.$buyuk_resim<>$thumb_resim_dizini)
									{
										$kucuk=getimagesize($thumb_resim_dizini.$buyuk_resim);
										$buyuk=getimagesize($resim_dizini.$buyuk_resim);
										$b_width=$buyuk[0];
										$k_width=$kucuk[0];							
										if  ($b_width==$k_width)
											{
											    if  (file_exists($resim_dizini.$buyuk_resim))    
													{  
														@chmod($resim_dizini.$buyuk_resim,0777); @unlink($resim_dizini.$buyuk_resim);
													}
											}
										else
											{
												Thumbnail($resim_dizini,$buyuk_resim,$resim_dizini,$byk_m_w,$byk_m_h);
											}
									}
								// Eger buyuk ve orta resim ayni boyuttaysa buyuk resim siliniyor (f)
							}   
							// Eger	gecerli bir kayit eklenmise resmin thumb unu ekliyoruz (f) //////////////////////////////////
						} // eger resim geldiyse
					/////////////////////////////////////////////////////////////////////////////////////////////
					///////////////  F  I  N  I  S  H  //////////////////////////////////////////////////////////
					include("yonlendir.php");
		 		    header("Location:kontrol.php?sayfa_no=$donulecek_sayfa"); 	 
			}
		////////////////////////////////////// Geri D�n�lecekse Onlari Ayarla..	 (f)
   } 
else 
   {
	    unset($_SESSION['yonet']);
	    include('error.php');
    }  //  (f)izinsiz girisleri engellemek i�in  kullanilmaktadir.
?>