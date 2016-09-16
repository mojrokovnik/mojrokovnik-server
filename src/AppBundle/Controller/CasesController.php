<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cases;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class CasesController extends FOSRestController {

    /**
     * Get all cases from currently logged user
     * 
     * Path: /cases
     * Method; GET
     * 
     * @return {json} List of cases
     * 
     * @throws NotFoundHttpException when there is no clients in database
     */
    public function getCasesAction() {
        $client = $this->getBaseManager()
                ->getAll('AppBundle:Cases', $this->getLoggedUser());

        if (!$client) {
            throw new HttpException(204, "There is no cases for particular user");
        }

        return $this->handleView($this->view($client));
    }

    /**
     * Get specific case requested by ID
     * 
     * Path: /cases/{id}
     * Method: GET
     * 
     * @param {int} $id Case identifier
     * @return {json} Case requested by ID
     * 
     * @throws NotFoundHttpException when requested client doesn't exist
     */
    public function getCaseAction($id) {
        $client = $this->getBaseManager()
                ->get('AppBundle:Cases', $id, $this->getLoggedUser());

        if (!$client) {
            throw new HttpException(404, "Case not exist!");
        }

        return $this->handleView($this->view($client));
    }

    /**
     * Add new case in database
     * 
     * Path: /cases
     * Method: POST
     * 
     * @param {obj} $request Request object
     * @return {json} Status
     * 
     */
    public function postCaseAction(Request $request) {
        $data = $request->request->all();
        $client = new Cases();

        $result = $this->getBaseManager()
                ->set($client, $data, $this->getLoggedUser());

        $view = array(
            'status' => 200,
            'client' => $result,
            'message' => 'New case added to database!'
        );

        return $this->handleView($this->view($view));
    }

    /**
     * Update specific case
     * 
     * Path: /cases/{id}
     * Method: PUT
     * 
     * @param {int} $id Case identifier
     * @param {obj} $request Request object
     * @return {json} Status
     * 
     * @throws NotFoundHttpException when requested case doesn't exist
     * @throws AccessDeniedException when user missmatch one defined in case
     */
    public function putCaseAction($id, Request $request) {
        $data = $request->request->all();

        $result = $this->getBaseManager()
                ->update($data, 'AppBundle:Cases', $id, $this->getLoggedUser());

        if ($result === 404) {
            throw new HttpException(404, "Case with id " . $id . " not found!");
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
     * Delete specific case
     * 
     * Path: /cases/{id}
     * Method: DELETE
     * 
     * @param {int} $id Case identifier
     * @return {json} Status
     * 
     * @throws NotFoundHttpException when requested case doesn't exist
     * @throws AccessDeniedException when user missmatch one defined in case
     */
    public function deleteCaseAction($id) {
        $result = $this->getBaseManager()
                ->delete('AppBundle:Cases', $id, $this->getLoggedUser());

        if ($result === 404) {
            throw new HttpException(404, "Case with id " . $id . " not found!");
        } else if ($result === 401) {
            throw new AccessDeniedException();
        }

        $view = array(
            'status' => 200,
            'message' => 'Case successfully deleted!'
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
