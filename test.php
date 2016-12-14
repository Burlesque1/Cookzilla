<form action="#" method="post" enctype="multipart/form-data">
<input type="file" name="fileToUpload" id="fileToUpload">
<input type="submit" value="Upload Image" name="submit">
</form>

<?php
    print_r($_FILES);
    $img=file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
    echo '<p>dfsdfs<img src="data:image/jpg;base64,'.base64_encode($img).'" width="100px"></p>';
   // echo "<p>dfsdfs<img src='11.jpg'></p>";
?>