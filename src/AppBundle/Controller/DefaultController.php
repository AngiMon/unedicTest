<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Department;
use AppBundle\Entity\Student;
use AppBundle\Form\StudentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $students = $em->getRepository(Student::class)
            ->findAll();
        $departments = $em->getRepository(Department::class)
            ->findAll();
        return $this->render('@App/index.html.twig',
            array(
                'students' => $students,
                'departments' => $departments
            ));
    }

    /**
     * @Route("/add", name="add_student")
     */
    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $student = new Student();
        $departments = $em->getRepository(Department::class)->findAll();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $num = $student->getNumEtud();
            if(ctype_digit($num) == false)
            {
                $this->addFlash(
                    'notice',
                    'Le numéro étudiant est mal renseigné'
                );
                return $this->render('@App/form_student.html.twig',
                    array(
                        'form' => $form->createView(),
                        'word' => 'Ajouter'
                    ));
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }
        return $this->render('@App/form_student.html.twig',
            array(
                'form' => $form->createView(),
                'word' => 'Ajouter'
            ));
    }

    /**
     * @Route("/edit/{id}", name="edit_student")
     */
    public function editAction(Request $request, Student $student)
    {
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $num = $student->getNumEtud();
            if(ctype_digit($num) == false)
            {
                $this->addFlash(
                    'notice',
                    'Le numéro étudiant est mal renseigné'
                );
                return $this->render('@App/form_student.html.twig',
                    array(
                        'form' => $form->createView(),
                        'word' => 'Ajouter'
                    ));
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }
        return $this->render('@App/form_student.html.twig',
            array(
                'form' => $form->createView(),
                'word' => 'Modifer'
            ));
    }

    /**
     * @Route("/show/{id}", name="show_student")
     */
    public function showAction(Student $student)
    {
        return $this->render('@App/show.html.twig',
            array(
                'student' => $student
            ));
    }

    /**
     * @Route("/delete/{id}", name="delete_student")
     */
    public function deleteAction(Student $student)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($student);
        $em->flush();
        return $this->redirectToRoute('homepage');
    }

}
