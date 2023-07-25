<?php
    $to = $_POST['email'];
    $subject = "Perla Lencería - Tu pedido está en camino!";

    $headers = array(
        "MIME-Version" => "1.0",
        "Content-Type" => "text/html;charset=UTF-8",
        "From" => "perlalenceria@gmail.com",
        "Reply-To" => "perlalenceria@gmail.com"
    );

    $seguimiento = $_POST['seguimiento'];
    $envio = $_POST['envio'];

    ob_start();
    include("mail-template.php");
    $message = ob_get_contents();
    ob_get_clean();

    $send = mail($to, $subject, $message, $headers);

    header('Content-Type: application/json');

    echo json_encode("Mail enviado");
?>