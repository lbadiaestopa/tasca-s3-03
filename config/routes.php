<?php 

$routes = array(
    '/' => 'task#index',
    '/task/completed' => 'task#completed',
    '/task/create' => 'task#create',
    '/task/delete' => 'task#delete',
    '/task/edit' => 'task#edit',
    '/task/:id' => 'task#detail',
    '/task/store' => 'task#store'
);