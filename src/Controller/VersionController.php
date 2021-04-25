<?php

namespace App\Controller;

use App\Entity\Version;
use App\Form\VersionType;
use App\Repository\VersionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VersionController extends AbstractController
{
    /**
     * @Route("/", name="version_index")
     */
    public function index(VersionRepository $versionRepository): Response
    {
        $versions = $versionRepository->findAll([], ['registrationDate'=> 'DESC']);
        $versionsUniquesId = [];
        $versionsUniques = [];
        foreach ($versions as $version) {
            if (!in_array($version->getCompany()->getSiren(), $versionsUniquesId)) {
                $versionsUniques[] = $version;
                $versionsUniquesId[] = $version->getCompany()->getSiren();
            }
        }
        return $this->render('company/index.html.twig', ['versions' => $versionsUniques]);
    }

    /**
     * @Route("/{id<\d+>}", name="version_show")
     */
    public function show(Version $version): Response
    {
        return $this->render('company/show.html.twig', ['version' => $version]);
    }

     /**
     * @Route("/create", name="version_create")
     */
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $version = new Version();
        $form = $this->createForm(VersionType::class, $version);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $version = $form->getData();
            $em->persist($version);
            $em->flush();
            //dd($version);
            return $this->redirectToRoute('version_index');
        }

        return $this->render('company/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/edit/{id<\d+>}", name="version_edit")
     */
    public function edit(Request $request, Version $version, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(VersionType::class, $version);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $version = $form->getData();
            $em->flush();
            return $this->redirectToRoute('version_index');
        }

        return $this->render('company/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
