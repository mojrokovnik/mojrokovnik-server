<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="mojrokovnik_cases")
 */
class Cases {

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
     * @ORM\ManyToOne(targetEntity="IndividualClient")
     * @ORM\JoinColumn(name="client_individual", referencedColumnName="id", nullable=true)
     */
    private $client_individual;

    /**
     * @ORM\ManyToOne(targetEntity="LegalClient")
     * @ORM\JoinColumn(name="client_legal", referencedColumnName="id", nullable=true)
     */
    private $client_legal;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $rival_type;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $rival_name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $rival_surname;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $element;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $legal_council;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $legal_label;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $legal_number;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="integer", length=100, nullable=true)
     */
    private $value;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $internal_number;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $supervisor;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $court;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $court_number;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $judge;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
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
     * Set rivalType
     *
     * @param string $rivalType
     *
     * @return Cases
     */
    public function setRivalType($rivalType) {
        $this->rival_type = $rivalType;

        return $this;
    }

    /**
     * Get rivalType
     *
     * @return string
     */
    public function getRivalType() {
        return $this->rival_type;
    }

    /**
     * Set rivalName
     *
     * @param string $rivalName
     *
     * @return Cases
     */
    public function setRivalName($rivalName) {
        $this->rival_name = $rivalName;

        return $this;
    }

    /**
     * Get rivalName
     *
     * @return string
     */
    public function getRivalName() {
        return $this->rival_name;
    }

    /**
     * Set rivalSurname
     *
     * @param string $rivalSurname
     *
     * @return Cases
     */
    public function setRivalSurname($rivalSurname) {
        $this->rival_surname = $rivalSurname;

        return $this;
    }

    /**
     * Get rivalSurname
     *
     * @return string
     */
    public function getRivalSurname() {
        return $this->rival_surname;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Cases
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set element
     *
     * @param string $element
     *
     * @return Cases
     */
    public function setElement($element) {
        $this->element = $element;

        return $this;
    }

    /**
     * Get element
     *
     * @return string
     */
    public function getElement() {
        return $this->element;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Cases
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set legalCouncil
     *
     * @param string $legalCouncil
     *
     * @return Cases
     */
    public function setLegalCouncil($legalCouncil) {
        $this->legal_council = $legalCouncil;

        return $this;
    }

    /**
     * Get legalCouncil
     *
     * @return string
     */
    public function getLegalCouncil() {
        return $this->legal_council;
    }

    /**
     * Set legalLabel
     *
     * @param string $legalLabel
     *
     * @return Cases
     */
    public function setLegalLabel($legalLabel) {
        $this->legal_label = $legalLabel;

        return $this;
    }

    /**
     * Get legalLabel
     *
     * @return string
     */
    public function getLegalLabel() {
        return $this->legal_label;
    }

    /**
     * Set legalNumber
     *
     * @param string $legalNumber
     *
     * @return Cases
     */
    public function setLegalNumber($legalNumber) {
        $this->legal_number = $legalNumber;

        return $this;
    }

    /**
     * Get legalNumber
     *
     * @return string
     */
    public function getLegalNumber() {
        return $this->legal_number;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Cases
     */
    public function setStatus($status) {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Get value
     *
     * @return integer
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * Set internalNumber
     *
     * @param integer $internalNumber
     *
     * @return Cases
     */
    public function setInternalNumber($internalNumber) {
        $this->internal_number = $internalNumber;

        return $this;
    }

    /**
     * Get internalNumber
     *
     * @return integer
     */
    public function getInternalNumber() {
        return $this->internal_number;
    }

    /**
     * Set supervisor
     *
     * @param string $supervisor
     *
     * @return Cases
     */
    public function setSupervisor($supervisor) {
        $this->supervisor = $supervisor;

        return $this;
    }

    /**
     * Get supervisor
     *
     * @return string
     */
    public function getSupervisor() {
        return $this->supervisor;
    }

    /**
     * Set court
     *
     * @param string $court
     *
     * @return Cases
     */
    public function setCourt($court) {
        $this->court = $court;

        return $this;
    }

    /**
     * Get court
     *
     * @return string
     */
    public function getCourt() {
        return $this->court;
    }

    /**
     * Set courtNumber
     *
     * @param string $courtNumber
     *
     * @return Cases
     */
    public function setCourtNumber($courtNumber) {
        $this->court_number = $courtNumber;

        return $this;
    }

    /**
     * Get courtNumber
     *
     * @return string
     */
    public function getCourtNumber() {
        return $this->court_number;
    }

    /**
     * Set judge
     *
     * @param string $judge
     *
     * @return Cases
     */
    public function setJudge($judge) {
        $this->judge = $judge;

        return $this;
    }

    /**
     * Get judge
     *
     * @return string
     */
    public function getJudge() {
        return $this->judge;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Cases
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
     * @return Cases
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
     * @return Cases
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

    /**
     * Set clientIndividual
     *
     * @param \AppBundle\Entity\IndividualClient $clientIndividual
     *
     * @return Cases
     */
    public function setClientIndividual(\AppBundle\Entity\IndividualClient $clientIndividual = null) {
        $this->client_individual = $clientIndividual;

        return $this;
    }

    /**
     * Get clientIndividual
     *
     * @return \AppBundle\Entity\IndividualClient
     */
    public function getClientIndividual() {
        return $this->client_individual;
    }

    /**
     * Set clientLegal
     *
     * @param \AppBundle\Entity\LegalClient $clientLegal
     *
     * @return Cases
     */
    public function setClientLegal(\AppBundle\Entity\LegalClient $clientLegal = null) {
        $this->client_legal = $clientLegal;

        return $this;
    }

    /**
     * Get clientLegal
     *
     * @return \AppBundle\Entity\LegalClient
     */
    public function getClientLegal() {
        return $this->client_legal;
    }
}
