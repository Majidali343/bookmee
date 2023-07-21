<!doctype html>
<?php
    $default_lang = get_default_language();
?>
<html lang="<?php echo e($default_lang); ?>" dir="<?php echo e(get_user_lang_direction()); ?>">
<?php
    $default_lang = get_default_language();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e(get_static_option('site_title').' '. __('Mail')); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        *{
            font-family: 'Open Sans', sans-serif;
        }
        .mail-container {
            max-width: 650px;
            margin: 0 auto;
            text-align: center;
            background-color: #f2f2f2;
            padding: 40px 0;
        }
        .inner-wrap {
            background-color: #fff;
            margin: 40px;
            padding: 30px 20px;
            text-align: left;
            box-shadow: 0 0 20px 0 rgba(0,0,0,0.01);
        }
        .inner-wrap p {
            font-size: 16px;
            line-height: 26px;
            color: #656565;
            margin: 0;
            margin-bottom: 20px;
        }
        .message-wrap {
            background-color: #f2f2f2;
            padding: 30px;
            margin-top: 40px;
        }

        .message-wrap p {
            font-size: 14px;
            line-height: 26px;
        }
        table {
            margin: 0 auto;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table td, table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table tr:nth-child(even){background-color: #f2f2f2;}

        table tr:hover {background-color: #ddd;}

        table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #111d5c;
            color: white;
        }
         .logo-wrapper img{
            max-width: 200px;
        }

        [dir="rtl"] .earning-wrapper {
            text-align: right !important;
        }
        [dir="rtl"] .earning-wrapper .earning-title {
            text-align: right !important;
        }
        [dir="rtl"] .wrap-para {
            text-align: right !important;
        }
        [dir="rtl"] .inner-wrap-contents p {
            text-align: right !important;
        }
        [dir="rtl"] .inner-wrap-contents .earning-order-title {
            text-align: right !important;
        }
        [dir="rtl"] .earning-title {
            text-align: right !important;
        }

    </style>
</head>
<body>

<div class="mail-container">
    <div class="logo-wrapper">
        <a href="<?php echo e(url('/')); ?>">
            <?php echo render_image_markup_by_attachment_id(get_static_option('site_logo')); ?>

        </a>
    </div>
    <div class="inner-wrap">
        <p class="wrap-para"><?php echo e(__('Hello,')); ?> <br><?php echo e(__('you have a new message from').' '. get_static_option('site_title')); ?>, <?php echo e(__('submitted from')); ?> <?php echo e($data['form_title']); ?></p>
        <table class="wrap-para">
            <?php $__currentLoopData = $data['data']['all_fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $name = str_replace(['-','_'],[' ',' '],$key);
                ?>
                <tr>
                    <td><?php echo e(__(ucwords($name))); ?></td>
                    <td><?php echo e(str_replace('_',' ',$field)); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
    </div>
    <footer>
        <?php echo get_footer_copyright_text(); ?>

    </footer>
</div>

</body>
</html>


<?php /**PATH /var/www/vhosts/dazzling-edison.217-174-244-122.plesk.page/httpdocs/@core/resources/views/mail/custom-form.blade.php ENDPATH**/ ?>