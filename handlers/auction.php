<?php
require_once("../app.php");

use MazadEgypt\Classes\Models\Cat;
use MazadEgypt\Classes\Models\Product;
use MazadEgypt\Classes\Models\User;

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
        $errors[] = "صورة القطعة مطلوبة";
    } elseif (!in_array($ext, ['png', 'jpg', 'jpeg', 'gif'])) {
        $errors[] = "*إمتداد الصورة يجب أن يكون من إحدي الخيارات ( jpg, png Or jpeg )";
    } elseif ($imageSizeMb >= 5) {
        $errors[] = "*أكبر حجم للصورة 4 ميجا بايت";
    }

    // Product Name Validation
    $productName = $request->post("productName");
    if (empty($productName)) {
        $errors[] = "اسم القطعة مطلوب";
    } elseif (strlen($productName) <= 3) {
        $errors[] = "اسم القطعة صغير للغاية";
    } else {
        $productName = trim(htmlspecialchars($productName));
    }

    // Product Description Validation
    $productDesc = $request->post("productDesc");

    if (empty($productDesc)) {
        $errors[] = "وصف القطعة مطلوب";
    } elseif (strlen($productDesc) >= 255) {
        $errors[] = "وصف القطعة كبير للغاية";
    } else {
        $productDesc = trim(htmlspecialchars($productDesc));
    }

    //Product Price Validation
    $productPrice = $request->post("productPrice");
    if (empty($productPrice)) {
        $errors[] = "سعر القطعة مطلوب";
    } elseif (!is_numeric($productPrice)) {
        $errors[] = "سعر القطعة يجب أن يكون رقم";
    } elseif (!is_numeric($productPrice)) {
        $errors[] = "سعر القطعة يجب أن يكون رقم";
    } else {
        $productPrice = trim(htmlspecialchars($productPrice));
    }

    // User Inputs
    // in DB piding.user_id, user.address, piding.phone, user.visa_card

    // Full Name Validation
    $fullName = $request->post("fullName");
    if (empty($fullName)) {
        $errors[] = "الاسم مطلوب";
    } elseif (is_numeric($fullName) || !is_string($fullName)) {
        $errors[] = "اسم المستخدم خطأ";
    } elseif ($user['name'] !== $fullName) {
        $errors[] = "الاسم الذي ادخلته غير مطابق لاسم المستخدم";
    } else {
        $fullName = trim(htmlspecialchars($fullName));
    }

    // Address Validation
    $address = $request->post("address");
    if (empty($address)) {
        $errors[] = "العنوان مطلوب";
    } elseif (is_numeric($address)) {
        $errors[] = "العنوان الذي أدخلته غير صالح";
    } else {
        $address = trim(htmlspecialchars($address));
    }

    // Phone Number Validatio
    $phoneNumber = $request->post("phoneNumber");
    if (empty($phoneNumber)) {
        $errors[] = "رقم الهاتف مطلوب";
    } elseif (!is_numeric($phoneNumber)) {
        $errors[] = "رقم الهاتف الذي أدخلته غير صحيح";
    } else {
        $phoneNumber = trim(htmlspecialchars($phoneNumber));
    }

    // Visa Card Validation
    $visaCard = $request->post("visaCard");
    if (empty($visaCard)) {
        $errors[] = "رقم بطاقة الإئتمان مطلوب";
    } elseif ($user['visa_card'] !== $visaCard) {
        $errors[] = "رقم بطاقة الإئتمان لا يطابق رقم بطاقة إئتمانك";
    } else {
        $visaCard = trim(htmlspecialchars($visaCard));
    }


    // End Auction At Validation
    // m - d - y

    $endAt = $request->post("endAt");
    if (empty($endAt)) {
        $errors[] = "تاريخ انتهاء المزاد مطلوب";
    } else {
        $endAt = $request->post("endAt");
    }

    if (empty($errors)) {
        // If Valid --> Rename Image Name
        $randomStr = uniqid();
        $imageNewName = "$randomStr.$ext";
        //--> Move To Distination
        move_uploaded_file($imageTempName, PATH . "uploads/$imageNewName");

        $pr->insert("name, `desc`, price, pieces_no, img, cat_id, product_owner, user_finish_at", " '$productName', '$productDesc', '$productPrice', '1', '$imageNewName', '$catId', '$userId', '$endAt' ");

        $session->set("aucationSuccess", "تم إضافة المزاد بنجاح");

        $request->redirect("");
    } else {
        $session->set("aucationErrors", $errors);
        $request->redirect("");
    }
    $request->redirect("");
}
