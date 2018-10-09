<?php

require __DIR__.'/vendor/autoload.php';

$client = new \GuzzleHttp\Client([
  'base_url' => 'http://localhost:8000',
  'defaults' => [
    'exceptions' => false,
  ]

]);

$reponse = $client->post('/api/programmers');

echo $reponse;
echo "\n\n";
 ?>
