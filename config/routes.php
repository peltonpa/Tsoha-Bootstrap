<?php

$routes->get('/', function() {
    AlueController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/etusivu', function() {
    AlueController::index();
});

$routes->get('/keskustelualue', function() {
    HelloWorldController::keskustelualue();
});

$routes->post('/ketju', function() {
    ViestiController::store();
});

$routes->get('/kirjautuminen', function() {
HelloWorldController::kirjautuminen();
});

$routes->get('/alue/:id', function($id) {
    AlueController::show($id);
});

$routes->get('/ketju/:id', function($id) {
    KetjuController::show($id);
});

