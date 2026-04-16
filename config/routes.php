<?php 

$routes = array(
    '/' => 'task#index',
    '/:status' => 'task#index',
    '/task/completed' => 'task#completed',
    '/task/create' => 'task#create',
    '/task/delete' => 'task#delete',
    '/task/update' => 'task#update',
    '/task/status' => 'task#status',
    '/task/edit' => 'task#edit',
    '/task/edit/:id' => 'task#edit',
    '/task/:id' => 'task#detail',
    '/task/store' => 'task#store'
);