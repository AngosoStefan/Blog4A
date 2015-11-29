<?php

namespace ABS\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Movie
 *
 * @ORM\Table(name="movie")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="ABS\BlogBundle\Entity\MovieRepository")
 */
class Movie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="release_date", type="date")
     */
    private $releaseDate;

    /**
     * @var string
     *
     * @ORM\Column(name="director", type="string", length=255)
     */
    private $director;


    /**
     * @var string
     *
     * @ORM\Column(name="actor1", type="string", length=255)
     */
    private $actor1;

    /**
     * @var string
     *
     * @ORM\Column(name="actor2", type="string", length=255)
     */
    private $actor2;


    /**
     * @var string
     *
     * @ORM\Column(name="actor3", type="string", length=255)
     */
    private $actor3;


    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer")
     */
    private $duration;

    /**
     * @var integer
     *
     * @ORM\Column(name="budget", type="integer")
     */
    private $budget;

    /**
     * @var integer
     *
     * @ORM\Column(name="box_office", type="integer")
     */
    private $boxOffice;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path;

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;


    private $temp;

    



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Movie
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set releaseDate
     *
     * @param \DateTime $releaseDate
     *
     * @return Movie
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * Get releaseDate
     *
     * @return \DateTime
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * Set director
     *
     * @param string $director
     *
     * @return Movie
     */
    public function setDirector($director)
    {
        $this->director = $director;

        return $this;
    }

    /**
     * Get director
     *
     * @return string
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return Movie
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set budget
     *
     * @param integer $budget
     *
     * @return Movie
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * Get budget
     *
     * @return integer
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * Set boxOffice
     *
     * @param integer $boxOffice
     *
     * @return Movie
     */
    public function setBoxOffice($boxOffice)
    {
        $this->boxOffice = $boxOffice;

        return $this;
    }

    /**
     * Get boxOffice
     *
     * @return integer
     */
    public function getBoxOffice()
    {
        return $this->boxOffice;
    }

    /**
     * Set actor1
     *
     * @param string $actor1
     *
     * @return Movie
     */
    public function setActor1($actor1)
    {
        $this->actor1 = $actor1;

        return $this;
    }

    /**
     * Get actor1
     *
     * @return string
     */
    public function getActor1()
    {
        return $this->actor1;
    }

    /**
     * Set actor2
     *
     * @param string $actor2
     *
     * @return Movie
     */
    public function setActor2($actor2)
    {
        $this->actor2 = $actor2;

        return $this;
    }

    /**
     * Get actor2
     *
     * @return string
     */
    public function getActor2()
    {
        return $this->actor2;
    }

    /**
     * Set actor3
     *
     * @param string $actor3
     *
     * @return Movie
     */
    public function setActor3($actor3)
    {
        $this->actor3 = $actor3;

        return $this;
    }

    /**
     * Get actor3
     *
     * @return string
     */
    public function getActor3()
    {
        return $this->actor3;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/movies';
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (is_file($this->getAbsolutePath())) {
            // store the old name to delete after the update
            $this->temp = $this->getAbsolutePath();
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }


    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
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
        if (null === $this->getFile()) {
            return;
        }

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->temp);
            // clear the temp image path
            $this->temp = null;
        }

        // you must throw an exception here if the file cannot be moved
        // so that the entity is not persisted to the database
        // which the UploadedFile move() method does
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->id.'.'.$this->getFile()->guessExtension()
        );

        $this->setFile(null);
    }

    /**
     * @ORM\PreRemove()
     */
    public function storeFilenameForRemove()
    {
        $this->temp = $this->getAbsolutePath();
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if (isset($this->temp)) {
            @unlink($this->temp);
        }

    }


    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->id.'.'.$this->path;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Article
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
    
}
