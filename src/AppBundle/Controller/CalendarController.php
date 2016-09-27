<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Calendar;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class CalendarController extends FOSRestController {

    /**
     * Get all calendars from currently logged user
     * 
     * Path: /calendars
     * Method; GET
     * 
     * @return {json} List of calendars
     * 
     * @throws NotFoundHttpException when there is no clients in database
     */
    public function getCalendarsAction() {
        $calendar = $this->getBaseManager()
                ->getAll('AppBundle:Calendar', $this->getLoggedUser());

        if (!$calendar) {
            throw new HttpException(204, "There is no cases for particular user");
        }

        return $this->handleView($this->view($calendar));
    }

    /**
     * Get specific calendar requested by ID
     * 
     * Path: /calendars/{id}
     * Method: GET
     * 
     * @param {int} $id Calendars identifier
     * @return {json} Calendars requested by ID
     * 
     * @throws NotFoundHttpException when requested calendar doesn't exist
     */
    public function getCalendarAction($id) {
        $calendar = $this->getBaseManager()
                ->get('AppBundle:Calendar', $id, $this->getLoggedUser());

        if (!$calendar) {
            throw new HttpException(404, "Calendar not exist!");
        }

        return $this->handleView($this->view($calendar));
    }

    /**
     * Add new calendar in database
     * 
     * Path: /calendars
     * Method: POST
     * 
     * @param {obj} $request Request object
     * @return {json} Status
     * 
     */
    public function postCalendarAction(Request $request) {
        $data = $request->request->all();
        $calendar = new Calendar();

        if (isset($data['client_individual'])) {
            $client = $this->getBaseManager()
                    ->get('AppBundle:IndividualClient', $data['client_individual'], $this->getLoggedUser());

            unset($data['client_individual']);
            $calendar->setClientIndividual($client);
        }

        if (isset($data['client_legal'])) {
            $client = $this->getBaseManager()
                    ->get('AppBundle:LegalClient', $data['client_legal'], $this->getLoggedUser());

            unset($data['client_legal']);
            $calendar->setClientLegal($client);
        }

        if (isset($data['cases'])) {
            $cases = $this->getBaseManager()
                    ->get('AppBundle:Cases', $data['cases'], $this->getLoggedUser());

            unset($data['cases']);
            $calendar->setCases($cases);
        }

        if (isset($data['datetime'])) {
            $calendar->setDatetime(\DateTime::createFromFormat('d-m-Y H:i', $data['datetime']));
            unset($data['datetime']);
        }

        $result = $this->getBaseManager()
                ->set($calendar, $data, $this->getLoggedUser());

        $view = array(
            'status' => 200,
            'calendar' => $result,
            'message' => 'New calendar added to database!'
        );

        return $this->handleView($this->view($view));
    }

    /**
     * Update specific calendar
     * 
     * Path: /calendars/{id}
     * Method: PUT
     * 
     * @param {int} $id Calendar identifier
     * @param {obj} $request Request object
     * @return {json} Status
     * 
     * @throws NotFoundHttpException when requested calendar doesn't exist
     * @throws AccessDeniedException when user missmatch one defined in case
     */
    public function putCalendarAction($id, Request $request) {
        $data = $request->request->all();

        unset($data['client_individual']);
        unset($data['client_legal']);
        unset($data['cases']);

        if (isset($data['datetime'])) {
            $data['datetime'] = \DateTime::createFromFormat('d-m-Y H:i', $data['datetime']);
        }

        $result = $this->getBaseManager()
                ->update($data, 'AppBundle:Calendar', $id, $this->getLoggedUser());

        if ($result === 404) {
            throw new HttpException(404, "Calendar with id " . $id . " not found!");
        } else if ($result === 401) {
            throw new AccessDeniedException();
        }

        $view = array(
            'status' => 200,
            'calendar_id' => $result->getId(),
            'message' => 'Calendar updated!'
        );

        return $this->handleView($this->view($view));
    }

    /**
     * Delete specific calendar
     * 
     * Path: /calendars/{id}
     * Method: DELETE
     * 
     * @param {int} $id Calendar identifier
     * @return {json} Status
     * 
     * @throws NotFoundHttpException when requested calendar doesn't exist
     * @throws AccessDeniedException when user missmatch one defined in calendar
     */
    public function deleteCalendarAction($id) {
        $result = $this->getBaseManager()
                ->delete('AppBundle:Calendar', $id, $this->getLoggedUser());

        if ($result === 404) {
            throw new HttpException(404, "Calendar with id " . $id . " not found!");
        } else if ($result === 401) {
            throw new AccessDeniedException();
        }

        $view = array(
            'status' => 200,
            'message' => 'Calendar successfully deleted!'
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
