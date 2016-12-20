<?php

namespace ROY\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Application
 *
 * @ORM\Table(name="application")
 * @ORM\Entity(repositoryClass="ROY\PlatformBundle\Repository\ApplicationRepository")
 */
class Application
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
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

     /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;
    
     /**
     * @var date
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
	
	/**
	 * @ORM\ManyToOne(targetEntity="ROY\PlatformBundle\Entity\Advert")
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $advert;
	

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
     * Set author
     *
     * @param string $author
     *
     * @return Application
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Application
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Application
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set image
     *
     * @param \ROY\PlatformBundle\Entity\Advert $image
     *
     * @return Application
     */
    public function setImage(\ROY\PlatformBundle\Entity\Advert $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \ROY\PlatformBundle\Entity\Advert
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set advert
     *
     * @param \ROY\PlatformBundle\Entity\Advert $advert
     *
     * @return Application
     */
    public function setAdvert(\ROY\PlatformBundle\Entity\Advert $advert)
    {
        $this->advert = $advert;

        return $this;
    }

    /**
     * Get advert
     *
     * @return \ROY\PlatformBundle\Entity\Advert
     */
    public function getAdvert()
    {
        return $this->advert;
    }
}
