<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'countries'], function () use ($router) {
    $router->get('/', ['uses' => 'CountryController@index']);
    $router->get('/{code}', ['uses' => 'CountryController@show']);

    $router->get('/{code}/flag', ['uses' => 'CountryFlagController@index']);
    $router->get('/{code}/currency', ['uses' => 'CountryCurrencyController@index']);
    $router->get('/{code}/languages', ['uses' => 'CountryLanguageController@index']);
    $router->get('/{code}/places', ['uses' => 'CountryPlacesController@index']);
    $router->get('/{code}/timeZones', ['uses' => 'CountryTimeZoneController@index']);
    $router->get('/{code}/neighbours', ['uses' => 'CountryNeighbourController@index']);
});

$router->group(['prefix' => 'continents'], function () use ($router) {
    $router->get('/', ['uses' => 'ContinentController@index']);
    $router->get('/{code}', ['uses' => 'ContinentController@show']);

    $router->get('/{code}/countries', ['uses' => 'ContinentCountryController@index']);
});

$router->group(['prefix' => 'currencies'], function () use ($router) {
    $router->get('/', ['uses' => 'CurrencyController@index']);
    $router->get('/{code}', ['uses' => 'CurrencyController@show']);
});

$router->group(['prefix' => 'featureClasses'], function () use ($router) {
    $router->get('/', ['uses' => 'FeatureClassController@index']);
    $router->get('/{code}', ['uses' => 'FeatureClassController@show']);
});

$router->group(['prefix' => 'featureCodes'], function () use ($router) {
    $router->get('/', ['uses' => 'FeatureCodeController@index']);
    $router->get('/{code}', ['uses' => 'FeatureCodeController@show']);
});

$router->group(['prefix' => 'timeZones'], function () use ($router) {
    $router->get('/', ['uses' => 'TimeZoneController@index']);
    $router->get('/{code}', ['uses' => 'TimeZoneController@show']);
});

$router->group(['prefix' => 'flags'], function () use ($router) {
    $router->get('/', ['uses' => 'FlagController@index']);
    $router->get('/{code}', ['uses' => 'FlagController@show']);
});

$router->group(['prefix' => 'languages'], function () use ($router) {
    $router->get('/', ['uses' => 'LanguageController@index']);
});

$router->group(['prefix' => 'places'], function () use ($router) {
    $router->get('/', ['uses' => 'PlaceController@index']);
    $router->get('/{id}', ['uses' => 'PlaceController@show']);

    $router->get('/{uuid}/location', ['uses' => 'PlaceLocationController@index']);
});
