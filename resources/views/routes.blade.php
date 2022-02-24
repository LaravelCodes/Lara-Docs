<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <style>
        table{font-family: Helvetica; border: 1px solid black; border-collapse:collapse;}
        td {border: 1px solid black; padding: 0.5em;  }
        th{border: 1px solid black; }
        td:first-child, pre {font-weight: bold;}

    </style>
</head>
<body>
    <h1>1 - Routes:</h1>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Topic</th>
                <th>Definition</th>
                <th>Code</th>
                <th>Command / Important</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="5"><h2>A - Basic Routing</h2></td>
            </tr>
            <tr>
                <td>1</td>
                <td>Basic Route (URL and Closure)</td>
                <td>
                    The most basic Laravel routes accept a URI and a closure, providing a very simple and expressive method of defining routes and behavior without complicated routing configuration files:
                </td>
                <td>
<pre>
use Illuminate\Support\Facades\Route;
                    
Route::get('/greeting', function () {
    return 'Hello World';
});
</pre>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>2</td>
                <td>The Default Route Files</td>
                <td>
                    All Laravel routes are defined in your route files, which are located in the routes directory. These files are automatically loaded by your application's App\Providers\RouteServiceProvider. The routes/web.php file defines routes that are for your web interface. These routes are assigned the web middleware group, which provides features like session state and CSRF protection. The routes in routes/api.php are stateless and are assigned the api middleware group.
                </td>
                <td>
<pre>
use App\Http\Controllers\UserController;
                    
Route::get('/user', [UserController::class, 'index']);
</pre>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>3</td>
                <td>Available Router Methods</td>
                <td>
                    The router allows you to register routes that respond to any HTTP verb.
                </td>
                <td>
<pre>
Route::get($uri, $callback);
                    
Route::post($uri, $callback);

Route::put($uri, $callback);

Route::patch($uri, $callback);

Route::delete($uri, $callback);

Route::options($uri, $callback);
</pre>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>4</td>
                <td>Match / Any Methods</td>
                <td>
                    Sometimes you may need to register a route that responds to multiple HTTP verbs. You may do so using the match method. Or, you may even register a route that responds to all HTTP verbs using the any method:
                </td>
                <td>
<pre>
Route::match(['get', 'post'], '/', function () {
    //
});

Route::any('/', function () {
    //
});
</pre>
                </td>
                <td>
                    When defining multiple routes that share the same URI, routes using the get, post, put, patch, delete, and options methods should be defined before routes using the any, match, and redirect methods. This ensures the incoming request is matched with the correct route.
                </td>
            </tr>
            <tr>
                <td>5</td>
                <td>Dependency Injection</td>
                <td>
                    You may type-hint any dependencies required by your route in your route's callback signature. The declared dependencies will automatically be resolved and injected into the callback by the Laravel service container.
                </td>
                <td>
<pre>
use Illuminate\Http\Request;
                    
Route::get('/users', function (Request $request) {
    // ...
});
</pre>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>6</td>
                <td>CSRF Protection</td>
                <td>
                    Remember, any HTML forms pointing to POST, PUT, PATCH, or DELETE routes that are defined in the web routes file should include a CSRF token field. Otherwise, the request will be rejected. 
                </td>
                <td>
<pre>
&lt;form method="POST" action="/profile">

    {{"@csrf"}}

&lt;/form>
</pre>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>7</td>
                <td>Redirect Routes</td>
                <td>
                    If you are defining a route that redirects to another URI, you may use the Route::redirect method. This method provides a convenient shortcut so that you do not have to define a full route or controller for performing a simple redirect
                    <br>
                    By default, Route::redirect returns a 302 status code. You may customize the status code using the optional third parameter:
                    <br>
                    Or, you may use the Route::permanentRedirect method to return a 301 status code:
                </td>
                <td>
<pre>
Route::redirect('/here', '/there');
                    
Route::redirect('/here', '/there', 301);

