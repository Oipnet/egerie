<?php
/**
 * Created by PhpStorm.
 * User: arnaud
 * Date: 09/01/18
 * Time: 10:59
 */

namespace App\Service;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{

    /**
     * @var string
     */
    private $targetDir;

    public function __construct(string $targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file)
    {
        $filname = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->getTargetDir(), $filname);

        return $filname;
    }

    /**
     * @return string
     */
    public function getTargetDir(): string
    {
        return $this->targetDir;
    }

}