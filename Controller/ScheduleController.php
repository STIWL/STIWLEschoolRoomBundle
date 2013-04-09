<?php

namespace Esolving\Eschool\RoomBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Esolving\Eschool\RoomBundle\Entity\Schedule;
use Esolving\Eschool\RoomBundle\Form\Type\ScheduleType;

/**
 * Schedule controller.
 *
 */
class ScheduleController extends Controller {

    /**
     * Lists all Schedule entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $serviceCore = $this->get('esolving_eschool_core');
        $section_id = $serviceCore->getSectionId();
        $headquarter_id = $serviceCore->getHeadquarterId();
        $entities = $em->getRepository('EsolvingEschoolRoomBundle:Schedule')->findAlldBySectionIdByHeadquarterIdByLanguage($section_id, $headquarter_id, $this->getRequest()->getLocale());

        return $this->render('EsolvingEschoolRoomBundle:Schedule:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a Schedule entity.
     *
     */
    public function showAction($roomId, $teacherId) {
        $em = $this->getDoctrine()->getManager();
        $serviceCore = $this->get('esolving_eschool_core');
        $sectionId = $serviceCore->getSectionId();
        $headquarterId = $serviceCore->getHeadquarterId();
        $entity = $em->getRepository('EsolvingEschoolRoomBundle:Schedule')->findOneBySectionIdByHeadquarterIdByRoomIdByTeacherIdByLanguage($sectionId, $headquarterId, $roomId, $teacherId, $this->getRequest()->getLocale());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Schedule entity.');
        }

        $deleteForm = $this->createDeleteForm($roomId, $teacherId);

        return $this->render('EsolvingEschoolRoomBundle:Schedule:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to create a new Schedule entity.
     *
     */
    public function newAction() {
        $entity = new Schedule();
        $form = $this->createForm(new ScheduleType(), $entity);

        return $this->render('EsolvingEschoolRoomBundle:Schedule:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new Schedule entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Schedule();
        $form = $this->createForm(new ScheduleType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('esolving_eschool_roomB_Schedule_show', array(
                                'roomId' => $entity->getRoom()->getId(),
                                'teacherId' => $entity->getTeacher()->getId()
            )));
        }

        return $this->render('EsolvingEschoolRoomBundle:Schedule:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Schedule entity.
     *
     */
    public function editAction($roomId, $teacherId) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EsolvingEschoolRoomBundle:Schedule')->findOneBy(array('room' => $roomId, 'teacher' => $teacherId));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Schedule entity.');
        }

        $editForm = $this->createForm(new ScheduleType(), $entity);
        $deleteForm = $this->createDeleteForm($roomId, $teacherId);

        return $this->render('EsolvingEschoolRoomBundle:Schedule:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Schedule entity.
     *
     */
    public function updateAction(Request $request, $roomId, $teacherId) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EsolvingEschoolRoomBundle:Schedule')->findOneBy(array('room' => $roomId, 'teacher' => $teacherId));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Schedule entity.');
        }

        $deleteForm = $this->createDeleteForm($roomId, $teacherId);
        $editForm = $this->createForm(new ScheduleType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('esolving_eschool_roomB_Schedule_edit', array('roomId' => $roomId, 'teacherId' => $teacherId)));
        }

        return $this->render('EsolvingEschoolRoomBundle:Schedule:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Schedule entity.
     *
     */
    public function deleteAction(Request $request, $roomId, $teacherId) {
        $em = $this->getDoctrine()->getManager();

        $serviceCore = $this->get('esolving_eschool_core');
        $sectionId = $serviceCore->getSectionId();
        $headquarterId = $serviceCore->getHeadquarterId();
        $entity = $em->getRepository('EsolvingEschoolRoomBundle:Schedule')->findOneBySectionIdByHeadquarterIdByRoomIdByTeacherIdByLanguage($sectionId, $headquarterId, $roomId, $teacherId, $this->getRequest()->getLocale());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Schedule entity.');
        }

        $form = $this->createDeleteForm($roomId, $teacherId);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $em->remove($entity);
                $em->flush();
                return $this->redirect($this->generateUrl('esolving_eschool_roomB_Schedule'));
            }
        }
        return $this->render('EsolvingEschoolRoomBundle:Schedule:delete.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView()
        ));
    }

    private function createDeleteForm($roomId, $teacherId) {
        return $this->createFormBuilder(array('roomId' => $roomId, 'teacherId', $teacherId))
                        ->add('roomId', 'hidden')
                        ->add('teacherId', 'hidden')
                        ->getForm()
        ;
    }

}
