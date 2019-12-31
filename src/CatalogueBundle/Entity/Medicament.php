<?php

namespace CatalogueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Medicament 
 *
 * @ORM\Table(name="medicament")
 * @ORM\Entity(repositoryClass="CatalogueBundle\Repository\MedicamentRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Medicament  {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Code", type="string", length=255)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="text")
     */
    private $designation;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="text")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="remarque", type="text")
     */
    private $remarque;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;

    /**
     * @var int
     *
     * @ORM\Column(name="qtn", type="integer")
     */
    private $qtn;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255, nullable=false, unique=true)
     */
    private $token;

    /**
     * @ORM\OneToOne(targetEntity="CatalogueBundle\Entity\Media", cascade={"persist","remove"})
     * @ORM\JoinColumn{Nullable=false} 
     */
    private $Media;
    
    
    
    /**
     * @ORM\OneToMany(targetEntity="CatalogueBundle\Entity\Medicament",mappedBy="medicament")
     * @ORM\JoinColumn{nullable=false}
     */
      private $medicament;
    

    public function __construct() {
        $this->token = base_convert(sha1(uniqid(mt_rand(1, 999), true)), 16, 36);
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set designation
     *
     * @param string $designation
     *
     * @return Medicament 
     */
    public function setDesignation($designation) {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string
     */
    public function getDesignation() {
        return $this->designation;
    }

    /**
     * Set description
     *
     * @param string $remarque
     *
     * @return Medicament 
     */
    public function setRemarque($remarque) {
        $this->remarque = $remarque;

        return $this;
    }

    /**
     * Get remarque
     *
     * @return string
     */
    public function getRemarque() {
        return $this->remarque;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode() {
        return $this->code;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Medicament 
     */
    public function setCode($code) {
        $this->code = $code;

        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Set date
     *
     * @param string $date
     *
     * @return Medicament 
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Medicament 
     */
    public function setPrix($prix) {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix() {
        return $this->prix;
    }

    /**
     * Set qtn
     *
     * @param integer $qtn
     *
     * @return Medicament 
     */
    public function setQtn($qtn) {
        $this->qtn = $qtn;

        return $this;
    }

    /**
     * Get qtn
     *
     * @return int
     */
    public function getQtn() {
        return $this->qtn;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return Medicament 
     */
    public function setToken($token) {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken() {
        return $this->token;
    }

   

    
    /**
     * Set media
     *
     * @param \CatalogueBundle\Entity\Media $media
     *
     * @return Medicament 
     */
    public function setMedia(\CatalogueBundle\Entity\Media $media = null) {
        $this->Media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \CatalogueBundle\Entity\Media
     */
    public function getMedia() {
        return $this->Media;
    }
    
    
    
     /**
     * Get client
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClient()
    {
        return $this->client;
    }

}
