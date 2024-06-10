<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//get per defecte tickets

// change Language
$routes->get('/changeLang/(:segment)', 'SessionController::changeLang/$1');

//tickets
$routes->match(['GET','POST'], '/viewTickets', 'TicketsController::viewTickets', ['filter' => 'UserLogged']);
// addTickets 
$routes->get('/addTickets', 'TicketsController::addTicket', ['filter' => 'NotStudent']);
$routes->post('/addTickets', 'TicketsController::addTicketPost', ['filter' => 'NotStudent']);
//update tickets
$routes->get('/updateTicket/(:segment)', 'TicketsController::updateTicket/$1', ['filter' => 'NotStudent']);
$routes->post('/updateTicket/(:segment)', 'TicketsController::updateTicket_post/$1', ['filter' => 'NotStudent']);
//assignacio tickets
$routes->get('/assignTicket/(:segment)', 'TicketsController::assignTicket/$1', ['filter' => 'OnlySSTT']);
$routes->post('/assignTicket/(:segment)', 'TicketsController::assignTicketPost/$1', ['filter' => 'OnlySSTT']);
//eliminar Tickets
$routes->get('/delTicket/(:segment)', 'TicketsController::deleteTicket/$1', ['filter' => 'NotStudent']);
//logins i sessions
//iniciar sessio profe, alum
$routes->get('/login', 'SessionController::google_login', ['filter' => 'UserNotLogged']);
$routes->post('/loginAuth', 'SessionController::login_post_Normal', ['filter' => 'UserNotLogged']);
//validar el centre
$routes->post('/validateCenter', 'SessionController::validateCenter');
//logOut
$routes->get('/logout', 'SessionController::logout', ['filter' => 'UserNotLogged']);

//pagina intermitja entre tickets i intervencio
$routes->match(['GET','POST'], '/interventionsOfTicket/(:segment)', 'TicketsInterventionsController::viewIntermediary/$1', ['filter' => 'UserLogged']);
//crud Intervencions
$routes->get('/addIntervention/(:segment)', 'InterventionsController::addIntervention/$1', ['filter' => 'notSSTT']);
$routes->get('/updateIntervention/(:segment)', 'InterventionsController::updateIntervention/$1', ['filter' => 'notSSTT']);
$routes->get('/delIntervention/(:segment)', 'InterventionsController::delIntervention/$1', ['filter' => 'OnlyProfessor']);

$routes->post('/addIntervention', 'InterventionsController::addIntervention_post', ['filter' => 'notSSTT']);
$routes->post('/updateIntervention/(:segment)', 'InterventionsController::updateIntervention_post/$1', ['filter' => 'notSSTT']);

$route['default_controller'] = 'TicketsController::viewTickets';

//stock
$routes->MATCH(['GET','POST'], '/viewStock', 'StockController::viewStock',  ['filter' => 'OnlyProfessor']);
//add
$routes->get('/addStock', 'StockController::addStock', ['filter' => 'OnlyProfessor']);
$routes->post('/addStock', 'StockController::addStock_post');
//update
$routes->get('/updateStock/(:segment)', 'StockController::updateStock/$1', ['filter' => 'OnlyProfessor']);
$routes->post('/updateStock/(:segment)', 'StockController::updateStock_post/$1', ['filter' => 'OnlyProfessor']);
//del
$routes->get('/delStock/(:segment)', 'StockController::deleteStock/$1', ['filter' => 'OnlyProfessor']);

//students
$routes->MATCH(['GET','POST'], '/viewStudents', 'StudentsController::viewStudents', ['filter' => 'OnlyProfessor']);
//add
$routes->get('/addStudent', 'StudentsController::addStudent', ['filter' => 'OnlyProfessor']);
$routes->post('/addStudent', 'StudentsController::addStudent_post', ['filter' => 'OnlyProfessor']);
//update
$routes->get('/updateStudent/(:segment)', 'StudentsController::updateStudent/$1', ['filter' => 'OnlyProfessor']);
$routes->post('/updateStudent/(:segment)', 'StudentsController::updateStudent_post/$1', ['filter' => 'OnlyProfessor']);
//del
$routes->get('/delStudent/(:segment)', 'StudentsController::delStudent/$1', ['filter' => 'OnlyProfessor']);
//redirect
$routes->get('/', 'SessionController::redirectToLogin');
//AJAX
$routes->get('/emailCenter/(:segment)', 'Gets::emailByCenter/$1');

//les sessions son 1 SSTT 2 centres / 3 professors / centre 4 Alumne 
//sessions: 
//mail: el mail de literal qualsevol usuari
//idSessionUser: el rol del usuari, previament descrit 
//idCenter: la id del centre del usuari excepte SSTT que no tenen centre assignat