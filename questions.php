<?php require_once("app.php"); ?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome Library -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php URL; ?>assets/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css">
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="<?= URL; ?>assets/css/questions.css">
    <!-- Render All Elements Normally -->
    <link rel="stylesheet" href="<?= URL; ?>assets/css/normalize.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500&display=swap" rel="stylesheet">
    <title> الصفحة الرئيسية | مزاد ايجيبت</title>
    <link rel="icon" type="image" href="<?= URL; ?>assets/images/illustration-law-concept_53876-5911.jpg">
</head>

<body>

    <!-- Start Navbar -->
    <nav>
        <div class="container">
            <a href="<?= URL; ?>"><img src="<?= URL; ?>assets/images/LOGO.png" alt=""></a>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Start Questions -->
    <section class="questions">
        <div class="container">
            <h2 class="special-heading">الأسئلة الشائعة</h2>
            <div class="content-text">
                <div class="content">
                    <img src="<?= URL; ?>assets/images/logo-questions.jpg" alt="">
                    <div class="text">
                        <h5>ما هو المزاد الإلكتروني؟</h5>
                        <p>منصة المزاد الإلكتروني هي أحد الحلول الذكية من تطوير وتشغيل شركة مزاد ايجيبت والتي تمكن المهتمين بالمزادات من المشاركة في
                            المزادات إلكترونياً دون الحاجة للحضور لمقر المزاد وإتمام كافة التعاملات المالية بشكل آمن وإلكتروني وبما يتوافق
                            مع قوانين
                            إقامة المزادات والبيع والشراء في مصر .</p>
                    </div>
                </div>
                <div class="content">
                    <img src="<?= URL; ?>assets/images/logo-questions.jpg" alt="">
                    <div class="text">
                        <h5>ما هي مزايا المزاد الإلكتروني؟</h5>
                        <ul>
                            <li>سهولة المشاركة في المزادات في أي وقت ومن أي مكان</li>
                            <li>شفافية عالية، من خلال عرض جميع المزادات إلكترونياً وإتاحة الفرصة للجميع.</li>
                            <li>توفير الوقت والجهد على المشاركين لحضور المزاد.</li>
                            <li>توفير وسائل دفع إلكترونية بشكل آمن.</li>
                        </ul>
                    </div>
                </div>
                <div class="content">
                    <img src="<?= URL; ?>assets/images/logo-questions.jpg" alt="">
                    <div class="text">
                        <h5>هل يوجد تكاليف اشتراك لعملية تسجيل الدخول؟</h5>
                        <p> لا يوجد تكاليف اشتراك لعملية تسجيل الدخول.</p>
                    </div>
                </div>
                <div class="content">
                    <img src="<?= URL; ?>assets/images/logo-questions.jpg" alt="">
                    <div class="text">
                        <h5>ما العمل إذا واجهت العميل مشكلة تقنية في تسجيل الدخول؟</h5>
                        <p>يمكنك الاتصال بالدعم الفني و الخدمة متاحة 24 ساعة فقط اتصل علي الرقم الذي في الاسفل او ارسال رسالة الي الواتساب</p>
                        <div class="contact">
                            <p><i class="fas fa-phone"></i> 01553106683</p>
                            <a href="https://wa.me/201553106683" target="_blanck" class="whatsapp-icon"><img src="<?= URL; ?>assets/images/lOol7j-zq4u.svg" alt="تواصل معنا" title="تواصل معنا"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Questions -->
</body>

</html>