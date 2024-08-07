<?php

/**
 * Used to define the routes in the system.
 * 
 * A route should be defined with a key matching the URL and an
 * controller#action-to-call method. E.g.:
 * 
 * '/' => 'index#index',
 * '/calendar' => 'calendar#index'
 */
$routes = array(
    '/' => 'task#index',
    '/task' => 'task#index',
    '/task/create' => 'task#create',
    '/task/edit' => 'task#edit',         // Ruta para editar sin ID
    '/task/edit/:id' => 'task#edit',     // Ruta para editar con ID
    '/task/delete/:id' => 'task#delete' //Ruta para borrar con ID
);
