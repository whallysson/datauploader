<form name="form_env" method="post" enctype="multipart/form-data">
    <?php
    require __DIR__ . "/../src/Uploader.php";
    require __DIR__ . "/../src/File.php";

    $file = new CodeBlog\DataUploader\File("uploads", "files");

    if ($_FILES) {
        try {
            $upload = $file->upload($_FILES['file'], $_POST['name']);
            echo "<p><a href='{$upload}' target='_blank'>Link File</a></p>";
        } catch (Exception $e) {
            echo "<p>(!) {$e->getMessage()}</p>";
        }
    }
    ?>
    <input type="text" name="name" placeholder="File Name" required/><br>
    <input type="file" name="file" required/><br><br>
    <button>Send File</button>
</form>
