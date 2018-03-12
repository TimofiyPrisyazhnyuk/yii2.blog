<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

class ImageUpload extends Model
{
    public $image;

    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpeg,png']
        ];
    }

    public function uploadFile(UploadedFile $file, $currentImage)
    {

        $this->image = $file;

        if ($this->validate()) {

            $this->deleteCurrentImage($currentImage);

            return $this->saveImage();
        }
    }

    // Get Folder - uploads

    public function getFolder()
    {
        return Yii::getAlias('@web') . 'uploads/';

    }

    // Generate Name from imageName and encrypt

    public function generateFileName()
    {
        return strtolower(md5(uniqid($this->image->baseName)) . '.' . $this->image->extension);
    }

    // Delete CurrentImage from folder uploads

    public function deleteCurrentImage($currentImage)
    {
        if ($this->fileExist($currentImage)) {

            unlink($this->getFolder() . $currentImage);

        }
    }

    // Checking what exist this file

    public function fileExist($currentImage)
    {
        if (!empty($currentImage) && $currentImage != null) {

            return file_exists($this->getFolder() . $currentImage);

        }
    }

    // Save image to folder upload

    public function saveImage()
    {
        $filename = $this->generateFileName();

        $this->image->saveAs($this->getFolder() . $filename);

        return $filename;
    }
}