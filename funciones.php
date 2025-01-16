<?php 

function fechaValida($fecha) {
    return strtotime($fecha) !== false;
}

?>