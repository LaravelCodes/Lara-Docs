<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Basic Route (URL and Closure) */
// *****************************
Route::view('/', 'routes');
Route::view('/middleware', 'middleware');

Route::prefix('controller')->group(function () {
    Route::get('/first', [UserController::class, 'show']);
    Route::view('/', 'controller');
});
Route::view('/request', 'request');

/****************************************************************/
/* Redirect Routes */
// ***************
/*
    
    Route::redirect('/here', '/there');
    
    Route::redirect('/here', '/there', 301);
    Or, you may use the Route::permanentRedirect method to return a 301 status code:

    Route::permanentRedirect('/here', '/there');
    
*/
/****************************************************************/
/* View Routes */
// ***********
/*

    Route::view('/welcome', 'welcome');
    Route::view('/welcome', 'welcome', ['name' => 'Taylor']);

*/
/****************************************************************/
/* Route Parameters */
// ****************
/*
    Required Parameters:
    *******************

    Route::get('/user/{id}', function ($id) {
        return 'User '.$id;
    });

    Parameters and dependency Injection:
    ***********************************

    use Illuminate\Http\Request;
 
    Route::get('/user/{id}', function (Request $request, $id) {
        return 'User '.$id;
    });

    Optional Parameters:
    *******************
    
    Route::get('/user/opp/{name?}', function ($name = null) {
        return $name;
    });
*/
/****************************************************************/
/* Regular Expression Constraints */
// ******************************
/*
    Route::get('/user/{name}', function ($name) {
        return $name;
    })->where('name', '[A-Za-z]+');

    Route::get('/user/{id}', function ($id) {
        return $id;
    })->where('id', '[0-9]+');

    Route::get('/user/{id}/{name}', function ($id, $name) {
        return "$id $name";
    })->where(['id' => '[0-9]+', 'name' => '[a-z]+']);

    ----------------------------------------------------------------
    
    Route::get('/user/constrai/{id}/{name}', function ($id, $name) {
        return "$id $name";
    })->whereNumber('id')->whereAlpha('name');
    
    Route::get('/user/constrai/{name}', function ($name) {
        return $name;
    })->whereAlphaNumeric('name');
    
    Route::get('/user/constrai/{id}', function ($id) {
        return $id;
    })->whereUuid('id');

    Global Constraints:
    ******************
    
    public function boot()
    {
        Route::pattern('id', '[0-9]+');
    }

    Encoded Forward Slash:
    *********************
    
*/
/****************************************************************/
/* Named Routes */
// ************
/*

    Route::get('/user/profile', function () {
        //
    })->name('profile');

    Generating URLs To Named Routes:
    *******************************

    // Generating URLs...
    $url = route('profile');

    // Generating Redirects...
    return redirect()->route('profile');

    Route::get('/user/{id}/profile', function ($id) {
        //
    })->name('profile');
    
    $url = route('profile', ['id' => 1]);

    ----------------------------------------------------------

    Route::get('/user/{id}/profile', function ($id) {
        //
    })->name('profile');
    
    $url = route('profile', ['id' => 1, 'photos' => 'yes']);
    
    // /user/1/profile?photos=yes
    
    Inspecting The Current Route:
    ****************************

    public function handle($request, Closure $next)
    {
        if ($request->route()->named('profile')) {
            //
        }
    
        return $next($request);
    }
    
*/
/****************************************************************/
/* Route Groups */
// ************
/*

    Middleware:
    **********

    Route::middleware(['first', 'second'])->group(function () {
        Route::get('/', function () {
            // Uses first & second middleware...
        });
    
        Route::get('/user/profile', function () {
            // Uses first & second middleware...
        });
    });

    Controllers:
    ***********

    use App\Http\Controllers\OrderController;
 
    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders/{id}', 'show');
        Route::post('/orders', 'store');
    });

    Subdomain Routing:
    *****************

    Route::domain('{account}.example.com')->group(function () {
        Route::get('user/{id}', function ($account, $id) {
            //
        });
    });

    Route Prefixes:
    **************

    Route::prefix('admin')->group(function () {
        Route::get('/users', function () {
            // Matches The "/admin/users" URL
        });
    });

    Route Name Prefixes:
    *******************

    Route::name('admin.')->group(function () {
        Route::get('/users', function () {
            // Route assigned name "admin.users"...
        })->name('users');
    });

*/
/****************************************************************/
/* Route Model Binding */
// *******************
/*

    Implicit Binding:
    ****************

    use App\Models\User;
    
    Route::get('/users/{user}', function (User $user) {
        return $user->email;
    });

    Soft Deleted Models:
    *******************

    use App\Models\User;
    
    Route::get('/users/{user}', function (User $user) {
        return $user->email;
    })->withTrashed();

    Customizing the key:
    *******************

    use App\Models\Post;
    
    Route::get('/posts/{post:slug}', function (Post $post) {
        return $post;
    });

    ---------------------------------------------

    public function getRouteKeyName()
    {
        return 'slug';
    }

    Custom Keys And Scoping:
    ***********************

    use App\Models\Post;
    use App\Models\User;
    
    Route::get('/users/{user}/posts/{post:slug}', function (User $user, Post $post) {
        return $post;
    });

    -------------------------------------------------------------------
    use App\Models\Post;
    use App\Models\User;
    
    Route::get('/users/{user}/posts/{post}', function (User $user, Post $post) {
        return $post;
    })->scopeBindings();

    -------------------------------------------------------------------
    
    Or, you may instruct an entire group of route definitions to use scoped bindings:

    Route::scopeBindings()->group(function () {
        Route::get('/users/{user}/posts/{post}', function (User $user, Post $post) {
            return $post;
        });
    });

    Customizing Missing Model Behaviour:
    ***********************************
    
    use App\Http\Controllers\LocationsController;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Redirect;

    Route::get('/locations/{location:slug}', [LocationsController::class, 'show'])
    ->name('locations.view')
    ->missing(function (Request $request) {
        return Redirect::route('locations.index');
    });

    Explicit Binding:
    ****************
    
    use App\Models\User;
    use Illuminate\Support\Facades\Route;
    
    public function boot()
    {
        Route::model('user', User::class);
    
        // ...
    }
    Next, define a route that contains a {user} parameter:

    use App\Models\User;
    
    Route::get('/users/{user}', function (User $user) {
        //
    });

    Customizing The Resolution Logic:
    ********************************
    
    use App\Models\User;
    use Illuminate\Support\Facades\Route;
    
    public function boot()
    {
        Route::bind('user', function ($value) {
            return User::where('name', $value)->firstOrFail();
        });
    
        // ...
    }

    ----------------------------------------------------------------

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('name', $value)->firstOrFail();
    }

    ----------------------------------------------------------------

    public function resolveChildRouteBinding($childType, $value, $field)
    {
        return parent::resolveChildRouteBinding($childType, $value, $field);
    }

    Falback Route:
    *************

    Route::fallback(function () {
        //
    });

*/
/****************************************************************/
/* Rate Limiting */
// *************
/*

    Defining Rate Limiters:
    **********************

    use Illuminate\Cache\RateLimiting\Limit;
    use Illuminate\Support\Facades\RateLimiter;
    
    protected function configureRateLimiting()
    {
        RateLimiter::for('global', function (Request $request) {
            return Limit::perMinute(1000);
        });
    }

    ------------------------------------------------------------
    
    protected function configureRateLimiting()
    {
        RateLimiter::for('global', function (Request $request) {
            return Limit::perMinute(1000)->response(function () {
                return response('Custom response...', 429);
            });
        });
    }

*/
/****************************************************************/
/* Form method Spoofing */
// ********************
/*

    <form action="/example" method="POST">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>

    -------------------------------------------------------------------

    <form action="/example" method="POST">
        @method('PUT')
        @csrf
    </form>

*/
/****************************************************************/
/* Accessing the Current Route */
// ***************************
/*
    use Illuminate\Support\Facades\Route;
    
    $route = Route::current(); // Illuminate\Routing\Route
    $name = Route::currentRouteName(); // string
    $action = Route::currentRouteAction(); // string

*/
/****************************************************************/
/* Cross-Origin Resource Sharing (CORS) */
// ***********************************
/*
    use Illuminate\Support\Facades\Route;
    
    $route = Route::current(); // Illuminate\Routing\Route
    $name = Route::currentRouteName(); // string
    $action = Route::currentRouteAction(); // string

*/
/****************************************************************/
/* Middleware */
// **********
/*
    Route::get('/profile', function () {
        //
    })->middleware('auth');
    -------------------------------------- Single 

    Route::get('/', function () {
        //
    })->middleware(['first', 'second']);
    -------------------------------------- Multiple

    use App\Http\Middleware\EnsureTokenIsValid;
    
    Route::get('/profile', function () {
        //
    })->middleware(EnsureTokenIsValid::class);
    -------------------------------------- Class-Based

    use App\Http\Middleware\EnsureTokenIsValid;
 
    Route::middleware([EnsureTokenIsValid::class])->group(function () {
        Route::get('/', function () {
            //
        });
    
        Route::get('/profile', function () {
            //
        })->withoutMiddleware([EnsureTokenIsValid::class]);
    });
    -------------------------------------- Excluding

    use App\Http\Middleware\EnsureTokenIsValid;
 
    Route::withoutMiddleware([EnsureTokenIsValid::class])->group(function () {
        Route::get('/profile', function () {
            //
        });
    });
    ----------------------------------------Group Exclude

    Route::put('/post/{id}', function ($id) {
        //
    })->middleware('role:editor');
    ---------------------------------------Middleware Params

*/
/****************************************************************/
/* CSRF */
// ****
/*
Route::get('/token', function (Request $request) {
    $token = $request->session()->token();
 
    $token = csrf_token();
 
    // ...
});
*/