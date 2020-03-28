<?php

namespace CodeBlog\DataUploader;

/**
 * Class CodeBlog DataUploader
 *
 * @author Whallysson Avelino <https://github.com/whallysson>
 * @package CodeBlog\DataUploader
 */
abstract class DataUploader
{

    /** @var string */
    protected $path;

    /** @var resource */
    protected $file;

    /** @var string */
    protected $name;

    /** @var string */
    protected $ext;

    /** @var array */
    protected static $allowJPG = [];

    /** @var array */
    protected static $allowPNG = [];

    /** @var array */
    protected static $allowGIF = [];

    /** @var array */
    protected static $allowTypes = [];

    /** @var array */
    protected static $extensions = [];

    /**
     * @param string $uploadDir
     * @param string $fileTypeDir
     * @example $uploade = new DataUploader("storage/uploads", "images");
     */
    public function __construct(string $uploadDir, string $fileTypeDir)
    {
        $this->dir($uploadDir);
        $this->dir("{$uploadDir}/{$fileTypeDir}");
        $this->path("{$uploadDir}/{$fileTypeDir}");
    }

    /**
     * @return array
     */
    public static function isAllowed()
    {
        return array_merge(static::$allowJPG, static::$allowPNG, static::$allowGIF, static::$allowTypes);
    }

    /**
     * @return array
     */
    public static function isExtension(): array
    {
        return static::$extensions;
    }

    /**
     * @param string $name
     * @return string
     */
    protected function name(string $name)
    {
        $name = filter_var(mb_strtolower($name), FILTER_SANITIZE_STRIPPED);
        $formats = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª¹²³';
        $replace = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                    ';
        $name = str_replace(["-----", "----", "---", "--"], "-",
            str_replace(" ", "-", trim(strtr(utf8_decode($name), utf8_decode($formats), $replace))));

        $this->name = "{$name}." . $this->ext;

        if (file_exists("{$this->path}/{$this->name}") && is_file("{$this->path}/{$this->name}")) {
            $this->name = "{$name}-" . time() . ".{$this->ext}";
        }
        return $this->name;
    }

    /**
     * @param string $dir
     * @param int $mode
     */
    protected function dir(string $dir, int $mode = 0755)
    {
        if (!file_exists($dir) || !is_dir($dir)) {
            mkdir($dir, $mode);
        }
    }

    /**
     * @param string $path
     */
    protected function path(string $path)
    {
        list($yearPath, $mothPath) = explode("/", date("Y/m"));

        $this->dir("{$path}/{$yearPath}");
        $this->dir("{$path}/{$yearPath}/{$mothPath}");
        $this->path = "{$path}/{$yearPath}/{$mothPath}";
    }

}
