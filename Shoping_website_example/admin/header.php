
<header>
        
        <h2><?php
       // error_reporting(E_ALL);
       // ini_set("display_errors",0);
        session_start();
        echo @$_SESSION['username']; 
        ?> Hoş Geldiniz</h2>
        
</header>