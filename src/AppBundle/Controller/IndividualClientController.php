<?php

namespace AppBundle\Controller;

use AppBundle\Entity\IndividualClient;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class IndividualClientController extends FOSRestController {

    /**
     * Get all individual clients from currently logged user
     * 
     * Path: /clients/legals
     * Method: GET
     * 
     * @return {json} Legal clients
     * 
     * @throws NotFoundHttpException when there is no clients in database
     */
    public function getIndividualsAction() {
        $client = $this->getBaseManager()
                ->getAll('AppBundle:IndividualClient', $this->getLoggedUser());

        if (!$client) {
            throw new HttpException(204, "There is no clients for particular user");
        }

        return $this->handleView($this->view($client));
    }

    /**
     * Get specific individual clients requested by ID
     * 
     * Path: /clients/legals/{id}
     * Method: GET
     * 
     * @param {int} $id Client identifier
     * @return {json} Legal clients requested by ID
     * 
     * @throws NotFoundHttpException when requested client doesn't exist
     */
    public function getIndividualAction($id) {
        $client = $this->getBaseManager()
                ->get('AppBundle:IndividualClient', $id, $this->getLoggedUser());

        if (!$client) {
            throw new HttpException(404, "Client not exist!");
        }

        return $this->handleView($this->view($client));
    }

    /**
     * Add new individual client in database
     * 
     * Path: /clients/legals
     * Method: POST
     * 
     * @param {obj} $request Request object
     * @return {json} Status
     * 
     */
    public function postIndividualAction(Request $request) {
        $data = $request->request->all();
        $client = new IndividualClient();

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
    public function putIndividualAction($id, Request $request) {
        $data = $request->request->all();

        $result = $this->getBaseManager()
                ->update($data, 'AppBundle:IndividualClient', $id, $this->getLoggedUser());

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
     * Delete specific individual clients
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
    public function deleteIndividualAction($id) {
        $result = $this->getBaseManager()
                ->delete('AppBundle:IndividualClient', $id, $this->getLoggedUser());

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
