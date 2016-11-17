<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Documents;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DocumentsController extends FOSRestController {

    /**
     * Get all documents from currently logged user and specific case
     * 
     * Path: /cases/{slug}/documents
     * Method: GET
     * 
     * @return {json} List of documents
     * 
     * @throws NotFoundHttpException when there is no clients in database
     */
    public function getCasesDocumentsAction($slug) {
        $document = $this->getBaseManager()
                ->getBy('AppBundle:Documents', array('cases' => $slug), $this->getLoggedUser());

        if (!$document || $document === 204) {
            throw new HttpException(204, "There is no documents for particular case");
        }

        return $this->handleView($this->view($document));
    }

    /**
     * Get specific document requested by ID
     * 
     * Path: /cases/documents/{id}
     * Method: GET
     * 
     * @param {int} $id Document identifier
     * @return {json} Document requested by ID
     * 
     * @throws NotFoundHttpException when requested document doesn't exist
     */
    public function getCasesDocumentAction($slug, $id) {
        $document = $this->getBaseManager()
                ->getBy('AppBundle:Documents', array('cases' => $slug, 'id' => $id), $this->getLoggedUser());

        if (!$document || $document == 204) {
            throw new HttpException(404, "Document not exist!");
        }

        return $this->handleView($this->view($document));
    }

    /**
     * Add new document in database
     * 
     * Path: /cases/{slug}/documents
     * Method: POST
     * 
     * @param {obj} $request Request object
     * @return {json} Status
     * 
     */
    public function postCasesDocumentsAction($slug, Request $request) {
        $data = $request->request->all();
        $document = new Documents();

        $case = $this->getBaseManager()
                ->get('AppBundle:Cases', $slug, $this->getLoggedUser());

        $document->setCases($case);

        $result = $this->getBaseManager()
                ->set($document, $data, $this->getLoggedUser());

        $view = array(
            'status' => 201,
            'document' => $result,
            'message' => 'New document added to database!'
        );

        return $this->handleView($this->view($view));
    }

    /**
     * Update specific document
     * 
     * Path: /cases/{slug}/documents/{id}
     * Method: PUT
     * 
     * @param {int} slug Case identifier
     * @param {int} id Document identifier
     * @param {obj} $request Request object
     * @return {json} Status
     * 
     * @throws NotFoundHttpException when requested document doesn't exist
     * @throws AccessDeniedException when user missmatch one defined in document
     */
    public function putCasesDocumentsAction($slug, $id, Request $request) {
        $data = $request->request->all();

        unset($data['cases']);

        $result = $this->getBaseManager()
                ->update($data, 'AppBundle:Documents', $id, $this->getLoggedUser());

        if ($result === 404) {
            throw new HttpException(404, "Document with id " . $id . " not found!");
        } else if ($result === 401) {
            throw new AccessDeniedException();
        }

        $view = array(
            'status' => 200,
            'document' => $result,
            'message' => 'Document updated!'
        );

        return $this->handleView($this->view($view));
    }

    /**
     * Delete specific document
     * 
     * Path: /cases/{slug}/documents/{id}
     * Method: DELETE
     * 
     * @param {int} slug Case identifier
     * @param {int} id Document identifier
     * @return {json} Status
     * 
     * @throws NotFoundHttpException when requested document doesn't exist
     * @throws AccessDeniedException when user missmatch one defined in document
     */
    public function deleteCasesDocumentsAction($slug, $id) {
        $result = $this->getBaseManager()
                ->delete('AppBundle:Documents', $id, $this->getLoggedUser());

        if ($result === 404) {
            throw new HttpException(404, "Document with id " . $id . " not found!");
        } else if ($result === 401) {
            throw new AccessDeniedException();
        }

        $view = array(
            'status' => 200,
            'message' => 'Document successfully deleted!'
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
