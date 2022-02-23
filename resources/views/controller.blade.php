<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <style>
        li{font-weight: bold; font-family: Helvetica; margin: 10px 0 0 0}
        p{margin: 5px 0px 15px 0px; font-family: arial}
        table, td{border: 1px solid black; border-collapse:collapse; padding: 5px}
    </style>
</head>
<body>
    <h1>3 - Controller</h1>
    <ol>
        <li>Introduction</li>
        <p>
            Instead of defining all of your request handling logic as closures in your route files, you may wish to organize this behavior using "controller" classes. Controllers can group related request handling logic into a single class. For example, a UserController class might handle all incoming requests related to users, including showing, creating, updating, and deleting users. By default, controllers are stored in the app/Http/Controllers directory.
        </p>
        
        <li>Single Action Controller</li>
        <ul>
            <li>__invoke</li>
            <p>
                If a controller action is particularly complex, you might find it convenient to dedicate an entire controller class to that single action. To accomplish this, you may define a single __invoke method within the controller.
                <br>
                When registering routes for single action controllers, you do not need to specify a controller method. Instead, you may simply pass the name of the controller to the router.
                <br>
                You may generate an invokable controller by using the --invokable option of the make:controller Artisan command:
                <br>
                php artisan make:controller ProvisionServer --invokable
            </p>
        </ul>

        <li>Controller Middleware</li>
        <p>
            Middleware may be assigned to the controller's routes in your route files:
            <br>
            Or, you may find it convenient to specify middleware within your controller's constructor. Using the middleware method within your controller's constructor, you can assign middleware to the controller's actions.
            <br>
            Controllers also allow you to register middleware using a closure. This provides a convenient way to define an inline middleware for a single controller without defining an entire middleware class
        </p>
        
        <li>Resource Controller</li>
        <p>
            If you think of each Eloquent model in your application as a "resource", it is typical to perform the same sets of actions against each resource in your application. For example, imagine your application contains a Photo model and a Movie model. It is likely that users can create, read, update, or delete these resources.
            <br>
            Because of this common use case, Laravel resource routing assigns the typical create, read, update, and delete ("CRUD") routes to a controller with a single line of code. To get started, we can use the make:controller Artisan command's --resource option to quickly create a controller to handle these actions:
            <br>
            php artisan make:controller PhotoController --resource
            <br>
            This command will generate a controller at app/Http/Controllers/PhotoController.php. The controller will contain a method for each of the available resource operations. Next, you may register a resource route that points to the controller.
            <br>
            This single route declaration creates multiple routes to handle a variety of actions on the resource. The generated controller will already have methods stubbed for each of these actions. Remember, you can always get a quick overview of your application's routes by running the route:list Artisan command.
            <br>
            You may even register many resource controllers at once by passing an array to the resources method.
        </p>
        
        <li>Actions Handled By Resource controller</li>
        <p>
            <table>
                <thead>
                    <tr>
                        <th>Verb</th>
                        <th>URI</th>
                        <th>Action</th>
                        <th>Route Name</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>GET</td>
                        <td>/photos</td>
                        <td>index</td>
                        <td>photos.index</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>/photos/create</td>
                        <td>create</td>
                        <td>photos.create</td>
                    </tr>
                    <tr>
                        <td>POST</td>
                        <td>/photos</td>
                        <td>store</td>
                        <td>photos.store</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>/photos/{photo}</td>
                        <td>show</td>
                        <td>photos.show</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>/photos/{photo}/edit</td>
                        <td>edit</td>
                        <td>photos.edit</td>
                    </tr>
                    <tr>
                        <td>PUT/PATCH</td>
                        <td>/photos/{photo}</td>
                        <td>update</td>
                        <td>photos.update</td>
                    </tr>
                    <tr>
                        <td>DELETE</td>
                        <td>/photos/{photo}</td>
                        <td>destroy</td>
                        <td>photos.destroy</td>
                    </tr>
                </tbody>
            </table>
        </p>

        <li>Customizing Missing Model Behaviour</li>
        <p>
            Typically, a 404 HTTP response will be generated if an implicitly bound resource model is not found. However, you may customize this behavior by calling the missing method when defining your resource route. The missing method accepts a closure that will be invoked if an implicitly bound model can not be found for any of the resource's routes
        </p>

        <li>Specifying The Resource Model</li>
        <p>
            If you are using route model binding and would like the resource controller's methods to type-hint a model instance, you may use the --model option when generating the controller:
            <br>
            php artisan make:controller PhotoController --model=Photo --resource
        </p>

        <li>Generating Form Requests</li>
        <p>
            You may provide the --requests option when generating a resource controller to instruct Artisan to generate form request classes for the controller's storage and update methods:
            <br>
            php artisan make:controller PhotoController --model=Photo --resource --requests
        </p>

        <li>Partial Resource Route</li>
        <p>
            When declaring a resource route, you may specify a subset of actions the controller should handle instead of the full set of default actions.
        </p>

        <li>API Resource Routes</li>
        <p>
            When declaring resource routes that will be consumed by APIs, you will commonly want to exclude routes that present HTML templates such as create and edit. For convenience, you may use the apiResource method to automatically exclude these two routes.
            <br>
            You may register many API resource controllers at once by passing an array to the apiResources method.
            <br>
            To quickly generate an API resource controller that does not include the create or edit methods, use the --api switch when executing the make:controller command:
            <br>
            php artisan make:controller PhotoController --api
        </p>

        <li>Nested Routes</li>
        <p>
            Sometimes you may need to define routes to a nested resource. For example, a photo resource may have multiple comments that may be attached to the photo. To nest the resource controllers, you may use "dot" notation in your route declaration:
            <br>
            This route will register a nested resource that may be accessed with URIs like the following: /photos/{photo}/comments/{comment}
        </p>
        <ul>
            <li>Scoping Nested Resources</li>
            <li>Shallow Nesting</li>
        </ul>

        <li>Naming Resource Routes</li>
        <p>
            By default, all resource controller actions have a route name; however, you can override these names by passing a names array with your desired route names
        </p>

        <li>Naming Resource Routes Parametes</li>
        <p>
            By default, Route::resource will create the route parameters for your resource routes based on the "singularized" version of the resource name. You can easily override this on a per resource basis using the parameters method. The array passed into the parameters method should be an associative array of resource names and parameter names.
            <br>
            The example above generates the following URI for the resource's show route: /users/{admin_user}
        </p>

        <li>Scoping Resource Routes</li>

        <li>Localizing Resource URIs</li>
        <p>
            By default, Route::resource will create resource URIs using English verbs. If you need to localize the create and edit action verbs, you may use the Route::resourceVerbs method. This may be done at the beginning of the boot method within your application's App\Providers\RouteServiceProvider.
        </p>
        
        <li>Supplementing Resource Controller</li>
        <p>
            If you need to add additional routes to a resource controller beyond the default set of resource routes, you should define those routes before your call to the Route::resource method; otherwise, the routes defined by the resource method may unintentionally take precedence over your supplemental routes.
        </p>

        <li>Dependency Injecition and Controllers</li>
        <ul>
            <li>Constructor Injection</li>
            <p>
                The Laravel service container is used to resolve all Laravel controllers. As a result, you are able to type-hint any dependencies your controller may need in its constructor. The declared dependencies will automatically be resolved and injected into the controller instance.
            </p>

            <li>Method Injection</li>
            <p>
                In addition to constructor injection, you may also type-hint dependencies on your controller's methods. A common use-case for method injection is injecting the Illuminate\Http\Request instance into your controller methods.
                <br>
                If your controller method is also expecting input from a route parameter, list your route arguments after your other dependencies.
            </p>
            
        </ul>
        
    </ol>
</body>
</html>
