<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class UserController extends FOSRestController {

    public function getUserAction() {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        return $this->handleView($this->view($user));
    }

    public function postUserCreateAction(Request $request) {
        $data = $request->request->all();

        $manipulator = $this->get('fos_user.util.user_manipulator');
        $manipulator->create($data['username'], $data['password'], $data['email'], null, null);

        $view = array(
            'status' => 200,
            'message' => 'New user created!'
        );

        return $this->handleView($this->view($view));
    }

}
