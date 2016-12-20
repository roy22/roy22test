<?php

namespace ROY\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use ROY\PlatformBundle\Entity\Advert;
use ROY\PlatformBundle\Entity\Image;
use ROY\PlatformBundle\Entity\Application;

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
	    //$advert = array('id'=>$id, 'title'=>'Recherche dev Symfony', 'author'=>'Roy22', 'date'=> new \Datetime(), 'content'=>'Nous cherchons un dev d\'ici !' );
	    
	    $entityManager = $this->getDoctrine()->getManager();
	    
	    
	    //l'annonce
	    $advert= $entityManager->getRepository('ROYPlatformBundle:Advert')->find($id);
	    if(null===$advert){
		    throw new NotFoundHttpException("L'annonce " . $id . " n'existe pas");
	    }
	    //les candidatures
	    //$listApplications= $entityManager->getRepository('ROYPlatformBundle:Application')->findBy(array('advert'=>$advert));
	    $listApplications= $entityManager->getRepository('ROYPlatformBundle:Application')->findByAdvert($advert);
	    
	    
	    //view
	    return $this->render('ROYPlatformBundle:Advert:view.html.twig', array('advert'=>$advert,'listApplications'=>$listApplications));
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
		$advert->setTitle('Recherche dev WP');
		$advert->setAuthor('Roy22');
		$advert->setContent('Nous cherchons un dev >P à montpellier');
		$advert->setDate(new \Datetime());
		//image
		$image = new Image();
		$image->setUrl('http://arobamedia.com/wp-content/uploads/2016/04/logo.png');
		$image->setAlt('Arobamedia');
		$advert->setImage($image);
		//candidature 1
		$application1 = new Application();
		$application1->setAuthor('Roy22');
		$application1->setContent('Je suis fait pour ca');
		$application1->setDate(new \Datetime());
		$application1->setAdvert($advert);
		//candidature 2
		$application2 = new Application();
		$application2->setAuthor('Corvisier');
		$application2->setContent('Je suis le meilleur');
		$application2->setDate(new \Datetime());
		$application2->setAdvert($advert);
		
		//le gestionnaire
		$entityManager=$this->getDoctrine()->getManager();
		//la percistance
		$entityManager->persist($advert);
		$entityManager->persist($application1);
		$entityManager->persist($application2);
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
    
    public function editImageAction($id){
	    //le gestionnaire
		$entityManager=$this->getDoctrine()->getManager();
		//l'annonce
		$advert=$entityManager->getRepository('ROYPlatformBundle:Advert')->find($id);
		//modification de l'url
		$advert->getImage()->setUrl('http://lxpro.fr/wp-content/themes/lxpro/img/LX_PRO.png');
		//enregistrement
		$entityManager->flush();
		
		return new Response('OK');
    }
}