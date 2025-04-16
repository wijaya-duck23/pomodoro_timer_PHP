<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pomodoro Timer | <?= APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <header class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800"><?= APP_NAME ?></h1>
            <nav class="mt-4">
                <ul class="flex justify-center space-x-6">
                    <li><a href="/" class="text-blue-600 font-medium border-b-2 border-blue-600">Timer</a></li>
                    <li><a href="/history" class="text-gray-600 hover:text-blue-600 transition">History</a></li>
                </ul>
            </nav>
        </header>

        <main class="max-w-lg mx-auto bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-center mb-4">
                <select id="sessionType" class="block w-full max-w-xs px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="focus" selected>Focus (25 min)</option>
                    <option value="short_break">Short Break (5 min)</option>
                    <option value="long_break">Long Break (15 min)</option>
                </select>
            </div>
            
            <div class="text-center mb-8">
                <div id="timer" class="text-7xl font-bold text-gray-800 my-8">25:00</div>
                
                <div id="motivationalText" class="text-gray-600 italic mb-6">
                    Time to focus on your work!
                </div>
                
                <div class="flex justify-center space-x-4">
                    <button id="startBtn" class="px-6 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Start
                    </button>
                    <button id="pauseBtn" class="px-6 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 hidden">
                        Pause
                    </button>
                    <button id="resetBtn" class="px-6 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Reset
                    </button>
                </div>
            </div>
            
            <?php if (isset($stats) && $stats): ?>
            <div class="border-t pt-4 mt-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-3">Your Statistics</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-blue-50 p-3 rounded">
                        <p class="text-sm text-gray-600">Total Focus Sessions</p>
                        <p class="text-xl font-bold"><?= $stats->focus_count ?? 0 ?></p>
                    </div>
                    <div class="bg-green-50 p-3 rounded">
                        <p class="text-sm text-gray-600">Total Minutes Focused</p>
                        <p class="text-xl font-bold"><?= $stats->total_minutes ?? 0 ?></p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </main>
    </div>

    <script src="<?= URL_ROOT ?>/assets/js/timer.js"></script>
</body>
</html> 