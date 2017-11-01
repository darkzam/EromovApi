<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actor
 *
 * @ORM\Table(name="actor")
 * @ORM\Entity
 */
class Actor
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
     * @ORM\Column(name="nombre", type="string", length=255, precision=0, scale=0, nullable=false, unique=true)
     */
    private $nombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="anio_nacimiento", type="date", precision=0, scale=0, nullable=false, unique=false)
     */
    private $anioNacimiento;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Pelicula", mappedBy="actores")
     */
    private $peliculas;

    /**
     * @var \AppBundle\Entity\Pais
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Pais", inversedBy="actores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pais_id", referencedColumnName="id")
     * })
     */
    private $pais;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->peliculas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Actor
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set anioNacimiento
     *
     * @param \DateTime $anioNacimiento
     *
     * @return Actor
     */
    public function setAnioNacimiento($anioNacimiento)
    {
        $this->anioNacimiento = $anioNacimiento;

        return $this;
    }

    /**
     * Get anioNacimiento
     *
     * @return \DateTime
     */
    public function getAnioNacimiento()
    {
        return $this->anioNacimiento;
    }

    /**
     * Add pelicula
     *
     * @param \AppBundle\Entity\Pelicula $pelicula
     *
     * @return Actor
     */
    public function addPelicula(\AppBundle\Entity\Pelicula $pelicula)
    {
        $this->peliculas[] = $pelicula;

        return $this;
    }

    /**
     * Remove pelicula
     *
     * @param \AppBundle\Entity\Pelicula $pelicula
     */
    public function removePelicula(\AppBundle\Entity\Pelicula $pelicula)
    {
        $this->peliculas->removeElement($pelicula);
    }

    /**
     * Get peliculas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPeliculas()
    {
        return $this->peliculas;
    }

    /**
     * Set pais
     *
     * @param \AppBundle\Entity\Pais $pais
     *
     * @return Actor
     */
    public function setPais(\AppBundle\Entity\Pais $pais = null)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return \AppBundle\Entity\Pais
     */
    public function getPais()
    {
        return $this->pais;
    }
}

