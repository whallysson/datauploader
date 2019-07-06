<form name="form_env" method="post" enctype="multipart/form-data">
    <?php
    require __DIR__ . "/../src/Uploader.php";
    require __DIR__ . "/../src/Media.php";

    $media = new CodeBlog\DataUploader\Media("uploads", "medias");

    if ($_FILES) {
        try {
            $upload = $media->upload($_FILES['file'], $_POST['name']);
            echo "<p><a href='{$upload}' target='_blank'>Link Media</a></p>";
        } catch (Exception $e) {
            echo "<p>(!) {$e->getMessage()}</p>";
        }
    }
    ?>
    <input type="text" name="name" placeholder="File Name" required/><br>
    <input type="file" name="file" required/><br><br>
    <button>Send Media</button>
</form>
