<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="text-center">Confirm Your Password</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-center mb-4">Please confirm your password before continuing.</p>
                        
                        <!-- Error Message Display -->
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Confirm Password Form -->
                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" autofocus>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    Confirm Password
                                </button>
                            </div>
                        </form>

                        <!-- Forgot Password Link -->
                        <div class="text-center mt-3">
                            <a href="{{ route('password.request') }}" class="text-muted">Forgot Your Password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
