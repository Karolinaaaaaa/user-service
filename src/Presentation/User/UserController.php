<?php

namespace App\Presentation\User;

use App\Domain\Model\User;
use App\Domain\Model\Attachment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/form', name: 'user_form', methods: ['GET'])]
    public function showForm(): Response
    {
        return $this->render('user/form.html.twig');
    }

    #[Route('/submit', name: 'user_submit', methods: ['POST'])]
    public function submitForm(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $name = $request->request->get('name');
        $surname = $request->request->get('surname');
        $file = $request->files->get('file');

        // Validation
        $errors = [];
        if (!$name) {
            $errors[] = 'Name is required.';
        }
        if (!$surname) {
            $errors[] = 'Surname is required.';
        }
        if ($file && $file->getSize() > 2 * 1024 * 1024) {
            $errors[] = 'File size cannot exceed 2MB.';
        }
        if ($file && !in_array($file->getMimeType(), ['image/jpeg', 'image/png'])) {
            $errors[] = 'Only JPEG or PNG files are allowed.';
        }

        if (!empty($errors)) {
            return new JsonResponse(['status' => 'error', 'errors' => $errors], 400);
        }

        // Save User and Attachment
        $user = new User($name, $surname);
        if ($file) {
            $uploadDir = $this->getParameter('kernel.project_dir') . '/public/uploads';
            $fileName = uniqid() . '.' . $file->guessExtension();
            $file->move($uploadDir, $fileName);

            $attachment = new Attachment();
            $attachment->setFileName($fileName);
            $attachment->setFilePath('/uploads/' . $fileName);
            $user->addAttachment($attachment);
        }

        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse(['status' => 'success', 'message' => 'User saved successfully.']);
    }

    #[Route('/users', name: 'user_list', methods: ['GET'])]
    public function listUsers(EntityManagerInterface $entityManager): Response
    {
        $users = $entityManager->getRepository(User::class)->findAll();

        return $this->render('user/list.html.twig', [
            'users' => $users,
        ]);
    }
}
