#!/bin/bash

# Check if remote origin already exists
if git remote | grep -q "^origin$"; then
  echo "Remote origin already exists."
  echo "Please remove it with 'git remote remove origin' if you want to reinitialize."
  exit 1
fi

# Get GitHub username
read -p "Enter your GitHub username: " username
if [ -z "$username" ]; then
  echo "Username cannot be empty."
  exit 1
fi

# Get repository name (default: pomodoro-timer)
read -p "Enter repository name [pomodoro-timer]: " repo_name
repo_name=${repo_name:-pomodoro-timer}

# Initialize git if not already initialized
if [ ! -d .git ]; then
  echo "Initializing git repository..."
  git init
fi

# Add all files
git add .

# Create initial commit
git commit -m "Initial commit: Pomodoro Timer Application"

# Create GitHub repository using GitHub CLI if available
if command -v gh &> /dev/null; then
  echo "Creating GitHub repository using GitHub CLI..."
  gh repo create "$username/$repo_name" --private --source=. --remote=origin
else
  # Set origin to GitHub repository
  echo "Setting up remote origin..."
  git remote add origin "https://github.com/$username/$repo_name.git"
  
  echo "Please create the repository '$repo_name' on GitHub:"
  echo "https://github.com/new"
  echo "Then push with: git push -u origin main"
fi

echo "Done! Your Pomodoro Timer is ready for GitHub."
echo "Repository: https://github.com/$username/$repo_name" 