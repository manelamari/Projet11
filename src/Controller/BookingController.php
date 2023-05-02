<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Booking;

use App\Form\BookingType;
use App\Repository\BookingRepository;
use App\Repository\UserRepository;
use App\Repository\VoitureRepository;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/booking")
 */
class BookingController extends AbstractController
{
    /**
     * @Route("/", name="app_booking_index", methods={"GET"})
     *
     */
    public function index(BookingRepository $bookingRepository): Response
    {
        $user=null;
        $user=$this->getUser();
    //  dd($user);
      $id=$user->getId();
      //dd($id);
        $bookings= $bookingRepository->findbookinguser($id);
        //dd($bookings);
        return $this->render('booking/index2.html.twig', [
            'bookings' => $bookingRepository->findbookinguser($id),
            'user'=>$user,
        ]);

    }

  /*  /**
     * @Route ("/add/{id}",name=add)
     *
     */
/*public function add($id,SessionInterface $session){
    dd($session);
}
*/


    /**
     * @Route("/new/{id}", name="app_booking_new", methods={"GET", "POST"})
     *  @param $id
     * @param Request $request
     * @param BookingRepository $bookingRepository
     * @param SearchData $searchData
     * @param UserRepository $userRepository
     * @param $session
     * @return Response
     */
    public function new($id,Request $request, BookingRepository $bookingRepository,SearchData $searchData,UserRepository $userRepository,VoitureRepository $voitureRepository): Response
    {

        $voiture=$voitureRepository->find($id);

        //dd($voiture);
        $user=$this->getUser();
       // dd($user);
        //$nom=$user->getNom();
        //dd($nom);
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);

        $booking->setUser($user);
        $session=$request->getSession();
        //dd($session->get('dateDebut'));
        $D=$session->get('dateDebut');
        $F=$session->get('dateFin');
        $days= $F->diff($D)->format("%a") + 1;
        //  dd($days);
        $booking->setDateDebut($session->get('dateDebut'));
        $booking->setDateFin($session->get('dateFin'));
        $prix=$days*$voiture->getPrix()/100;
        //dd($prix);
        $booking->setVoiture($voiture);
        $booking->setPrixtotale($prix);

$im=$voiture->getImage();
        $us=$user->getUserId();
      //  dd($us);
        $idv=$voiture->getId();
        //dd($idv);
        $booking->setImagevoiture($im);
        $booking->setIduser($us);
        $booking->setIdvoiture($idv);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $bookingRepository->add($booking, true);

            return $this->redirectToRoute('app_booking_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('booking/new.html.twig', [
            'booking' => $booking,
            'session'=>$session,
            'voiture'=>$voiture,
            'user'=>$user,
            'days'=>$days,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{id}", name="app_booking_show", methods={"GET"})
     */
    public function show(Booking $booking): Response
    {
        $voiture=$booking->getVoiture();
        //dd($voiture);
        $id=$voiture->getId();
        //dd($id);
        return $this->render('booking/show.html.twig', [
            'booking' => $booking,
            'voiture'=>$voiture,
        ]);
    }
/*
    /**
     * @Route("/{id}/edit", name="app_booking_edit", methods={"GET", "POST"})
     */
  /*  public function edit(Request $request, Booking $booking, BookingRepository $bookingRepository): Response
    {
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bookingRepository->add($booking, true);

            return $this->redirectToRoute('app_booking_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('booking/edit.html.twig', [
            'booking' => $booking,
            'form' => $form,
        ]);
    }
*/
    /**
     * @Route("/{id}", name="app_booking_delete", methods={"POST"})
     */
    public function delete(Request $request, Booking $booking, BookingRepository $bookingRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$booking->getId(), $request->request->get('_token'))) {
            $bookingRepository->remove($booking, true);
        }

        return $this->redirectToRoute('app_booking_index', [], Response::HTTP_SEE_OTHER);
    }



}
