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
    <h1>1 - Routes:</h1>
    <ol>
        <li>Basic Route (URL and Closure)</li>
        <p>
            When defining multiple routes that share the same URI, routes using the get, post, put, patch, delete, and options methods should be defined before routes using the any, match, and redirect methods. This ensures the incoming request is matched with the correct route.
        </p>

        <li>Dependency Injection</li>
        <p>
            You may type-hint any dependencies required by your route in your route's callback signature. The declared dependencies will automatically be resolved and injected into the callback by the Laravel service container.
        </p>
        
        <li>CSRF Protection</li>
        <p>
            Remember, any HTML forms pointing to POST, PUT, PATCH, or DELETE routes that are defined in the web routes file should include a CSRF token field. Otherwise, the request will be rejected. @csrf
        </p>

        <li>Redirect Routes</li>
        <p>
            If you are defining a route that redirects to another URI, you may use the Route::redirect method. This method provides a convenient shortcut so that you do not have to define a full route or controller for performing a simple redirect. 
            <br>
            By default, Route::redirect returns a 302 status code. You may customize the status code using the optional third parameter. <br>
            When using route parameters in redirect routes, the following parameters are reserved by Laravel and cannot be used: destination and status.
        </p>
        
        <li>View Routes</li>
        <p>
            If your route only needs to return a view, you may use the Route::view method. The view method accepts a URI as its first argument and a view name as its second argument. In addition, you may provide an array of data to pass to the view as an optional third argument. 
            <br>
            When using route parameters in view routes, the following parameters are reserved by Laravel and cannot be used: view, data, status, and headers.
        </p>
        
        <li>Route Parameters:</li>
        <ul>
            <li>Required Parameters</li>
            <p>
                Sometimes you will need to capture segments of the URI within your route. You may do so by defining route parameters. You may define as many route parameters as required by your route. 
                <br>
                Route parameters are always encased within {} braces and should consist of alphabetic characters. Underscores (_) are also acceptable within route parameter names. Route parameters are injected into route callbacks / controllers based on their order - the names of the route callback / controller arguments do not matter.
            </p>
            
            <li>Parameters and dependency Injection</li>
            <p>
                If your route has dependencies that you would like the Laravel service container to automatically inject into your route's callback, you should list your route parameters after your dependencies.
            </p>
            
            <li>Optional Parameters</li>
            <p>
                Occasionally you may need to specify a route parameter that may not always be present in the URI. You may do so by placing a ? mark after the parameter name. Make sure to give the route's corresponding variable a default value.
            </p>
            
        </ul>
        
        <li>Regular Expression Constraints:</li>
        <ul>
            <li>Global Constraints</li>
            <p>
                You may constrain the format of your route parameters using the where method on a route instance. The where method accepts the name of the parameter and a regular expression defining how the parameter should be constrained 
                <br>
                For convenience, some commonly used regular expression patterns have helper methods that allow you to quickly add pattern constraints to your routes. 
                <br>
                If you would like a route parameter to always be constrained by a given regular expression, you may use the pattern method. You should define these patterns in the boot method of your App\Providers\RouteServiceProvider class. Once the pattern has been defined, it is automatically applied to all routes using that parameter name.
            </p>
            
            <li>Encoded Forward Slash</li>
            <p>
                The Laravel routing component allows all characters except / to be present within route parameter values. You must explicitly allow / to be part of your placeholder using a where condition regular expression. 
                <br>
                Encoded forward slashes are only supported within the last route segment.
            </p>
            
        </ul>

        <li>Named Routes:</li>
        <p>
            Named routes allow the convenient generation of URLs or redirects for specific routes. You may specify a name for a route by chaining the name method onto the route definition 
            <br>
            You may also specify route names for controller actions. Route names should always be unique.
        </p>
        
        <ul>
            <li>Generating URLs To Named Routes</li>
            <p>
                Once you have assigned a name to a given route, you may use the route's name when generating URLs or redirects via Laravel's route and redirect helper functions. 
                <br>
                If the named route defines parameters, you may pass the parameters as the second argument to the route function. The given parameters will automatically be inserted into the generated URL in their correct positions. 
                <br>
                If you pass additional parameters in the array, those key / value pairs will automatically be added to the generated URL's query string. 
            </p>
            
            <li>Inspecting The Current Route</li>
            <p>
                If you would like to determine if the current request was routed to a given named route, you may use the named method on a Route instance. For example, you may check the current route name from a route middleware. 
            </p>
            
        </ul>
        
        <li>Route Groups</li>
        <p>
            Nested groups attempt to intelligently "merge" attributes with their parent group. Middleware and where conditions are merged while names and prefixes are appended. Namespace delimiters and slashes in URI prefixes are automatically added where appropriate.
        </p>
        
        <ul>
            <li>Middleware</li>
            <p>
                To assign middleware to all routes within a group, you may use the middleware method before defining the group. Middleware are executed in the order they are listed in the array
            </p>
            
            <li>Controllers</li>
            <p>
                If a group of routes all utilize the same controller, you may use the controller method to define the common controller for all of the routes within the group. Then, when defining the routes, you only need to provide the controller method that they invoke.
            </p>
            
            <li>Subdomain Routing</li>
            <p>
                Route groups may also be used to handle subdomain routing. Subdomains may be assigned route parameters just like route URIs, allowing you to capture a portion of the subdomain for usage in your route or controller. The subdomain may be specified by calling the domain method before defining the group. 
                <br>
                In order to ensure your subdomain routes are reachable, you should register subdomain routes before registering root domain routes. This will prevent root domain routes from overwriting subdomain routes which have the same URI path. 
            </p>
            
            <li>Route Prefixes</li>
            <p>
                The prefix method may be used to prefix each route in the group with a given URI. For example, you may want to prefix all route URIs within the group with admin. 
            </p>
            
            <li>Route Name Prefixes</li>
            <p>
                The name method may be used to prefix each route name in the group with a given string. For example, you may want to prefix all of the grouped route's names with admin. The given string is prefixed to the route name exactly as it is specified, so we will be sure to provide the trailing . character in the prefix. 
            </p>
        </ul>

        <li>Route Model Binding</li>
        <p>
            When injecting a model ID to a route or controller action, you will often query the database to retrieve the model that corresponds to that ID. Laravel route model binding provides a convenient way to automatically inject the model instances directly into your routes. For example, instead of injecting a user's ID, you can inject the entire User model instance that matches the given ID.
        </p>
        <ul>
            <li>Implicit Binding</li>
            <p>
                Laravel automatically resolves Eloquent models defined in routes or controller actions whose type-hinted variable names match a route segment name. 
                <br>
                Since the $user variable is type-hinted as the App\Models\User Eloquent model and the variable name matches the {user} URI segment, Laravel will automatically inject the model instance that has an ID matching the corresponding value from the request URI. If a matching model instance is not found in the database, a 404 HTTP response will automatically be generated. 
            </p>

            <li>Soft Deleted Models</li>
            <p>
                Typically, implicit model binding will not retrieve models that have been soft deleted. However, you may instruct the implicit binding to retrieve these models by chaining the withTrashed method onto your route's definition.
            </p>

            <li>Customizing The Key</li>
            <p>
                Sometimes you may wish to resolve Eloquent models using a column other than id. To do so, you may specify the column in the route parameter definition 
                <br>
                If you would like model binding to always use a database column other than id when retrieving a given model class, you may override the getRouteKeyName method on the Eloquent model
            </p>

            <li>Custom keys and scoping</li>
            <p>
                When using a custom keyed implicit binding as a nested route parameter, Laravel will automatically scope the query to retrieve the nested model by its parent using conventions to guess the relationship name on the parent. In this case, it will be assumed that the User model has a relationship named posts (the plural form of the route parameter name) which can be used to retrieve the Post model. 
                <br>
                If you wish, you may instruct Laravel to scope "child" bindings even when a custom key is not provided. To do so, you may invoke the scopeBindings method when defining your route 
            </p>

            <li>Customizing Missing Model Behaviour</li>
            <p>
                Typically, a 404 HTTP response will be generated if an implicitly bound model is not found. However, you may customize this behavior by calling the missing method when defining your route. The missing method accepts a closure that will be invoked if an implicitly bound model can not be found.
            </p>
            
            <li>Implicit Enum Binding</li>
            <p>
                PHP 8.1 introduced support for Enums. To compliment this feature, Laravel allows you to type-hint an Enum on your route definition and Laravel will only invoke the route if that route segment corresponds to a valid Enum value. Otherwise, a 404 HTTP response will be returned automatically.
            </p>
            
            <li>Explicit Binding</li>
            <p>
                You are not required to use Laravel's implicit, convention based model resolution in order to use model binding. You can also explicitly define how route parameters correspond to models. To register an explicit binding, use the router's model method to specify the class for a given parameter. You should define your explicit model bindings at the beginning of the boot method of your RouteServiceProvider class. 
                <br>
                Next, define a route that contains a {user} parameter. 
                <br>
                Since we have bound all {user} parameters to the App\Models\User model, an instance of that class will be injected into the route. So, for example, a request to users/1 will inject the User instance from the database which has an ID of 1. 
                <br>
                If a matching model instance is not found in the database, a 404 HTTP response will be automatically generated. 
            </p>
            
            <li>Customizing The Resolution Logic</li>
            <p>
                If you wish to define your own model binding resolution logic, you may use the Route::bind method. The closure you pass to the bind method will receive the value of the URI segment and should return the instance of the class that should be injected into the route. Again, this customization should take place in the boot method of your application's RouteServiceProvider. 
                <br>
                Alternatively, you may override the resolveRouteBinding method on your Eloquent model. This method will receive the value of the URI segment and should return the instance of the class that should be injected into the route 
                <br>
                If a route is utilizing implicit binding scoping, the resolveChildRouteBinding method will be used to resolve the child binding of the parent model. 
            </p>
        </ul>

        <li>Fallback Routes</li>
        <p>
            Using the Route::fallback method, you may define a route that will be executed when no other route matches the incoming request. Typically, unhandled requests will automatically render a "404" page via your application's exception handler. However, since you would typically define the fallback route within your routes/web.php file, all middleware in the web middleware group will apply to the route. You are free to add additional middleware to this route as needed. 
            <br>
            The fallback route should always be the last route registered by your application. 
        </p>

        <li>Rate Limiting</li>
        <p>
            Laravel includes powerful and customizable rate limiting services that you may utilize to restrict the amount of traffic for a given route or group of routes. To get started, you should define rate limiter configurations that meet your application's needs. Typically, this should be done within the configureRateLimiting method of your application's App\Providers\RouteServiceProvider class. 
            <br>
            Rate limiters are defined using the RateLimiter facade's for method. The for method accepts a rate limiter name and a closure that returns the limit configuration that should apply to routes that are assigned to the rate limiter. Limit configuration are instances of the Illuminate\Cache\RateLimiting\Limit class. This class contains helpful "builder" methods so that you can quickly define your limit. The rate limiter name may be any string you wish. 
            <br>
            If the incoming request exceeds the specified rate limit, a response with a 429 HTTP status code will automatically be returned by Laravel. If you would like to define your own response that should be returned by a rate limit, you may use the response method. 
        </p>

        <ul>
            <li>Segmenting Rate Limits</li>
            <li>Multiple Rate Limits</li>
            <li>Attaching Rate Limiters To Routes</li>
        </ul>

        <li>Form Method Spoofing</li>
        <p>
            HTML forms do not support PUT, PATCH, or DELETE actions. So, when defining PUT, PATCH, or DELETE routes that are called from an HTML form, you will need to add a hidden _method field to the form. The value sent with the _method field will be used as the HTTP request method. 
            <br>
            For convenience, you may use the &amp;method Blade directive to generate the _method input field:
        </p>

        <li>Accessing The CUrrent Route</li>
        <p>
            You may use the current, currentRouteName, and currentRouteAction methods on the Route facade to access information about the route handling the incoming request:
        </p>

        <li>Cross-Origin Resource Sharing (CORS)</li>
        <p>
            Laravel can automatically respond to CORS OPTIONS HTTP requests with values that you configure. All CORS settings may be configured in your application's config/cors.php configuration file. The OPTIONS requests will automatically be handled by the HandleCors middleware that is included by default in your global middleware stack. Your global middleware stack is located in your application's HTTP kernel (App\Http\Kernel).
        </p>

        <li>Route Caching</li>
        <p>
            When deploying your application to production, you should take advantage of Laravel's route cache. Using the route cache will drastically decrease the amount of time it takes to register all of your application's routes. To generate a route cache, execute the route:cache Artisan command: $-* php artisan route:cache 
            <br>
            After running this command, your cached routes file will be loaded on every request. Remember, if you add any new routes you will need to generate a fresh route cache. Because of this, you should only run the route:cache command during your project's deployment. 
            <br>
            You may use the route:clear command to clear the route cache: $-* php artisan route:clear
        </p>
    </ol>
</body>
</html>
