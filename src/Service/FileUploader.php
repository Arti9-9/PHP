<?php

namespace App\Service;

use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    private $targetDirectory;
    private $slugger;

    public function __construct($targetDirectory, SluggerInterface $slugger)
    {
        $this->targetDirectory = $targetDirectory;
        $this->slugger = $slugger;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectory(), $fileName);
        } catch (FileException $e) {
            echo $e;
        }

        return $fileName;
    }
    public function removeFile($ImgName){
        $System=new Filesystem();
        $file=$this->getTargetDirectory().'/'.$ImgName;
        try {
            $System->remove($file);
        }catch (Exception $e){
            echo $e;
        }
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
     
    
}