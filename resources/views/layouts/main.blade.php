<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - TypStr</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body data-bs-theme="{{ session('theme') ?? 'dark' }}">
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">TypStr</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/settings">Settings</a>
                    </li>
                </ul>
                <div>
                    <ul class="navbar-nav">
                        @if (!session('user_id'))
                        <li class="nav-item me-2">
                            <a href="#" type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#signupModal" class="btn btn-outline-success">Signup</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="#" class="btn btn-outline-success">Logout</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    @if (session('alert_type'))
    <div class="alert alert-{{ session('alert_type') }} alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="modal fade" id="signupModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Signup</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="needs-validation" novalidate method="post" action="{{ url('/register') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <label for="username">Username:</label>
                            </div>
                            <div class="col-10">
                                <input type="text" id="username" name="username" class="form-control" required />
                                <div class="invalid-feedback">Please enter a valid Username.</div>
                            </div>
                        </div>
                        <div class="row align-items-center mt-3">
                            <div class="col-2">
                                <label for="email">Email:</label>
                            </div>
                            <div class="col-10">
                                <input type="email" id="email" name="email" class="form-control" required />
                                <div class="invalid-feedback">Please enter a valid Email.</div>
                            </div>
                            <p class="form-text">We share your email everywhere and steal your data too &gt;: &rpar;</p>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-2">
                                <label for="password">Password:</label>
                            </div>
                            <div class="col-10">
                                <input type="password" id="password" name="password" class="form-control" required />
                                <div class="invalid-feedback">Please enter a valid Password.</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Signup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Login</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="needs-validation" novalidate action="{{ url('/login') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <label for="login-email" class="form-label">Email:</label>
                            </div>
                            <div class="col-10">
                                <input type="email" id="login-email" class="form-control" name="loginEmail" required />
                                <div class="invalid-feedback">Please Enter a valid Email.</div>
                            </div>
                        </div>
                        <div class="row mt-3 align-items-center">
                            <div class="col-2">
                                <label for="login-password" class="form-label">Password:</label>
                            </div>
                            <div class="col-10">
                                <input type="password" id="login-password" class="form-control" name="loginPassword" required />
                                <div class="invalid-feedback">Please enter a valid Password.</div>
                            </div>
                        </div>
                        <p class="form-text mt-3">We steal your information with this one &gt;: &rpar;</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="container">
        @yield('content')
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script type="module" src="{{ asset('js/index.js') }}"></script>

</html>