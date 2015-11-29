<?php
// src/AppBundle/Entity/User.php

namespace ABS\BlogBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * User
 * @ORM\Table(name="fos_user")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     */
    private $path;

     
 
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;
 
    private $tempFilename;
 
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        // Si jamais il n'y a pas de fichier (champ facultatif)
        if (null !== $this->getFile()) {
            $this->path = $this->getFile()->guessExtension();
        }
 
    }
 
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        // Si jamais il n'y a pas de fichier (champ facultatif)
        if (null === $this->file) {
            return;
        }
 
        // Si on avait un ancien fichier, on le supprime
        if (null !== $this->tempFilename) {
            $oldFile = $this->getUploadRootDir() . '/' . $this->id . '.' . $this->tempFilename;
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }
 
        // On déplace le fichier envoyé dans le répertoire de notre choix
        $this->getFile()->move(
            $this->getUploadRootDir(), // Le répertoire de destination
            $this->id . '.' . $this->path // Le nom du fichier à créer, ici "id.extension"
        );
        $this->file = null;
    }
 
    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        // On sauvegarde temporairement le nom du fichier car il dépend de l'id
        $this->tempFilename = $this->getUploadRootDir() . '/' . $this->id . '.' . $this->path;
    }
 
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        // En PostRemove, on n'a pas accès à l'id, on utilise notre nom sauvegardé
        if (isset($this->tempFilename)) {
            // On supprime le fichier
            unlink($this->tempFilename);
        }
    }
 
    public function getUploadDir()
    {
        // On retourne le chemin relatif vers l'image pour un navigateur
        return 'uploads/users';
    }
 
    protected function getUploadRootDir()
    {
        // On retourne le chemin absolu vers l'image pour notre code PHP
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }
 
    public function getWebPath()
    {
        return $this->getUploadDir() . '/' . $this->getId() . '.' . $this->getPath();
    }
 
 
    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
 
    /**
     * @param string $path
     * @return Image
     */
    public function setPath($path)
    {
        $this->path = $path;
 
        return $this;
    }
 
    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
 
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
 
        // On vérifie si on avait déjà un fichier pour cette entité
        if (null !== $this->path) {
            // On sauvegarde l'extension du fichier pour le supprimer plus tard
            $this->tempFilename = $this->path;
 
            // On réinitialise les valeurs des attributs path
            $this->path = null;
    
        }
    }
 
    public function getFile()
    {
        return $this->file;
    }

}
