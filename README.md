# PHP Car2db.Auto API SDK

## Requirements

PHP 7.1 or above


## Links

1. BaseBuy.Auto API page: [Ru](http://api.car2db.com//api/auto/v1/),
2. [sample app](https://github.com/basebuy/basebuy-auto-sdk-php/blob/master/sample.php)

## Getting started

### Installation

composer require mutahir-shah/carsdbapi:dev-master

Using Car2db.Auto API requires following steps

1. Obtain API_KEY (token) by buying database at https://car2db.com/.
Note: `API_KEY` is constant that you get for access to BaseBuy.Auto API.

2. Than you can use  API.
 
    $basebuyAutoApi = new BasebuyAutoApi(
        new CurlGetConnector( API_KEY )
    );

    // check last information update date
    $basebuyAutoApi->typeGetDateUpdate();

    // get database file
    $downloadedFilePath = $basebuyAutoApi->typeGetAll();

    // catch error codes
    } catch( Exception $e ){
        if ( $e->getCode() == 401 ) ...
    }
    ```


 

## Running tests
 
4. Create `sample.php` with `API_KEY` constant.
 
