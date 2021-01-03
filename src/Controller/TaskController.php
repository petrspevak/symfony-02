<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    private TaskRepository $taskRepository;

    public function __construct(EntityManagerInterface $entityManager, TaskRepository $taskRepository)
    {
        $this->entityManager = $entityManager;
        $this->taskRepository = $taskRepository;
    }

    /**
     * @Route("/", name="task")
     * @Route("/{id}", name="task_id")
     */
    public function index(?Task $task, Request $request): Response
    {
        $task ??= new Task(new \DateTime('today +2 days'), '');
        $allTasks = $this->taskRepository->findBy([], ['dueDate' => 'ASC']);

        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $this->entityManager->persist($task);
            $this->entityManager->flush();

            return $this->redirectToRoute('task');
        }

        return $this->render('task/index.html.twig', [
            'form' => $form->createView(),
            'tasks' => $allTasks,
        ]);
    }

    /**
     * @Route("/{id}/delete", name="task_delete")
     */
    public function delete(Task $task): Response
    {
        $this->entityManager->remove($task);
        $this->entityManager->flush();

        return $this->redirectToRoute('task');
    }
}
