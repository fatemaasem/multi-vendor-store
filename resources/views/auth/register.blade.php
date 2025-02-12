<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="form-container">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="form-label">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="form-input" />
            @error('name')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required class="form-input" />
            @error('email')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password" required class="form-input" />
            @error('password')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required class="form-input" />
        </div>

        <!-- Store Name -->
        <div>
            <label for="store" class="form-label">Store Name</label>
            <input id="store" type="text" name="store" value="{{ old('store') }}" required class="form-input" />
            @error('store')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" required class="form-textarea">{{ old('description') }}</textarea>
            @error('description')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <!-- Logo -->
        <div>
            <label for="logo" class="form-label">Logo</label>
            <input id="logo" type="file" name="logo" class="form-input" />
            @error('logo')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="form-actions">
            <button type="submit" class="btn-primary">Register</button>
        </div>
    </form>
</x-guest-layout>

<style>
    .form-container {
        max-width: 500px;
        margin: auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background: #f9f9f9;
    }
    .form-label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }
    .form-input, .form-textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .form-textarea {
        height: 100px;
        resize: none;
    }
    .form-error {
        color: red;
        font-size: 14px;
    }
    .btn-primary {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .btn-primary:hover {
        background-color: #45a049;
    }
    .form-actions {
        text-align: center;
    }
</style>
