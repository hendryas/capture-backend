<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Inaku Cafe Stock</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Premium Bootstrap v5.0.2 Landing Page Template" />
    <meta name="keywords" content="bootstrap v5.0.2, premium, marketing, multipurpose" />
    <meta content="Themesdesign" name="author" />

    <link rel="shortcut icon" href="<?= base_url('assets/img/logo/logo_inaku.png'); ?>" />
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="<?= base_url('assets/assets_three/css/bootstrap.min.css') ?>" type="text/css" />

    <!-- slider -->
    <link rel="stylesheet" href="<?= base_url('assets/assets_three/css/swiper-bundle.min.css') ?>" />

    <!-- Icon -->
    <link rel="stylesheet" href="<?= base_url('assets/assets_three/css/materialdesignicons.min.css') ?>" type="text/css" />

    <!-- css -->
    <link rel="stylesheet" href="<?= base_url('assets/assets_three/css/style.min.css') ?>" type="text/css" />
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-offset="71">
    <!-- Start Home -->
    <section class="section home" id="home">
        <div class="container">
            <div class="row align-items-center mt-5 mt-lg-0">
                <div class="col-lg-5">
                    <div class="home-heading">
                        <h6 class="text-uppercase text-muted"></h6>
                        <h1 class="lh-sm">
                            Inventory Management
                            <span class="text-success">Inaku Cafe Stock</span>
                        </h1>
                    </div>
                    <div class="home-btn d-grid d-sm-block gap-3">
                        <a class="btn btn-outline-success rounded-pill me-sm-3" href="<?= base_url('login'); ?>">Login
                            <span class="avatar-xs">
                                <span class="avatar-title rounded-circle btn-icon">
                                    <i class="mdi mdi-chevron-double-right"></i>
                                </span>
                            </span>
                        </a>
                        <!-- Modal -->
                        <div class="modal fade bd-example-modal-lg watchvideomodal" data-keyboard="false" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg">
                                <div class="modal-content home-modal">
                                    <div class="modal-header border-0">
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END MODAL -->
                    </div>
                </div>
                <!-- end col-->
                <div class="col-lg-7">
                    <div class="ms-md-4">
                        <img class="home-img" src="<?= base_url('assets/assets_three/images/img_management_inventory.jpg') ?>" alt="" width="800" />
                        <a hidden href="https://www.freepik.com/free-vector/conveyor-belt-warehouse-concept-illustration_37113966.htm#query=ilustration%20management%20inventory&position=0&from_view=search&track=ais">Image by storyset on Freepik</a>
                    </div>
                </div>
                <!-- end col-->
                <!-- End col-->
            </div>
            <!-- end row-->
        </div>
        <!--end container-->
        <!--end container-->
    </section>
    <!-- End Home -->

    <!--Custom js-->
    <script src="<?= base_url('assets/assets_three/js/counter.js') ?>"></script>

    <script src="<?= base_url('assets/assets_three/js/swiper-bundle.min.js') ?>"></script>

    <!--Bootstrap Js-->
    <script src="<?= base_url('assets/assets_three/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- contact -->
    <script src="<?= base_url('assets/assets_three/js/contact.js') ?>"></script>

    <!-- App Js -->
    <script src="<?= base_url('assets/assets_three/js/app.js') ?>"></script>
</body>

</html>