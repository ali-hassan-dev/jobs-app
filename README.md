# Jobs App

Welcome to the Jobs Listings App repository! Authenticated users can effortlessly post, edit, and delete their job listings, while unauthenticated users have the ability to browse through the available job opportunities and contact the employers. The app also features a tag-based filtering system to streamline the process of finding relevant job listings.

## Table of Contents

1. [Running Locally](#running-locally)
1. [Tech Stack](#tech-stack)
1. [Features](#features)

## Running Locally

1. Clone this repo
1. `cd jobs-app`
1. `composer install`
1. `cp .env.example .env`
1. `php artisan migrate`
1. `php artisan db:seed`
1. `php artisan serve`

## Tech Stack

1. Laravel
1. Tailwind
1. MySQL

## Features

1. User Authentication: Secure user authentication system ensures that only authorized users can post, edit, and delete job listings.
1. Job Listings: Authenticated users can create, edit, and remove job listings, providing comprehensive details about the job opportunities.
1. View Only Mode: Unauthenticated users can view the job listings but are unable to perform any modifications.
1. Tag-Based Filtering: Users can efficiently search for jobs by using tags, making it easier to find suitable job openings.
1. Responsive UI: The application is built with a responsive design using Tailwind CSS, ensuring optimal user experience across devices.
