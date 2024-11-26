
<x-layouts.layout-component title="home">
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Two Factor Authentication</h3>
                    </div>
                    <div class="card-body">
                        <!-- Display error messages -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Login Form -->
                        <form action="{{ url('user/two-factor-authentication') }}" method="POST">
                            @csrf
                            @if(!auth()->user()->two_factor_secret)
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Enable</button>
                            </div>
                            @else
                            <h3>QR Code for authenticator applications</h3>
                <div class="pt-5 pb-5">
                    {!!  auth()->user()->twoFactorQrCodeSvg() !!}
                </div>
                            @method('delete')
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Disable</button>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
</x-layouts.layout-component>