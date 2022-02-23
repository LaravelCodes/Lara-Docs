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
    <h1>4 - Request</h1>
    <ol>
        <li>Introduction</li>
        <p>
            Laravel's Illuminate\Http\Request class provides an object-oriented way to interact with the current HTTP request being handled by your application as well as retrieve the input, cookies, and files that were submitted with the request.
        </p>
        
        <li>Interacting With The Request</li>
        <ul>
            <li>Accessing the Requesy</li>
            <p>
                To obtain an instance of the current HTTP request via dependency injection, you should type-hint the Illuminate\Http\Request class on your route closure or controller method. The incoming request instance will automatically be injected by the Laravel service container.
            </p>
        </ul>

        <li>Dependency Injection And Route Parameters</li>
        <p>
            If your controller method is also expecting input from a route parameter you should list your route parameters after your other dependencies.
        </p>
        
        <li>Request Path and Method</li>
        <p>
            The Illuminate\Http\Request instance provides a variety of methods for examining the incoming HTTP request and extends the Symfony\Component\HttpFoundation\Request class. We will discuss a few of the most important methods below.
        </p>
        <ul>
            <li>Retrieving the Request Path</li>
            <p>
                The path method returns the request's path information. So, if the incoming request is targeted at http://example.com/foo/bar, the path method will return foo/bar.
            </p>

            <li>Inspecting the Current Request / Path</li>
            <p>
                The is method allows you to verify that the incoming request path matches a given pattern. You may use the * character as a wildcard when utilizing this method.
                <br>
                Using the routeIs method, you may determine if the incoming request has matched a named route.
            </p>

            <li>Retrieving The Request URL</li>
            <p>
                To retrieve the full URL for the incoming request you may use the url or fullUrl methods. The url method will return the URL without the query string, while the fullUrl method includes the query string.
                <br>
                If you would like to append query string data to the current URL, you may call the fullUrlWithQuery method. This method merges the given array of query string variables with the current query string.
            </p>

            <li>Retrieving the Request method</li>
            <p>
                The method method will return the HTTP verb for the request. You may use the isMethod method to verify that the HTTP verb matches a given string.
            </p>
        </ul>

        <li>Request Headers</li>
        <p>
            You may retrieve a request header from the Illuminate\Http\Request instance using the header method. If the header is not present on the request, null will be returned. However, the header method accepts an optional second argument that will be returned if the header is not present on the request.
            <br>
            The hasHeader method may be used to determine if the request contains a given header:
            <br>
            For convenience, the bearerToken method may be used to retrieve a bearer token from the Authorization header. If no such header is present, an empty string will be returned:
            <br>
            The ip method may be used to retrieve the IP address of the client that made the request to your application:
        </p>

        <li>Content Negotiation</li>
        <p>
            MUST LEARN....
        </p>

        <li>PSR-7 Request</li>
        <p>
            MUST LEARN....
        </p>

        <li>Input</li>
        <ul>
            <li>Retrieving Input</li>
            <p>
                You may retrieve all of the incoming request's input data as an array using the all method. This method may be used regardless of whether the incoming request is from an HTML form or is an XHR request:
                <br>
                Using the collect method, you may retrieve all of the incoming request's input data as a collection:
                <br>
                The collect method also allows you to retrieve a subset of the incoming request input as a collection.
            </p>

            <li>Retrieving An Input Value</li>
            <p>
                Using a few simple methods, you may access all of the user input from your Illuminate\Http\Request instance without worrying about which HTTP verb was used for the request. Regardless of the HTTP verb, the input method may be used to retrieve user input:
                <br>
                ou may pass a default value as the second argument to the input method. This value will be returned if the requested input value is not present on the request
                <br>
                When working with forms that contain array inputs, use "dot" notation to access the arrays:
                <br>
                You may call the input method without any arguments in order to retrieve all of the input values as an associative array:
            </p>

            <li>Retrieving Input From The Query String</li>
            <p>
                While the input method retrieves values from the entire request payload (including the query string), the query method will only retrieve values from the query string:
                <br>
                If the requested query string value data is not present, the second argument to this method will be returned:
                <br>
                You may call the query method without any arguments in order to retrieve all of the query string values as an associative array:
            </p>

            <li>Retrieving JSON Input Values</li>
            <p>
                When sending JSON requests to your application, you may access the JSON data via the input method as long as the Content-Type header of the request is properly set to application/json. You may even use "dot" syntax to retrieve values that are nested within JSON arrays:
            </p>

            <li>Retrieving Boolean Input Values</li>
            <p>
                When dealing with HTML elements like checkboxes, your application may receive "truthy" values that are actually strings. For example, "true" or "on". For convenience, you may use the boolean method to retrieve these values as booleans. The boolean method returns true for 1, "1", true, "true", "on", and "yes". All other values will return false:
            </p>

            <li>Retrieving Date Input Values</li>
            <p>
                For convenience, input values containing dates / times may be retrieved as Carbon instances using the date method. If the request does not contain an input value with the given name, null will be returned:
                <br>
                The second and third arguments accepted by the date method may be used to specify the date's format and timezone, respectively:
                <br>
                If the input value is present but has an invalid format, an InvalidArgumentException will be thrown; therefore, it is recommended that you validate the input before invoking the date method.
            </p>

            <li>Retrieving Input Via Dynamic Properties</li>
            <p>
                For convenience, input values containing dates / times may be retrieved as Carbon instances using the date method. If the request does not contain an input value with the given name, null will be returned:
                <br>
                The second and third arguments accepted by the date method may be used to specify the date's format and timezone, respectively:
                <br>
                If the input value is present but has an invalid format, an InvalidArgumentException will be thrown; therefore, it is recommended that you validate the input before invoking the date method.
            </p>
            
        </ul>
                
    </ol>
</body>
</html>
