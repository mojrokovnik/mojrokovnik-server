<?php

namespace AppBundle\Services;

class BaseManager {

    protected $em;

    public function __construct($em) {
        $this->em = $em;
    }

    /**
     * Get all data from database
     * 
     * @param $repo Name of repo where to look
     * @param $user Currently logged user
     * 
     * @retun {Object} Data
     * 
     */
    public function getAll($repo, $user) {
        return $this->em
                        ->getRepository($repo)
                        ->findByUser($user);
    }

    /**
     * Get specific data from database
     * 
     * @param $repo Name of repo whete to look
     * @param $id Identifier
     * 
     * @retun {Object} Data
     * 
     */
    public function get($repo, $id) {
        return $$this->em
                        ->getRepository($repo)
                        ->find($id);
    }

    /**
     * Set new data in database
     * 
     * @param $obj Class of object
     * @param $data Data to be defined
     * @param $user Currently logged user
     * 
     * @retun {Object} Newly created object
     * 
     */
    public function set($obj, $data, $user) {
        $obj->setUser($user);
        $obj->setActive(1);

        foreach ($data as $key => $value) {
            $obj->setValue($key, $value);
        }

        $this->em->persist($obj);

        $this->em->flush();

        return $obj;
    }

    /**
     * Updating data in database
     * 
     * @param $data Data to be updated
     * @param $repo Name of repo whete to look
     * @param $id Identifier
     * @param $user Currently logged user
     * 
     * @retun {Object} Updated object
     * 
     */
    public function update($data, $repo, $id, $user) {
        $obj = $this->em->getRepository($repo)->find($id);

        if (!$obj) {
            return 404;
        }

        if ($user->getId() !== $obj->getUser()->getId()) {
            return 401;
        }

        foreach ($data as $key => $value) {
            $obj->setValue($key, $value);
        }

        $this->em->flush();

        return $obj;
    }

    /**
     * Deleting data from database
     * 
     * @param $repo Name of repo whete to look
     * @param $id Identifier
     * @param $user Currently logged user
     * 
     */
    public function delete($repo, $id, $user) {
        $obj = $this->em->getRepository($repo)->find($id);

        if (!$obj) {
            return 404;
        }

        if ($user->getId() !== $obj->getUser()->getId()) {
            return 401;
        }

        $this->em->remove($obj);
        $this->em->flush();
    }

}