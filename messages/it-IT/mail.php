<?php

return [
    'offer_accepted {supplier}{rfq_manager}{request_title}' => 'Gentile {supplier},<br><br>

    siamo lieti di comunicarti che {rfq_manager} ha accettato la tua offerta relativa a  {request_title}.<br><br>
    
    Puoi prenderne visione qui:<br>',


    'new_ticket {supplier}{rfq_manager}{request_title}' => 'Gentile {rfq_manager},<br><br>

    {supplier} ti ha appena inviato un nuovo ticket relativo alla RFQ {request_title}.<br><br>
    
    Puoi prenderne visione al seguente link:<br>',


    'new_request_invitation {supplier}{rfq_manager}{date}{link}' => 'Gentile {supplier},<br><br>

    hai ricevuto una Richiesta di Offerta (RFQ) dalla società {rfq_manager} tramite B2CONN PRO, la piattaforma online utilizzata dalla Società per la gestione degli acquisti.<br><br>
    
    Per accedere alla RFQ ed inviare la tua offerta, è necessario registrarsi al sito di B2CONN PRO. Clicca sul link riportato di seguito e crea il tuo account gratuito:<br>
    <a hrerf="' . Yii::$app->params['subdomain'] . '.b2connpro.com" target="_blank">' . Yii::$app->params['subdomain'] . '.b2connpro.com</a><br><br>
    
    Una volta completata la registrazione, ti invitiamo a collegarti al link sotto riportato per poter verificare la richiesta ricevuta ed inserire la tua offerta.<br><br>
    
    <a hrerf="' . Yii::$app->params['subdomain'] . '.b2connpro.com/{link}" target="_blank">Apri</a><br><br>
    
    La presente Richiesta di Offerta scade il prossimo {date}.',


    'new_offer_received {supplier}{rfq_manager}{request_title}' => 'Gentile {rfq_manager},<br><br>

    {supplier} ha appena aggiunto una nuova offerta a {request_title}.<br><br>
    
    Puoi prenderne visione qui:<br>',


    'offer_not_accepted {supplier}{rfq_manager}{request_title}' => 'Gentile {supplier},<br><br>

    siamo spiacenti di comunicarti che la tua offerta per {request_title} NON è stata accettata da {rfq_manager}.<br><br>

    Puoi prenderne visione al seguente link:<br>',
];

?>