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
    public function addTovar($post){
      $params = [
        'id'      => null,
        'title'   => $post['title'],
        'summa'   => $post['summa'],
        'parent'  => 1,
        'text'    => $post['text'],
        'up_date' => date("Y-m-d H:i:s"),
        'date'    => date("Y-m-d H:i:s"),
      ];
      $this->db->query('INSERT INTO products VALUES(:id, :title, :summa, :parent, :text, :up_date, :date)', $params);
      return $this->db->lastInsertId();
    }
    public function upload_images($path, $id_user) {
        if(!isset($_SESSION['img_count'])) $_SESSION['img_count'] = 0;
        else $_SESSION['img_count']++;
        $name = "us_".$id_user."_".$_SESSION['img_count'];
        $_SESSION['info_images_upload'][$_SESSION['img_count']] = $name.'.jpg';
        $img = new Imagick($path);
        $draw = new ImagickDraw();
        //$img->cropThumbnailImage(720, 1080);
        $img->enhanceImage(); // Улучшает качество шумного изображения
        $img->setImageCompressionQuality(90);
        $img->adaptiveResizeImage(700, 700, true);
        $img->writeImage($_SERVER['DOCUMENT_ROOT'].'/files/tovar/'.$name.'.jpg');
        if ($_SESSION['img_count'] == 0){
          $img->adaptiveResizeImage(200, 200, true);
          $img->writeImage($_SERVER['DOCUMENT_ROOT'].'/files/tovar/'.$name.'.jpg');
        }

    }
} // End Class
