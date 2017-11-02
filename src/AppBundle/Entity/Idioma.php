<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Idioma
 *
 * @ORM\Table(name="idioma")
 * @ORM\Entity
 */
class Idioma
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
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Pelicula", mappedBy="idiomas_audio")
     */
    private $peliculas_audio;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Pelicula", inversedBy="idiomas_subtitulo")
     * @ORM\JoinTable(name="idioma_pelicula",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idioma_id", referencedColumnName="id", onDelete="CASCADE")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="pelicula_id", referencedColumnName="id", onDelete="CASCADE")
     *   }
     * )
     */
    private $peliculas_subtitulo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->peliculas_audio = new \Doctrine\Common\Collections\ArrayCollection();
        $this->peliculas_subtitulo = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Idioma
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
     * Add peliculasAudio
     *
     * @param \AppBundle\Entity\Pelicula $peliculasAudio
     *
     * @return Idioma
     */
    public function addPeliculasAudio(\AppBundle\Entity\Pelicula $peliculasAudio)
    {
        $this->peliculas_audio[] = $peliculasAudio;

        return $this;
    }

    /**
     * Remove peliculasAudio
     *
     * @param \AppBundle\Entity\Pelicula $peliculasAudio
     */
    public function removePeliculasAudio(\AppBundle\Entity\Pelicula $peliculasAudio)
    {
        $this->peliculas_audio->removeElement($peliculasAudio);
    }

    /**
     * Get peliculasAudio
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPeliculasAudio()
    {
        return $this->peliculas_audio;
    }

    /**
     * Add peliculasSubtitulo
     *
     * @param \AppBundle\Entity\Pelicula $peliculasSubtitulo
     *
     * @return Idioma
     */
    public function addPeliculasSubtitulo(\AppBundle\Entity\Pelicula $peliculasSubtitulo)
    {
        $this->peliculas_subtitulo[] = $peliculasSubtitulo;

        return $this;
    }

    /**
     * Remove peliculasSubtitulo
     *
     * @param \AppBundle\Entity\Pelicula $peliculasSubtitulo
     */
    public function removePeliculasSubtitulo(\AppBundle\Entity\Pelicula $peliculasSubtitulo)
    {
        $this->peliculas_subtitulo->removeElement($peliculasSubtitulo);
    }

    /**
     * Get peliculasSubtitulo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPeliculasSubtitulo()
    {
        return $this->peliculas_subtitulo;
    }
}

