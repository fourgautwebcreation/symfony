<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sectors
 *
 * @ORM\Table(name="sectors")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SectorsRepository")
 */
class Sectors
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @var string
     *
     * @ORM\Column(name="sector_name", type="string", length=255)
     *
     */
    public $sectorName;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set sectorName
     *
     * @param string $sectorName
     *
     * @return Sectors
     */
    public function setSectorName($sectorName)
    {
        $this->sectorName = $sectorName;

        return $this;
    }

    /**
     * Get sectorName
     *
     * @return string
     */
    public function getSectorName()
    {
        return $this->sectorName;
    }
}
