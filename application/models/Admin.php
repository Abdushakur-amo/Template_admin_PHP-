<?php

namespace application\models;

use application\core\Model;
use Imagick;
use ImagickDraw;
use ImagickPixel;
class Admin extends Model {

    public function UploadAvatar($path, $id) {
        $img = new Imagick($path);
        $draw = new ImagickDraw();
        //$img->cropThumbnailImage(720, 1080);
        $img->enhanceImage(); // Улучшает качество шумного изображения
        $img->setImageCompressionQuality(80);
        // $img->writeImage($_SERVER['DOCUMENT_ROOT'].'/files/users/original/a_avatar-'.$id.'.jpg');
        $img->adaptiveResizeImage(100, 100, true);
        $img->writeImage($_SERVER['DOCUMENT_ROOT'].'/files/users/a_avatar-'.$id.'.jpg');
      }

    public function DeletMessageChat($id) {
  		$this->db->query("DELETE FROM `chat` WHERE id = $id");
  		return true;
  	}
}
