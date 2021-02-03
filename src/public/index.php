<?php

use App\CeeController;
use MongoDB\Client;
use Phalcon\Config;
use Phalcon\DI\FactoryDefault;
use Phalcon\Loader;
use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Micro\Collection as MicroCollection;
use Phalcon\Http\Request;

$loader = new Loader();
$loader->registerFiles(['/vendor/autoload.php']);
$loader->register();

$di = new FactoryDefault();

$di->set('config', function () {        
    return new Config([
        'app' => [
            'baseUri'  => getenv('APP_BASE_URI'),
            'env'  => getenv('APP_ENV'),
            'name'  => getenv('APP_NAME')
        ]
    ]);
});

# https://docs.mongodb.com/php-library/v1.2/reference/bson/#emulating-the-legacy-driver
$di->set('mongoDB', function () {
    return  ( new Client(getenv('DB_URI'), [], ['typeMap' => ['array' => 'array', 'document' => 'array', 'root' => 'array',],]))
                    ->selectCollection(getenv('DB_NAME'), getenv('DB_COLLECTION'));
}, true);

$application = new Micro($di);

$application->mount(
    (new MicroCollection())
        ->setHandler(new CeeController())
        ->setPrefix('/cee')
        ->post('/', 'add')
        ->post('/bulk', 'bulk')
        ->get('/{version}/{name}', 'view')
        ->delete('/{version}/{name}', 'delete')
        ->post('/cumac/{version}/{name}', 'cumac')

);

$application->notFound(function () use ($application) {
    $application->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo 'This is crazy, but this page was not found!';
});

$application->handle((new Request())->getURI());


return $application;