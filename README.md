Laravel Real-Time Chat App
A simple real-time chat application built with Laravel, Pusher, and Blade templating. This app demonstrates how to send and receive live chat messages using Laravel Echo and Pusher channels.

Features
Real-time message broadcasting with Pusher

User authentication (Laravel default)

Clean UI using Blade components and Tailwind CSS

Auto-scrolling chat window for new messages

Message persistence in database with Eloquent models

Requirements
PHP 8.x

Laravel 9.x or 10.x

Composer

Node.js & npm

Pusher account (free tier works)

MySQL or other supported database

Installation
Clone the repository

bash
Copy
Edit
git clone https://github.com/yourusername/laravel-chat-app.git
cd laravel-chat-app
Install dependencies

bash
Copy
Edit
composer install
npm install
npm run dev
Setup environment

Copy .env.example to .env and update:

env
Copy
Edit
APP_NAME=LaravelChat
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password

BROADCAST_DRIVER=pusher
PUSHER_APP_ID=your_pusher_app_id
PUSHER_APP_KEY=your_pusher_app_key
PUSHER_APP_SECRET=your_pusher_app_secret
PUSHER_APP_CLUSTER=your_pusher_cluster
Run migrations

bash
Copy
Edit
php artisan migrate
Run the application

bash
Copy
Edit
php artisan serve
Usage
Register and login to the app

Navigate to /chat to enter the chat room

Send messages and see real-time updates from other users instantly

Broadcasting
This app uses Laravel Echo with Pusher for real-time broadcasting.

Laravel Echo listens on chat-channel

Events broadcast as message.sent

Messages are sent to others using the MessageSent event

Make sure your Pusher credentials are correctly configured in .env.

Folder Structure
app/Events/MessageSent.php — Event broadcast class

app/Http/Controllers/ChatsController.php — Chat logic

resources/views/chat.blade.php — Blade view for chat room

resources/js/echo.js — Echo setup and event listener (imported in app.js)

routes/web.php — Route for chat

License
MIT License — feel free to use and modify.

