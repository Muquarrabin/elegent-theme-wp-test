<?php

class TestUserController
{
    public function create_user_laravel($request)
    {
        $params = $request->get_params();

        if (empty($params['username']) || empty($params['email']) || empty($params['password'])) {
            return new WP_Error('invalid_data', 'Username, email, and password are required.', array('status' => 400));
        }

        $user_id = wp_create_user($params['username'], $params['password'], $params['email']);

        if (is_wp_error($user_id)) {
            return wp_send_json_error(array('message' => $user_id->get_error_message()), 400);
        }

        update_user_meta($user_id, 'is_imported', true);

        return wp_send_json_success(array(
            'message'=>'User Exported! WP User ID: '. $user_id), 201);

    }
}