Route::permanentRedirect('/here', '/there');
</pre>
                </td>
                <td>
                    When using route parameters in redirect routes, the following parameters are reserved by Laravel and cannot be used: destination and status.
                </td>
            </tr>
            <tr>
                <td>8</td>
                <td>View Routes</td>
                <td>
                    If your route only needs to return a view, you may use the Route::view method. Like the redirect method, this method provides a simple shortcut so that you do not have to define a full route or controller. The view method accepts a URI as its first argument and a view name as its second argument. In addition, you may provide an array of data to pass to the view as an optional third argument:
                </td>
                <td>
<pre>
Route::view('/welcome', 'welcome');

Route::view('/welcome', 'welcome', ['name' => 'Taylor']);
</pre>
                </td>
                <td>
                    When using route parameters in view routes, the following parameters are reserved by Laravel and cannot be used: view, data, status, and headers.
                </td>
            </tr>
            <tr>
                <td colspan="5"><h2>B - Route Parameters</h2></td>
            </tr>
            <tr>
                <td>1</td>
                <td>Required Parameters</td>
                <td>
                    Sometimes you will need to capture segments of the URI within your route. For example, you may need to capture a user's ID from the URL. You may do so by defining route parameters:
                </td>
                <td>
<pre>
Route::get('/user/{id}', function ($id) {
    return 'User '.$id;
});

<!-- Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
    //
}); -->
</pre>
                </td>
                <td>
                    Route parameters are always encased within {} braces and should consist of alphabetic characters. Underscores (_) are also acceptable within route parameter names. Route parameters are injected into route callbacks / controllers based on their order - the names of the route callback / controller arguments do not matter.
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Parameters & Dependency Injection</td>
                <td>
                    If your route has dependencies that you would like the Laravel service container to automatically inject into your route's callback, you should list your route parameters after your dependencies:
                </td>
                <td>
<pre>
use Illuminate\Http\Request;

Route::get('/user/{id}', function (Request $request, $id) {
    return 'User '.$id;
});
</pre>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Optional Parameters</td>
                <td>
                    Occasionally you may need to specify a route parameter that may not always be present in the URI. You may do so by placing a ? mark after the parameter name. Make sure to give the route's corresponding variable a default value:
                </td>
                <td>
<pre>
Route::get('/user/{name?}', function ($name = null) {
    return $name;
});

Route::get('/user/{name?}', function ($name = 'John') {
    return $name;
});
</pre>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td>Regular Expression Constraints</td>
                <td>
                    You may constrain the format of your route parameters using the where method on a route instance. The where method accepts the name of the parameter and a regular expression defining how the parameter should be constrained
                    <br>
                    For convenience, some commonly used regular expression patterns have helper methods that allow you to quickly add pattern constraints to your routes:
                </td>
                <td>
<pre>
Route::get('/user/{name}', function ($name) {
    //
})->where('name', '[A-Za-z]+');
 
Route::get('/user/{id}', function ($id) {
    //
})->where('id', '[0-9]+');
 
Route::get('/user/{id}/{name}', function ($id, $name) {
    //
})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);

OR

Route::get('/user/{id}/{name}', function ($id, $name) {
    //
})->whereNumber('id')->whereAlpha('name');
 
Route::get('/user/{name}', function ($name) {
    //
})->whereAlphaNumeric('name');
 
Route::get('/user/{id}', function ($id) {
    //
})->whereUuid('id');
</pre>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>5</td>
                <td>Global Constraints</td>
                <td>
                    If you would like a route parameter to always be constrained by a given regular expression, you may use the pattern method. You should define these patterns in the boot method of your App\Providers\RouteServiceProvider class:
                </td>
                <td>
<pre>
public function boot()
{
    Route::pattern('id', '[0-9]+');
}
</pre>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>6</td>
                <td>Encoded Forward Slashes</td>
                <td>
                    The Laravel routing component allows all characters except / to be present within route parameter values. You must explicitly allow / to be part of your placeholder using a where condition regular expression:
                </td>
                <td>
<pre>
Route::get('/search/{search}', function ($search) {
    return $search;
})->where('search', '.*');
</pre>
                </td>
                <td>
                    Encoded forward slashes are only supported within the last route segment.
                </td>
            </tr>

            <tr>
                <td colspan="5"><h2>C - Named Routes</h2></td>
            </tr>
            <tr>
                <td>1</td>
                <td>Named Routes</td>
                <td>
                    Named routes allow the convenient generation of URLs or redirects for specific routes. You may specify a name for a route by chaining the name method onto the route definition:
                </td>
                <td>
