<?	session_start();
$link_inherit="kontrol.php";
include("config.php");	
include($uzaklik."inc_s/baglanti.php");
if (isset($_SESSION['yonet']))
   {
	  include($uzaklik."inc_s/sayfa_no_belirle.php");
	  $limit_ilk_deger=($sayfa_no-1)*$bir_sayfadaki_toplam_kayit_sayisi;
	  $sql_cumlesi="select numara from $tablo_ismi";
	  $calistir_sql=@$baglanti->query($sql_cumlesi)->fetchAll(PDO::FETCH_ASSOC);																																																			
	  $toplam_kayit_sayisi_calistir_sql=count($calistir_sql);
	  include($uzaklik."inc_s/sayfalama.php");
	  sayfala($toplam_kayit_sayisi_calistir_sql,$bir_sayfadaki_toplam_kayit_sayisi);
	  $sql_cumlesi="select * from $tablo_ismi order by numara desc limit $limit_ilk_deger,$bir_sayfadaki_toplam_kayit_sayisi";
	  $recordset=@$baglanti->query($sql_cumlesi)->fetchAll(PDO::FETCH_ASSOC);
	  $toplam_kayit_sayisi=count($recordset);
?>	
<SCRIPT language=JavaScript1.2 src="<? print $uzaklik; ?>js/feedback.js"></SCRIPT>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><? echo $title; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
.style3 {color: #132C6A;font-weight: bold;}
</style>
<link href="../css/kontrolpanel.css" rel="stylesheet" type="text/css"></head>
<body>
<table width="950" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr> 
    <td width="48" class="td_anabaslik"><div align="center"><img src="../pictures/ana_dok.gif" width="48" height="48"></div></td>
    <td width="904" class="td_anabaslik"><font class="veri_ana_baslik"><a href="../anaframe.php" class="veri_ana_baslik" >Kontrol Panel</a> &gt;</font></td>
  </tr>
</table>
<table width="950" align="center"  class="table">
  <tr> 
<form  name="xxx" action="kontrol_islem.php" method="post">
      <td width="1212"  align="left" valign="top" bordercolor="#C0C0C0" bgcolor="#FFFFFF">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
<?
if  ( $toplam_kayit_sayisi>0)
    {
?>
          <tr> 
            <td><table width="100%" border="0" cellspacing="2" cellpadding="2">
                <tr>
                  <td colspan="6" class="anabaslik">Dökümanlar</td>
                </tr>
				<? if ($toplam_sayfa_sayisi>1) { ?>
				<tr>
                  <td colspan="6"><div align="center">
                    <table width="100%" bordercolor="#CCCCCC" bgcolor="#FFFFFF">
                      <tr bgcolor="#EBEBEB">
                        <td height="25" valign="bottom" bgcolor="#FFFFFF"><div align="right"><? include("navigation.php"); ?></div></td>
                        </tr>
                    </table>
                  </div></td>
                </tr>
				<? } ?>
                <tr>
                  <td width="5%"><div align="center" class="style3">
                    <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Aktif</font></div>
                  </div></td> 
                  <td width="5%"><div align="center" class="style3">
                      <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Sil</font></div>
                  </div></td>
                  <td><font color="#132C6A" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Dosya</strong></font></td>
                  <td><font color="#132C6A" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Dil</strong></font></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
				 <?
				 for ($sayac=0; $sayac<$toplam_kayit_sayisi; $sayac++)
					 {
						$dosya=$recordset[$sayac]["dosya"];
						$ad=$recordset[$sayac]["ad"];
						$aktif=$recordset[$sayac]["aktif"];
						$numara=$recordset[$sayac]["numara"];	
						$dil=$recordset[$sayac]["dil"];
						switch ($dil)
							   {		
									case 1: $dil_aciklama="Türkçe"; break;
									case 2: $dil_aciklama="İngilizce"; break;
							   }			
				?>
                <tr>
                  <td class="aktif_tdler">
                  <div align="center">
                  <input type="checkbox" <? if ($aktif=='1')  { print("checked"); }  ?> name="onay_no[<? print($numara);?>]" value="<? print($numara);?>"> 
                  </div></td> 
                  <td class="sil_tdler">
                  <div align="center">
                    <input name="silinecekler_numara[<? print($numara);?>]" type="checkbox" id="silinecekler_numara[<? print($numara);?>]" value="<? print($numara);?>">
                  </div></td>
                  <td width="24%" valign="middle" bgcolor="#F7F7F7"><font class="veri_baslik">&nbsp;<strong><img src="<? print $uzaklik; ?>rsmlr/gri_nokta.gif" width="12" height="12" align="absmiddle"> 
				  <? print($ad); ?></strong></font></td>
                  <td width="25%" valign="middle" bgcolor="#F7F7F7"><font class="veri_baslik"><? echo $dil_aciklama; ?></font></td>
                  <td width="8%" valign="middle" bgcolor="#F7F7F7"><div align="center"><a href="<? print($dosya_dizini.$dosya); ?>" target="_blank" title="İndirmek için tıklayınız"><img src="../../rsmlr/ek.gif" width="16" height="16" border="0" align="absmiddle"></a></div></td>
                  <td width="33%" valign="middle" bgcolor="#F7F7F7">
				  <a href="duzenle.php?numara=<? print($numara);?>" class="link_faaliyet" title="Düzenlemek İçin Tıklayınız">
				  <img src="../../rsmlr/duzenle.gif" width="50" height="39" border="0"></a></td>
                </tr>
				<?
				 	 }
				?>
            </table> </td>
          </tr>
          <tr> 
            <td><table width="100%" border="0" cellpadding="0" cellspacing="5">
                <tr> 
                  <td height="46" valign="bottom"><input name="aktiflestirme" type="submit" id="aktiflestirme" class="dugmeler_aktif" value="Aktif">
                  <input name="sil" type="submit" id="sil" class="dugmeler_sil" value=" Sil ">
                  <input name="ekle" type="submit" id="ekle"  class="dugmeler_ekle" value="Ekle">
				  <input type="hidden" name="ilkkayit" value="<? print $limit_ilk_deger; ?>">
					<input type="hidden" name="page" value="<? print $sayfa_no; ?>"></td>
                </tr>
                <tr valign="bottom" bordercolor="#FFFFFF">
                  <td valign="middle">&nbsp;</td>
                </tr>
                <tr valign="bottom" bordercolor="#FFFFFF">
                  <td valign="middle">&nbsp;</td>
                </tr>
                
              </table></td>
          </tr>
<?
    }  
 elseif  ( $toplam_kayit_sayisi==0)
   {
?>
          <tr>
            <td>
				<div align="center">
				<table width="100%" height="65">
                  <tr> 
                    <td  height="61" valign="middle" bgcolor="#FFFFFF"><div align="center"> 
                        <p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p><span class="kayit_yok">Bu Kategoride Kayıt Bulunamamıştır</span><br>
						</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p><br>
					    </p>
						<p><span class="kayit_yok">
						  <input type="hidden" name="ilkkayit" value="<? print $limit_ilk_deger; ?>">
						</span>
						  <input name="ekle" type="submit" id="ekle" class="dugmeler_ekle" value="Ekle">
                        </p>
						<p>&nbsp;</p>
						</div></td>
                     </tr>
                 </table>
              </div>
             </td>
          </tr>
<?
   }
?>
      </table></td>
</form>
  </tr>
</table>
</body>
</html>
<? 
   } 
else 
   {
	  unset($_SESSION['yonet']);
	  include('error.php');
   }  //  (f)izinsiz girisleri engellemek için  kullanilmaktadr.
?>