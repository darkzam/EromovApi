<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Pelicula;

class PeliculaController extends FOSRestController
{

  /**
      * @Rest\Get("/peliculas")
      */

      public function getPeliculas(Request $request)
      {
          $em = $this->getDoctrine()->getManager();

          $repoPeliculas = $em->getRepository('AppBundle:Pelicula');

          $peliculas = $repoPeliculas->findall();
          $output = array();

          if($peliculas)
          {
            foreach ($peliculas as $pelicula ) {

              //categoria
              $categoria = array();

              if($pelicula->getCategoria())
              {
                $categoria = array(
                  'id' => $pelicula->getCategoria()->getId(),
                  'nombre' => $pelicula->getCategoria()->getNombre()
                );
              }

              $actores = array();

              foreach ($pelicula->getActores() as $actor) {

                $actores[] = array(
                          'id'             => $actor->getId(),
                          'nombre'         => $actor->getNombre(),
                          'anioNacimiento' => $actor->getAnioNacimiento()
                      );
                  }

                  $output[] = array(
                      'id'          => $pelicula->getId(),
                      'nombre'      => $pelicula->getNombre(),
                      'descripcion' => $pelicula->getDescripcion(),
                      'categoria'   => $categoria,
                      'actores'      => $actores,
                  );
            }

            return new View($output, Response::HTTP_OK);

          }

          return new View('No existen película aun epa.', Response::HTTP_NOT_FOUND);

      }

    /**
    * @Rest\Post("/peliculas")
    */
    public function crearPelicula(Request $request)
      {
      // entity manager
      $em = $this->getDoctrine()->getManager();

      //parametros de la petición
      $nombre = $request->request->get('nombre');
      $resumen = $request->request->get('resumen');
      $url_trailer = $request->request->get('url_trailer');
      $paisparam = $request->request->get('pais_id');
      $catparam = $request->request->get('categoria');

      // entidad
      $pelicula = new Pelicula();
      $pelicula->setNombre($nombre);
      $pelicula->setResumen($resumen);
      $pelicula->setUrlTrailer($url_trailer);

      //entidad pais

      $repoPais = $em->getRepository('AppBundle:Pais');
      $pais = $repoPais->find($paisparam);
      if($pais){
        $pelicula->setPais($pais);
      } else {
        return new View('Error Pais no existente .', Response::HTTP_CREATED);
      }

      $repoCategoria = $em->getRepository('AppBundle:Categoria');
      $categoria = $repoCategoria->find($catparam);
      if($categoria){
        $pelicula->setCategoria($categoria);
      } else {
        return new View('Error Categoria no existente .', Response::HTTP_CREATED);
      }

      // persistencia
      try {
          $em->persist($pelicula);
          $em->flush();
          return new View('Creación satisfactoria.', Response::HTTP_CREATED);
      } catch (exception $e) {
          return new View('Se presentó un error.', Response::HTTP_INTERNAL_SERVER_ERROR);
      }
      }

}