<pre>
Route::get('/user/profile', function () {
    //
})->name('profile');

Route::get(
    '/user/profile',
    [UserProfileController::class, 'show']
)->name('profile');
</pre>
                </td>
                <td>
                    Route names should always be unique.
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Generating URLs To Named Routes</td>
                <td>
                    Once you have assigned a name to a given route, you may use the route's name when generating URLs or redirects via Laravel's route and redirect helper functions:
                    <br>
                    If the named route defines parameters, you may pass the parameters as the second argument to the route function. The given parameters will automatically be inserted into the generated URL in their correct positions:
                    <br>
                    If you pass additional parameters in the array, those key / value pairs will automatically be added to the generated URL's query string.
                </td>
                <td>
<pre>
// Generating URLs...
$url = route('profile');
 
// Generating Redirects...
return redirect()->route('profile');
OR
Route::get('/user/{id}/profile', function ($id) {
    //
})->name('profile');
 
$url = route('profile', ['id' => 1]);
OR
Route::get('/user/{id}/profile', function ($id) {
    //
})->name('profile');
 
$url = route('profile', ['id' => 1, 'photos' => 'yes']);
 
// /user/1/profile?photos=yes
</pre>
                </td>
                <td>
                    Sometimes, you may wish to specify request-wide default values for URL parameters, such as the current locale. To accomplish this, you may use the URL::defaults method.
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Inspecting The Current Route</td>
                <td>
                    If you would like to determine if the current request was routed to a given named route, you may use the named method on a Route instance. For example, you may check the current route name from a route middleware:
                </td>
                <td>
<pre>
public function handle($request, Closure $next)
{
    if ($request->route()->named('profile')) {
        //
    }
 
    return $next($request);
}
</pre>
                </td>
                <td>
                </td>
            </tr>

            <tr>
                <th colspan="2"><h2>C - Route Groups</h2></th>
                <td colspan="3">
                    Route groups allow you to share route attributes, such as middleware, across a large number of routes without needing to define those attributes on each individual route.
                    <br>
                    Nested groups attempt to intelligently "merge" attributes with their parent group. Middleware and where conditions are merged while names and prefixes are appended. Namespace delimiters and slashes in URI prefixes are automatically added where appropriate.
                </td>
            </tr>
            <tr>
                <td>1</td>
                <td>Middleware</td>
                <td>
                    To assign middleware to all routes within a group, you may use the middleware method before defining the group. Middleware are executed in the order they are listed in the array:
                </td>
                <td>
<pre>
Route::middleware(['first', 'second'])->group(function () {
    Route::get('/', function () {
        // Uses first & second middleware...
    });
 
    Route::get('/user/profile', function () {
        // Uses first & second middleware...
    });
});
</pre>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Controllers</td>
                <td>
                    If a group of routes all utilize the same controller, you may use the controller method to define the common controller for all of the routes within the group. Then, when defining the routes, you only need to provide the controller method that they invoke:
                </td>
                <td>
<pre>
use App\Http\Controllers\OrderController;
 
Route::controller(OrderController::class)->group(function () {
    Route::get('/orders/{id}', 'show');
    Route::post('/orders', 'store');
});
</pre>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>3</td>
                <td>Subdomain Routing</td>
                <td>
                    Route groups may also be used to handle subdomain routing. Subdomains may be assigned route parameters just like route URIs, allowing you to capture a portion of the subdomain for usage in your route or controller. The subdomain may be specified by calling the domain method before defining the group:
                </td>
                <td>
<pre>
Route::domain('{account}.example.com')->group(function () {
    Route::get('user/{id}', function ($account, $id) {
        //
    });
});
</pre>
                </td>
                <td>
                    In order to ensure your subdomain routes are reachable, you should register subdomain routes before registering root domain routes. This will prevent root domain routes from overwriting subdomain routes which have the same URI path.
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td>Route Prefixes</td>
                <td>
                    The prefix method may be used to prefix each route in the group with a given URI. For example, you may want to prefix all route URIs within the group with admin
                </td>
                <td>
