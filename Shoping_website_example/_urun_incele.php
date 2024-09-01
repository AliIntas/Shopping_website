<?php
include("admin/inc/baglan.php");
if (isset($_GET['id'])) {
    $urun_id = $_GET['id'];

    // Ürüne ait bilgileri çekmek için SQL sorgusu
    $sorgu = "SELECT * FROM urunler WHERE id = '$urun_id'";
    $sonuc = mysqli_query($baglanti, $sorgu);

    // Eğer sonuç varsa ürüne ait bilgileri çek
    if ($urun = mysqli_fetch_array($sonuc)) {
        $urun_adi = $urun['urun_adi'];
        $urun_resmi = $urun['pic'];
        $urun_fiyati = $urun['price'];
        $urun_adeti = $urun['amount'];
        $urun_durumu = $urun['durum'] == 0 ? 'Pasif' : 'Aktif';
    } else {
        // Ürün bulunamazsa hata mesajı
        echo "Ürün bulunamadı.";
        exit;
    }
} else {
    // ID parametresi bulunamazsa hata mesajı
    echo "Ürün ID'si belirtilmemiş.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin/assets/bootstrap.css">
    <link rel="stylesheet" href="admin/assets/style.css">
    <link rel="stylesheet" href="admin/assets/fontawesome-free/css/all.css">
    <title>Ürün İncele</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


<div class="modal fade show" id="urunModal" tabindex="-1" aria-labelledby="urunModalLabel" aria-modal="true" style="display: block;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="urunModalLabel"><?php echo $urun_adi; ?></h5>
        <a href="javascript:history.back()" class="btn-close"></a>
      </div>
      <div class="modal-body">
      <img src="admin/<?php echo $urun_resmi; ?>" style="max-height: 150px; width: auto;" class="img-fluid mb-3" alt="<?php echo $urun_adi; ?>">
        <p><strong>Fiyat:</strong> <?php echo $urun_fiyati; ?> TL</p>
        <p><strong>Adet:</strong> <?php echo $urun_adeti; ?></p>
        <p><strong>Durum:</strong> <?php echo $urun_durumu; ?></p>
      </div>
      <div class="modal-footer">
        <a href="javascript:history.back()" class="btn btn-secondary">Kapat</a>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>