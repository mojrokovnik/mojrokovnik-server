<?php

namespace AppBundle\Controller;

use AppBundle\Entity\LegalClient;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class LegalClientController extends FOSRestController {

    /**
     * Get all legal clients from currently logged user
     * 
     * Path: /clients/legals
     * Method; GET
     * 
     * @return {json} Legal clients
     * 
     * @throws NotFoundHttpException when there is no clients in database
     */
    public function getLegalsAction() {
        $client = $this->getBaseManager()
                ->getAll('AppBundle:LegalClient', $this->getLoggedUser());

        if (!$client) {
            throw new HttpException(204, "There is no clients for particular user");
        }

        return $this->handleView($this->view($client));
    }

    /**
     * Get specific legal clients requested by ID
     * 
     * Path: /clients/legals/{id}
     * Method: GET
     * 
     * @param {int} $id Client identifier
     * @return {json} Legal clients requested by ID
     * 
     * @throws NotFoundHttpException when requested client doesn't exist
     */
    public function getLegalAction($id) {
        $client = $this->getBaseManager()
                ->get('AppBundle:LegalClient', $id, $this->getLoggedUser());

        if (!$client) {
            throw new HttpException(404, "Client not exist!");
        }

        return $this->handleView($this->view($client));
    }

    /**
     * Add new legal client in database
     * 
     * Path: /clients/legals
     * Method: POST
     * 
     * @param {obj} $request Request object
     * @return {json} Status
     * 
     */
    public function postLegalAction(Request $request) {
        $data = $request->request->all();
        $client = new LegalClient();

        $result = $this->getBaseManager()
                ->set($client, $data, $this->getLoggedUser());

        $view = array(
            'status' => 200,
            'client' => $result,
            'message' => 'New client added to database!'
        );

        return $this->handleView($this->view($view));
    }

    /**
     * Update specific legal clients
     * 
     * Path: /clients/legals/{id}
     * Method: PUT
     * 
     * @param {int} $id Client identifier
     * @param {obj} $request Request object
     * @return {json} Status
     * 
     * @throws NotFoundHttpException when requested client doesn't exist
     * @throws AccessDeniedException when user missmatch one defined in client
     */
    public function putLegalAction($id, Request $request) {
        $data = $request->request->all();

        $result = $this->getBaseManager()
                ->update($data, 'AppBundle:LegalClient', $id, $this->getLoggedUser());

        if ($result === 404) {
            throw new HttpException(404, "Client with id " . $id . " not found!");
        } else if ($result === 401) {
            throw new AccessDeniedException();
        }

        $view = array(
            'status' => 200,
            'client_id' => $result->getId(),
            'message' => 'Client updated!'
        );

        return $this->handleView($this->view($view));
    }

    /**
     * Delete specific legal clients
     * 
     * Path: /clients/legals/{id}
     * Method: DELETE
     * 
     * @param {int} $id Client identifier
     * @return {json} Status
     * 
     * @throws NotFoundHttpException when requested client doesn't exist
     * @throws AccessDeniedException when user missmatch one defined in client
     */
    public function deleteLegalAction($id) {
        $result = $this->getBaseManager()
                ->delete('AppBundle:LegalClient', $id, $this->getLoggedUser());

        if ($result === 404) {
            throw new HttpException(404, "Client with id " . $id . " not found!");
        } else if ($result === 401) {
            throw new AccessDeniedException();
        }

        $view = array(
            'status' => 200,
            'message' => 'Client successfully deleted!'
        );

        return $this->handleView($this->view($view));
    }

    /**
     * Initialize BaseManager
     * 
     * @return AppBundle\Services\BaseManager
     */
    protected function getBaseManager() {
        return $this->get('app.base_manager');
    }

    /**
     * Get currently logged user
     * 
     * @return {obj} User
     */
    protected function getLoggedUser() {
        return $this->get('security.token_storage')->getToken()->getUser();
    }

}
