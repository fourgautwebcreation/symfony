<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Enterprises
 *
 * @ORM\Table(name="enterprises")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EnterprisesRepository")
 */
class Enterprises
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
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="enterprise_name", type="string", length=255)
     */
    public $enterpriseName;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = 9,
     *      max = 9
     * )
     *
     *
     * @ORM\Column(name="enterprise_siren", type="string", length=9)
     */
    public $enterpriseSiren;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="enterprise_adress", type="string", length=255)
     */
    public $enterpriseAdress;

    /**
     * @var int
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="enterprise_sector", type="integer")
     */
    public $enterpriseSector;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Sectors")
     *
     * @ORM\JoinColumn(name="enterprise_sector", referencedColumnName="id")
     */
    public $enterpriseSectorName;

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
     * Set enterpriseName
     *
     * @param string $enterpriseName
     *
     * @return Enterprises
     */
    public function setEnterpriseName($enterpriseName)
    {
        $this->enterpriseName = $enterpriseName;

        return $this;
    }

    /**
     * Get enterpriseName
     *
     * @return string
     */
    public function getEnterpriseName()
    {
        return $this->enterpriseName;
    }

    /**
     * Set enterpriseSiren
     *
     * @param integer $enterpriseSiren
     *
     * @return Enterprises
     */
    public function setEnterpriseSiren($enterpriseSiren)
    {
        $this->enterpriseSiren = $enterpriseSiren;

        return $this;
    }

    /**
     * Get enterpriseSiren
     *
     * @return int
     */
    public function getEnterpriseSiren()
    {
        return $this->enterpriseSiren;
    }

    /**
     * Set enterpriseAdress
     *
     * @param string $enterpriseAdress
     *
     * @return Enterprises
     */
    public function setEnterpriseAdress($enterpriseAdress)
    {
        $this->enterpriseAdress = $enterpriseAdress;

        return $this;
    }

    /**
     * Get enterpriseAdress
     *
     * @return string
     */
    public function getEnterpriseAdress()
    {
        return $this->enterpriseAdress;
    }

    /**
     * Set enterpriseSector
     *
     * @param integer $enterpriseSector
     *
     * @return Enterprises
     */
    public function setEnterpriseSector($s)
    {
        $this->enterpriseSector = $s;
        return $this;
    }

    /**
     * Get enterpriseSector
     *
     * @return int
     */
    public function getEnterpriseSector()
    {
        return $this->enterpriseSector;
    }

    /**
     * Get enterpriseSectorName
     *
     * @return string
     */
    public function getEnterpriseSectorName()
    {
        return $this->enterpriseSectorName;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->enterpriseSectorName = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add enterpriseSectorName
     *
     * @param \AppBundle\Entity\Sectors $enterpriseSectorName
     *
     * @return Enterprises
     */
    public function addEnterpriseSectorName(\AppBundle\Entity\Sectors $enterpriseSectorName)
    {
        $this->enterpriseSectorName[] = $enterpriseSectorName;

        return $this;
    }

    /**
     * Remove enterpriseSectorName
     *
     * @param \AppBundle\Entity\Sectors $enterpriseSectorName
     */
    public function removeEnterpriseSectorName(\AppBundle\Entity\Sectors $enterpriseSectorName)
    {
        $this->enterpriseSectorName->removeElement($enterpriseSectorName);
    }

    /**
     * Set enterpriseSectorName
     *
     * @param \AppBundle\Entity\Sectors $enterpriseSectorName
     *
     * @return Enterprises
     */
    public function setEnterpriseSectorName(\AppBundle\Entity\Sectors $enterpriseSectorName = null)
    {
        $this->enterpriseSectorName = $enterpriseSectorName;

        return $this;
    }
}
