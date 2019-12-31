<?php

namespace CatalogueBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Media
 *
 * @ORM\Table(name="media")
 * @ORM\Entity(repositoryClass="CatalogueBundle\Repository\MediaRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Media
{
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
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;


    /**
     * Get id
     *
     * @return int
     */
    
    private $file;
    private $tempfilename;
    
    public function setfile(UploadedFile $file){
        $this->file= $file;
        if(null !== $this->url ){
            $this->tempfilename = $this->url;
            $this->url= 'url';
            $this->alt = 'alt';
        }
    }
     public function getfile(){
         return $this->file;
     }
      /**
     * @ORM\Prepersist()
     * @oRM\PreUpdate()
     */
    public function  preUpload(){
        if(null==$this->file){return;
        }
        $this->url= $this->file->guessExtension();
        $this->alt = $this->file->getClientOriginalName();
    }
    /**
     * *@ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
        if(null=== $this->file){return;
        }
        if (null !== $this->tempfilename){
            $oldFile = $this->getUploadRootDir().'/'. $this->id.'.'
                    . $this->tempfilename;
            if(file_exists($oldFile)){
                unlink($oldFile);
            }
        }
        $this->file->move(
                $this->getUploadRootDir(),$this->id.'.'.$this->url);
    }
    public function preRemoveUpload(){
        $this->tempfilename = $this->getUploadRootDir().'/'.$this->url;
    }
    /**
     * @ORM\preRemove()
     */
    public function removeUpload(){
        if(file_exists($this->tempfilename)){
            unlink($this->tempfilename);
    }}
    public function getUploadDir(){
        return 'upload/img';
    }
    protected function getUploadRootDir(){
        return __Dir__.'/../../../web/'.$this->getUploadDir();
    }
     /*
      * Get id
      */       
     
     
    public function getId()
    {
        return $this->id;
    }
    
      /**
     * Set alt
     *
     * @param string $alt
     *
     * @return Media
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Media
     */
    public function seturl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function geturl()
    {
        return $this->url;
    }
 
    public function getWebPath(){
    return $this->getUploadDir() . '/' . $this->getId() . '.' .$this->getUrl();
}

}