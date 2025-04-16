document.addEventListener('DOMContentLoaded', function() {
    // DOM elements
    const timerDisplay = document.getElementById('timer');
    const startBtn = document.getElementById('startBtn');
    const pauseBtn = document.getElementById('pauseBtn');
    const resetBtn = document.getElementById('resetBtn');
    const sessionTypeSelect = document.getElementById('sessionType');
    const motivationalText = document.getElementById('motivationalText');

    // Timer variables
    let countdown;
    let timerRunning = false;
    let secondsRemaining = 0;
    let originalSeconds = 0;
    let startTime = null;
    
    // Session durations in seconds
    const sessionDurations = {
        'focus': 25 * 60,        // 25 minutes
        'short_break': 5 * 60,   // 5 minutes
        'long_break': 15 * 60    // 15 minutes
    };
    
    // Motivational messages by session type
    const motivationalMessages = {
        'focus': [
            'Time to focus on your work!',
            'Stay on task and eliminate distractions.',
            'Deep work leads to great results!',
            'Concentrate on one thing at a time.'
        ],
        'short_break': [
            'Take a short break. Stretch, breathe, relax.',
            'A quick break helps maintain productivity.',
            'Rest your eyes and mind for a moment.'
        ],
        'long_break': [
            'Time for a longer break. You earned it!',
            'Use this time to recharge completely.',
            'Step away from your work space for a bit.'
        ]
    };

    // Initialize timer based on selected session type
    function initializeTimer() {
        const sessionType = sessionTypeSelect.value;
        secondsRemaining = sessionDurations[sessionType];
        originalSeconds = secondsRemaining;
        updateTimerDisplay();
        
        // Update motivational text
        const messages = motivationalMessages[sessionType];
        motivationalText.textContent = messages[Math.floor(Math.random() * messages.length)];
    }

    // Update the timer display
    function updateTimerDisplay() {
        const minutes = Math.floor(secondsRemaining / 60);
        const seconds = secondsRemaining % 60;
        
        timerDisplay.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        
        // Update document title
        document.title = `${timerDisplay.textContent} - Pomodoro Timer`;
    }

    // Start the countdown
    function startTimer() {
        if (timerRunning) return;
        
        if (secondsRemaining <= 0) {
            initializeTimer();
        }
        
        timerRunning = true;
        startBtn.classList.add('hidden');
        pauseBtn.classList.remove('hidden');
        
        // Record start time if not already set
        if (!startTime) {
            startTime = new Date().toISOString();
        }
        
        countdown = setInterval(function() {
            secondsRemaining--;
            updateTimerDisplay();
            
            if (secondsRemaining <= 0) {
                completeTimer();
            }
        }, 1000);
    }

    // Pause the countdown
    function pauseTimer() {
        clearInterval(countdown);
        timerRunning = false;
        startBtn.classList.remove('hidden');
        pauseBtn.classList.add('hidden');
    }

    // Reset the countdown
    function resetTimer() {
        clearInterval(countdown);
        timerRunning = false;
        startTime = null;
        startBtn.classList.remove('hidden');
        pauseBtn.classList.add('hidden');
        initializeTimer();
    }

    // Handle timer completion
    function completeTimer() {
        // Play notification sound (a simple beep)
        const audio = new Audio('data:audio/wav;base64,UklGRnoGAABXQVZFZm10IBIAAAAHAAEAQB8AAEAfAAABAAgAAABMSVNUKAAAAENVRUyCCAAARUdOUgoAAABQVUJMSVNIRVISAAAAU09VTkQgRk9SIEZVTl8xMDAwTElTVFQCAABJTkZPSUNSRBIAAABTT1VORCBGT1IgRlVOXzEwMDBJR05SMAgAAABBVkFJTC4yMUlTRlQkAAAATEF2ZjU5LjI3LjEwMCBbMHhdMDAzM0YwQkUgWzB4MDA4MEJEMDBdZGF0YR4GAACBAE2BrHzBgY+EEYE+hHGGZoPbgJODMYkMiViFj37eeUaBFYzGlF+SjYrNhUWEUYOJgVR8ZHg0evuAa4VJgxJ9XXiKeAp9g4KDiPmNg4+tjQaKN4c7hkeHhodOhgaEXYIng66DP4Qrg6eAfH09eYp3IXcMeLt5pnoHfHx+RYDHgL1/FX4UfNl6/Xm6eYV5nXmxekl8+H3qfkd/yn9GgPSAGIL3gpKDQoTOhBOFCoXvhO6FHIcHiOCHO4ahhEaE14PZgrSAwn9NfqV9k3y3evJ4QneadTh0QnOoc+J0jnYjeNN5vnqqe0V8f3z9fN19Tn6WflJ+o33MfEV8O3yofN19WH+mgNqBEYP8hDeHCIpOjO6NNY+wj1KP5I6VjnqOg46cjfCL3YkBh+eD0YD0fTh8LHvbeXt4CXfAdl53e3lFfKh+yICaggyEBoXBhHGDTIJIgY6AVoBMgJF/E37Qe8d5TncBddxy+3Cbb7tuVW4VbqJuKm/pb85xnXOCdGV00nMlc2NyBXJJciRzn3TRdjR6cX56gsWGSovvj4yUX5j+mjub2JkwluiR8o3JisaJ74ktiyWMpYwCjcKM4YvVirmJMYiahj+F4oN6gpp/NH1veoZ3UnRQcRBvoW22awpqn2nCaqttXXEgdUl3DnnOep58Fn6Cf1WA+4Ahgc+Bd4KOg4iEVYVNhh2IAJD9l9+ePKVarCax/rMxs4Ox/q60rCerbqpcqwKt3654sca0ircvuZW6kruOvAO+1b9qwu7FYMkKzE7Nss2nzhPSwNbB2jzd4t1W3V3ceNvo2l7aQ9oA2n7Z8Ni62Rrd6uEw5uLpi+wV7sru9u7u8Pvz2fYk+Uf6w/pm+tD5MvmN+BP4Ifej9sf1L/Q78mLvo+zj6oToBOcd5jnmIect6CzpBOot65Ls4O1B767wUfKh9Dj3YfqB/TsAxgJrBQoIxgrgDWkQBRL8Ei8TChMkE90S+BH2EAAR2BC9ECMQKw/bDdQL1wiJBUUCh/9U/a/7YvoA+V/35vVo9N/y2fHt8D/wE/AB8MvvmO9W72XvZO+h77zvdO+d74bwoPJk9GT2gvh9+jD8lP2N/tX/jwEjA6cERQaxBzsJGQtgDF8NMw4tD7QPchC8EXMTvhT9FfYWthePF+wWKRWVE2oS0RL4ExAV7RUKFhcWthWeFC0ThhGJEL0P+A9mEKkQyRCWEXIS/BKbExQU3BS8FcMWuhfvGT0dNSJjJi8qqi0lMM8x/DJ5MuQwVC+ULWMrVCnNKNAozijPKI4puSoZLGUtyS7oL1cw/y8NL4QteivXKecniSXCIiwg4h1sG5YZGhnuGQ0bGhyLHfseoSAMIhUjBCRxJFYkKCS+I6QifSGdIIUfGh7BHJUbNxp+GO8WwhTOEX4OMguLCIUF/AK5AMH+Wf0v/Cj76vmK+Lj3efat9ZD0QPSm9Iz0r/Nj8sXw7O/t713wkfA18A3wJfDW7zfvO+/z7nHuNO337LPsB+yD677rUex3677rUa');
        audio.play();
        
        pauseTimer();
        
        // Save session data
        const sessionType = sessionTypeSelect.value;
        const endTime = new Date().toISOString();
        const durationMin = Math.round(originalSeconds / 60);
        
        // Only save if more than 0 seconds were completed
        if (startTime && originalSeconds > 0) {
            saveSession(sessionType, startTime, endTime, durationMin);
        }
        
        // Reset for next session
        startTime = null;
        
        // Show notification
        if (Notification.permission === 'granted') {
            new Notification('Pomodoro Timer', { 
                body: `Your ${sessionType.replace('_', ' ')} session is complete!`,
                icon: '/favicon.ico'
            });
        }
    }
    
    // Save session to database
    function saveSession(sessionType, startTime, endTime, durationMin) {
        const formData = new FormData();
        formData.append('session_type', sessionType);
        formData.append('start_time', startTime);
        formData.append('end_time', endTime);
        formData.append('duration_min', durationMin);
        
        fetch('/api/save-session', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Session saved successfully');
            } else {
                console.error('Failed to save session:', data.message);
            }
        })
        .catch(error => {
            console.error('Error saving session:', error);
        });
    }

    // Event listeners
    startBtn.addEventListener('click', startTimer);
    pauseBtn.addEventListener('click', pauseTimer);
    resetBtn.addEventListener('click', resetTimer);
    sessionTypeSelect.addEventListener('change', resetTimer);
    
    // Request notification permission
    if (Notification.permission !== 'granted' && Notification.permission !== 'denied') {
        Notification.requestPermission();
    }
    
    // Initialize the timer on page load
    initializeTimer();
}); 