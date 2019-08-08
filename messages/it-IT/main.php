<?php

$traslation = array_merge(
    include('mail.php'),
    [
      'Test' => 'Test'
    ]
);

if (file_exists(getcwd().'/override.php')) {
    return array_merge($traslation, include('override.php'));
}

return $traslation;
