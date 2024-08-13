<?php
session_start();
    $cliente = $_SESSION['cliente'];
    $email = $cliente['email'];
    unset($_SESSION['cliente']);
    var_dump($cliente);

    if(isset($_SESSION['giftcards'])) {
        $giftcards = $_SESSION['giftcards'];
        var_dump($giftcards);
    }
    

    $to = $email;
    $subject = "Perla Lencería - Pago recibido";

    $headers = array(
        "MIME-Version" => "1.0",
        "Content-Type" => "text/html;charset=UTF-8",
        "From" => "juanaramberri02@gmail.com",
        "Reply-To" => "juanaramberri02@gmail.com"
    );

    // Construir el contenido de los detalles de las giftcards
    $giftcardDetails = '';
    if(isset($_SESSION['giftcards'])) {
        foreach ($giftcards as $giftcard) {
            $giftcardDetails .= '<li><strong>Código:</strong> ' . $giftcard->codigo . ', <strong>Valor:</strong> $' . $giftcard->valor . '</li>';
        }
        unset($_SESSION['giftcards']);
    }
    

    ob_start();
    include("template.php");
    $message = ob_get_contents();
    ob_get_clean();

    $send = mail($to, $subject, $message, $headers);

    header('Content-Type: application/json');
    echo ($send ? json_encode("Mail enviado") : json_encode("Error"));
?>