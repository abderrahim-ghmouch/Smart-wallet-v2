<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 min-h-screen flex items-center justify-center p-4">

    <form class="flex flex-col w-full max-w-md bg-gray-800 rounded-lg p-6 shadow-lg" 
          action="../Controllers/login.php" method="POST">
        
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-white mb-2">Welcome Back</h1>
            <p class="text-gray-400 text-sm">Sign in to your account</p>
        </div>

        <div class="flex flex-col gap-4 mb-6">
            
            <div>
                <label for="email" class="block text-sm font-medium mb-1 text-gray-300">
                    Email Address
                </label>
                <input type="email" id="email" name="email" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:border-blue-500 text-white"placeholder="you@example.com"
                       required>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium mb-1 text-gray-300">
                    Password
                </label>
                <input type="password" id="password" name="password" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:border-blue-500 text-white"
                       placeholder="••••••••"
                       required>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="w-4 h-4 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 text-blue-600">


                    <label for="remember" class="ml-2 text-sm text-gray-300">
                        Remember me
                    </label>
                </div>
            >

        </div>

        <button type="submit" 
                class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded transition mb-4">
            Sign In
        </button>

        <div class="text-center">
            <p class="text-gray-400 text-sm">
                Don't have an account? 
                <a href="signup.php" class="text-blue-400 hover:text-blue-300 font-medium">Sign Up</a>
            </p>
        </div>

    </form>

</body>

</html>