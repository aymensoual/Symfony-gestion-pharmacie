<?php

namespace CatalogueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client 
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="CatalogueBundle\Repository\ClientRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Client {

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
     * @ORM\Column(name="nom", type="text")
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="text")
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="remarque", type="text")
     */
    private $remarque;

    /**
     * @var int
     *
     * @ORM\Column(name="telephone", type="integer")
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255, nullable=false, unique=true)
     */
    private $token;

    /**
     * @ORM\ManyToOne(targetEntity="CatalogueBundle\Entity\Medicament")
     * @ORM\JoinColumn{Nullable=false} 
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Client 
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Set description
     *
     * @param string $remarque
     *
     * @return Client 
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
     * @return Client 
     */
    public function setCode($code) {
        $this->code = $code;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom() {
        return $this->prenom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Client 
     */
    public function setPrenom($prenom) {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Set telephone
     *
     * @param integer $telephone
     *
     * @return Client 
     */
    public function setTelephone($telephone) {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return int
     */
    public function getTelephone() {
        return $this->telephone;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return Client 
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
     * Set medicament
     *
     * @param \CatalogueBundle\Entity\Medicament $medicament
     *
     * @return Medicament 
     */
    public function setMedicament(\CatalogueBundle\Entity\Medicament $medicament = null) {
        $this->medicament = $medicament;

        return $this;
    }

    /**
     * Get medicament
     *
     * @return \CatalogueBundle\Entity\Medicament
     */
    public function getMedicament() {
        return $this->medicament;
    }

}
