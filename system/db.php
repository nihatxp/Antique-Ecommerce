<?php
function inp_filter($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function getirKategoriler()
{
    global $conn;
    $query = $conn->prepare("SELECT * FROM kategori");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function IdIleKatGetir($id)
{
    global $conn;
    $query = $conn->prepare("SELECT * FROM kategori where kategori_id=?");
    $query->execute([$id]);
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}


function getirKuponlar()
{
    global $conn;
    $query = $conn->prepare("SELECT * FROM kupon");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getirKupon($kupon_id = null)
{
    global $conn;

    if ($kupon_id == null) {
        $query = $conn->prepare("SELECT * FROM `kupon` LIMIT 0, 1");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
    } else {
        $query = $conn->prepare("SELECT * FROM kupon WHERE id=?");
        $query->execute([$kupon_id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
    }
    return $result;
}


function kacMesajVar()
{
    global $conn;
    $sql = "SELECT COUNT(*) FROM mesajlar";
    global $conn;
    $urun = $conn
        ->query($sql)
        ->fetch();
    return $urun;
}



function guncelleKategori($kategori_id, $kategori_ad)
{
    global $conn;
    $conn->prepare("UPDATE `kategori` SET `kategori_ad`=? WHERE `kategori_id`=?")->execute([inp_filter($kategori_ad), inp_filter($kategori_id)]);
}

function guncelleKupon($kupon_id, $kupon_kod, $kupon_miktar)
{
    global $conn;
    $conn->prepare("UPDATE `kupon` SET `kupon_kodu`=?,`kupon_miktar`=? WHERE `id`=?")->execute([inp_filter($kupon_kod), inp_filter($kupon_miktar), inp_filter($kupon_id)]);
}

function EkleKategori($kategori_ad, $id = null)
{
    global $conn;
    if ($id != null) {
        $conn->prepare("INSERT INTO `kategori`(`kategori_id`,`kategori_ad`) VALUES (?,?)")->execute([$id, inp_filter($kategori_ad)]);
    } else {
        $conn->prepare("INSERT INTO `kategori`(`kategori_ad`) VALUES (?)")->execute([inp_filter($kategori_ad)]);
    }
}

function EkleKupon($kupon_kodu, $kupon_miktar)
{
    global $conn;
    $conn->prepare("INSERT INTO `kupon`(`kupon_kodu`, `kupon_miktar`) VALUES (?,?)")->execute([inp_filter($kupon_kodu), inp_filter($kupon_miktar)]);
}

function SilKupon($kupon_id)
{
    global $conn;
    $conn->prepare("DELETE FROM `kupon` WHERE `id`=?")->execute([$kupon_id]);
}

function SilKategori($kategori_id)
{
    global $conn;
    $conn->prepare("DELETE FROM `kategori` WHERE `kategori_id`=?")->execute([$kategori_id]);
}

function EkleUrun($kategori_id, $urun_zaman, $urun_ad, $urun_seourl, $urun_detay, $urun_fiyat, $urun_img, $urun_keyword, $urun_stok, $urun_durum, $urun_onecikar)
{
    global $conn;
    $conn->prepare("INSERT INTO `urun`(`kategori_id`, `urun_zaman`, `urun_ad`, `urun_seourl`, `urun_detay`, `urun_fiyat`, `urun_img`, `urun_keyword`, `urun_stok`, `urun_durum`, `urun_onecikar`) VALUES (?,?,?,?,?,?,?,?,?,?,?)")->execute([$kategori_id, $urun_zaman, inp_filter($urun_ad), inp_filter($urun_seourl), inp_filter($urun_detay), inp_filter($urun_fiyat), inp_filter($urun_img), inp_filter($urun_keyword), inp_filter($urun_stok), inp_filter($urun_durum), inp_filter($urun_onecikar)]);
}


function GuncelleUrun($kategori_id, $urun_zaman, $urun_ad, $urun_seourl, $urun_detay, $urun_fiyat, $urun_img, $urun_keyword, $urun_stok, $urun_durum, $urun_onecikar, $urun_id)
{
    global $conn;
    $conn->prepare("UPDATE `urun` SET `kategori_id`=?,`urun_zaman`=?,`urun_ad`=?,`urun_seourl`=?,`urun_detay`=?,`urun_fiyat`=?,`urun_img`=?,`urun_keyword`=?,`urun_stok`=?,`urun_durum`=?,`urun_onecikar`=? WHERE `urun_id`=?")->execute([inp_filter($kategori_id), $urun_zaman, $urun_ad, $urun_seourl, $urun_detay, $urun_fiyat, $urun_img, $urun_keyword, $urun_stok, $urun_durum, $urun_onecikar, $urun_id]);
}

function GuncelleUrunFotografsiz($kategori_id, $urun_zaman, $urun_ad, $urun_seourl, $urun_detay, $urun_fiyat, $urun_keyword, $urun_stok, $urun_durum, $urun_onecikar, $urun_id)
{
    global $conn;
    $conn->prepare("UPDATE `urun` SET `kategori_id`=?,`urun_zaman`=?,`urun_ad`=?,`urun_seourl`=?,`urun_detay`=?,`urun_fiyat`=?,`urun_keyword`=?,`urun_stok`=?,`urun_durum`=?,`urun_onecikar`=? WHERE `urun_id`=?")->execute([inp_filter($kategori_id), inp_filter($urun_zaman), inp_filter($urun_ad), inp_filter($urun_seourl), inp_filter($urun_detay), inp_filter($urun_fiyat), inp_filter($urun_keyword), inp_filter($urun_stok), inp_filter($urun_durum), inp_filter($urun_onecikar), inp_filter($urun_id)]);
}

function SilUrun($id)
{
    global $conn;
    $conn->prepare("DELETE FROM urun WHERE urun_id = ?")->execute([$id]);
}

function cekUrun($id)
{
    global $conn;
    $urun = $conn
        ->query("SELECT * FROM urun WHERE urun_id = $id")
        ->fetchAll();
    return $urun;
}



function ListeleUrun($nerdenBaslasin = null, $kacTaneGelsin = null, $filter = null, $sirala = null)
{
    global $conn;
    $sql = "SELECT * FROM urun";
    if (isset($filter)) {
        if ($filter == "onecikan") {
            $sql .= " WHERE urun_onecikar = 1";
        }

        if ($filter == "pasif") {
            $sql .= " Where urun_durum = true";
        }

        if ($filter == "fotografsiz") {
            $sql .= " Where urun_img = 'default.jpg'";
        }

        if ($filter == "stoktaYok") {
            $sql .= " Where urun_stok = 0";
        }

        if ($filter == "aciklamasiz") {
            $sql .= " Where urun_detay = ''";
        }
    }

    if (isset($sirala)) {
        if ($sirala == "default") {
            $sql .= "";
        }

        if ($sirala == "az") {
            $sql = "SELECT * FROM urun ORDER BY urun_ad ASC";
        }

        if ($sirala == "za") {
            $sql = "SELECT * FROM urun ORDER BY urun_ad DESC";
        }

        if ($sirala == "stok") {
            $sql = "SELECT * FROM urun WHERE urun_stok > 0";
        }
    }

    if (isset($nerdenBaslasin) && isset($kacTaneGelsin)) {
        $sql .= " LIMIT $nerdenBaslasin, $kacTaneGelsin";
    }

    $urun = $conn
        ->query($sql)
        ->fetchAll();
    return $urun;
}

function ListeleKullanicilar($nerdenBaslasin = null, $kacTaneGelsin = null, $filter = null)
{
    global $conn;
    $sql = "SELECT * FROM kullanici";
    if (isset($filter)) {
        if ($filter == "onecikan") {
            $sql .= " WHERE urun_onecikar = 1";
        }

        if ($filter == "fotografsiz") {
            $sql .= " Where urun_img = 'default.jpg'";
        }
    }
    if (isset($nerdenBaslasin) && isset($kacTaneGelsin)) {
        $sql .= " LIMIT $nerdenBaslasin, $kacTaneGelsin";
    }

    $urun = $conn
        ->query($sql)
        ->fetchAll();
    return $urun;
}

function silKullanici($id)
{
    global $conn;
    $conn->prepare("DELETE FROM kullanici WHERE kullanici_id = ?")->execute([$id]);
}



function ListeleUrunAz()
{
    global $conn;
    $urun = $conn
        ->query("SELECT * FROM urun ORDER BY urun_ad ASC")
        ->fetchAll();
    return $urun;
}

function ListeleUrunZa()
{
    global $conn;
    $urun = $conn
        ->query("SELECT * FROM urun ORDER BY urun_ad DESC")
        ->fetchAll();
    return $urun;
}

function ListeleUrunStok()
{
    global $conn;
    $urun = $conn
        ->query("SELECT * FROM urun WHERE urun_stok > 0")
        ->fetchAll();
    return $urun;
}

function StoktaVarMi($urun_id)
{
    global $conn;
    $urun = $conn
        ->query("SELECT urun_ad FROM urun WHERE urun_id = $urun_id AND urun_stok > 0")
        ->fetch();
    return $urun;
}

function ekleKullanici($kullResim, $kullMail, $kullSifre, $kullIsim, $kullAdres, $kullDurum)
{
    global $conn;
    $conn->prepare("INSERT INTO `kullanici`(`kullanici_zaman`, `kullanici_resim`, `kullanici_mail`, `kullanici_password`, `kullanici_adsoyad`, `kullanici_adres`, `kullanici_durum`) VALUES (?,?,?,?,?,?,?)")->execute([date("Y-m-d H:i:s"), inp_filter($kullResim), inp_filter($kullMail), inp_filter($kullSifre), inp_filter($kullIsim), inp_filter($kullAdres), inp_filter($kullDurum)]);
}

function guncelleKullaniciWithPhoto($kullResim, $kullMail, $kullIsim, $kullAdres, $kullDurum, $id)
{
    global $conn;
    $conn->prepare("UPDATE `kullanici` SET `kullanici_zaman`=?,`kullanici_resim`=?,`kullanici_mail`=?,`kullanici_adsoyad`=?,`kullanici_adres`=?,`kullanici_durum`=? WHERE kullanici_id = ?")->execute([date("Y-m-d H:i:s"), inp_filter($kullResim), inp_filter($kullMail), inp_filter($kullIsim), inp_filter($kullAdres), inp_filter($kullDurum), $id]);
}


function guncelleKullaniciWithoutPhoto($kullMail, $kullIsim, $kullAdres, $kullDurum, $id)
{
    global $conn;
    $conn->prepare("UPDATE `kullanici` SET `kullanici_zaman`=?,`kullanici_mail`=?,`kullanici_adsoyad`=?,`kullanici_adres`=?,`kullanici_durum`=? WHERE kullanici_id = ?")->execute([date("Y-m-d H:i:s"), inp_filter($kullMail), inp_filter($kullIsim), inp_filter($kullAdres), inp_filter($kullDurum), $id]);
}

function selectKullaniciPhoto($kullid)
{
    global $conn;
    $kull = $conn
        ->query("SELECT kullanici_resim FROM kullanici where kullanici_id = " . $kullid)
        ->fetchAll();
    return $kull;
}

function KacKullaniciVar()
{
    global $conn;
    $kull = $conn
        ->query("SELECT COUNT(*) FROM kullanici")
        ->fetch();
    return $kull;
}

function KacUrunVar($filter = null)
{
    global $conn;
    $sql = "SELECT COUNT(*) FROM urun";
    if (isset($filter)) {
        if ($filter == "onecikan") {
            $sql .= " WHERE urun_onecikar = 1";
        }

        if ($filter == "pasif") {
            $sql .= " Where urun_durum = true";
        }

        if ($filter == "fotografsiz") {
            $sql .= " Where urun_img = 'default.jpg'";
        }

        if ($filter == "stoktaYok") {
            $sql .= " Where urun_stok = 0";
        }

        if ($filter == "aciklamasiz") {
            $sql .= " Where urun_detay = ''";
        }
    }
    global $conn;
    $urun = $conn
        ->query($sql)
        ->fetch();
    return $urun;
}

function mailIleIdCek($kullMail)
{
    global $conn;
    $kullId = $conn
        ->query("SELECT kullanici_id FROM kullanici WHERE kullanici_mail = '$kullMail'")
        ->fetchAll();
    return $kullId;
}

function idIleKullCek($kullId)
{
    global $conn;
    $kull = $conn
        ->query("SELECT * FROM kullanici WHERE kullanici_id = '$kullId'")
        ->fetchAll();
    return $kull;
}

function mailIleIdVeParolaCek($kullMail)
{
    global $conn;
    $kull = $conn
        ->query("SELECT kullanici_id, kullanici_password FROM kullanici WHERE kullanici_mail = '$kullMail'")
        ->fetchAll();
    return $kull;
}


function bakimDurumu()
{
    global $conn;
    $bakim = $conn
        ->query("SELECT bakim_durumu FROM ayarlar WHERE id = 1")
        ->fetchAll();
    return $bakim;
}

function adminCek($adminMail)
{
    global $conn;
    $admin = $conn
        ->query("SELECT * FROM admin WHERE email = '$adminMail'")
        ->fetch();
    return $admin;
}

function getirUrun($urunId)
{
    global $conn;
    $urun = $conn
        ->query("SELECT * FROM urun WHERE urun_id = '$urunId'")
        ->fetch();
    return $urun;
}

function IlkAdminiCek()
{
    global $conn;
    $admin = $conn
        ->query("SELECT * FROM admin")
        ->fetch();
    return $admin;
}

function siteDurumunuGuncelle($siteDurum)
{
    global $conn;
    $conn->prepare("UPDATE `ayarlar` SET `bakim_durumu`=? WHERE id = 1")->execute([inp_filter($siteDurum)]);
}

function siteDurumu()
{
    global $conn;
    $siteDurum = $conn
        ->query("SELECT bakim_durumu FROM ayarlar WHERE id = 1")
        ->fetch();
    return $siteDurum;
}

function oneCikanUrunler()
{
    global $conn;
    $oneCikanUrunler = $conn
        ->query("SELECT * FROM urun WHERE urun_onecikar = '1'")
        ->fetchAll();
    return $oneCikanUrunler;
}

function KategoriIleUrunCek($kategoriId)
{
    global $conn;
    $urun = $conn
        ->query("SELECT * FROM urun WHERE kategori_id = '$kategoriId' LIMIT 4")
        ->fetchAll();
    return $urun;
}

function AnaSayfaBasligiCek()
{
    global $conn;
    $baslik = $conn
        ->query("SELECT baslik, icerik FROM sayfalar WHERE id = 1")
        ->fetch();
    return $baslik;
}

function AnaSayfaBasligiGuncelle($baslik, $icerik)
{
    global $conn;
    $conn->prepare("UPDATE `sayfalar` SET `baslik`=?,`icerik`=? WHERE id = 1")->execute([inp_filter($baslik), inp_filter($icerik)]);
}

function HakkimizdaBasligiCek()
{
    global $conn;
    $baslik = $conn
        ->query("SELECT baslik, icerik FROM sayfalar WHERE id = 2")
        ->fetch();
    return $baslik;
}

function HakkimizdaBasligiGuncelle($baslik, $icerik)
{
    global $conn;
    $conn->prepare("UPDATE `sayfalar` SET `baslik`=?,`icerik`=? WHERE id = 2")->execute([inp_filter($baslik), inp_filter($icerik)]);
}


function MesajEkle($isim, $mail, $mesaj)
{
    global $conn;
    $conn->prepare("INSERT INTO `mesajlar`(`isim`, `mail`, `mesaj`, `zaman`)  VALUES (?,?,?,?)")->execute([inp_filter($isim), inp_filter($mail), inp_filter($mesaj), date("Y-m-d H:i:s")]);
}


function cekKupon($kuponKodu)
{
    global $conn;
    $kupon = $conn
        ->query("SELECT * FROM kupon WHERE kupon_kodu = '$kuponKodu'")->fetch();
    return $kupon;
}

function kuponEkle($kuponKodu, $kuponTuru, $kuponMiktari, $kuponKullaniciSayisi)
{
    global $conn;
    $conn->prepare("INSERT INTO `kupon`(`kupon_kodu`, `kupon_turu`, `kupon_miktari`, `kullanici_sayisi`) VALUES (?,?,?,?)")->execute([inp_filter($kuponKodu), inp_filter($kuponTuru), inp_filter($kuponMiktari), inp_filter($kuponKullaniciSayisi)]);
}

function kuponGuncelle($kuponKodu, $kuponTuru, $kuponMiktari, $kuponKullaniciSayisi, $kuponId)
{
    global $conn;
    $conn->prepare("UPDATE `kupon` SET `kupon_kodu`=?,`kupon_turu`=?,`kupon_miktari`=?,`kullanici_sayisi`=? WHERE kupon_id = ?")->execute([inp_filter($kuponKodu), inp_filter($kuponTuru), inp_filter($kuponMiktari), inp_filter($kuponKullaniciSayisi), inp_filter($kuponId)]);
}

function kuponSil($kuponId)
{
    global $conn;
    $conn->prepare("DELETE FROM `kupon` WHERE kupon_id = ?")->execute([$kuponId]);
}

function satinAlma()
{
    global $conn;
    $satinAlma = $conn
        ->query("SELECT * FROM satinalma")
        ->fetchAll();
    return $satinAlma;
}

function KacUrunKategori($kategoriId)
{
    global $conn;
    $urun = $conn
        ->query("SELECT COUNT(*) FROM urun WHERE kategori_id = '$kategoriId'")
        ->fetch();
    return $urun;
}

function Search($search, $kapsamli = false)
{
    global $conn;
    $sql = "SELECT urun_id, urun_ad FROM urun WHERE 1=0";
    if (count($search) == 0) {
        return array();
    } else {
        if ($kapsamli == true) {

            foreach ($search as $key => $value) {
                $sql .= " OR urun_ad LIKE '%$value%'";
                $sql .= " OR urun_zaman LIKE '%$value%'";
                $sql .= " OR urun_detay LIKE '%$value%'";
                $sql .= " OR urun_img LIKE '%$value%'";
            }
        } else {
            foreach ($search as $key => $value) {
                $sql .= " OR urun_ad LIKE '%$value%'";
            }
        }
        $urun = $conn
            ->query($sql)
            ->fetchAll();
        return $urun;
    }
}

function SelectUrunFoto($urunId)
{
    global $conn;
    $urun = $conn
        ->query("SELECT urun_img FROM urun WHERE urun_id = '$urunId'")
        ->fetch();
    return $urun;
}

function getirMesajlar($nerdenBaslasin = null, $kacTaneGelsin = null)
{
    global $conn;
    $sql = "SELECT * FROM mesajlar";

    if (isset($nerdenBaslasin) && isset($kacTaneGelsin)) {
        $sql .= " LIMIT $nerdenBaslasin, $kacTaneGelsin";
    }

    $mesajlar = $conn
        ->query($sql)
        ->fetchAll();
    return $mesajlar;
}

function mesajSil($mesajId)
{
    global $conn;
    $conn->prepare("DELETE FROM `mesajlar` WHERE id = ?")->execute([$mesajId]);
}

function stokAzalt($urun_id)
{
    global $conn;
    $conn->prepare("UPDATE `urun` SET `urun_stok`= urun_stok - 1 WHERE urun_id = ?")->execute([inp_filter($urun_id)]);
}

function KategoriyeGoreRandomUrunGetir($kategoriId)
{
    global $conn;
    $katUrun = $conn
        ->query("SELECT * FROM urun where kategori_id = $kategoriId ORDER BY rand() LIMIT 6")
        ->fetchAll();
    return $katUrun;
}

function KategoriyeGoreRandomUrunIdGetir($kategoriId)
{
    global $conn;
    $katUrun = $conn
        ->query("SELECT urun_id FROM urun where kategori_id = $kategoriId ORDER BY rand() LIMIT 2")
        ->fetchAll();
    return $katUrun;
}


function yorumEkle($kullanici_id, $urun_id, $yorum)
{
    global $conn;
    $conn->prepare("INSERT INTO `yorumlar`(`kullanici_id`, `urun_id`, `yorum_detay`) VALUES (?,?,?)")->execute([inp_filter($kullanici_id), inp_filter($urun_id), inp_filter($yorum)]);
}

function yorumOnayla($yorum_id)
{
    global $conn;
    $conn->prepare("UPDATE `yorumlar` SET `yorum_onay`= '1' WHERE yorum_id = ?")->execute([inp_filter($yorum_id)]);
}

function OnayKaldir($yorum_id)
{
    global $conn;
    $conn->prepare("UPDATE `yorumlar` SET `yorum_onay`= '0' WHERE yorum_id = ?")->execute([inp_filter($yorum_id)]);
}

function yorumSil($yorum_id)
{
    global $conn;
    $conn->prepare("DELETE FROM `yorumlar` WHERE yorum_id = ?")->execute([$yorum_id]);
}

function ListeleYorumlar()
{
    global $conn;
    $yorumlar = $conn
        ->query("SELECT * FROM `yorumlar`")
        ->fetchAll();
    return $yorumlar;
}

function onaylanmisYorumlariGetir($id = null)
{
    global $conn;
    $sql = "SELECT * FROM `yorumlar` WHERE yorum_onay = \"1\"";

    if (isset($id)) {
        $sql .= " AND urun_id = $id";
    }
    $yorumlar = $conn
        ->query($sql) //dogru sorgu yapamadim ama calisiyor
        ->fetchAll();
    return $yorumlar;
}

function ListeleSayfa()
{
    global $conn;
    $sayfalar = $conn
        ->query("SELECT * FROM `sayfa_goruntulenme`")
        ->fetchAll();
    return $sayfalar;
}

function sayfaHit($sayfa_id)
{
    global $conn;
    $conn->prepare("UPDATE `sayfa_goruntulenme` SET `goruntulenme`= goruntulenme + 1 WHERE id = ?")->execute([inp_filter($sayfa_id)]);
}


function sayfaSifirla()
{
    global $conn;
    $conn->prepare("UPDATE `sayfa_goruntulenme` SET `goruntulenme`= 0")->execute();
}

function guncelleKullanici($kullanici_id, $kullanici_resim, $kullanici_mail, $kullanici_parola, $kullanici_adsoyad, $kullanici_adres, $kullanici_durum)
{
    global $conn;

    if ($kullanici_resim == "" && $kullanici_parola == "") {
        $conn->prepare("UPDATE `kullanici` SET `kullanici_mail`=?,`kullanici_adsoyad`=?,`kullanici_adres`=?,`kullanici_durum`=? WHERE kullanici_id = ?")->execute([inp_filter($kullanici_mail), inp_filter($kullanici_adsoyad), inp_filter($kullanici_adres), inp_filter($kullanici_durum), inp_filter($kullanici_id)]);
    } else if ($kullanici_resim == "") {
        $conn->prepare("UPDATE `kullanici` SET `kullanici_mail`=?,`kullanici_password`=?,`kullanici_adsoyad`=?,`kullanici_adres`=?,`kullanici_durum`=? WHERE kullanici_id = ?")->execute([inp_filter($kullanici_mail), inp_filter(md5($kullanici_parola)), inp_filter($kullanici_adsoyad), inp_filter($kullanici_adres), inp_filter($kullanici_durum), inp_filter($kullanici_id)]);
    } else if ($kullanici_parola == "") {

        $conn->prepare("UPDATE `kullanici` SET `kullanici_resim`=?,`kullanici_mail`=?,`kullanici_adsoyad`=?,`kullanici_adres`=?,`kullanici_durum`=? WHERE kullanici_id = ?")->execute([inp_filter($kullanici_resim), inp_filter($kullanici_mail), inp_filter($kullanici_adsoyad), inp_filter($kullanici_adres), inp_filter($kullanici_durum), inp_filter($kullanici_id)]);
    } else {
        $conn->prepare("UPDATE `kullanici` SET `kullanici_resim`=?,`kullanici_mail`=?,`kullanici_password`=?,`kullanici_adsoyad`=?,`kullanici_adres`=?,`kullanici_durum`=? WHERE kullanici_id = ?")->execute([inp_filter($kullanici_resim), inp_filter($kullanici_mail), inp_filter(md5($kullanici_parola)), inp_filter($kullanici_adsoyad), inp_filter($kullanici_adres), inp_filter($kullanici_durum), inp_filter($kullanici_id)]);
    }
}

function urunSil($urun_id)
{
    global $conn;
    $conn->prepare("DELETE FROM `urun` WHERE urun_id = ?")->execute([inp_filter($urun_id)]);
}

function adminGuncelle($admin_id, $username, $admin_mail, $admin_parola, $admin_adsoyad, $admin_tel)
{
    global $conn;

    if ($admin_parola == "") {
        $conn->prepare("UPDATE `admin` SET `username`=?,`tam-ad`=?,`email`=?,`telefon`=? WHERE id = ?")->execute([inp_filter($username), inp_filter($admin_adsoyad), inp_filter($admin_mail), inp_filter($admin_tel), inp_filter($admin_id)]);
    } else {
        $conn->prepare("UPDATE `admin` SET `username`=?,`tam-ad`=?,`email`=?,`parola`=?,`telefon`=? WHERE id = ?")->execute([inp_filter($username), inp_filter($admin_adsoyad), inp_filter($admin_mail), inp_filter(md5($admin_parola)), inp_filter($admin_tel), inp_filter($admin_id)]);
    }
}


function sssEkle($sss_baslik, $sss_icerik, $sss_sira)
{
    global $conn;
    $conn->prepare("INSERT INTO `sss` SET `soru`=?,`cevap`=? `sira`=? ")->execute([inp_filter($sss_baslik), inp_filter($sss_icerik), inp_filter($sss_sira)]);
}

function sssGetir($sira = null)
{
    global $conn;
    $sql = "SELECT * FROM `sss`";
    if ($sira) {
        $sql .= " WHERE sira = $sira";
    }
    $sss = $conn
        ->query($sql)
        ->fetchAll();
    return $sss;
}

function AdminMailDogruMu($admin_mail)
{
    global $conn;
    $admin = $conn
        ->query("SELECT * FROM `admin` WHERE email = '$admin_mail'")
        ->fetchAll();
    return $admin;
}

function adminSifreDegistir($admin_mail, $admin_parola)
{
    global $conn;
    $conn->prepare("UPDATE `admin` SET `parola`=? WHERE email = ?")->execute([inp_filter(md5($admin_parola)), inp_filter($admin_mail)]);
}

function setAdminToken($admin_id, $token)
{
    global $conn;
    $conn->prepare("INSERT INTO `admin`(`token`) VALUES ('?')")->execute([$token]);

}
    

function selectAdminToken(){
    global $conn;
    $admin = $conn
        ->query("SELECT token FROM `admin`")
        ->fetch();
    return $admin;
}