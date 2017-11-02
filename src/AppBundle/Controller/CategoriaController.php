<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Categoria;

class CategoriaController extends FOSRestController
{

    /**
    * @Rest\Post("/categorias")
    */
    public function crearCategoria(Request $request)
      {
      // entity manager
      $em = $this->getDoctrine()->getManager();
      //parametros de la petición
      $nombre = $request->request->get('nombre');
      // entida
      $categoria = new Categoria();
      $categoria->setNombre($nombre);
      // persistencia
      try {
          $em->persist($categoria);
          $em->flush();
          return new View('Creación Categoria satisfactoria.', Response::HTTP_CREATED);
      } catch (exception $e) {
          return new View('Se presentó un error con la creacion de categoria.', Response::HTTP_INTERNAL_SERVER_ERROR);
      }
      }

}
