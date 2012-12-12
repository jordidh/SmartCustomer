<?php

namespace Jdh\BrandInfoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/smartc", name="_brand_main")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/brand/{startIndex}", name="_brand_info")
     * @Template()
     */
    public function brandAction(Request $request, $startIndex)
    {
        $form = $this->createFormBuilder()
            ->add('brand_name', 'text')
            ->getForm();

        //The google apis key is stored in config\parameters.yml file
        $googleApisKey = $this->container->getParameter('google_apis_key');

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $brand = $form['brand_name']->getData();

                $buzz = $this->container->get('buzz');
                //Google Search API for Shopping
                $response = $buzz->get('https://www.googleapis.com/shopping/search/v1/public/products?key='.$googleApisKey.'&country=ES&q=shoes&alt=json&startIndex='.$startIndex.'&restrictBy=brand%3A'.$brand);
                //Google web
                //$response = $buzz->get('http://google.com/#hl=ca&tbo=d&sclient=psy-ab&q='.$brand);

                //Get the data returned
                //$result = $response->getReasonPhrase();
                $responseStatus = $response->getStatusCode();
                if ($responseStatus == 200)
                {
                    $info = $response->getContent();
                    $result = json_decode($info, true);
                }
                else
                {
                    $info = $response->getContent();
                    $result = json_decode($info, true);
                }
                return array(
                    'brand' => $brand,
                    'result' => $response->getReasonPhrase(),
                    'info' => $result,
                    'form' => $form->createView(),
                );
            }
        }

        return array(
            'brand' => '',
            'result' => '',
            'info' => null,
            'form' => $form->createView(),
        );
    }

    /**
     * @Route("/wheretobuy/{startIndex}", name="_brand_wheretobuy")
     * @Template()
     */
    public function wheretobuyAction(Request $request, $startIndex)
    {
        $form = $this->createFormBuilder()
            ->add('product_to_buy', 'text')
            ->getForm();

        //The google apis key is stored in config\parameters.yml file
        $googleApisKey = $this->container->getParameter('google_apis_key');

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $brand = $form['product_to_buy']->getData();

                $buzz = $this->container->get('buzz');
                //Google Search API for Shopping
                $response = $buzz->get('https://www.googleapis.com/shopping/search/v1/public/products?key='.$googleApisKey.'&country=ES&q=shoes&alt=json&startIndex='.$startIndex.'&restrictBy=brand%3A'.$brand);
                //Google web
                //$response = $buzz->get('http://google.com/#hl=ca&tbo=d&sclient=psy-ab&q='.$brand);

                //Get the data returned
                //$result = $response->getReasonPhrase();
                $responseStatus = $response->getStatusCode();
                if ($responseStatus == 200)
                {
                    $info = $response->getContent();
                    $result = json_decode($info, true);
                }
                else
                {
                    $info = $response->getContent();
                    $result = json_decode($info, true);
                }
                return array(
                    'brand' => $brand,
                    'result' => $response->getReasonPhrase(),
                    'info' => $result,
                    'form' => $form->createView(),
                );
            }
        }

        return array(
            'brand' => '',
            'result' => '',
            'info' => null,
            'form' => $form->createView(),
        );
    }
}