<pre>
Route::prefix('admin')->group(function () {
    Route::get('/users', function () {
        // Matches The "/admin/users" URL
    });
});
</pre>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>5</td>
                <td>Route Name Prefixes</td>
                <td>
                    The name method may be used to prefix each route name in the group with a given string. For example, you may want to prefix all of the grouped route's names with admin. The given string is prefixed to the route name exactly as it is specified, so we will be sure to provide the trailing . character in the prefix:
                </td>
                <td>
<pre>
Route::name('admin.')->group(function () {
    Route::get('/users', function () {
        // Route assigned name "admin.users"...
    })->name('users');
});
</pre>
                </td>
                <td></td>
            </tr>

            <tr>
                <th colspan="2"><h2>D - Route Model Binding</h2></th>
                <td colspan="3">
                    When injecting a model ID to a route or controller action, you will often query the database to retrieve the model that corresponds to that ID. Laravel route model binding provides a convenient way to automatically inject the model instances directly into your routes. For example, instead of injecting a user's ID, you can inject the entire User model instance that matches the given ID.
                </td>
            </tr>
            <tr>
                <td>1</td>
                <td>Implicit Binding</td>
                <td>
                    Since the $user variable is type-hinted as the App\Models\User Eloquent model and the variable name matches the {user} URI segment, Laravel will automatically inject the model instance that has an ID matching the corresponding value from the request URI. If a matching model instance is not found in the database, a 404 HTTP response will automatically be generated.
                    <br>
                    Of course, implicit binding is also possible when using controller methods. Again, note the {user} URI segment matches the $user variable in the controller which contains an App\Models\User type-hint:
                </td>
                <td>
<pre>
use App\Models\User;
 
Route::get('/users/{user}', function (User $user) {
    return $user->email;
});

OR

use App\Http\Controllers\UserController;
use App\Models\User;
 
// Route definition...
Route::get('/users/{user}', [UserController::class, 'show']);
 
// Controller method definition...
public function show(User $user)
{
    return view('user.profile', ['user' => $user]);
}
</pre>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Soft Deleted Models</td>
                <td>
                    Typically, implicit model binding will not retrieve models that have been soft deleted. However, you may instruct the implicit binding to retrieve these models by chaining the withTrashed method onto your route's definition
                </td>
                <td>
<pre>
use App\Models\User;
 
Route::get('/users/{user}', function (User $user) {
    return $user->email;
})->withTrashed();
</pre>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>3</td>
                <td>Customizing The Key</td>
                <td>
                    Sometimes you may wish to resolve Eloquent models using a column other than id. To do so, you may specify the column in the route parameter definition:
                    <br>
                    If you would like model binding to always use a database column other than id when retrieving a given model class, you may override the getRouteKeyName method on the Eloquent model:

                </td>
                <td>
<pre>
use App\Models\Post;
 
Route::get('/posts/{post:slug}', function (Post $post) {
    return $post;
});

OR

public function getRouteKeyName()
{
    return 'slug';
}
</pre>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>4</td>
                <td>Custom Keys & Scoping</td>
                <td>Read DOCS</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>5</td>
                <td>Customizing Missing Model Behavior</td>
                <td>
                    Typically, a 404 HTTP response will be generated if an implicitly bound model is not found. However, you may customize this behavior by calling the missing method when defining your route. The missing method accepts a closure that will be invoked if an implicitly bound model can not be found:
                </td>
                <td>
<pre>
use App\Http\Controllers\LocationsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
 
Route::get('/locations/{location:slug}', 
    [LocationsController::class, 'show'])
        ->name('locations.view')
        ->missing(function (Request $request) {
            return Redirect::route('locations.index');
        });
</pre>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>6</td>
                <td>Implicit Enum Binding</td>
                <td>Read DOCS</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>7</td>
                <td>Explicit Binding</td>
                <td>
                    You are not required to use Laravel's implicit, convention based model resolution in order to use model binding. You can also explicitly define how route parameters correspond to models. To register an explicit binding, use the router's model method to specify the class for a given parameter. You should define your explicit model bindings at the beginning of the boot method of your RouteServiceProvider class:
                    <br>
                    Next, define a route that contains a {user} parameter:
                    <br>
                    Since we have bound all {user} parameters to the App\Models\User model, an instance of that class will be injected into the route. So, for example, a request to users/1 will inject the User instance from the database which has an ID of 1.
                    <br>
                    If a matching model instance is not found in the database, a 404 HTTP response will be automatically generated.
                </td>
                <td>
