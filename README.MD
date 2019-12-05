# Introduction
This is bespoke site for creating researches and data collection via polls anonymously or using authentication.

This site is not complete. Project was postponed and may never be resumed. This is why I'm making it public. Maybe it's going to be useful to someone else.

## What's done
1. Site build with Laravel 6.0 and MySQL, but can support any driver like sqlite.
2. Easy installation process to get you up and running

## Todo
1. Frontend
2. Research builder backend

# Requirements
Node, npm, php 7.2, MySQL (optional)

# Installation

After checking out project run

```bash
composer install
``` 

Copy environment file from example

```bash
cp .env.example .env
``` 

Edit .env file

1. Set **APP_URL**
2. Configure database
	1. For **MySQL** change **DB_USERNAME** and **DB_PASSWORD**. Make sure **DB_DATABASE** exists
	2. For file based option change **DB_CONNECTION** to **sqlight**
3. If you are planning to use mailing change **MAIL_*** settings

Genetate autoload files

```bash
composer dump-autoload
```

Import database

Change username and password in **database/seeds/AdminUsers.php**

```bash
php artisan migrate:fresh --seed
```

# How it works

You can create a research and then link it to a poll. You can link multiple polls to a single research. This is useful when you want to make consecutive polls and compare results.

There's no proper research builder at the moment. However you can create migration file or insert values into DB directly.

# Usage with test data

1. After instalation open **/admin/login** and enter credentials from **database/seeds/AdminUsers.php** file.
2. Click **Poll** and then **Create**
3. Create poll form
    1. Select research from drop down
    2. **Anonymous poll** allow users complete poll without providing email address
    3. **Allow users to share poll** after finishing poll uses can provide email addresses and share
4. Copy poll URL

# Set up your own research

## Create a research

Available via backend **/admin/research**

## Build a research

Check how to build research in seed file
**database/seeds/ResearchExample.php**

## Create a poll

Available via backend **/admin/poll**

## Share

Copy a link from poll page and share
