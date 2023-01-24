<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Equipment;
use App\Form\EquipmentType;

class EquipmentController extends AbstractApiController
{
    public function indexAction(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();

        $search = $request->get('search');

        if (empty($search) || $search === 1) {
            $statement = $connection->query('SELECT * from equipment');
            $equipments = $statement->fetchAll();

            /*$equipments = $this->getDoctrine()
                ->getRepository(Equipment::class)
                ->findAll();*/
        } else {
            $statement = $connection->executeQuery(
                "SELECT * from equipment where (name like '%" .
                    $search .
                    "%' ||  category like '%" .
                    $search .
                    "%' || number like '%" .
                    $search .
                    "%' || description like '%" .
                    $search .
                    "%')"
            );

            $equipments = $statement->fetchAll();
        }

        return $this->json($equipments);
    }

    public function createAction(Request $request): Response
    {
        $form = $this->buildForm(EquipmentType::class);

        $form->handleRequest($request);

        //dump((string) $form->getErrors(true, false));die;
        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->respond($form, Response::HTTP_BAD_REQUEST);
        }

        $equipment = $form->getData();

        $this->getDoctrine()
            ->getManager()
            ->persist($equipment);
        $this->getDoctrine()
            ->getManager()
            ->flush();

        return $this->respond($equipment);
    }

    public function updateAction(Request $request): Response
    {
        $equipmentId = $request->get('equipmentId');

        $equipment = $this->getDoctrine()
            ->getRepository(Equipment::class)
            ->findOneBy(['id' => $equipmentId]);

        if (!$equipment) {
            throw new NotFoundHttpException('Equipment not found');
        }

        $form = $this->buildForm(EquipmentType::class, $equipment, [
            'method' => $request->getMethod(),
        ]);

        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->respond($form, Response::HTTP_BAD_REQUEST);
        }

        $equipment = $form->getData();

        $this->getDoctrine()
            ->getManager()
            ->persist($equipment);

        $this->getDoctrine()
            ->getManager()
            ->flush();

        return $this->respond($equipment);
    }

    public function deleteAction(Request $request): Response
    {
        $equipmentId = $request->get('equipmentId');

        $equipment = $this->getDoctrine()
            ->getRepository(Equipment::class)
            ->findOneBy(['id' => $equipmentId]);

        if (!$equipment) {
            throw new NotFoundHttpException('Equipment not found');
        }

        $this->getDoctrine()
            ->getManager()
            ->remove($equipment);

        $this->getDoctrine()
            ->getManager()
            ->flush();

        return $this->respond(null);
    }
}
