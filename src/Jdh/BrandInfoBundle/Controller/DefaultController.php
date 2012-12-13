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

                return array(
                    'brand' => $brand,
                    'result' => 'invented',
                    'info' => array(
                        'Environmental care' => 'In the company, we strive for well-considered and economical use of natural sources. We use environmental friendly technologies in our production and we try hard by reduction of waste, lower consumption of energy and water to minimise environmental burdening. We are respectful to environment, what, inter alia, proves also the international certificate on environmental management
ISO 14001.'),
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
     * @Route("/wheretobuy", name="_brand_wheretobuy")
     * @Template()
     */
    public function wheretobuyAction()
    {
        //The google apis key is stored in config\parameters.yml file
        $googleApisKey = $this->container->getParameter('google_apis_key');

        return array(
            'googleApisKey' => $googleApisKey,
        );
    }

    /**
     * @Route("/wheretobuyonline/{startIndex}", name="_brand_wheretobuy_online")
     * @Template()
     */
    public function wheretobuyonlineAction(Request $request, $startIndex)
    {
        $form = $this->createFormBuilder()
            ->add('product_name', 'text')
            ->getForm();

        //The google apis key is stored in config\parameters.yml file
        $googleApisKey = $this->container->getParameter('google_apis_key');

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $brand = $form['product_name']->getData();

                $buzz = $this->container->get('buzz');
                //Google Search API for Shopping
                $response = $buzz->get('https://www.googleapis.com/shopping/search/v1/public/products?key='.$googleApisKey.'&country=ES&alt=json&startIndex='.$startIndex.'&restrictBy=brand%3A'.$brand);
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