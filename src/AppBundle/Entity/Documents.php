<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @Vich\Uploadable
 * @ORM\Table(name="mojrokovnik_documents")
 */
class Documents {

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
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @Vich\UploadableField(mapping="file", fileNameProperty="url")
     */
    private $file;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $url;

    /**
     * @ORM\Column(type="integer", options={"default" : 0}, nullable=true)
     */
    private $dirty;

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
     * Set name
     *
     * @param string $name
     *
     * @return Documents
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
     * Set content
     *
     * @param string $content
     *
     * @return Documents
     */
    public function setContent($content) {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Set file
     *
     * @param string $file
     *
     * @return Documents
     */
    public function setFile(File $file = null) {
        $this->file = $file;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getFile() {
        return $this->file;
    }

    /**
     * Set documentUrl
     *
     * @param string $url
     *
     * @return Documents
     */
    public function setUrl($url) {
        $this->url = $url;

        return $this;
    }

    /**
     * Get documentUrl
     *
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Set dirty
     *
     * @param integer $dirty
     *
     * @return Documents
     */
    public function setDirty($dirty) {
        $this->dirty = $dirty;

        return $this;
    }

    /**
     * Get dirty
     *
     * @return integer
     */
    public function getDirty() {
        return $this->dirty;
    }

    /**
     * Set active
     *
     * @param integer $active
     *
     * @return Documents
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
     * @return Documents
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
     * @return Documents
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
