<?php

namespace Test\ZombieBundle\Controller;

use Test\ZombieBundle\Entity\Task;
use Test\ZombieBundle\Entity\Tag;
use Test\ZombieBundle\Form\Type\TaskType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TaskController extends Controller
{
    public function newAction(Request $request)
    {
        $task = new Task();

        // dummy code - this is here just so that the Task has some tags
        // otherwise, this isn't an interesting example
        $tag1 = new Tag();
        $tag1->name = 'tag1';
        $task->getTags()->add($tag1);
        $tag2 = new Tag();
        $tag2->name = 'tag2';
        $task->getTags()->add($tag2);
        // end dummy code

        $form = $this->createForm(new TaskType(), $task);

        // process the form on POST
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                // maybe do some form processing, like saving the Task and Tag objects
            }
        }

        return $this->render('TestZombieBundle:Task:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository('AcmeTaskBundle:Task')->find($id);

        if (!$task) {
            throw $this->createNotFoundException('No task found for is '.$id);
        }

        $originalTags = array();

        // Create an array of the current Tag objects in the database
        foreach ($task->getTags() as $tag) $originalTags[] = $tag;

        $editForm = $this->createForm(new TaskType(), $task);

        if ($request->isMethod('POST')) {
            $editForm->bind($this->getRequest());

            if ($editForm->isValid()) {

                // filter $originalTags to contain tags no longer present
                foreach ($task->getTags() as $tag) {
                    foreach ($originalTags as $key => $toDel) {
                        if ($toDel->getId() === $tag->getId()) {
                            unset($originalTags[$key]);
                        }
                    }
                }

                // remove the relationship between the tag and the Task
                foreach ($originalTags as $tag) {
                    // remove the Task from the Tag
                    $tag->getTasks()->removeElement($task);

                    // if it were a ManyToOne relationship, remove the relationship like this
                    // $tag->setTask(null);

                    $em->persist($tag);

                    // if you wanted to delete the Tag entirely, you can also do that
                    // $em->remove($tag);
                }

                $em->persist($task);
                $em->flush();

                // redirect back to some edit page
                return $this->redirect($this->generateUrl('task_edit', array('id' => $id)));
            }
        }

        // render some form template
    }
}