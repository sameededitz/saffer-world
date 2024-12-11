<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Documentation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        .header {
            margin-bottom: 40px;
        }

        .endpoint {
            margin-bottom: 30px;
        }

        .response-example {
            background-color: #f0f4f7;
            padding: 15px;
            border-radius: 5px;
        }

        .code-block {
            background-color: #2d2d2d;
            color: #f8f8f2;
            padding: 10px;
            border-radius: 5px;
            font-family: monospace;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header text-center">
            <h1>API Documentation</h1>
        </div>

        <!-- Authentication Endpoints -->
        <div class="endpoint">
            <h3>Login</h3>
            <p><strong>URL:</strong> <code>/login</code></p>
            <p><strong>Method:</strong> POST</p>
            <p><strong>Headers:</strong></p>
            <ul>
                <li>Accept: <code>Application/json</code></li>
            </ul>
            <p><strong>Description:</strong> Logs in the user.</p>
            <p><strong>Request Body:</strong></p>
            <ul>
                <li><code>email</code> (string) - Required</li>
                <li><code>password</code> (string) - Required</li>
            </ul>
            <p><strong>Success Response:</strong></p>
            <div class="response-example">
                <pre class="code-block">{
    "status": true,
    "token": "your-authentication-token"
}</pre>
            </div>
            <p><strong>Error Response:</strong></p>
            <div class="response-example">
                <pre class="code-block">{
    "status": false,
    "message": "Invalid credentials."
}</pre>
            </div>
        </div>

        <div class="endpoint">
            <h3>Signup</h3>
            <p><strong>URL:</strong> <code>/signup</code></p>
            <p><strong>Method:</strong> POST</p>
            <p><strong>Headers:</strong></p>
            <ul>
                <li>Accept: <code>Application/json</code></li>
            </ul>
            <p><strong>Description:</strong> Registers a new user.</p>
            <p><strong>Request Body:</strong></p>
            <ul>
                <li><code>name</code> (string) - Required</li>
                <li><code>email</code> (string) - Required</li>
                <li><code>password</code> (string) - Required</li>
                <li><code>password_confirmation</code> (string) - Required</li>
            </ul>
            <p><strong>Success Response:</strong></p>
            <div class="response-example">
                <pre class="code-block">{
    "status": true,
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        ...
    }
}</pre>
            </div>
            <p><strong>Error Response:</strong></p>
            <div class="response-example">
                <pre class="code-block">{
    "status": false,
    "message": "Validation errors."
}</pre>
            </div>
        </div>

        <div class="endpoint">
            <h3>Reset Password</h3>
            <p><strong>URL:</strong> <code>/reset-password</code></p>
            <p><strong>Method:</strong> POST</p>
            <p><strong>Headers:</strong></p>
            <ul>
                <li>Accept: <code>Application/json</code></li>
            </ul>
            <p><strong>Description:</strong> Sends a reset password token to the user's email.</p>
            <p><strong>Request Body:</strong></p>
            <ul>
                <li><code>email</code> (string) - Required</li>
            </ul>
            <p><strong>Success Response:</strong></p>
            <div class="response-example">
                <pre class="code-block">{
    "status": true,
    "message": "Password reset token sent. Please check your email."
}</pre>
            </div>
            <p><strong>Error Response:</strong></p>
            <div class="response-example">
                <pre class="code-block">{
    "status": false,
    "message": "User not found."
}</pre>
            </div>
        </div>

        <div class="endpoint">
            <h3>Reset Password Confirmation</h3>
            <p><strong>URL:</strong> <code>/password/reset</code></p>
            <p><strong>Method:</strong> POST</p>
            <p><strong>Headers:</strong></p>
            <ul>
                <li>Accept: <code>Application/json</code></li>
            </ul>
            <p><strong>Description:</strong> Resets the user's password using a token.</p>
            <p><strong>Request Body:</strong></p>
            <ul>
                <li><code>email</code> (string) - Required</li>
                <li><code>token</code> (string) - Required</li>
                <li><code>password</code> (string) - Required</li>
                <li><code>password_confirmation</code> (string) - Required</li>
            </ul>
            <p><strong>Success Response:</strong></p>
            <div class="response-example">
                <pre class="code-block">{
    "status": true,
    "message": "Password reset successfully"
}</pre>
            </div>
            <p><strong>Error Response:</strong></p>
            <div class="response-example">
                <pre class="code-block">{
    "status": false,
    "message": "Invalid token"
}</pre>
            </div>
        </div>

        <!-- More endpoints can be added similarly -->
        <div class="endpoint">
            <h3>Logout</h3>
            <p><strong>URL:</strong> <code>/logout</code></p>
            <p><strong>Method:</strong> POST</p>
            <p><strong>Headers:</strong></p>
            <ul>
                <li>Accept: <code>Application/json</code></li>
            </ul>
            <p><strong>Description:</strong> Logs out the user.</p>
            <p><strong>Success Response:</strong></p>
            <div class="response-example">
                <pre class="code-block">{
            "status": true,
            "message": "Logged out successfully."
        }</pre>
            </div>
            <p><strong>Error Response:</strong></p>
            <div class="response-example">
                <pre class="code-block">{
            "status": false,
            "message": "Unauthorized."
        }</pre>
            </div>
        </div>

        <div class="endpoint">
            <h3>Add Purchase</h3>
            <p><strong>URL:</strong> <code>/purchase</code></p>
            <p><strong>Method:</strong> POST</p>
            <p><strong>Headers:</strong></p>
            <ul>
                <li>Accept: <code>Application/json</code></li>
            </ul>
            <p><strong>Description:</strong> Adds a new purchase for the authenticated user.</p>
            <p><strong>Request Body:</strong></p>
            <ul>
                <li><code>plan_id</code> (integer) - Required, must exist in the plans table</li>
                <li><code>expires_at</code> (string, date) - Required, must be a date in the future</li>
                <li><code>is_active</code> (boolean) - Required</li>
            </ul>
            <p><strong>Success Response:</strong></p>
            <div class="response-example">
                <pre class="code-block">{
            "status": true,
            "message": "Purchase created successfully!",
            "purchase": {
                "id": 1,
                "plan_id": 3,
                "started_at": "2024-08-31 12:00:00",
                "expires_at": "2025-08-31 12:00:00",
                "is_active": true
            }
        }</pre>
            </div>
            <p><strong>Error Response:</strong></p>
            <div class="response-example">
                <pre class="code-block">{
            "status": false,
            "message": [
                "The selected plan_id is invalid."
            ]
        }</pre>
            </div>
        </div>

        <div class="endpoint">
            <h3>Check Purchase Status</h3>
            <p><strong>URL:</strong> <code>/purchase/status</code></p>
            <p><strong>Method:</strong> POST</p>
            <p><strong>Headers:</strong></p>
            <ul>
                <li>Accept: <code>Application/json</code></li>
            </ul>
            <p><strong>Description:</strong> Retrieves the status of all purchases for the authenticated user.</p>
            <p><strong>Success Response:</strong></p>
            <div class="response-example">
                <pre class="code-block">{
            "status": true,
            "purchases": [
                {
                    "id": 1,
                    "plan_id": 3,
                    "started_at": "2024-08-31 12:00:00",
                    "expires_at": "2025-08-31 12:00:00",
                    "is_active": true
                }
            ]
        }</pre>
            </div>
            <p><strong>Error Response:</strong></p>
            <div class="response-example">
                <pre class="code-block">{
            "status": false,
            "message": "Unauthorized."
        }</pre>
            </div>
        </div>

        <div class="endpoint">
            <h3>Get User Devices</h3>
            <p><strong>URL:</strong> <code>/user/devices</code></p>
            <p><strong>Method:</strong> POST</p>
            <p><strong>Headers:</strong></p>
            <ul>
                <li>Accept: <code>Application/json</code></li>
            </ul>
            <p><strong>Description:</strong> Retrieves all registered devices for the authenticated user.</p>
            <p><strong>Success Response:</strong></p>
            <div class="response-example">
                <pre class="code-block">{
            "status": true,
            "devices": [
                {
                    "device_id": "device123",
                    "device_name": "iPhone 12"
                },
                ...
            ]
        }</pre>
            </div>
            <p><strong>Error Response:</strong></p>
            <div class="response-example">
                <pre class="code-block">{
            "status": false,
            "message": "Unauthorized."
        }</pre>
            </div>
        </div>

        <div class="endpoint">
            <h3>Check Device</h3>
            <p><strong>URL:</strong> <code>/user/check-device</code></p>
            <p><strong>Method:</strong> POST</p>
            <p><strong>Headers:</strong></p>
            <ul>
                <li>Accept: <code>Application/json</code></li>
            </ul>
            <p><strong>Description:</strong> Checks if a device is registered for the authenticated user.</p>
            <p><strong>Request Body:</strong></p>
            <ul>
                <li><code>device_id</code> (string) - Required</li>
            </ul>
            <p><strong>Success Response:</strong></p>
            <div class="response-example">
                <pre class="code-block">{
            "status": true,
            "message": "Device is registered."
        }</pre>
            </div>
            <p><strong>Error Response:</strong></p>
            <div class="response-example">
                <pre class="code-block">{
            "status": false,
            "message": "Device not found."
        }</pre>
            </div>
        </div>

        <div class="endpoint">
            <h3>Delete Device</h3>
            <p><strong>URL:</strong> <code>/user/device/delete</code></p>
            <p><strong>Method:</strong> DELETE</p>
            <p><strong>Headers:</strong></p>
            <ul>
                <li>Accept: <code>Application/json</code></li>
            </ul>
            <p><strong>Description:</strong> Deletes a registered device for the authenticated user.</p>
            <p><strong>Request Body:</strong></p>
            <ul>
                <li><code>device_id</code> (string) - Required</li>
            </ul>
            <p><strong>Success Response:</strong></p>
            <div class="response-example">
                <pre class="code-block">{
            "status": true,
            "message": "Device deleted successfully."
        }</pre>
            </div>
            <p><strong>Error Response:</strong></p>
            <div class="response-example">
                <pre class="code-block">{
            "status": false,
            "message": "Device not found or does not belong to the user."
        }</pre>
            </div>
        </div>

        <div class="endpoint">
            <h3>Get All Servers</h3>
            <p><strong>URL:</strong> <code>/servers</code></p>
            <p><strong>Method:</strong> GET</p>
            <p><strong>Headers:</strong></p>
            <ul>
                <li>Accept: <code>Application/json</code></li>
            </ul>
            <p><strong>Description:</strong> Retrieves all servers available.</p>
            <p><strong>Success Response:</strong></p>
            <div class="response-example">
                <pre class="code-block">{
            "status": true,
            "servers": [
                {
                    "id": 1,
                    "name": "Server 1",
                    "streams": [...]
                },
                ...
            ]
        }</pre>
            </div>
        </div>

        <div class="endpoint">
            <h3>Get All Plans</h3>
            <p><strong>URL:</strong> <code>/plans</code></p>
            <p><strong>Method:</strong> GET</p>
            <p><strong>Headers:</strong></p>
            <ul>
                <li>Accept: <code>Application/json</code></li>
            </ul>
            <p><strong>Description:</strong> Retrieves all available plans.</p>
            <p><strong>Success Response:</strong></p>
            <div class="response-example">
                <pre class="code-block">{
            "status": true,
            "plans": [
                {
                    "id": 1,
                    "name": "Basic Plan",
                    "price": 10.00
                },
                ...
            ]
        }</pre>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
