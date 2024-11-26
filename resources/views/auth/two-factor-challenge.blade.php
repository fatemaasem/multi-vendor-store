<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two-Factor Authentication</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Two-Factor Authentication</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-center mb-4">
                            Please enter the code provided by your authentication app or use one of your recovery codes.
                        </p>

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

                        <!-- Form to Enter Authentication Code -->
                        <form method="POST" action="{{ url('/two-factor-challenge') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="code" class="form-label">Authentication Code</label>
                                <input id="code" type="text" class="form-control" name="code" required autofocus>
                            </div>

                            <div class="text-center my-3">Or</div>

                            <!-- Form to Enter Recovery Code -->
                            <div class="mb-3">
                                <label for="recovery_code" class="form-label">Recovery Code</label>
                                <input id="recovery_code" type="text" class="form-control" name="recovery_code">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Verify</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
