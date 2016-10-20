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

        $user = $this->get('fos_user.user_manager')->findUserByEmail($data['email']);
        $urltoken = $user->getConfirmationToken();
//        $url = $this->generateUrl('fos_user_registration_confirm', array('token' => $urltoken), true);

        $view = array(
            'status' => 200,
            'url' => $urltoken,
            'message' => 'New user created!'
        );

        return $this->handleView($this->view($view));
    }

}
