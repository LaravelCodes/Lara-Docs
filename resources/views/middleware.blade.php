<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <style>
        li{font-weight: bold; font-family: Helvetica; margin: 10px 0 0 0}
        p{margin: 5px 0px 15px 0px; font-family: arial}
    </style>
</head>
<body>
    <h1>2 - Middleware</h1>
    <ol>
        <li>Defifning Middleware</li>
        <p>
            To create a new middleware, use the make:middleware Artisan command:php artisan make:middleware EnsureTokenIsValid
            <br>
            This command will place a new EnsureTokenIsValid class within your app/Http/Middleware directory. In this middleware, we will only allow access to the route if the supplied token input matches a specified value. Otherwise, we will redirect the users back to the home URI.
            <br>
            All middleware are resolved via the service container, so you may type-hint any dependencies you need within a middleware's constructor.
        </p>
        <ul>
            <li>Middleware And Responses</li>
            <p>
                Any middleware would perform some task before the request is handled by the application.
                <br>
                However this middleware would perform its task after the request is handled by the application (whene response is returned)
            </p>
        </ul>

        <li>Registering Middleware</li>
        <ul>
            <li>Global Middleware</li>
            <p>
                If you want a middleware to run during every HTTP request to your application, list the middleware class in the $middleware property of your app/Http/Kernel.php class.
            </p>

            <li>Assigning Middleware to Routes</li>
            <p>
                If you would like to assign middleware to specific routes, you should first assign the middleware a key in your application's app/Http/Kernel.php file. By default, the $routeMiddleware property of this class contains entries for the middleware included with Laravel.
                <br>
                Once the middleware has been defined in the HTTP kernel, you may use the middleware method to assign middleware to a route
            </p>

            <li>Excluding Middleware</li>
            <p>
                When assigning middleware to a group of routes, you may occasionally need to prevent the middleware from being applied to an individual route within the group. You may accomplish this using the withoutMiddleware method
                <br>
                The withoutMiddleware method can only remove route middleware and does not apply to global middleware.
            </p>
        </ul>

        <li>Middleware Group</li>
        <p>
            Sometimes you may want to group several middleware under a single key to make them easier to assign to routes. You may accomplish this using the $middlewareGroups property of your HTTP kernel.
            <br>
            Out of the box, Laravel comes with web and api middleware groups that contain common middleware you may want to apply to your web and API routes. Remember, these middleware groups are automatically applied by your application's App\Providers\RouteServiceProvider service provider to routes within your corresponding web and api route files:
        </p>
        
        <li>Sorting Middleware</li>
        <p>
            Rarely, you may need your middleware to execute in a specific order but not have control over their order when they are assigned to the route. In this case, you may specify your middleware priority using the $middlewarePriority property of your app/Http/Kernel.php file. This property may not exist in your HTTP kernel by default. If it does not exist, you may copy its default definition below
        </p>
        
        <li>Middleware Parameters</li>
        <p>
            Middleware can also receive additional parameters. For example, if your application needs to verify that the authenticated user has a given "role" before performing a given action, you could create an EnsureUserHasRole middleware that receives a role name as an additional argument.
            <br>
            Additional middleware parameters will be passed to the middleware after the $next argument.
            <br>
            Middleware parameters may be specified when defining the route by separating the middleware name and parameters with a :. Multiple parameters should be delimited by commas.
        </p>

        <li>Terminating Middleware</li>
        <p>
            Check Docs Last
        </p>

        <li>CSRF</li>
        <p>
            The current session's CSRF token can be accessed via the request's session or via the csrf_token helper function:
        </p>
        <p>
            Anytime you define a "POST", "PUT", "PATCH", or "DELETE" HTML form in your application, you should include a hidden CSRF _token field in the form so that the CSRF protection middleware can validate the request. For convenience, you may use the @csrf Blade directive to generate the hidden token input field
        </p>

        <li>CSRF Middleware</li>
        <p>
            The App\Http\Middleware\VerifyCsrfToken middleware, which is included in the web middleware group by default, will automatically verify that the token in the request input matches the token stored in the session. When these two tokens match, we know that the authenticated user is the one initiating the request.
        </p>

        <li>Excluding CSRF</li>
        <p>
            Sometimes you may wish to exclude a set of URIs from CSRF protection. For example, if you are using Stripe to process payments and are utilizing their webhook system, you will need to exclude your Stripe webhook handler route from CSRF protection since Stripe will not know what CSRF token to send to your routes.
            <br>
            Typically, you should place these kinds of routes outside of the web middleware group that the App\Providers\RouteServiceProvider applies to all routes in the routes/web.php file. However, you may also exclude the routes by adding their URIs to the $except property of the VerifyCsrfToken middleware.
            <br>
            For convenience, the CSRF middleware is automatically disabled for all routes when running tests.
        </p>

        <li>X-CSRF Token</li>
        <p>
            In addition to checking for the CSRF token as a POST parameter, the App\Http\Middleware\VerifyCsrfToken middleware will also check for the X-CSRF-TOKEN request header. You could, for example, store the token in an HTML meta tag

            <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
            <br>
            Then, you can instruct a library like jQuery to automatically add the token to all request headers. This provides simple, convenient CSRF protection for your AJAX based applications using legacy JavaScript technology.

            <!--
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
            -->
            <br>
            By default, the resources/js/bootstrap.js file includes the Axios HTTP library which will automatically send the X-XSRF-TOKEN header for you.
        </p>
        
        
        
    </ol>
</body>
</html>
