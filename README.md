Users
    - auth
    - promjena lozinke
    - promjena podataka
    - edit svih korisnika (admin) 

Roles and Permissions
    - admin
    - subscriber
    - visitor

Categories
    - CRUD

Books
    - CRUD
    - download
    - upload (samo pdf), preuzimaju se metapodaci i odmah se prikazuju u formama
    
Search
    - elasticsearch
    - pretraga knjiga po: naslovu, autorima, kljucnim rijecima, sadraju, jeziku
    
    Allow CORS
When a standalone frontend application sends request to your server the browser might sqwak about Cross Origin Resource Sharing (CORS). Install this package:

$ composer require barryvdh/laravel-cors
And add it to app/Http/Kernel.php in the $middleware array:

protected $middleware = [
    ...
    \Barryvdh\Cors\HandleCors::class,
];
