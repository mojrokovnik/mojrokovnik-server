<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="mojrokovnik_calendar")
 */
class Calendar {

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
     * @ORM\ManyToOne(targetEntity="Cases")
     * @ORM\JoinColumn(name="cases", referencedColumnName="id", nullable=true)
     */
    private $cases;

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
     * @ORM\Column(type="string", length=100)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datetime;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $duration;

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
     * Set type
     *
     * @param string $type
     *
     * @return Calendar
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
     * Set name
     *
     * @param string $name
     *
     * @return Calendar
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
     * Set datetime
     *
     * @param \DateTime $datetime
     *
     * @return Calendar
     */
    public function setDatetime($datetime) {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime
     */
    public function getDatetime() {
        return $this->datetime;
    }

    /**
     * Set duration
     *
     * @param string $duration
     *
     * @return Calendar
     */
    public function setDuration($duration) {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return string
     */
    public function getDuration() {
        return $this->duration;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Calendar
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
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Calendar
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
     * Set cases
     *
     * @param \AppBundle\Entity\Cases $cases
     *
     * @return Calendar
     */
    public function setCases(\AppBundle\Entity\Cases $cases = null) {
        $this->cases = $cases;

        return $this;
    }

    /**
     * Get cases
     *
     * @return \AppBundle\Entity\Cases
     */
    public function getCases() {
        return $this->cases;
    }

    /**
     * Set clientIndividual
     *
     * @param \AppBundle\Entity\IndividualClient $clientIndividual
     *
     * @return Calendar
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
     * @return Calendar
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

    /**
     * Set active
     *
     * @param integer $active
     *
     * @return Calendar
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
