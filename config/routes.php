<?php

$routes->get('/', function() {
    AlueController::index();
});

$routes->get('/hiekkalaatikko', function() {
    AlueController::sandbox();
});

$routes->get('/etusivu', function() {
    AlueController::index();
});

$routes->post('/uusiketju', function() {
    KetjuController::store();
});

$routes->get('/kirjautuminen', function() {
    KayttajaController::kirjaudu();
});

$routes->post('/kirjautuminen', function() {
    KayttajaController::kasittele();
});

$routes->get('/rekisteroidy', function() {
    KayttajaController::rekisterointi();
});

$routes->post('/rekisteroidy', function() {
    KayttajaController::rekisteroidy(); 
});


$routes->get('/alue/uusiketju/:id', function($id) {
    KetjuController::uusiketju($id);
});

$routes->get('/alue/:id', function($id) {
    AlueController::show($id);
});


$routes->post('/ketju', function() {
    ViestiController::store();
});

$routes->get('/ketju/:id/ketjuedit', function($id) {
    KetjuController::edit($id);
});

$routes->post('/ketju/:id/edit', function($id) {
    KetjuController::update($id);
});

$routes->get('/ketju/:id/poista', function($id) {
    KetjuController::destroy($id);
});

$routes->get('/ketju/:id', function($id) {
    KetjuController::show($id);
});

$routes->get('/viesti/:id/edit', function($id) {
    ViestiController::edit($id);
});

$routes->post('/viesti/:id/edit', function($id) {
    ViestiController::update($id);
});

$routes->get('/viesti/:id/destroy', function($id) {
    ViestiController::destroy($id);
});

$routes->get('/ulos', function() {
    BaseController::logout(); 
});
