<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= base_url('bootstrap/bootstrap/dist/css/bootstrap.min.css');?>">
    <link rel="shortcut icon" type="image/png" href="/icon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- Sweet Alert -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">

    <style>
    .btn-color {
        background-color: #0e1c36;
        color: #fff;
    }

    .profile-image-pic {
        height: 200px;
        width: 200px;
        object-fit: cover;
    }

    .cardbody-color {
        background-color: #ebf2fa;
    }

    a {
        text-decoration: none;
    }

    .field-icon {
        float: right;
        margin-left: -25px;
        margin-right: 10px;
        margin-top: -25px;
        position: relative;
        z-index: 2;
    }
    </style>
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card my-5">

                    <!-- If Success Register -->
                    <?php if(session()->getFlashdata('success')): ?>
                    <style>
                    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

                    .swal2-popup .swal2-content {
                        font-family: 'Poppins', sans-serif;
                        font-size: 16px;
                    }
                    </style>
                    <script>
                    Swal.fire({
                        title: 'Success!',
                        text: '<?php echo session()->getFlashdata('success');?>',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    })
                    </script>
                    <?php endif; ?>

                    <!-- Checking Error -->
                    <?php if(session()->getFlashdata('error')): ?>
                    <style>
                    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

                    .swal2-popup .swal2-content {
                        font-family: 'Poppins', sans-serif;
                        font-size: 16px;
                    }
                    </style>
                    <script>
                    Swal.fire({
                        title: 'ERROR!',
                        text: '<?php echo session()->getFlashdata('error');?>',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    })
                    </script>
                    <?php endif; ?>

                    <form class="card-body cardbody-color p-lg-5" method="post" action="/auth/login">
                        <?= csrf_field() ?>

                        <div class="text-center">
                            <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png"
                                class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px"
                                alt="profile">
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" aria-describedby="emailHelp"
                                placeholder="Username or Email" id="username" name="username" required
                                value="<?= set_value('username') ?>">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" placeholder="Password" id="password" required
                                name="password">
                            <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <div class="text-center"><button type="submit"
                                class="btn btn-color px-5 mb-5 w-100">Login</button></div>
                        <div id="emailHelp" class="form-text text-center mb-5 text-dark">Not
                            Registered? <a href="/register" class="text-dark fw-bold"> Create an
                                Account.</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="<?= base_url('bootstrap/bootstrap/dist/js/bootstrap.bundle.min.js'); ?>"></script>
    <script>
    $(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
    </script>
</body>

</html>