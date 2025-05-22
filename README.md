# Laravel Real-Time Chat App

A simple real-time chat app built with Laravel, Pusher, and Blade templating.  
It demonstrates live chat using Laravel Echo and Pusher channels.

---

## Features

- Real-time message broadcasting with Pusher  
- User authentication (Laravel default)  
- Clean UI with Blade components and Tailwind CSS  
- Auto-scrolling chat window for new messages  
- Messages saved in database with Eloquent models  

---

## Requirements

- PHP 8.x  
- Laravel 9.x or 10.x  
- Composer  
- Node.js & npm  
- Pusher account (free tier works)  
- MySQL or other supported DB  

---

## Installation

1. Clone the repo:  
   ```bash
   git clone https://github.com/yourusername/laravel-chat-app.git
   cd laravel-chat-app

composer install
npm install
npm run dev

## Setup environment:
Copy .env.example to .env and update these values:

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

Run migrations:

php artisan migrate

Start the server:

php artisan serve


## Usage
Register or login

Visit /chat

Send messages and see real-time updates

Broadcasting
Uses Laravel Echo with Pusher

Listens on chat-channel

Broadcasts message.sent events

Messages sent via MessageSent event

Make sure Pusher keys in .env are correct

Important Files
app/Events/MessageSent.php — Broadcast event

app/Http/Controllers/ChatsController.php — Chat logic

resources/views/chat.blade.php — Chat UI Blade view

resources/js/echo.js — Echo config & listener

routes/web.php — Routes

# License
MIT License — free to use and modify.
