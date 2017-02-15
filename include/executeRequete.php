<?php

function executeR($logIn, $sql, $arg = null) {
    if ($arg == null) {
        $resReque = $logIn->query($sql);
    } else {
        $resReque = $logIn->prepare($sql);
        $resReque->execute($arg);
    }
    return $resReque;
}
?>



