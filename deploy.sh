#!/bin/bash
set -e

# Build the frontend assets
npm run build

# Create a directory for GitHub Pages
mkdir -p docs

# Copy built assets 
cp -R public/build/* docs/

# Copy static assets from the public folder
cp -R public/assets docs/assets

# Commit and push to the main branch
git add docs
git commit -m "Deploy frontend to GitHub Pages"
git push origin main
