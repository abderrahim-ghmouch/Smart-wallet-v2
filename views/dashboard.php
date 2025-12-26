<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-900 min-h-screen p-4">
    

    <div class="max-w-7xl mx-auto">
        

        <header class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-white">Finance Dashboard</h1>
                    <p class="text-gray-400">Track your income and expenses</p>
                </div>
                <div class="flex space-x-4">
                    <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 flex items-center space-x-2">
                        <i class="fas fa-plus"></i>
                        <span>Add Income</span>
                    </button>
                    <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 flex items-center space-x-2">
                        <i class="fas fa-minus"></i>
                        <span>Add Expense</span>
                    </button>
                    <button class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center space-x-2">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </div>
            </div>
        </header>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            

            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-400">Current Balance</p>
                        <h2 class="text-3xl font-bold text-white mt-2">$0.00</h2>
                        <p class="text-gray-500 mt-2 text-sm">No transactions yet</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-wallet text-white text-xl"></i>
                    </div>
                </div>
            </div>


            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-400">Total Income</p>
                        <h2 class="text-3xl font-bold text-green-400 mt-2">$0.00</h2>
                        <p class="text-gray-500 mt-2 text-sm">Add your first income</p>
                    </div>
                    <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-money-bill-wave text-white text-xl"></i>
                    </div>
                </div>
            </div>

   
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-400">Total Expenses</p>
                        <h2 class="text-3xl font-bold text-red-400 mt-2">$0.00</h2>
                        <p class="text-gray-500 mt-2 text-sm">Add your first expense</p>
                    </div>
                    <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-shopping-cart text-white text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

 
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                <h3 class="text-xl font-bold text-white mb-6">Income vs Expenses</h3>
                <div class="h-64 flex items-center justify-center border border-gray-700 rounded-lg">
                    <p class="text-gray-500">Chart will appear here</p>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                <h3 class="text-xl font-bold text-white mb-6">Recent Transactions</h3>
                <div class="space-y-4">
                    <!-- Transaction items will go here -->
                    <div class="text-center py-8 border border-gray-700 rounded-lg">
                        <i class="fas fa-exchange-alt text-gray-600 text-4xl mb-4"></i>
                        <p class="text-gray-500">No transactions yet</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                <h3 class="text-xl font-bold text-white mb-4">Add Income</h3>
                <p class="text-gray-400 mb-4">Track your earnings and revenue</p>
                <button class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 flex items-center justify-center space-x-2">
                    <i class="fas fa-plus"></i>
                    <span>Add New Income</span>
                </button>
            </div>

            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                <h3 class="text-xl font-bold text-white mb-4">Add Expense</h3>
                <p class="text-gray-400 mb-4">Track your spending and costs</p>
                <button class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 flex items-center justify-center space-x-2">
                    <i class="fas fa-minus"></i>
                    <span>Add New Expense</span>
                </button>
            </div>
        </div>

        <!-- Logout Button -->
        <div class="mt-8 text-center">
            <button class="bg-gray-800 text-white px-6 py-3 rounded-lg hover:bg-gray-700 flex items-center space-x-2 mx-auto">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </div>

    </div>

</body>
</html>