<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pais
 *
 * @ORM\Table(name="pais")
 * @ORM\Entity
 */
class Pais
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
     * @ORM\Column(name="nombre", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $nombre;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Pelicula", mappedBy="pais")
     */
    private $peliculas;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Actor", mappedBy="pais")
     */
    private $actores;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->peliculas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->actores = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Pais
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
     * Add pelicula
     *
     * @param \AppBundle\Entity\Pelicula $pelicula
     *
     * @return Pais
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
     * Add actore
     *
     * @param \AppBundle\Entity\Actor $actore
     *
     * @return Pais
     */
    public function addActore(\AppBundle\Entity\Actor $actore)
    {
        $this->actores[] = $actore;

        return $this;
    }

    /**
     * Remove actore
     *
     * @param \AppBundle\Entity\Actor $actore
     */
    public function removeActore(\AppBundle\Entity\Actor $actore)
    {
        $this->actores->removeElement($actore);
    }

    /**
     * Get actores
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActores()
    {
        return $this->actores;
    }
}

