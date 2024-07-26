<?php

namespace App\Controller;

use App\Entity\Empresa;
use App\Form\EmpresaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class EmpresaController extends AbstractController
{
    /**
     * @Route("/empresas", name="empresa_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $em): Response
    {
        $empresas = $em->getRepository(Empresa::class)->findAll();

        return $this->json($empresas);
    }

    /**
     * @Route("/empresas/{id}", name="empresa_show", methods={"GET"})
     */
    public function show(Empresa $empresa): Response
    {
        return $this->json($empresa);
    }

    /**
     * @Route("/empresas", name="empresa_create", methods={"POST"})
     */
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $empresa = new Empresa();
        $form = $this->createForm(EmpresaType::class, $empresa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($empresa);
            $em->flush();

            return $this->json($empresa, Response::HTTP_CREATED);
        }

        return $this->json(['error' => 'Invalid data'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/empresas/{id}", name="empresa_update", methods={"PUT"})
     */
    public function update(Request $request, Empresa $empresa, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(EmpresaType::class, $empresa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->json($empresa);
        }

        return $this->json(['error' => 'Invalid data'], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/empresas/{id}", name="empresa_delete", methods={"DELETE"})
     */
    public function delete(Empresa $empresa, EntityManagerInterface $em): Response
    {
        $em->remove($empresa);
        $em->flush();

        return $this->json(['status' => 'Empresa deleted'], Response::HTTP_NO_CONTENT);
    }
}

