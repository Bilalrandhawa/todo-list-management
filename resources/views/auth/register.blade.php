<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register-Page</title>
    <!-- base:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="assets/images/logo-dark.svg" alt="logo">
                            </div>
                            <h4>New here?</h4>
                            <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                            <form class="pt-3" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <x-text-input id="name" placeholder="Name" class="form-control form-control-lg"
                                        type="text" name="name" :value="old('name')" required autofocus
                                        autocomplete="name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                                </div>
                                <div class="form-group">
                                    <x-text-input id="email" class="form-control form-control-lg" type="email"
                                        placeholder="Email" name="email" :value="old('email')" required
                                        autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                </div>

                                <div class="form-group">
                                    <x-text-input id="password" class="form-control form-control-lg" type="password"
                                        placeholder="Password" name="password" required autocomplete="new-password" />

                                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                </div>
                                <div class="form-group">
                                    <x-text-input id="password_confirmation" placeholder="Confirm Password"
                                        class="form-control form-control-lg" type="password"
                                        name="password_confirmation" required autocomplete="new-password" />

                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                                </div>

                                <div class="mt-3">
                                    <x-primary-button
                                        class="btn btn-block btn-info btn-lg font-weight-medium auth-form-btn">
                                        {{ __('Register') }}
                                    </x-primary-button>

                                </div>
                                <div class="text-center mt-4 font-weight-light">

                                    Already have an account? <a href="{{ route('login') }}"
                                        class="text-primary">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    <script src="assets/vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/template.js"></script>
    <!-- endinject -->
</body>

</html>
