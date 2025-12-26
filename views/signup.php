
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <title>sign up</title>
</head>

<body class="bg-gray-900 min-h-screen flex items-center justify-center p-4">

    <form class="flex flex-col w-full max-w-md bg-gray-800 rounded-lg p-6 shadow-lg" 
        action="../Controllers/signup.php" method="POST">
        
        <h1 class="text-2xl font-bold text-white mb-6 text-center">Create Account</h1>

        <div class="flex flex-col gap-4 mb-6">
            
            <div>
                <label for="username" class="block text-sm font-medium mb-1 text-gray-300">
                    Username
                </label>
                <input type="text" id="username" name="username" 
                       class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:border-blue-500 text-white"
                       placeholder="Enter username"
                       required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium mb-1 text-gray-300">
                    Email
                </label>
                <input type="email" id="email" name="email" 
                       class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:border-blue-500 text-white"
                       placeholder="you@example.com"
                       required>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium mb-1 text-gray-300">
                    Password
                </label>
                <input type="password" id="password" name="password" 
                       class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:border-blue-500 text-white"
                       placeholder="••••••••"
                       required>
            </div>

            <div>
                <label for="passwordConfirm" class="block text-sm font-medium mb-1 text-gray-300">
                    Confirm Password
                </label>
                <input type="password" id="passwordConfirm" name="passwordConfirm" 
                       class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:border-blue-500 text-white"
                       placeholder="••••••••"
                       required>
            </div>

        </div>

        <button type="submit" 
                class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded transition mb-4">
            Sign Up
        </button>

        <p class="text-gray-400 text-sm text-center">
            Already have an account? 
            <a href="/views/login.php" class="text-blue-400 hover:text-blue-300">Sign In</a>
        </p>

    </form>

</body>

</html>