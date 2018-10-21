<?php
/**
 * Created by PhpStorm.
 * User: Angélina
 * Date: 21/10/2018
 * Time: 23:12
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Department;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Get;

class APIController extends Controller
{
    /**
     * @GET("department/{name}")
     */
    public function apiAction(Department $department, Request $request)
    {
        $data = $this->get('jms_serializer')->serialize($department, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

}