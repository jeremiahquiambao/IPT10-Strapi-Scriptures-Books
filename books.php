<?php

require "vendor/autoload.php";

use GuzzleHttp\Client;

function getBooks() {
    $token = '34e08ebce66b53ea05b882373129c557520fe8a9834e63c780b7da50d79dcf770977d5b2fe9c485fbe8adc630254549c271a60455304b7f256f2b51a1332b604556b29a2ab813b95a00a58a9dcc7eb3f4d0763846614186cb8f85b24d8d9905ed2eb3bb6f3ad3135b67a6429ecf33469e4b22ad6524f760abd68c5ec8ad7fc7f';

    $client = new Client([
        'base_uri' => 'http://localhost:1337/api/',
    ]);

    $headers = [
        'Authorization' => 'Bearer ' . $token,        
        'Accept'        => 'application/json',
    ];

    $response = $client->request('GET', 'books?pagination[pageSize]=66', [
        'headers' => $headers
    ]);

    $body = $response->getBody();
    $decoded_response = json_decode($body);
    return $decoded_response;
}

$books = getBooks();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <title>66 Books of the Bible</title>

    <style>
        html,body {
	    height: 100%;
        }

        body {
	    margin: 0;
	    background: linear-gradient(45deg, #49a09d, #5f2c82);
	    font-family: sans-serif;
	    font-weight: 100;
        }
    </style>
    
</head>
<body>
    <div class = "container"> 
        <h1 style="text-align:center; color:white;">The 66 Books of the Bible</h1>
        <table class="table table-hover table-dark table-striped" style="margin-top:20px;">
        <hr>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Author</th>
                        <th scope="col">Category</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach($books->data as $bookData){ 
                    $book = $bookData->attributes;?>
                    <tr>
                        <th scope="row"><?php echo $bookData->id?></th>
                        <td><?php echo $book->name ?></td>
                        <td><?php echo $book->author?></td>
                        <td><?php echo $book->category?></td>
                    </tr>
                    <?php }?>
                </tbody>
        </table>
    </div>
</body>
</html>