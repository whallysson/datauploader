<?php

namespace CodeBlog\DataUploader;

/**
 * Class CodeBlog Image
 *
 * @author Whallysson Avelino <https://github.com/whallysson>
 * @package CodeBlog\DataUploader
 */
class Image extends DataUploader {

    /** @var array */
    protected static $quality = ["jpg" => 75, "png" => 5];

    /** @var array */
    protected static $allowJPG = [
        "image/jpg",
        "image/jpeg",
        "image/pjpeg"
    ];

    /** @var array */
    protected static $allowPNG = [
        "image/png",
        "image/x-png"
    ];

    /** @var array */
    protected static $allowGIF = [
        "image/gif"
    ];

    /**
     * @param array $image
     * @param string $name
     * @param int $width
     * @param array|null $quality
     * @return string
     * @throws \Exception
     */
    public function upload(array $image, string $name, int $width = 2000, ?array $quality = null) {
        if (empty($image['type'])) {
            throw new \Exception("Not a valid data from image");
        }

        if (!$this->create($image)) {
            throw new \Exception("Not a valid image type or extension");
        } else {
            $this->name($name);
        }

        if ($this->ext == "gif") {
            move_uploaded_file("{$image['tmp_name']}", "{$this->path}/{$this->name}");
            return "{$this->path}/{$this->name}";
        }

        $this->generate($width, ($quality ? $quality : static::$quality));
        return "{$this->path}/{$this->name}";
    }

    /**
     * Image create and valid extension from mime-type
     * https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types#Image_types
     *
     * @param array $image
     * @return bool
     */
    protected function create(array $image) {
        if (in_array($image['type'], static::$allowJPG)) {
            $this->file = imagecreatefromjpeg($image['tmp_name']);
            $this->ext = "jpg";
            $this->angle($image);
            return true;
        }

        if (in_array($image['type'], static::$allowPNG)) {
            $this->file = imagecreatefrompng($image['tmp_name']);
            $this->ext = "png";
            $this->angle($image);
            return true;
        }

        if (in_array($image['type'], static::$allowGIF)) {
            $this->ext = "gif";
            return true;
        }

        return false;
    }

    /**
     * @param int $width
     * @param array $quality
     */
    private function generate(int $width, array $quality) {
        $fileX = imagesx($this->file);
        $fileY = imagesy($this->file);
        $imageW = ($width < $fileX ? $width : $fileX);
        $imageH = ($imageW * $fileY) / $fileX;
        $imageCreate = imagecreatetruecolor($imageW, $imageH);

        if ($this->ext == "jpg") {
            imagecopyresampled($imageCreate, $this->file, 0, 0, 0, 0, $imageW, $imageH, $fileX, $fileY);
            imagejpeg($imageCreate, "{$this->path}/{$this->name}", $quality['jpg']);
        }

        if ($this->ext == "png") {
            imagealphablending($imageCreate, false);
            imagesavealpha($imageCreate, true);
            imagecopyresampled($imageCreate, $this->file, 0, 0, 0, 0, $imageW, $imageH, $fileX, $fileY);
            imagepng($imageCreate, "{$this->path}/{$this->name}", $quality['png']);
        }

        imagedestroy($this->file);
        imagedestroy($imageCreate);
    }

    /**
     * Check image (JPG, PNG) angle and rotate from exif data.
     * @param $image
     */
    private function angle($image) {
        $exif = @exif_read_data($image["tmp_name"]);
        $orientation = (!empty($exif["Orientation"]) ? $exif["Orientation"] : null);

        switch ($orientation) {
            case 8:
                $this->file = imagerotate($this->file, 90, 0);
                break;
            case 3:
                $this->file = imagerotate($this->file, 180, 0);
                break;
            case 6:
                $this->file = imagerotate($this->file, -90, 0);
                break;
        }

        return;
    }

}
