<?php
require_once(dirname(__DIR__) . "/vendor/autoload.php");
require_once(dirname(__DIR__) . "/classes/autoload.php");

use dginsburg\ObjectOriented\Author;

$authorId = new Author("06083f41-e334-4caf-ad7e-9b2600c41793", "books.com", 'a125bc814cff43d68bfcbc6570ad31ac', 'arnold@cnm.edu', '$argon2i$v=19$m=1024,t=384,p=2$T1B6Ymdqa3FJdmZqaDdqYg$hhyC1jf2WjbgfD8Jp6GZE9Tg3IpsYpXKm2VWYOJq8LA', 'username;');

var_dump($authorId);