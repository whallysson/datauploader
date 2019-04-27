# DataUploader @Codeblog 

[![Maintainer](http://img.shields.io/badge/maintainer-@whallysson-blue.svg?style=flat-square)](https://twitter.com/whallysson)
[![Source Code](http://img.shields.io/badge/source-codeblog/datauploader-blue.svg?style=flat-square)](https://github.com/whallysson/datauploader)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/codeblog/datauploader.svg?style=flat-square)](https://packagist.org/packages/codeblog/datauploader)
[![Latest Version](https://img.shields.io/github/release/whallysson/datauploader.svg?style=flat-square)](https://github.com/whallysson/datauploader/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build](https://img.shields.io/scrutinizer/build/g/whallysson/datauploader.svg?style=flat-square)](https://scrutinizer-ci.com/g/whallysson/datauploader)
[![Quality Score](https://img.shields.io/scrutinizer/g/whallysson/datauploader.svg?style=flat-square)](https://scrutinizer-ci.com/g/whallysson/datauploader)
[![Total Downloads](https://img.shields.io/packagist/dt/codeblog/datauploader.svg?style=flat-square)](https://packagist.org/packages/codeblog/datauploader)

###### DataUploader handles the sending of images, files and media received by a form. Uploader handles, validates, and submits files.

DataUploader trata o envio de imagens, arquivos e midias recebidos por um formulário. O Uploader trata, valida e envia os arquivos.


### Highlights

- File simple upload (Simples envio de arquivos)
- Media simple upload (Simples envio de midias)
- Image simple upload (Simples envio de imagems)
- Composer ready and PSR-2 compliant (Pronto para o composer e compatível com PSR-2)
- Validation of images, files and media by mime-types (Valida de imagens, arquivos e mídias por mime-types)

## Installation

DataUploader is available via Composer:

```bash
"codeblog/datauploader": "^1.0"
```

or run

```bash
composer require codeblog/datauploader
```

## Documentation

###### For details on how to use, see a sample folder in the component directory. In it you will have an example of use for each class. It works like this:

Para mais detalhes sobre como usar, veja uma pasta de exemplo no diretório do componente. Nela terá um exemplo de uso para cada classe. Ele funciona assim:

#### Upload an Image

```php
<?php
require __DIR__ . "/../vendor/autoload.php";

$image = new CodeBlog\DataUploader\Image("uploads", "images");

if ($_FILES) {
    try {
        $upload = $image->upload($_FILES['image'], $_POST['name'], 400);
        echo "<img src='{$upload}' />";
    } catch (Exception $e) {
        echo "<p>(!) {$e->getMessage()}</p>";
    }
}
```

#### Upload an File

```php
<?php
require __DIR__ . "/../vendor/autoload.php";

$file = new CodeBlog\DataUploader\File("uploads", "files");

if ($_FILES) {
    try {
        $upload = $file->upload($_FILES['file'], $_POST['name']);
        echo "<p><a href='{$upload}' target='_blank'>Link File</a></p>";
    } catch (Exception $e) {
        echo "<p>(!) {$e->getMessage()}</p>";
    }
}
```

#### Upload an Media

```php
<?php
require __DIR__ . "/../vendor/autoload.php";

$media = new CodeBlog\DataUploader\Media("uploads", "medias");

if ($_FILES) {
    try {
        $upload = $media->upload($_FILES['file'], $_POST['name']);
        echo "<p><a href='{$upload}' target='_blank'>Link Media</a></p>";
    } catch (Exception $e) {
        echo "<p>(!) {$e->getMessage()}</p>";
    }
}
```

## Contributing

Please see [CONTRIBUTING](https://github.com/whallysson/datauploader/blob/master/CONTRIBUTING.md) for details.

## Support

###### Security: If you discover any security related issues, please email whallyssonallain@gmail.com instead of using the issue tracker.

Se você descobrir algum problema relacionado à segurança, envie um e-mail para whallyssonallain@gmail.com em vez de usar o rastreador de problemas.

Thank you

## Credits

- [Whallysson Avelino](https://github.com/whallysson) (Developer)
- [CodBlog](https://github.com/whallysson) (Team)
- [All Contributors](https://github.com/whallysson/datauploader/contributors) (This Rock)

## License

The MIT License (MIT). Please see [License File](https://github.com/whallysson/datauploader/blob/master/LICENSE) for more information.
