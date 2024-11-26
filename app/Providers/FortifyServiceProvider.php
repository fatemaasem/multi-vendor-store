<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\ConfirmPasswordViewResponse;
use Laravel\Fortify\Http\Responses\SimpleViewResponse;
class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (request()->is('admin/*')) {

            config()->set('fortify.guard', 'admin');

            config()->set('fortify.home', '/admin/home');
           config()->set('fortify.prefix','admin');
          
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::registerView(function () {

            return view('auth.register');

        });

        Fortify::loginView(function () {

            return view('auth.login');

        });
        Fortify::confirmPasswordView(function () {
            return view('auth.confirm-password');
        });
        Fortify::twoFactorChallengeView(function () {
            return view('auth.two-factor-challenge');
        });
        Fortify::authenticateUsing(function (Request $request) {
         
            if(config('fortify.guard')=='web'){
               $login=config('fortify.username');
               
                $user = User::where('email', $request->$login)->orWhere('phone', $request->$login)->first();
                if ($user &&
                    Hash::check($request->password, $user->password)) {
                    return $user;
                }
            }
            else if(config('fortify.guard')=='admin'){
                $login=config('fortify.username');
                
                 $user = Admin::where('email', $request->$login)->orWhere('phone', $request->$login)->first();
                 if ($user &&
                     Hash::check($request->password, $user->password)) {
                     return $user;
                 }
             }
        });
    }
}
