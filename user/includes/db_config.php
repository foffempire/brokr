<?php 
    
    ob_start();
    session_start();
    
    // for local connection
    define("HOST", "localhost");
    define("DBNAME", "crypto_broker_2");
    define("DBUSER", "root");
    define("DBPASS", "science");
    
    
    
    // for Live connection
    // define("HOST", "localhost");
    // define("DBNAME", "hpodhsmn_flip");
    // define("DBUSER", "hpodhsmn_flip");
    // define("DBPASS", "Y@pA3Cp-{3(x");
?>