<?php

/**
 * Description of StudentController
 *
 * @author Luis Alberto Sánchez Saldaña <luis22989@hotmail.com>
 */

namespace Esolving\Eschool\RoomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Esolving\Eschool\RoomBundle\Entity\StudentInscribe;

class StudentController extends Controller {

    public function editInscribeAction($studentInscribeId) {
        $studentInscribe = $this->getDoctrine()->getRepository('EsolvingEschoolRoomBundle:StudentInscribe')->find($studentInscribeId);
        if (!$studentInscribe) {
            throw $this->createNotFoundException('Not student inscribe found');
        }
        $formStudentInscribe = $this->get('esolving_eschool_user.form.type.student_inscribe');
        $formStudentInscribe->setOptions(array('studentId' => $studentInscribe->getStudent()->getId()));
        $form = $this->createForm($formStudentInscribe, $studentInscribe);
        $request = $this->getRequest();
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($studentInscribe);
                $em->flush();
                $this->get('session')->setFlash(
                        'notice', $this->get('translator')->trans('updated', array(), 'EsolvingEschoolRoomBundle')
                );
                return $this->redirect($this->generateUrl('esolving_eschool_userB_Student_edit_inscribe', array('studentInscribeId' => $studentInscribeId)));
            }
        }
        return $this->render('EsolvingEschoolRoomBundle:Student:editInscribe.html.twig', array(
                    'form' => $form->createView(),
                    'studentInscribeId' => $studentInscribeId
        ));
    }

    public function deleteInscribeAction(Request $request, $studentInscribeId) {
        $em = $this->getDoctrine()->getManager();
        $studentInscribe = $this->getDoctrine()->getRepository('EsolvingEschoolRoomBundle:StudentInscribe')->findOneByStudentInscribeIdByLanguage($studentInscribeId, $this->getRequest()->getLocale());
        if (!$studentInscribe) {
            throw $this->createNotFoundException('Not student inscribe found');
        }
        $formDeleteStudentInscribe = $this->createDeleteFormInscribe($studentInscribeId);

        if ($request->isMethod('POST')) {
            $formDeleteStudentInscribe->bind($request);
            if ($formDeleteStudentInscribe->isValid()) {
//                 do delete                
            }
        }
        return $this->render('EsolvingEschoolRoomBundle:Student:deleteInscribe.html.twig', array(
                    'studentInscribe' => $studentInscribe,
                    'formDeleteStudentInscribe' => $formDeleteStudentInscribe->createView()
        ));
    }

    private function createDeleteFormInscribe($studentInscribeId) {
        return $this->createFormBuilder(array('studentInscribeId' => $studentInscribeId))
                        ->add('studentInscribeId', 'hidden')
                        ->getForm();
    }

    public function showInscribeAction($studentInscribeId) {
        $studentInscribe = $this->getDoctrine()->getRepository('EsolvingEschoolRoomBundle:StudentInscribe')->findOneByStudentInscribeIdByLanguage($studentInscribeId, $this->getRequest()->getLocale());
        if (!$studentInscribe) {
            throw $this->createNotFoundException('Not student inscribe found');
        }
        return $this->render('EsolvingEschoolRoomBundle:Student:showInscribe.html.twig', array(
                    'studentInscribe' => $studentInscribe
        ));
    }

    public function inscribeAction() {
        $studentInscribe = new StudentInscribe();
        $form = $this->createForm($this->get('esolving_eschool_user.form.type.student_inscribe'), $studentInscribe);
        $request = $this->getRequest();
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($studentInscribe);
                $em->flush();
                return $this->redirect($this->generateUrl('esolving_eschool_userB_Student_show_inscribe', array('studentInscribeId' => $studentInscribe->getId())));
            }
        }
        return $this->render('EsolvingEschoolRoomBundle:Student:inscribe.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function listInscribeAction() {
        $formStudentFilters = $this->get('esolving_eschool_user.form.type.student_inscribe_filter');
        $form = $this->createForm($formStudentFilters);
        $serviceCore = $this->get('esolving_eschool_core');
        $criteria = array();
//        if ($this->getRequest()->isXmlHttpRequest()) {
//            $formStudentFilters->setOptions(array('year' => true));
//            $form = $this->createForm($formStudentFilters);
//            if ($this->getRequest()->get($form->getName())) {
//                $form->bind($this->getRequest());
//                if ($form->isValid()) {
//                    //do something
//                }
//            }
//            return $this->render('EsolvingEschoolRoomBundle:Student:form.inc.html.twig', array(
//                        'form' => $form->createView()
////                        'print' => $print
//            ));
//        }
        if ($this->getRequest()->query->get('search')) {
            $form->bind($this->getRequest());
            if ($form->isValid()) {
                $criteria['dateStart'] = $form->get('dateStart')->getData();
                $criteria['dateEnd'] = $form->get('dateEnd')->getData();
            }
        }

        $inscribes = $this->getDoctrine()->getRepository('EsolvingEschoolRoomBundle:StudentInscribe')->findAllBySectionIdByHeadquarterIdByLanguageByCriteria($serviceCore->getSectionId(), $serviceCore->getHeadquarterId(), $this->getRequest()->getLocale(), $criteria);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($inscribes, $this->get('request')->query->get('page', 1)/* page number */, 3/* limit per page */);
        $inscribesCompactPagination = compact('pagination');

        return $this->render('EsolvingEschoolRoomBundle:Student:listInscribe.html.twig', array(
                    'inscribes' => $inscribesCompactPagination,
                    'form' => $form->createView()
        ));
    }

}

?>
