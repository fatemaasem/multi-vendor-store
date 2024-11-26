@extends('layout')

@section('content')
<div class="container">
    <x-alert type='success' alert='success'/>
    <h2>Edit Profile</h2>
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <!-- First Name -->
        <div class="mb-3">
            <label for="f_name" class="form-label">First Name</label>
            <x-form.input type='text' name='f_name' :value="$profile->f_name" required="required"/>
        </div>

        <!-- Second Name -->
        <div class="mb-3">
            <label for="s_name" class="form-label">Second Name</label>
            <x-form.input type='text' name='s_name' :value="$profile->s_name" required='required'/>
        </div>

        <!-- Street -->
        <div class="mb-3">
            <label for="street" class="form-label">Street</label>
            <x-form.input type='text' name='street' :value="$profile->street" />
        </div>

        <!-- City -->
        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <x-form.input type='text' name='city' :value="$profile->city" />

        </div>

        <!-- Country -->
        <div class="mb-3">
            <label for="country" class="form-label">Country</label>
        
            <x-form.select name="country" :array="$country" :selected="$profile->country"/>
        </div>

        <!-- Postal Code -->
        <div class="mb-3">
            <label for="postal_code" class="form-label">Postal Code</label>
            <x-form.input type='text' name='postal_code' :value="$profile->postal_code" />
        </div>

        <!-- Language -->
        <div class="mb-3">
            <label for="lang" class="form-label">Preferred Language</label>
            <x-form.select name="lang" :array="$lang" :selected="$profile->lang"/>
        </div>

        <!-- Gender -->
        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <x-form.select name="gender" :array="['male'=>'Male','female'=>'Female']" :selected="$profile->gender"/>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection
