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
        $case = $this->getBaseManager()
                ->getAll('AppBundle:Cases', $this->getLoggedUser());

        if (!$case) {
            throw new HttpException(204, "There is no cases for particular user");
        }

        return $this->handleView($this->view($case));
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
        $case = $this->getBaseManager()
                ->get('AppBundle:Cases', $id, $this->getLoggedUser());

        if (!$case) {
            throw new HttpException(404, "Case not exist!");
        }

        return $this->handleView($this->view($case));
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
        $case = new Cases();

        if (isset($data['client_individual'])) {
            $client = $this->getBaseManager()
                    ->get('AppBundle:IndividualClient', $data['client_individual'], $this->getLoggedUser());

            unset($data['client_individual']);
            $case->setClientIndividual($client);
        }

        if (isset($data['client_legal'])) {
            $client = $this->getBaseManager()
                    ->get('AppBundle:LegalClient', $data['client_legal'], $this->getLoggedUser());

            unset($data['client_legal']);
            $case->setClientLegal($client);
        }

        $result = $this->getBaseManager()
                ->set($case, $data, $this->getLoggedUser());

        $view = array(
            'status' => 200,
            'cases' => $result,
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

        unset($data['client_individual']);
        unset($data['client_legal']);

        $result = $this->getBaseManager()
                ->update($data, 'AppBundle:Cases', $id, $this->getLoggedUser());

        if ($result === 404) {
            throw new HttpException(404, "Case with id " . $id . " not found!");
        } else if ($result === 401) {
            throw new AccessDeniedException();
        }

        $view = array(
            'status' => 200,
            'case_id' => $result->getId(),
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
