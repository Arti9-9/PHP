<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\File;
use App\Service\ImageUploader;
use App\Service\FileUploader;
use Symfony\Component\String\Slugger\SluggerInterface;

class BookController extends AbstractController
{
    #[Route('/', name: 'book_index', methods: ['GET'])]
    public function index(BookRepository $bookRepository): Response
    {
        return $this->render('book/index.html.twig', [
            'books' => $bookRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'book_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $book->setDate();
           
            $imageFile = $form->get('image')->getData();
            $imageTargetDirectory= $this->getParameter('kernel.project_dir') . '/public/uploads/img';
            $imageUploader = new ImageUploader($imageTargetDirectory, $slugger);
            if($imageFile) {
                $imageName=$imageUploader->upload($imageFile);
                $book->setImage($imageName);
            }
            $file = $form->get('file')->getData();
            $fileTargetDirectory= $this->getParameter('kernel.project_dir') . '/public/uploads/file';
            $fileUploader = new FileUploader($fileTargetDirectory, $slugger);
            if($file) {
                $fileName=$fileUploader->upload($file);
                $book->setFile($fileName);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirectToRoute('book_index');
        }

        return $this->render('book/new.html.twig', [
            'book' => $book,
            'bookForm' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'book_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Book $book,SluggerInterface $slugger): Response
    {
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image=$form->get('image')->getData();
            $imageTargetDirectory= $this->getParameter('kernel.project_dir') . '/public/uploads/img';
            $imageUploader = new ImageUploader($imageTargetDirectory, $slugger);

            $file=$form->get('file')->getData();
            $fileTargetDirectory= $this->getParameter('kernel.project_dir') . '/public/uploads/file';
            $fileUploader = new ImageUploader($imageTargetDirectory, $slugger);
            
            if ($book->getImage()) {
                $imageUploader->removeImage($book->getImage());
                $book->setImage("-");
            }

            if ($book->getFile()) {
                $fileUploader->removeFile($book->getfile());
                $book->setfile("-");
            }

            if ($image) {
                $imageNewFilename = $imageUploader->upload($image);
                $book->setImage($imageNewFilename);
            }

            if ($file) {
                $fileNewFilename = $fileUploader->upload($file);
                $book->setFile($fileNewFilename);
            }

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('book_index');
        }

        return $this->render('book/edit.html.twig', [
            'book' => $book,
            'bookForm' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'book_show', methods: ['GET'])]
    public function show(Book $book): Response
    {
        return $this->render('book/show.html.twig', [
            'book' => $book,
        ]);
    }
 

    #[Route('/{id}', name: 'book_delete', methods: ['POST'])]
    public function delete(Request $request, Book $book, SluggerInterface $slugger): Response
    {
        if ($this->isCsrfTokenValid('delete' . $book->getId(), $request->request->get('_token'))) {
            $imageTargetDirectory= $this->getParameter('kernel.project_dir') . '/public/uploads/img';
            $imageUploader = new ImageUploader($imageTargetDirectory, $slugger);

            $fileTargetDirectory= $this->getParameter('kernel.project_dir') . '/public/uploads/file';
            $fileUploader = new FileUploader($fileTargetDirectory, $slugger);

            $imageUploader->removeImage($book->getImage());
            $fileUploader->removeFile($book->getFile());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($book);
            $entityManager->flush();
        }

        return $this->redirectToRoute('book_index', [], Response::HTTP_SEE_OTHER);
    }
}
