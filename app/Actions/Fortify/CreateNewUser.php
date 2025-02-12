<?php namespace App\Actions\Fortify;
use Illuminate\Support\Str; // Import the Str helper
use App\Models\Profile;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'store' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:500'],
            'logo' => ['nullable', 'image', 'max:2048'], // Optional and max size is 2MB
        ])->validate();
            $logoPath="";
        if (isset($input['logo'])  && $input['logo'] instanceof \Illuminate\Http\UploadedFile) {
            $logoPath = $input['logo']->store('stores', 'public'); // Store logo in the public disk
            
        }
        $store=Store::create([
            'name'=>$input['store'],
            'description'=>$input['description'],
            'slug'=>Str::slug($input['store']),
            'logo_image'=>$logoPath??null
        ]);
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'store_id'=>$store->id
        ]);
       
      

        Profile::create([
            'f_name' => $user->name,
            'user_id' => $user->id,
            'store_name' => $input['store'],
            'description' => $input['description'],
            'logo' => $logoPath ?? null, // Save logo path if provided
        ]);

        return $user;
    }
}
