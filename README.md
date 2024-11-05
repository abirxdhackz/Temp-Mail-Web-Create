# 📬 PHP Temp Mail Website

**⚠️ DISCLAIMER: This project is for educational and ethical use only. Misusing temporary email services for unauthorized or malicious activities is strictly prohibited. Use responsibly.**

---

## 🛡️ Project Overview
This **Temp Mail Website** allows users to create disposable email addresses, providing a layer of privacy for situations requiring temporary accounts. This project includes:
- **Main Application**: Uses `bot.php` to handle incoming emails via webhook.
- **Helper Library**: `lib.php` contains functions for managing email requests, creating temporary addresses, and deleting them as needed.

---

## 📂 File Descriptions

### `bot.php`
This file:
- Manages the core logic for generating and handling temporary emails.
- Processes webhook requests for incoming messages or deletes expired emails.
- Interfaces with the email service API to send, receive, or delete messages.

### `lib.php`
This file contains:
- Helper functions to support `bot.php` and simplify the code.
- Functions for interacting with APIs, such as:
  - **Generating unique temporary email addresses.**
  - **Handling inboxes and storing messages.**
  - **Deleting expired or used email addresses.**

---

## ✨ Key Features

- **Instant Email Generation**: Users can create disposable emails on the spot.
- **Auto-Deletes After Time Limit**: Cleans up expired inboxes to prevent clutter.
- **Webhook-Enabled**: Automatically processes incoming emails for each temp email address.

---

## 📋 Prerequisites

- **PHP 7.0 or higher** installed.
- Access to an **email API** that supports temporary email management (such as Temp-Mail.org, 1secmail, etc.).
- **Webhook URL** for receiving and processing incoming messages automatically.

---

## 🔧 Setup Instructions

### 1. Configuring `bot.php`
1. Open `bot.php` in a text editor.
2. Update the configuration for the email API (API keys, endpoint URLs, etc.).
   ```php
   $apiKey = 'YOUR_EMAIL_API_KEY';
   $apiUrl = 'https://api.temp-mail.org/request/';
   ```
3. Add any additional configurations, such as time limits for temporary emails.

### 2. Setting Up `lib.php`
1. Ensure `lib.php` includes necessary functions to:
   - Generate a new email.
   - Check for incoming emails on the generated address.
   - Delete the temp email address after a set time or upon user action.

### 3. Testing Locally
To test the application on your local machine:
1. Place `bot.php` and `lib.php` in the same directory.
2. Start a PHP server:
   ```bash
   php -S localhost:8000
   ```
3. Open `http://localhost:8000/bot.php` to test the interface for creating and managing temp emails.

---
Also Create A admin **Folder** And Under It Create A Another Folder **Users** 
## 🌐 Hosting Options

To deploy this application online, use any of the following PHP-compatible hosting options:

### **1. 000webhost**
- Upload `bot.php` and `lib.php` to the public_html folder.
- Configure your webhook URL (see below) using your domain.

### **2. InfinityFree**
- Sign up and upload the files to the htdocs directory.
- Set your webhook URL with the InfinityFree-provided domain.

### **3. Heroku (Using PHP Buildpack)**
- Install the Heroku CLI and deploy with:
   ```bash
   git init
   git add .
   git commit -m "Initial commit"
   heroku create --buildpack heroku/php
   git push heroku main
   ```

---

## 🔄 Setting Up Webhook

To configure a webhook for automatic processing of incoming emails:

1. **Set Up the Webhook URL**:
   - Define a webhook URL that points to your `bot.php` file on the server.
   - Example: `https://yourdomain.com/bot.php`

2. **Configure Webhook with the Email API**:
   - Log in to your email API service (e.g., Temp-Mail).
   - Set up the webhook by inputting your webhook URL in the API settings.
   - This setup tells the API to notify `bot.php` whenever an email arrives.

3. **Handle Incoming Webhook Requests**:
   - Ensure `bot.php` is configured to process `POST` requests sent by the API.
   - Sample code snippet:
     ```php
     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         $data = json_decode(file_get_contents('php://input'), true);
         // Process incoming email data
         handleIncomingEmail($data); // A function in lib.php to handle the email
     }
     ```

4. **Testing the Webhook**:
   - Send a test email to the generated temp address.
   - Confirm that the email arrives and triggers `bot.php` to handle the message.

---

## ⚖️ Legal Disclaimer

Use of this temporary email system must comply with all applicable laws. Misusing temporary emails for unauthorized activities is strictly prohibited. **The authors are not liable for any misuse of this project.**
