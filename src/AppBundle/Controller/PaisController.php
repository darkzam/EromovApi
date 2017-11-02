<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Pais;

class PaisController extends FOSRestController
{

    /**
    * @Rest\Post("/paises")
    */
    public function crearPais(Request $request)
      {
      // entity manager
      $em = $this->getDoctrine()->getManager();
      //parametros de la petición
      $nombre = $request->request->get('nombre');
      // entida
      $pais = new Pais();
      $pais->setNombre($nombre);
      // persistencia
      try {
          $em->persist($pais);
          $em->flush();
          return new View('Creación Pais satisfactoria.', Response::HTTP_CREATED);
      } catch (exception $e) {
          return new View('Se presentó un error con la creacion de pais.', Response::HTTP_INTERNAL_SERVER_ERROR);
      }
      }

}
