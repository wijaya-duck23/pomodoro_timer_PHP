<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session History | <?= APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <header class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800"><?= APP_NAME ?></h1>
            <nav class="mt-4">
                <ul class="flex justify-center space-x-6">
                    <li><a href="/" class="text-gray-600 hover:text-blue-600 transition">Timer</a></li>
                    <li><a href="/history" class="text-blue-600 font-medium border-b-2 border-blue-600">History</a></li>
                </ul>
            </nav>
        </header>

        <main class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Your Session History</h2>
            
            <?php if (isset($sessions) && !empty($sessions)): ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Time</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Time</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration (min)</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($sessions as $session): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            <?php 
                                            echo match($session->session_type) {
                                                'focus' => 'bg-green-100 text-green-800',
                                                'short_break' => 'bg-blue-100 text-blue-800',
                                                'long_break' => 'bg-purple-100 text-purple-800',
                                                default => 'bg-gray-100 text-gray-800'
                                            }; 
                                            ?>">
                                            <?= ucfirst(str_replace('_', ' ', $session->session_type)) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= date('h:i:s A', strtotime($session->start_time)) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= date('h:i:s A', strtotime($session->end_time)) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= $session->duration_min ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= date('M d, Y', strtotime($session->created_at)) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="bg-gray-50 p-4 rounded text-center">
                    <p class="text-gray-600">No sessions recorded yet. Start using the timer to track your productivity!</p>
                </div>
            <?php endif; ?>
        </main>
    </div>
</body>
</html> 