<?php

namespace ROY\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use ROY\PlatformBundle\Entity\Advert;

class AdvertController extends Controller
{
	
    public function indexAction($page)
    {
	    //on ne connait pas le nombre de pages mais doit être >= 1
	    if($page<1){
		    //404
		    throw new NotFoundHttpException('Roy Page ' . $page . ' inexistante');
	    }
	    
	    $listAdverts = array(
		  array('id'=>2, 'title'=>'Recherche dev Symfony', 'author'=>'Roy22', 'date'=> new \Datetime(), 'content'=>'Nous cherchons un dev d\'ici !' ),
		  array('id'=>5, 'title'=>'Mission Web', 'author'=>'Roy22', 'date'=> new \Datetime(), 'content'=>'Nous cherchons un dev pour une mission'  ),
		  array('id'=>6, 'title'=>'Offre webdesigner', 'author'=>'Roy22', 'date'=> new \Datetime(), 'content'=>'Nous cherchons un webmaster'  )
	    );
	    
	    
	    return $this->render('ROYPlatformBundle:Advert:index.html.twig', array('listAdverts'=>$listAdverts));
    }
    
    
    public function viewAction($id)
    {
	    $advert = array('id'=>$id, 'title'=>'Recherche dev Symfony', 'author'=>'Roy22', 'date'=> new \Datetime(), 'content'=>'Nous cherchons un dev d\'ici !' );
	    
	    return $this->render('ROYPlatformBundle:Advert:view.html.twig', array('advert'=>$advert));
    }
    
    
    public function addAction(Request $request)
    {
	    // l'antispam ROY
	    //$antispam=$this->container->get('roy_platform.antispam');
	    //essai si moins de 50 chars c'est du spam
	    //$text='coucou coucou coucou coucou coucou coucou coucou coucou coucou coucou coucou coucou coucou coucou coucou coucou coucou coucou coucou';
	    //if($antispam->isSpam($text)){
		//    throw new \Exception('C\'est du spam');
	   // }
	    
	    


		//creation de l'entité
		$advert = new Advert();
		$advert->setTitle('Recherche Symfony');
		$advert->setAuthor('Roy22');
		$advert->setContent('Nous cherchons un dev à montpellier');
		$advert->setDate(new \Datetime());
		//le gestionnaire
		$entityManager=$this->getDoctrine()->getManager();
		//la percistance
		$entityManager->persist($advert);
		//la mise jour
		$entityManager->flush();
		
		//si requete = POST -> formulaire soumis
	    if($request->isMethod('POST')){
		    //gestion du formulaire
		    
		    //le flag
		    $request->getSession()->getFlashBag()->add('notice', 'Annonce enregistrée');
		    
		    //redirection
		    return $this->redirectToRoute('roy_platform_view', array('id'=>5));
	    }




        return $this->render('ROYPlatformBundle:Advert:add.html.twig');
    }
    
    
    public function editAction($id, Request $request)
    {
         //si requete = POST -> formulaire soumis
	    if($request->isMethod('POST')){
		    //gestion du formulaire
		    
		    //le flag
		    $request->getSession()->getFlashBag()->add('notice', 'Annonce modifiée');
		    
		    //redirection
		    return $this->redirectToRoute('roy_platform_view', array('id'=>5));
	    }
		
		$advert = array('id'=>$id, 'title'=>'Recherche dev Symfony', 'author'=>'Roy22', 'date'=> new \Datetime(), 'content'=>'Nous cherchons un dev d\'ici !' );
		
        return $this->render('ROYPlatformBundle:Advert:edit.html.twig', array('advert'=>$advert));
    }
    
    
    public function deleteAction($id)
    {
        return $this->render('ROYPlatformBundle:Advert:delete.html.twig', array('id'=>$id));
    }
    
    
    public function menuAction($limit)
    {
	    $listAdverts = array(
		  array('id'=>2, 'title'=>'Recherche dev Symfony'),
		  array('id'=>5, 'title'=>'Mission Web'),
		  array('id'=>6, 'title'=>'Offre webdesigner')
	    );
	    return $this->render('ROYPlatformBundle:Advert:menu.html.twig', array('listAdverts'=>$listAdverts));
    }
    
    
    public function viewSlugAction($year, $slug, $format)
    {
         return new Response("Slug : " . $slug . " - année : " . $year . " - format : " . $format);
    }
}