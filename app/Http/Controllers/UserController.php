<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        return 'From User Controller';
    }


    /****************************************************************/
    /*  Controller */
    // ***********
    /*
        use App\Http\Controllers\UserController;
    
        Route::get('/user/{id}', [UserController::class, 'show']);

    */
    /****************************************************************/
    /* Single Action Controller */
    // ************************
    /*
        use App\Http\Controllers\ProvisionServer;
    
        Route::post('/server', ProvisionServer::class);

        ----------------------------------------------------------
        
        public function __invoke()
        {
            // ...
        }
    */
    /****************************************************************/
    /* Controller Middleware */
    // *********************
    /*
        Route::get('profile', [UserController::class, 'show'])->middleware('auth');

        -------------------------------------------------------------------
        
        public function __construct()
        {
            $this->middleware('auth');
            $this->middleware('log')->only('index');
            $this->middleware('subscribed')->except('store');
        }

        -------------------------------------------------------------------

        $this->middleware(function ($request, $next) {
            return $next($request);
        });

    */
    /****************************************************************/
    /* Resource Controller */
    // *******************
    /*

        Route::resource('photos', PhotoController::class);

        ------------------------------------------------------------

        Route::resources([
            'photos' => PhotoController::class,
            'posts' => PostController::class,
        ]);
    */
    /****************************************************************/
    /* Customizing Missing Model Behaviour */
    // ***********************************
    /*
        use App\Http\Controllers\PhotoController;
        use Illuminate\Http\Request;
        use Illuminate\Support\Facades\Redirect;
        
        Route::resource('photos', PhotoController::class)
                ->missing(function (Request $request) {
                    return Redirect::route('photos.index');
                });
    */
    /****************************************************************/
    /* Partial Resource Route */
    // **********************
    /*
        use App\Http\Controllers\PhotoController;
        
        Route::resource('photos', PhotoController::class)->only([
            'index', 'show'
        ]);
        
        Route::resource('photos', PhotoController::class)->except([
            'create', 'store', 'update', 'destroy'
        ]);
    */
    /****************************************************************/
    /* API Resource Routes */
    // *******************
    /*
        use App\Http\Controllers\PhotoController;
        
        Route::apiResource('photos', PhotoController::class);

        -------------------------------------------------------

        use App\Http\Controllers\PhotoController;
        use App\Http\Controllers\PostController;
        
        Route::apiResources([
            'photos' => PhotoController::class,
            'posts' => PostController::class,
        ]);
    */
    /****************************************************************/
    /* Nested Routes */
    // *************
    /*

        Route::resource('photos.comments', PhotoCommentController::class);

    */
    /****************************************************************/
    /* Naming Resource Routes */
    // **********************
    /*
    
        Route::resource('photos', PhotoController::class)->names([
            'create' => 'photos.build'
        ]);
    */
    /****************************************************************/
    /* Naming Resource Route Parameters */
    // ********************************
    /*
    
        Route::resource('users', AdminUserController::class)->parameters([
            'users' => 'admin_user'
        ]);
    */
    /****************************************************************/
    /* Supplementing Resource Controllers */
    // ********************************
    /*
    
        Route::get('/photos/popular', [PhotoController::class, 'popular']);
        Route::resource('photos', PhotoController::class);
    */
    /****************************************************************/
    /* Dependency Injecition and Controllers */
    // *************************************
    /*
        Constructor Injection:
        *********************

        use App\Repositories\UserRepository;

        class UserController extends Controller
        {

            protected $users;
            
            public function __construct(UserRepository $users)
            {
                $this->users = $users;
            }
        }

        ---------------------------------------------------------------
        Method Injection:
        *********************

        use Illuminate\Http\Request;

        class UserController extends Controller
        {
            public function store(Request $request)
            {
                $name = $request->name;
            }

            public function update(Request $request, $id)
            {
                //
            }
        }

        ---------------------------------------------------------------
        
        
    */
    /****************************************************************/
    /* Request */
    // *************************************
    /*
        Accessing the Request:
        *********************

        public function store(Request $request)
        {
            $name = $request->input('name');
    
            //
        }

        ----------------------------------------------------------
        Dependency Injection and Route Params:
        *************************************
        
        public function update(Request $request, $id)
        {
            //
        }

        ---------------------------------------------------------------
        Request Path and Method:
        ***********************

        + Retrieving the Request Path:
        - $uri = $request->path();

        + Inspecting the Request Path / Route: 
        - $request->is('admin/*') //route
        - $request->routeIs('admin.*') //named route

        + Retrieving The Request URL:
        - $url = $request->url();
        - $urlWithQueryString = $request->fullUrl();
        - $request->fullUrlWithQuery(['type' => 'phone']);

        + Retrieving the Request Method:
        - $method = $request->method();
        - $request->isMethod('post')

        ---------------------------------------------------------------
        Request Headers:
        **************

        (1) $value = $request->header('X-Header-Name');
 
        (2) $value = $request->header('X-Header-Name', 'default');

        (3) if ($request->hasHeader('X-Header-Name')) {
            //
        }
        
        (4) $token = $request->bearerToken();

        -------------------------------------------------------------
        Request IP Address:
        ******************
        
        - $ipAddress = $request->ip();
        
        -------------------------------------------------------------
        Input:
        *****

        Retrieving Input:
        ----------------
        (1) $input = $request->all();
        
        (2) $input = $request->all();
        
        (3) $request->collect('users')->each(function ($user) {
            // ...
        });


        Retrieving An Input Value:
        -------------------------
        
        (1) $name = $request->input('name');

        (2) $name = $request->input('name', 'Sally');

        (3) $name = $request->input('products.0.name');
 
        (3) $names = $request->input('products.*.name');

        (4) $input = $request->input();


        Retrieving Input From Query String:
        ----------------------------------
        
        (1) $name = $request->query('name');

        (2) $name = $request->query('name', 'Helen');

        (3) $query = $request->query();


        Retrieving JSON Input Values:
        ----------------------------------
        
        (1) $name = $request->input('user.name');


        Retrieving Boolean Input Values:
        ----------------------------------
        
        (1) $archived = $request->boolean('archived');


        Retrieving Date Input Values:
        ----------------------------
        
        (1) $birthday = $request->date('birthday');

        (2) $elapsed = $request->date('elapsed', '!H:i', 'Europe/Madrid');


        Retrieving Input Via Dynamic Properties:
        ---------------------------------------
        
        (1) $name = $request->name;


        Retrieving A portion of Input Data:
        ----------------------------------
        
        (1) $input = $request->only(['username', 'password']);
 
        (2) $input = $request->only('username', 'password');
 
        (3) $input = $request->except(['credit_card']);
 
        (4) $input = $request->except('credit_card');


        Determining If Input Is Present:
        -------------------------------
        
        (1) if ($request->has('name')) { }
 
        (2)  if ($request->has(['name', 'email'])) { }
 
        (3) $request->whenHas('name', function ($input) { });
 
        (4) $request->whenHas('name', function ($input) {
                // The "name" value is present...
            }, function () {
                // The "name" value is not present...
            });
        
        (5) if ($request->hasAny(['name', 'email'])) { }

        (6) if ($request->filled('name')) { }

        (7) $request->whenFilled('name', function ($input) { });

        (8) $request->whenFilled('name', function ($input) {
                // The "name" value is filled...
            }, function () {
                // The "name" value is not filled...
            });

        (9) if ($request->missing('name')) { }


        Merging Additional Inputs:
        -------------------------------
        
        (1) $request->merge(['votes' => 0]);
 
        (2) $request->mergeIfMissing(['votes' => 0]);

        -------------------------------------------------------------
        OLD Input:
        *********

        Flashing Input to session:
        -------------------------

        (1) $request->flash();

        (2) $request->flashOnly(['username', 'email']);
        
        (3) $request->flashExcept('password');


        Flashing Input Then Redirecting:
        -------------------------------
        
        (1) return redirect('form')->withInput();

        (2) return redirect()->route('user.create')->withInput();
        
        (3) return redirect('form')->withInput(
                $request->except('password')
            );


        Retrieving Old Input:
        --------------------
        
        (1) $username = $request->old('username');

        (2) <input type="text" name="username" value="{{ old('username') }}">
        

 


    */
}
