<?php

namespace Nav\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category
 *
 * @ORM\Table("category")
 * @ORM\Entity
 */
class Category extends TimestampableEntity
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
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Page", mappedBy="category")
     */
    private $pages;


    /**
     * Holds the pages in a ArrayCollection
     * for us. Did you note that the
     * Page Entity doesnt have getter/setter for category?
     */
    public function __construct(){
        $this->pages = new ArrayCollection();
    }

    public function __toString(){
       return $this->name;
    }


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
     * @return Category
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
     * Add pages
     *
     * @param \Nav\CMSBundle\Entity\Page $pages
     * @return Category
     */
    public function addPage(\Nav\CMSBundle\Entity\Page $pages)
    {
        $this->pages[] = $pages;

        return $this;
    }

    /**
     * Remove pages
     *
     * @param \Nav\CMSBundle\Entity\Page $pages
     */
    public function removePage(\Nav\CMSBundle\Entity\Page $pages)
    {
        $this->pages->removeElement($pages);
    }

    /**
     * Get pages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPages()
    {
        return $this->pages;
    }
}
