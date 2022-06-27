<?php

namespace App\Controller\Task;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface; // Nous appelons le bundle KNP Paginator
class TaskListController extends AbstractController
{
    /**
     * @Route("/tasks", name="task_list")
     */
    public function taskList(Request $request, PaginatorInterface $paginator, TaskRepository $taskRepository): Response
    {
        $tasksAreDone = $request->query->get('are-done');

        $tasks = [];
        if ('' == $tasksAreDone) {
            $tasks = $taskRepository->findAll();
        }
        if ('false' === $tasksAreDone) {
            $tasks = $taskRepository->findBy(['isDone' => '0']);
        }
        if ('true' === $tasksAreDone) {
            $tasks = $taskRepository->findBy(['isDone' => '1']);
        }
        // findBy method which allows to retrieve data with filter and sort criteria
       $page_donnees = $this->getDoctrine()->getRepository(Task::class)->findBy([],['createdAt' => 'desc']);

      $tasks = $paginator->paginate(
           $page_donnees, // Request containing the data to be paginated (here our tasks)
           $request->query->getInt('page', 1), // Current page number, passed in the URL, 1 if no page
           6 // Nombre de résultats par page
       );

        return $this->render('task/list.html.twig', [
            'tasks' => $tasks,
        ]);
    }
}
