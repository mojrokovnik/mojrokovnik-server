<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="mojrokovnik_legalclients")
 */
class LegalClient {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $company_name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $state;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="integer", length=24, nullable=true)
     */
    private $vat;

    /**
     * @ORM\Column(type="integer", length=24, nullable=true)
     */
    private $company_number;

    /**
     * @ORM\Column(type="text", length=24, nullable=true)
     */
    private $account_number;

    /**
     * @ORM\ManyToOne(targetEntity="IndividualClient")
     * @ORM\JoinColumn(name="attorney", referencedColumnName="id", nullable=true)
     */
    private $attorney;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $attorney_name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $attorney_phone;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $attorney_address;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $attorney_city;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $attorney_state;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comment;

    /**
     * @ORM\Column(type="integer", options={"default" : 1})
     */
    private $active;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set companyName
     *
     * @param string $companyName
     *
     * @return ClientsLegal
     */
    public function setCompanyName($companyName) {
        $this->company_name = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string
     */
    public function getCompanyName() {
        return $this->company_name;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return ClientsLegal
     */
    public function setAddress($address) {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return ClientsLegal
     */
    public function setCity($city) {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return ClientsLegal
     */
    public function setState($state) {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState() {
        return $this->state;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return ClientsLegal
     */
    public function setPhone($phone) {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return ClientsLegal
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set vat
     *
     * @param integer $vat
     *
     * @return ClientsLegal
     */
    public function setVat($vat) {
        $this->vat = $vat;

        return $this;
    }

    /**
     * Get vat
     *
     * @return integer
     */
    public function getVat() {
        return $this->vat;
    }

    /**
     * Set companyNumber
     *
     * @param integer $companyNumber
     *
     * @return ClientsLegal
     */
    public function setCompanyNumber($companyNumber) {
        $this->company_number = $companyNumber;

        return $this;
    }

    /**
     * Get companyNumber
     *
     * @return integer
     */
    public function getCompanyNumber() {
        return $this->company_number;
    }

    /**
     * Set accountNumber
     *
     * @param string $accountNumber
     *
     * @return ClientsLegal
     */
    public function setAccountNumber($accountNumber) {
        $this->account_number = $accountNumber;

        return $this;
    }

    /**
     * Get accountNumber
     *
     * @return string
     */
    public function getAccountNumber() {
        return $this->account_number;
    }

    /**
     * Set attorneyName
     *
     * @param string $attorneyName
     *
     * @return ClientsLegal
     */
    public function setAttorneyName($attorneyName) {
        $this->attorney_name = $attorneyName;

        return $this;
    }

    /**
     * Get attorneyName
     *
     * @return string
     */
    public function getAttorneyName() {
        return $this->attorney_name;
    }

    /**
     * Set attorneyPhone
     *
     * @param string $attorneyPhone
     *
     * @return ClientsLegal
     */
    public function setAttorneyPhone($attorneyPhone) {
        $this->attorney_phone = $attorneyPhone;

        return $this;
    }

    /**
     * Get attorneyPhone
     *
     * @return string
     */
    public function getAttorneyPhone() {
        return $this->attorney_phone;
    }

    /**
     * Set attorneyAddress
     *
     * @param string $attorneyAddress
     *
     * @return ClientsLegal
     */
    public function setAttorneyAddress($attorneyAddress) {
        $this->attorney_address = $attorneyAddress;

        return $this;
    }

    /**
     * Get attorneyAddress
     *
     * @return string
     */
    public function getAttorneyAddress() {
        return $this->attorney_address;
    }

    /**
     * Set attorneyCity
     *
     * @param string $attorneyCity
     *
     * @return ClientsLegal
     */
    public function setAttorneyCity($attorneyCity) {
        $this->attorney_city = $attorneyCity;

        return $this;
    }

    /**
     * Get attorneyCity
     *
     * @return string
     */
    public function getAttorneyCity() {
        return $this->attorney_city;
    }

    /**
     * Set attorneyState
     *
     * @param string $attorneyState
     *
     * @return ClientsLegal
     */
    public function setAttorneyState($attorneyState) {
        $this->attorney_state = $attorneyState;

        return $this;
    }

    /**
     * Get attorneyState
     *
     * @return string
     */
    public function getAttorneyState() {
        return $this->attorney_state;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return ClientsLegal
     */
    public function setComment($comment) {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment() {
        return $this->comment;
    }

    /**
     * Set active
     *
     * @param integer $active
     *
     * @return ClientsLegal
     */
    public function setActive($active) {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return integer
     */
    public function getActive() {
        return $this->active;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return ClientsLegal
     */
    public function setUser(\AppBundle\Entity\User $user = null) {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Set attorney
     *
     * @param \AppBundle\Entity\Clients $attorney
     *
     * @return ClientsLegal
     */
    public function setAttorney(\AppBundle\Entity\Clients $attorney = null) {
        $this->attorney = $attorney;

        return $this;
    }

    /**
     * Get attorney
     *
     * @return \AppBundle\Entity\Clients
     */
    public function getAttorney() {
        return $this->attorney;
    }

    /**
     * Set values dinamicaly
     *
     * @return integer
     */
    public function setValue($key, $value) {
        if ($key !== 'user' && $key !== 'id') {
            $this->{$key} = $value;
            return $this;
        }
    }

}
