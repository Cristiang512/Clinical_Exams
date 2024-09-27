<?php
$boton = $_POST["boton"];

if ($boton=="e") {
    redirect::to('consultaest');
}
else{
    echo "buenas";
}
?>