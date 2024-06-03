<?php

use MazadEgypt\Classes\Models\Cat;

require_once('../../app.php');
$c = new Cat;
if ($request->postHas('submit')) {
    $catName = $request->post("catName");
    $catArabicName = $request->post("catArabicName");
    $image = $_FILES['image'];




    if (empty($catName)) {
        $errors[] = "*Name Is Empty";
    } elseif (is_numeric($catName)) {
        $errors[] = "*Name Must Be A String";
    }

    if (empty($catArabicName)) {
        $errors[] = "*Arabic Name Is Empty";
    } elseif (is_numeric($catArabicName)) {
        $errors[] = "*Arabic Name Must Be A String";
    }

    $imageName = $image['name'];
    $imageType = $image['type'];
    $imageTempName = $image['tmp_name'];
    $imageError = $image['error'];
    $imageSize = $image['size'];
    $ext = pathinfo($imageName, PATHINFO_EXTENSION);

    $imageSizeMb = $imageSize / (1024 ** 2);
    if ($imageError != 0) {
        $errors[] = "*Choose An Image";
    } elseif (!in_array($ext, ['png', 'jpg', 'jpeg', 'gif'])) {
        $errors[] = "*Image Must Be ( jpg, png Or jpeg )";
    } elseif ($imageSizeMb >= 3) {
        $errors[] = "*Image Max Size 4 Mb";
    }



    if (empty($errors)) {
        // If Valid --> Rename Image Name
        $randomStr = uniqid();
        $imageNewName = "$randomStr.$ext";
        //--> Move To Distination
        move_uploaded_file($imageTempName, PATH . "assets/images/$imageName");

        $catName = trim(htmlspecialchars($catName));

        $c->insert("name, arabic_name, img", " '$catName', '$catArabicName', '$imageName' ");

        $request->aredirect("add-category.php");
        
    } else {
        $session->set("CatErrors", $errors);
        $request->aredirect("add-category.php");
    }
} else {
    $request->redirect("");
}
