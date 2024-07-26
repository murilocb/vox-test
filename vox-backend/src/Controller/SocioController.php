<?php

namespace App\Controller;

use App\Entity\Socio;
use App\Form\SocioType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class SocioController extends AbstractController
{
    /**
     * @Route("/socios", name="socio_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $em): Response
    {
        $socios = $em->getRepository(Socio::class)->findAll();

        return $this->json($socios);
    }

    /**
     * @Route("/socios/{id}", name="socio_show", methods={"GET"})
     */
    public function show(Socio $socio): Response
    {
        return $this->json($socio);
    }

    /**
     * @Route("/socios", name="socio_create", methods={"POST"})
     */
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $socio = new Socio();
        $form = $this->createForm(SocioType::class, $socio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($socio);
            $em->flush();

            return $this->json($socio, Response::HTTP_CREATED);
        }

        return $this->json(['error' => 'Invalid data'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/socios/{id}", name="socio_update", methods={"PUT"})
     */
    public function update(Request $request, Socio $socio, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(SocioType::class, $socio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->json($socio);
        }

        return $this->json(['error' => 'Invalid data'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/socios/{id}", name="socio_delete", methods={"DELETE"})
     */
    public function delete(Socio $socio, EntityManagerInterface $em): Response
    {
        $em->remove($socio);
        $em->flush();

        return $this->json(['status' => 'Sócio deleted'], Response::HTTP_NO_CONTENT);
    }
}

