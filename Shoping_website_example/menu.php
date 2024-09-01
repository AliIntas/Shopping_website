<div class="menu form-control  pt-2">
    <h4>Menü</h4>
    <ul>
        <?php
        if (@$_SESSION['admin'] == 0) { 
        ?>
            <li><a href="index.php">Ana Sayfa</a></li>
            <li><a href="siparislerim.php">Siparişlerim</a></li>
            <li><a href="sepete_ekle.php">Sepet</a></li>
            <li><a href="bilgilerim.php">Bilgilerim</a></li>
            <div class="exit"><a href="admin/exit.php">Oturumu Kapat</a></div>
        <?php
        }
        ?>
    </ul>
</div>
