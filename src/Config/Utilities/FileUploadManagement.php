<?php

namespace App\Config\Utilities;

class FileUploadManagement
{
  public const TARGET_DIR = "./assets/images/";
  public const FILE_MAX_SIZE_ALLOWED = 500000;
  public const FILE_FORMATS_JPG_ALLOWED = "jpg";
  public const FILE_FORMATS_JPEG_ALLOWED = "jpeg";
  public const FILE_FORMATS_PNG_ALLOWED = "png";
  public const FILE_FORMATS_GIF_ALLOWED = "gif";
  public const FILE_FORMATS_WEBP_ALLOWED = "webp";
  private $postMessageStatus = [];
  private $uploadOk = -1;
  public function checkFileStatus(string $target_file, string $imageFileType)
  {
    // if (file_exists($target_file)) {
    //   $this->postMessageStatus["post"] = "Sorry, file already exists.";
    //   $this->postMessageStatus["status"] =  "message-error";
    //   $this->uploadOk = 0;
    //   $errorStatus = true;
    // }

    if ($_FILES["fileToUpload"]["size"] > self::FILE_MAX_SIZE_ALLOWED) {
      $this->postMessageStatus["status"] =  "message-error";
      $this->postMessageStatus["post"] = "Sorry, your file is too large.";
      $errorStatus = true;
      $this->uploadOk = 0;
    }

    if (
      $imageFileType !== self::FILE_FORMATS_JPG_ALLOWED &&
      $imageFileType !== self::FILE_FORMATS_JPEG_ALLOWED &&
      $imageFileType !== self::FILE_FORMATS_PNG_ALLOWED &&
      $imageFileType !== self::FILE_FORMATS_WEBP_ALLOWED &&
      $imageFileType !== self::FILE_FORMATS_GIF_ALLOWED
    ) {
      $this->postMessageStatus["post"] = "Sorry, only JPG, JPEG, WEBP, PNG & GIF files are allowed.";
      $this->postMessageStatus["status"] =  "message-error";

      $this->uploadOk = 0;
    }
    if ($this->uploadOk === 0) {
      return $this->postMessageStatus;
    } else {
    }
  }
  public function getStatusOfFileWasUploadSuccessfully($target_file)
  {
    $interruptorIfFileWasUploaded = false;
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $interruptorIfFileWasUploaded = true;
    }
    return $interruptorIfFileWasUploaded;
  }

  public function isUploadedFile()
  {
  }

  /**
   * Get the value of uploadOk
   */
  public function getUploadOk()
  {
    return $this->uploadOk;
  }
}
