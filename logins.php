<?php require_once('./config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<?php require_once ('inc/header.php') ?>

<body class="hold-transition ">
    <script>
    start_loader()
    </script>
    <style>
    html,
    body {
        height: calc(100%) !important;
        width: calc(100%) !important;
    }

    body {
        background-image: url("<?php echo validate_image($_settings->info('cover')) ?>");
        background-size: cover;
        background-repeat: no-repeat;
    }

    .login-title {
        text-shadow: 2px 2px black
    }

    #login {
        flex-direction: column !important
    }

    #logo-img {
        height: 150px;
        width: 150px;
        object-fit: scale-down;
        object-position: center center;
        border-radius: 100%;
    }

    #login .col-7,
    #login .col-5 {
        width: 100% !important;
        max-width: unset !important
    }

    .card-primary.card-outline {
        border-top: 3px solid #c42020;
    }

    a:hover {
        color: #c42020;
        text-decoration: none;
    }

    a {
        color: #be4040;
        text-decoration: none;
        background-color: transparent;
    }

    .btn-primary {
        color: #fff;
        background-color: #c94f4f;
        border-color: #b04444;
        box-shadow: none;
    }

    .btn-primary:hover {
        color: #fff;
        background-color: #da5252;
        border-color: #e6657d;
    }
    </style>
    <?php if ($_settings->chk_flashdata('success')): ?>
    <script>
    alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
    <?php endif; ?>
    <div class="h-70 d-flex align-items-center w-100" id="login">
        <div class="h-70 d-flex py-5 align-items-center w-100" id="login">
            <div class="col-7 h-100 d-flex align-items-center justify-content-center">
                <div class="w-100">
                    <center><img src="<?= validate_image($_settings->info('logo')) ?>" alt="" id="logo-img"></center>
                    <h1 class="text-center py-3 login-title"><b><?php echo $_settings->info('name') ?> </b></h1>
                </div>
            </div>
            <div class="col-5 h-100 bg-gradient">
                <div class="d-flex w-100 h-100 justify-content-center align-items-center">
                    <div class="card col-sm-12 col-md-6 col-lg-3 card-outline card-primary">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <a href="<?php echo base_url ?>"><i class="fas fa-home"></i></a>
                            <h4><b>Login</b></h4>
                        </div>
                        <div class="card-body">
                            <form id="slogin-form" action="" method="post">
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" id="email" autofocus name="email"
                                        placeholder="Email">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <select class="form-control" name="user_type">
                                        <option value="student">Student</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user-cog"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        <a href="register.php" class="ml-2">Create Account</a>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-4">
                                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url ?>plugins/select2/js/select2.full.min.js"></script>

    <script>
    $(document).ready(function() {
        $('select[name="user_type"]').change(function() {
            var userType = $(this).val();
            var form = $('#slogin-form, #login-frm');
            var input = $('input[name="email"], input[name="username"]');
            var inputValue = $('input[name="email"], input[name="username"]').val();

            if (userType === 'admin') {
                form.attr('id', 'login-frm');
                form.attr('action', '');
                form.attr('method', 'post');
                input.attr('name', 'username');
                input.attr('type', 'text');
                input.attr('placeholder', 'Username');
            } else if (userType === 'student') {
                form.attr('id', 'slogin-form');
                form.attr('action', '');
                form.attr('method', '');
                input.attr('name', 'email');
                input.attr('type', 'email');
                input.attr('placeholder', 'Email');
            }

            console.log('------------------------------');
            console.log('Form Type: ' + userType);
            console.log('Form id: ' + form.attr('id'));
            console.log('Form action: ' + form.attr('action'));
            console.log('Form method: ' + form.attr('method'));
            console.log('Username input name: ' + input.attr('name'));
            console.log('Username input type: ' + input.attr('type'));
            console.log('Username: ' + inputValue)
        });

        end_loader();
        // Registration Form Submit == Student
        $('#slogin-form, #login-frm').submit(function(e) {
            var userType = $('select[name="user_type"]').val();
            if (userType === 'student') {
                e.preventDefault();
                var _this = $(this);
                $(".pop-msg").remove();
                $('#password, #cpassword').removeClass("is-invalid");
                var el = $("<div>");
                el.addClass("alert pop-msg my-2");
                el.hide();
                start_loader();
                $.ajax({
                    url: _base_url_ + "classes/Login.php?f=student_login",
                    method: 'POST',
                    data: _this.serialize(),
                    dataType: 'json',
                    error: err => {
                        console.log(err);
                        el.text("An error occurred while saving the data");
                        el.addClass("alert-danger");
                        _this.prepend(el);
                        el.show('slow');
                        end_loader();
                    },
                    success: function(resp) {
                        if (resp.status == 'success') {
                            location.href = "./";
                        } else if (!!resp.msg) {
                            el.text(resp.msg);
                            el.addClass("alert-danger");
                            _this.prepend(el);
                            el.show('show');
                        } else {
                            el.text("An error occurred while saving the data");
                            el.addClass("alert-danger");
                            _this.prepend(el);
                            el.show('show');
                        }
                        end_loader();
                        $('html, body').animate({
                            scrollTop: 0
                        }, 'fast')
                    },
                });
            }
        });
    });
    </script>
</body>

</html>