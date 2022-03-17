<?php
$to = "brouette";
$subject = "Sujet du message ";

$message = "cffvzf";
$headers = [
    "From" => "no-reply@dite.fr",
    "Reply-To" => "adresse@rtre.fr",
    "Cc" => "copie@site.fr",
    "Bcc" => "cpoiecacahé@gmail.fr"
];

$message = wordwrap($message, 70, "\r\n");

mail($to, $subject, $message, $headers);
