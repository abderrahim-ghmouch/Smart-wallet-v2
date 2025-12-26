<?php

require_once __DIR__ . "/../Models/Database.php";
require_once __DIR__ . "/../Models/Category.php";
require_once __DIR__ ."/../Models/Transfer.php";
require_once __DIR__ . "/../Models/Income.php";
require_once __DIR__ . "/../Models/Expense.php";

session_start();
if (!isset($_SESSION["user_id"])) {
    header("location:/views/login.php");
}
;

$category = new category();
$categories = $category->getAll();

$income = new income();
$incomes = $income->getAllTranfer("incomes");
$totalincomes=$income->total("incomes");

$expense = new expense();
$expences = $expense->getAllTranfer("expences");

$totalexpences=$expense->total("expences");

$balance=$totalincomes-$totalexpences;

if(isset($_POST["filterIncome"])){
    $category = $_POST["filterIncome"];
    if($category === "all"){
        $incomes = $income->getAllTranfer("incomes");
    }else{
        $incomes = $expense->filterTransfer('incomes',$category);
    }
}

if(isset($_POST["filterExpence"])){
    $category = $_POST["filterExpence"];
    if($category === "all"){
        $expences = $income->getAllTranfer("expences");
    }else{
        $expences = $expense->filterTransfer('expences',$category);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Wallet</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-900 min-h-screen p-4">

    <div id="blurOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-40"></div>

    <div id="expenseForm"
        class="hidden fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-gray-800 rounded-xl p-6 w-full max-w-sm border border-gray-700 z-50">
        <div class="absolute top-4 right-4 text-gray-400 hover:text-white cursor-pointer" onclick="hideExpenseForm()">
            <i class="fas fa-times text-xl"></i>
        </div>
        <h2 class="text-xl font-bold text-white mb-6 text-center">Add Expense</h2>
        <form class="space-y-4" action="../Controllers/expense.php" method="POST">
            <div>
                <label class="block text-sm text-gray-300 mb-1">Amount ($)</label>
                <input required type="number" step="0.01" name="amount"
                    class="w-full px-3 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white"
                    placeholder="0.00" required>
            </div>
            <div>
                <label class="block text-sm text-gray-300 mb-1">Description</label>
                <textarea required name="description"
                    class="w-full px-3 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white"
                    placeholder="What was this expense for?" rows="3"></textarea>
            </div>
            <div>
                <label class="block text-sm text-gray-300 mb-1">Date</label>
                <input required type="date" name="date"
                    class="w-full px-3 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white" required>
            </div>
            <div>
                <label class="block text-sm text-gray-300 mb-1">Category</label>
                <select required name="category"
                    class="w-full px-3 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white">
                    <option value="" disabled selected>Select category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= $category['namecategory'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <button type="submit" name="add"
                class="w-full bg-gradient-to-r from-red-600 to-red-700 text-white py-3 rounded-lg font-medium hover:from-red-700 hover:to-red-800 transition">
                Add Expense
            </button>
        </form>
    </div>

    <!-- Update Expense Form -->
    <div id="updateExpenseForm"
        class="hidden fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-gray-800 rounded-xl p-6 w-full max-w-sm border border-gray-700 z-50">
        <div class="absolute top-4 right-4 text-gray-400 hover:text-white cursor-pointer" onclick="hideUpdateExpenseForm()">
            <i class="fas fa-times text-xl"></i>
        </div>
        <h2 class="text-xl font-bold text-white mb-6 text-center">Update Expense</h2>
        <form class="space-y-4" action="../Controllers/expense.php" method="POST">
            <input type="hidden" name="id" required id="updateExpenseId">
            <div>
                <label class="block text-sm text-gray-300 mb-1">Amount ($)</label>
                <input required type="number" step="0.01" name="amount" id="updateExpenseAmount"
                    class="w-full px-3 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white"
                    placeholder="0.00" required>
            </div>
            <div>
                <label class="block text-sm text-gray-300 mb-1">Description</label>
                <textarea required name="description" id="updateExpenseDescription"
                    class="w-full px-3 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white"
                    placeholder="What was this expense for?"rows="3"></textarea>
            </div>
            <div>
                <label class="block text-sm text-gray-300 mb-1">Date</label>
                <input required type="date" name="date" id="updateExpenseDate"
                    class="w-full px-3 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white" required>
            </div>
            <div>
                <label class="block text-sm text-gray-300 mb-1">Category</label>
                <select required  name="category" id="updateExpenseCategory"
                    class="w-full px-3 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white">
                    <option  value="" disabled>Select category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= $category['namecategory'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <button type="submit" name="update"
                class="w-full bg-gradient-to-r from-green-600 to-green-700 text-white py-3 rounded-lg font-medium hover:from-green-700 hover:to-green-800 transition">
                Update Expense
            </button>
        </form>
    </div>

    <div id="incomeForm"
        class="hidden fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-gray-800 rounded-xl p-6 w-full max-w-sm border border-gray-700 z-50">
        <div class="absolute top-4 right-4 text-gray-400 hover:text-white cursor-pointer" onclick="hideIncomeForm()">
            <i class="fas fa-times text-xl"></i>
        </div>
        <h2 class="text-xl font-bold text-white mb-6 text-center">Add Income</h2>
        <form class="space-y-4" action="../Controllers/income.php" method="POST">
            <div>
                <label class="block text-sm text-gray-300 mb-1">Amount ($)</label>
                <input required type="number" step="0.01" name="amount"
                    class="w-full px-3 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white"
                    placeholder="0.00" required>
            </div>
            <div>
                <label class="block text-sm text-gray-300 mb-1">Description</label>
                <textarea  required name="description"
                    class="w-full px-3 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white"
                    placeholder="What is this income for?" rows="3"></textarea>
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">Date</label>
                <input required type="date" name="date"
                    class="w-full px-3 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white" required>
            </div>
            <div>
                <label class="block text-sm text-gray-300 mb-1">Category</label>
                <select required name="category"
                    class="w-full px-3 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white">
                    <option  value="" disabled selected>Select category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= $category['namecategory'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <button type="submit" name="add"
                class="w-full bg-gradient-to-r from-green-600 to-green-700 text-white py-3 rounded-lg font-medium hover:from-green-700 hover:to-green-800 transition">
                Add Income
            </button>
        </form>
    </div>

    
    <div id="updateIncomeForm"
        class="hidden fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-gray-800 rounded-xl p-6 w-full max-w-sm border border-gray-700 z-50">
        <div class="absolute top-4 right-4 text-gray-400 hover:text-white cursor-pointer" onclick="hideUpdateIncomeForm()">
            <i class="fas fa-times text-xl"></i>
        </div>
        <h2 class="text-xl font-bold text-white mb-6 text-center">Update Income</h2>
        <form class="space-y-4" action="../Controllers/income.php" method="POST">
            <input type="hidden" name="id" id="updateIncomeId">
            <div>
                <label class="block text-sm text-gray-300 mb-1">Amount ($)</label>
                <input type="number" step="0.01" name="amount" id="updateIncomeAmount"
                    class="w-full px-3 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white"
                    placeholder="0.00" required>
            </div>
            <div>
                <label class="block text-sm text-gray-300 mb-1">Description</label>
                <textarea name="description" id="updateIncomeDescription"
                    class="w-full px-3 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white"
                    placeholder="What is this income for?" rows="3"></textarea>
            </div>
            <div>
                <label class="block text-sm text-gray-300 mb-1">Date</label>
                <input type="date" name="date" id="updateIncomeDate"
                    class="w-full px-3 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white" required>
            </div>
            <div>
                <label class="block text-sm text-gray-300 mb-1">Category</label>
                <select required name="category" id="updateIncomeCategory"
                    class="w-full px-3 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white">
                    <option value="" disabled>Select category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= $category['namecategory'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <button type="submit" name="update"
                class="w-full bg-gradient-to-r from-green-600 to-green-700 text-white py-3 rounded-lg font-medium hover:from-green-700 hover:to-green-800 transition">
                Update Income
            </button>
        </form>
    </div>


    <div class="max-w-7xl mx-auto relative z-10">
        <header class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-white">Smartwallet</h1>
                    <p class="text-gray-400">Track your income and expenses</p>
                </div>
                <div class="flex space-x-4">
                    <button onclick="showIncomeForm()"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 flex items-center space-x-2">
                        <i class="fas fa-plus"></i>
                        <span>Add Income</span>
                    </button>
                    <button onclick="showExpenseForm()"
                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 flex items-center space-x-2">
                        <i class="fas fa-minus"></i>
                        <span>Add Expense</span>
                    </button>
                    <a href="../Controllers/logout.php"
                        class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center space-x-2">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-400">Current Balance</p>
                        <h2 class="text-3xl font-bold text-white mt-2"><?=$balance?></h2>
                  
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
                        <h2 class="text-3xl font-bold text-green-400 mt-2">$<?=$totalincomes?></h2>
                        
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
                        <h2 class="text-3xl font-bold text-red-400 mt-2">$<?= $totalexpences?></h2>
   
                    </div>
                    <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-shopping-cart text-white text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Income and Expenses Display Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Income Section -->
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-white">Income</h3>
                    <form action="" method="post" onchange="this.submit()">
                        <select required name="filterIncome"
                            class="w-[50%] px-3 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white">
                            <option value="" disabled selected>Select category</option>
                            <option value="all">All</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"><?= $category['namecategory'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </form>
                </div>

                <div class="space-y-4 max-h-96 overflow-y-auto">
                    <?php if (empty($incomes)): ?>
                        <div class="text-center py-8">
                            <i class="fas fa-money-bill-wave text-gray-600 text-4xl mb-4"></i>
                            <p class="text-gray-500">No income recorded yet</p>
                            <p class="text-gray-400 text-sm mt-2">Add your first income to get started</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($incomes as $income): ?>
    <div class="flex justify-between items-center bg-gray-900 p-4 rounded-lg border border-gray-700">
        <div>
            <p class="text-white font-semibold">$<?= $income['amount'] ?></p>
            <p class="text-gray-400 text-sm">
                <?= $income['namecategory'] ?> • <?= $income['dateIncomes'] ?>
            </p>
        </div>

        <div class="flex gap-2">
            <button onclick="showUpdateIncomeForm(
             
                
                '<?= $income['id'] ?>',
                '<?= $income['amount'] ?>',
                '<?= $income['income_description'] ?>',
                '<?= $income['dateIncomes'] ?>',
                  '<?= $income['category_income'] ?>'
            )"
            class="px-3 py-1 bg-green-600 text-white rounded text-sm">
                Update
            </button>

            <form action="../Controllers/income.php" method="post">
                <input type="hidden" name="id" value="<?= $income['id'] ?>">
                <button name="delete"
                        class="px-3 py-1 bg-red-600 text-white rounded text-sm">
                    Delete
                </button>
            </form>
        </div>
    </div>
<?php endforeach ?>

                    <?php endif; ?>
                </div>      

                <div class="mt-6">
                    <button onclick="showIncomeForm()"
                        class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 flex items-center justify-center space-x-2">
                        <i class="fas fa-plus"></i>
                        <span>Add New Income</span>
                    </button>
                </div>
            </div>

            <!-- Expense Section -->
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-white">Expenses</h3>
                    <form action="" method="post" onchange="this.submit()">
                        <select required name="filterExpence"
                            class="w-[50%] px-3 py-2.5 bg-gray-900 border border-gray-700 rounded-lg text-white">
                            <option value="" disabled selected>Select category</option>
                            <option value="all" >All</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"><?= $category['namecategory'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </form>
                </div>

                <div class="space-y-4 max-h-96 overflow-y-auto">
                    <?php if (empty($expences)): ?>
                        <div class="text-center py-8">
                            <i class="fas fa-shopping-cart text-gray-600 text-4xl mb-4"></i>
                            <p class="text-gray-500">No expenses recorded yet</p>
                            <p class="text-gray-400 text-sm mt-2">Add your first expense to get started</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($expences as $expense): ?>
                            <div class="flex justify-between items-center bg-gray-900 p-4 rounded-lg border border-gray-700">
                                <div>
                                    <p class="text-white font-semibold">$<?= $expense['amount'] ?></p>
                                    <p class="text-gray-400 text-sm">
                                        <?= $expense['namecategory'] ?> • <?= $expense['dateExpenses'] ?>
                                    </p>
                                </div>

                                <div class="flex gap-2">
                                    <button  onclick="showUpdateExpenseForm(
                                        '<?= $expense['id'] ?>',
                                        '<?= $expense['amount'] ?>',
                                        '<?= $expense['expenses_description'] ?>',
                                        '<?= $expense['dateExpenses'] ?>',
                                        '<?= $expense['category_expense'] ?>'
                                    )"
                                    class="px-3 py-1 bg-green-600 text-white rounded text-sm">
                                        Update
                                    </button>

                                    <form action="../Controllers/expense.php" method="post">
                                        <input type="hidden" name="id" value="<?= $expense['id'] ?>">
                                        <button name="delete"
                                                class="px-3 py-1 bg-red-600 text-white rounded text-sm">
                                            Delete
                                        </button>
                                    </form>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div class="mt-6">
                    <button onclick="showExpenseForm()"
                        class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 flex items-center justify-center space-x-2">
                        <i class="fas fa-minus"></i>
                        <span>Add New Expense</span>
                    </button>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const today = new Date().toISOString().split('T')[0];
            const dateInputs = document.querySelectorAll('input[type="date"]');
            dateInputs.forEach(input => {
                input.value = today;
            });
        });

        function showExpenseForm() {
            document.getElementById('blurOverlay').classList.remove('hidden');
            document.getElementById('expenseForm').classList.remove('hidden');
        }

        function hideExpenseForm() {
            document.getElementById('blurOverlay').classList.add('hidden');
            document.getElementById('expenseForm').classList.add('hidden');
        }

        function showUpdateExpenseForm(id, amount, description, date, categoryId) {
            document.getElementById('updateExpenseId').value = id;
            document.getElementById('updateExpenseAmount').value = amount;
            document.getElementById('updateExpenseDescription').value = description || '';
            document.getElementById('updateExpenseDate').value = date;
            document.getElementById('updateExpenseCategory').value = categoryId;
            
            document.getElementById('blurOverlay').classList.remove('hidden');
            document.getElementById('updateExpenseForm').classList.remove('hidden');
        }

        function hideUpdateExpenseForm() {
            document.getElementById('blurOverlay').classList.add('hidden');
            document.getElementById('updateExpenseForm').classList.add('hidden');
        }

        function showIncomeForm() {
            document.getElementById('blurOverlay').classList.remove('hidden');
            document.getElementById('incomeForm').classList.remove('hidden');
        }

        function hideIncomeForm() {
            document.getElementById('blurOverlay').classList.add('hidden');
            document.getElementById('incomeForm').classList.add('hidden');
        }

        function showUpdateIncomeForm(id, amount, description, date, categoryId) {
            document.getElementById('updateIncomeId').value = id;
            document.getElementById('updateIncomeAmount').value = amount;
            document.getElementById('updateIncomeDescription').value = description || '';
            document.getElementById('updateIncomeDate').value = date;
            document.getElementById('updateIncomeCategory').value = categoryId;
            
            document.getElementById('blurOverlay').classList.remove('hidden');
            document.getElementById('updateIncomeForm').classList.remove('hidden');
        }

        function hideUpdateIncomeForm() {
            document.getElementById('blurOverlay').classList.add('hidden');
            document.getElementById('updateIncomeForm').classList.add('hidden');
        }

        document.getElementById('blurOverlay').addEventListener('click', function () {
            hideExpenseForm();
            hideIncomeForm();
            hideUpdateExpenseForm();
            hideUpdateIncomeForm();
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                hideExpenseForm();
                hideIncomeForm();
                hideUpdateExpenseForm();
                hideUpdateIncomeForm();
            }
        });
    </script>
</body>

</html>