<pre>
use App\Models\User;
use Illuminate\Support\Facades\Route;
 
public function boot()
{
    Route::model('user', User::class);
 
    // ...
}

THEN...

use App\Models\User;
 
Route::get('/users/{user}', function (User $user) {
    //
});
</pre>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>8</td>
                <td>Customizing The Resolution Logic</td>
                <td>
                    If you wish to define your own model binding resolution logic, you may use the Route::bind method. The closure you pass to the bind method will receive the value of the URI segment and should return the instance of the class that should be injected into the route. Again, this customization should take place in the boot method of your application's RouteServiceProvider.
                </td>
                <td>
<pre>
use App\Models\User;
use Illuminate\Support\Facades\Route;
 
public function boot()
{
    Route::bind('user', function ($value) {
        return User::where('name', $value)->firstOrFail();
    });
 
    // ...
}
</pre>
                </td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>|||</td>
                <td>
                    Alternatively, you may override the resolveRouteBinding method on your Eloquent model. This method will receive the value of the URI segment and should return the instance of the class that should be injected into the route:
                    <br>
                    If a route is utilizing implicit binding scoping, the resolveChildRouteBinding method will be used to resolve the child binding of the parent model:
                </td>
                <td>
<pre>
public function resolveRouteBinding($value, $field = null)
{
    return $this->where('name', $value)->firstOrFail();
}

OR

public function resolveChildRouteBinding($childType, $value, $field)
{
    return parent::resolveChildRouteBinding($childType, $value, $field);
}
</pre>
                </td>
                <td></td>
            </tr>

            <tr>
                <th colspan="2"><h2>E - Fallback Routes</h2></th>    
                <td>
<pre>
Route::fallback(function () {
    //
});
</pre>
                </td>
                <td>
                    Using the Route::fallback method, you may define a route that will be executed when no other route matches the incoming request. Typically, unhandled requests will automatically render a "404" page via your application's exception handler. However, since you would typically define the fallback route within your routes/web.php file, all middleware in the web middleware group will apply to the route. You are free to add additional middleware to this route as needed.
                </td>    
                <td>
                    The fallback route should always be the last route registered by your application.
                </td>
            </tr>

            <tr>
                <td colspan="4"><h2>Rate Limiting</h2></td>    
                <td>Read Docs</td>
            </tr>

            <tr>
                <td colspan="2"><h2>F - Form Method Spoofing</h2></td>    
                <td>
                    HTML forms do not support PUT, PATCH, or DELETE actions. So, when defining PUT, PATCH, or DELETE routes that are called from an HTML form, you will need to add a hidden _method field to the form. The value sent with the _method field will be used as the HTTP request method:

                    <!-- <form action="/example" method="POST">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form> -->

                    For convenience, you may use the &amp;method Blade directive to generate the _method input field:

                    <!-- <form action="/example" method="POST">
                        @method('PUT')
                        @csrf
                    </form> -->
                </td>    
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th colspan="2"><h2>G - Accessing The CUrrent Route</h2></th>    
                <td>
                    You may use the current, currentRouteName, and currentRouteAction methods on the Route facade to access information about the route handling the incoming request:
                </td>    
                <td>
<pre>
use Illuminate\Support\Facades\Route;
 
$route = Route::current(); // Illuminate\Routing\Route
$name = Route::currentRouteName(); // string
$action = Route::currentRouteAction(); // string
</pre>
                </td>
                <td></td>
            </tr>

            <tr>
                <td colspan="4"><h2>Cross-Origin Resource Sharing (CORS)</h2></td>    
                <td>Read Docs</td>
            </tr>

            <tr>
                <td colspan="4"><h2>Route Caching</h2></td>    
                <td>Read Docs</td>
            </tr>


        </tbody>
    </table>
    
</body>
</html>
