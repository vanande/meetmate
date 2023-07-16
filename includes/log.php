<?php
function writeLogLine($try, $success, $email){
    $log = fopen ('log.txt', 'a+');
    $value = $success ? 'reussie' : 'échouée';
    $line = date("Y-m-d H:i:s ").' - '. $try .' '. $value . ' de ' . $email . "\r\n";
    fputs($log, $line);
    fclose ($log);
}
?>