<div class="menu form-control">
    <h4>Menü</h4>
    <ul>
        <li><a href="main.php">Ana Sayfa</a></li>
        <?php
        if (@$_SESSION['admin'] == 1) {

        ?>

            <li><a href="uyeler.php">Üyeler</a></li>

        <?php
        }
        if (@$_SESSION['admin'] == 2 || @$_SESSION['admin'] == 1) {
        ?>

            <li><a href="kategori.php">Kategoriler</a></li>
            <li><a href="urun.php">Ürünler</a></li>

        <?php
        }
        
        if (@$_SESSION['admin'] == 2) {
        ?>
            <li><a href="bilgilerim.php">Bilgilerim</a></li>

        <?php
        }
        ?>
        <div class="exit"><a href="exit.php"> Oturumu Kapat</a></div>
    </ul>
</div>