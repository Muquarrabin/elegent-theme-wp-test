<?php

add_action(
    'rest_api_init',
    function () {
        register_rest_route(
            'elegent-test',
            '/user-create',
            array(
                'methods'             => 'POST',
                'callback'            => [new TestUserController(),'create_user_laravel'],
                'permission_callback' => '__return_true'
            )
        );
    }
);
