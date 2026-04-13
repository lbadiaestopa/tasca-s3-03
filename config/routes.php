<?php 

$routes = array(
    '/' => 'task#index',
    '/task/completed' => 'task#completed',
    '/task/create' => 'task#create',
    '/task/edit' => 'task#edit',
    '/task/:id' => 'task#detail'
);