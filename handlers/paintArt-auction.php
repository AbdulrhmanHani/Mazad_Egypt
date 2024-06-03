<?php
require_once("../app.php");

use MazadEgypt\Classes\Models\Cat;
use MazadEgypt\Classes\Models\Piding;
use MazadEgypt\Classes\Models\Product;
use MazadEgypt\Classes\Models\User;

$p = new Piding;
$pr = new Product;

if ($request->postHas("submit")) {
    // Category
    $catId = $request->get("catid");
    $c = new Cat;
    $cat = $c->selectId($catId);

    // User
    $n = $session->get("user");
    $us = new User;
    $user = $us->selectWhere("name = '$n'")[0];
    $userId = $user['id'];

    // Product Inputs
    // in DB product.name, product.desc, product.price, product.img

    // Image Handling
    $image = $_FILES["image"];
    // Image & Image Validation
    $imageName = $image['name'];
    $imageType = $image['type'];
    $imageTempName = $image['tmp_name'];
    $imageError = $image['error'];
    $imageSize = $image['size'];
    $ext = pathinfo($imageName, PATHINFO_EXTENSION);
    // Validatoin
    // 1- error = 0
    // 2- ext(png, jpg, jpeg)
    // 3- size <= 1MB
    $imageSizeMb = $imageSize / (1024 ** 2);
    if ($imageError != 0) {
        $errors[] = "Product Image Is Required";
    } elseif (!in_array($ext, ['png', 'jpg', 'jpeg', 'gif'])) {
        $errors[] = "*Image Must Be ( jpg, png Or jpeg )";
    } elseif ($imageSizeMb >= 3) {
        $errors[] = "*Image Max Size 4 Mb";
    }

    // Product Name Validation
    $productName = $request->post("productName");
    if (empty($productName)) {
        $errors[] = "Product Name Is Required";
    } elseif (strlen($productName) <= 10) {
        $errors[] = "Product Name Length Is Small";
    } else {
        $productName = trim(htmlspecialchars($productName));
    }

    // Product Description Validation
    $productDesc = $request->post("productDesc");

    if (empty($productDesc)) {
        $errors[] = "Product Descreption Is Required";
    } elseif (strlen($productDesc) >= 256) {
        $errors[] = "Product Description Length Is Too Large";
    } else {
        $productDesc = trim(htmlspecialchars($productDesc));
    }

    //Product Price Validation
    $productPrice = $request->post("productPrice");
    if (empty($productPrice)) {
        $errors[] = "Product Price Is Required";
    } elseif (!is_numeric($productPrice)) {
        $errors[] = "Product Price Must Be Numeric";
    } elseif (!is_numeric($productPrice)) {
        $errors[] = "Product Price Must Be Numeric";
    } else {
        $productPrice = trim(htmlspecialchars($productPrice));
    }

    // User Inputs
    // in DB piding.user_id, user.address, piding.phone, user.visa_card

    // Full Name Validation
    $fullName = $request->post("fullName");
    if (empty($fullName)) {
        $errors[] = "Name Is Required";
    } elseif (is_numeric($fullName) || !is_string($fullName)) {
        $errors[] = "Invaild User Name";
    } elseif ($user['name'] !== $fullName) {
        echo "User Success";
    } else {
        $fullName = trim(htmlspecialchars($fullName));
    }

    // Address Validation
    $address = $request->post("address");
    if (empty($address)) {
        $errors[] = "Address Is Required";
    } elseif (is_numeric($address)) {
        $errors[] = "Address Is Not Valid";
    } else {
        $address = trim(htmlspecialchars($address));
    }

    // Phone Number Validatio
    $phoneNumber = $request->post("phoneNumber");
    if (empty($phoneNumber)) {
        $errors[] = "Phone Number Is Required";
    } elseif (!is_numeric($phoneNumber)) {
        $errors[] = "Phone Number Is Not Vaild";
    } else {
        $phoneNumber = trim(htmlspecialchars($phoneNumber));
    }

    // Visa Card Validation
    $visaCard = $request->post("visaCard");
    if (empty($visaCard)) {
        $errors[] = "Visa Card Is Required";
    } elseif ($user['visa_card'] !== $visaCard) {
        $errors[] = "Visa Card That You Entered Does Not Match Your Visa Card";
    } else {
        $visaCard = trim(htmlspecialchars($visaCard));
    }

    if (empty($errors)) {
        // If Valid --> Rename Image Name
        $randomStr = uniqid();
        $imageNewName = "$randomStr.$ext";
        //--> Move To Distination
        move_uploaded_file($imageTempName, PATH . "uploads/$imageNewName");

        $pr->insert("name, `desc`, price, pieces_no, img, cat_id, product_owner", " '$productName', '$productDesc', '$productPrice', '1', '$imageNewName', '$catId', '$userId' ");

        // $p->insert("user_id, product_id, cat_id, highst_price", " '$userId', '', '', '' ");
        
        $us->update("is_pidding_owner", "'yes'", $user['id']);

        $request->redirect("paintArt.php?id=$catId");

        $session->set("aucationSuccess", "Your Aucation Added Successfully");
    } else {
        $session->set("aucationErrors", $errors);
        $request->redirect("paintArt.php?id=$catId");
    }
    // $request->redirect("otherPieces.php?id=$catId");
}
