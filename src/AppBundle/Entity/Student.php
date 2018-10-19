<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Student
 *
 * @ORM\Table(name="student")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StudentRepository")
 */
class Student
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
     * @ORM\Column(name="firstname", type="string", length=25)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=25)
     */
    private $lastname;

    /**
     * @var int
     *@Assert\Length(
     *      min = 10,
     *      max = 10,
     *      minMessage = "Le numéro étudiant doit comprendre 10 chiffres",
     *      maxMessage = "Le numéro étudiant doit comprendre 10 chiffres"
     * )
     * @ORM\Column(name="numEtud", type="string", length=10)
     *
     */
    private $numEtud;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Department", inversedBy="student")
     * @ORM\JoinColumn(name="department_id", referencedColumnName="id")
     *
     */
    private $department;


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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Student
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Student
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set numEtud
     *
     * @param integer $numEtud
     *
     * @return Student
     */
    public function setNumEtud($numEtud)
    {
        $this->numEtud = $numEtud;

        return $this;
    }

    /**
     * Get numEtud
     *
     * @return int
     */
    public function getNumEtud()
    {
        return $this->numEtud;
    }


    /**
     * Set department
     *
     * @param \AppBundle\Entity\Department $department
     *
     * @return Student
     */
    public function setDepartment(\AppBundle\Entity\Department $department = null)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return \AppBundle\Entity\Department
     */
    public function getDepartment()
    {
        return $this->department;
    }
}
