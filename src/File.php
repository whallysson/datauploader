<?php

namespace CodeBlog\DataUploader;

/**
 * Class CodeBlog File
 *
 * @author Whallysson Avelino <https://github.com/whallysson>
 * @package CodeBlog\DataUploader
 */
class File extends DataUploader {

    /**
     * Allow zip, rar, bzip, pdf, doc, docx files
     * @var array allowed file types
     * https://www.freeformatter.com/mime-types-list.html
     */
    protected static $allowTypes = [
        "application/zip",
        'application/x-rar-compressed',
        'application/x-bzip',
        "application/pdf",
        "application/msword",
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
    ];

    /**
     * Allowed extensions to types.
     * @var array
     */
    protected static $extensions = [
        "zip",
        "rar",
        "bz",
        "pdf",
        "doc",
        "docx"
    ];

    /**
     * @param array $file
     * @param string $name
     * @return null|string
     * @throws \Exception
     */
    public function upload(array $file, string $name) {
        $this->ext = mb_strtolower(pathinfo($file['name'])['extension']);

        if (!in_array($file['type'], static::$allowTypes) || !in_array($this->ext, static::$extensions)) {
            throw new \Exception("Not a valid file type or extension");
        }

        $this->name($name);
        move_uploaded_file($file['tmp_name'], "{$this->path}/{$this->name}");
        return "{$this->path}/{$this->name}";
    }

}
