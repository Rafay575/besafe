<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Scripts -->
    <link href="<?php echo e(asset('assets/css/custom.css')); ?>?v=<?php echo e(time()); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('build/assets/app.css')); ?>">
   
</head>

<body>
    <div class="main-wrapper">
        <div class="wrapper min-vh-100 flex-1">
            <img src="./assets/img/logos/Flexi_FF-02.png" alt="Flexi Logo" class="position-absolute custom-logo-size">

            <div class="d-flex align-items-center justify-content-center flex-1" style=" width: 100%">
                <div class="row " style="width: 100%; ">
                    <div class="col-lg-7 col-xl-8 d-none d-lg-flex flex-column justify-content-between text-white">
                        <div class="mt-auto">
                            <div class="text-center">
                                <a href="#" class="text-decoration-none text-white">Privacy Policy</a> |
                                <a href="#" class="text-decoration-none text-white">FAQs</a> |
                                <a href="#" class="text-decoration-none text-white">Terms of Use</a>
                            </div>
                            <p class="text-center">© Flexi IT Services Pvt. Ltd. All rights reserved.</p>
                        </div>
                    </div>

                    <div
                        class="col-lg-5 col-xl-4 right-side col-md-10 mx-auto d-flex flex-column justify-content-center align-items-center ">
                        <div class="form-content bg-light "
                            style="width: 100%; padding: 30px; border-radius: 50px;z-index:10">


                            <?php echo e($slot); ?>

                        </div>
                        <div class="w-full  mt-4">
                            <img src="./assets/img/logos/Hrpsp_FF-02.png" alt="Flexi Logo" width="150"
                                style="margin-left:auto">
                        </div>

                    </div>
                </div>
            </div>
            <div class="footer-2 text-center text-white w-full mb-4">
                <div>

                    <a href="#" class="text-decoration-none text-white">Privacy Policy</a> |
                    <a href="#" class="text-decoration-none text-white">FAQs</a> |
                    <a href="#" class="text-decoration-none text-white">Terms of Use</a>
                </div>
                <p>© Flexi IT Services Pvt. Ltd. All rights reserved.</p>
            </div>

            <!-- Bubble Animation -->
            <ul class="bg-bubbles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo e(asset('build/assets/app.js')); ?>"></script>
</body>

</html><?php /**PATH C:\wamp64\www\flexi\flexi\resources\views/layouts/guest.blade.php ENDPATH**/ ?>