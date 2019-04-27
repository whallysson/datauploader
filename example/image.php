<form name="form_env" method="post" enctype="multipart/form-data">
    <?php
    require __DIR__ . "/../src/DataUploader.php";
    require __DIR__ . "/../src/Image.php";

    $image = new CodeBlog\DataUploader\Image("uploads", "images");

    if ($_FILES) {
        try {
            $upload = $image->upload($_FILES['image'], $_POST['name'], 400);
            echo "<img src='{$upload}' width='100%'>";
        } catch (Exception $e) {
            echo "<p>(!) {$e->getMessage()}</p>";
        }
    }
    ?>
    <input type="text" name="name" placeholder="Image Name" required/><br>
    <input type="file" name="image" required/><br><br>
    <button>Send Image</button>
</form>


