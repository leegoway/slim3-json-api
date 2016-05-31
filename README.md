# slim-rest-api

This is a slim extension to implement fast JSON API's response

##Installation
Using composer you can add use this as your composer.json

```json
    {
        "require": {
            "slim/slim": "3.*",
            "entomb/slim-json-api": "dev-master"
        }
    }

```
##Usage
To include the middleware and view you just have to load them using the default _Slim_ way.
Read more about Slim Here (https://github.com/codeguy/Slim#getting-started)

```php
    require 'vendor/autoload.php';

    $app = new \Slim\Slim();

    $app->view(new \JsonApiView());
    $app->add(new \JsonApiMiddleware());
```

###example method
all your requests will be returning a JSON output.
the usage will be `$app->render( (int)$HTTP_CODE, (array)$DATA);`

####example Code 
```php

    $app->get('/', function() use ($app) {
        $app->render(200,array(
                'msg' => 'welcome to my API!',
            ));
    });

```


####example output
```json
{
    "msg":"welcome to my API!",
    "error":false,
    "status":200
}

```

##Errors
To display an error just set the `error => true` in your data array.
All requests will have an `error` param that defaults to false.

```php

    $app->get('/user/:id', function($id) use ($app) {

        //your code here

        $app->render(404,array(
                'error' => TRUE,
                'msg'   => 'user not found',
            ));
    });

```
```json
{
    "msg":"user not found",
    "error":true,
    "status":404
}

```
