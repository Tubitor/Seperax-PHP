# Seperax PHP

A PHP Library to make improve your coding experience.

* Much functions for sanitizing and validating user input
* MySQL Class for simpler communication between PHP and MySQL
* Helper functions like `starts_with` or `ends_with`
* More!

## Get started

1. Download the code [here from GitHub](https://github.com/Tubitor/Seperax-PHP/releases)
2. Create a new folder (e.g. `seperax`) in your project
3. Put all files in the `src` folder into the new folder
4. Import Seperax in your project with one line of code:
```
require_once './seperax/seperax.php';
```

The `seperax.php` file will import the other Seperax-files for you :)

## Before you use Seperax-PHP in production

When you download Seperax-PHP, you have all offical addons in your project. To improve performance,
delete the addonds you don't use.

**Required files:**
* seperax.php
* helpers.seperax.php

All other files can simply be deleted. If you want to import an addon back in, just add the file back into the folder.

## PHP Modules

For some addons you need specific PHP Modules enabled. Don't worry, Seperax-PHP won't import addons you can't use.

|Module|Required PHP Modules|
|-|-|
|MySQL|PDO_MySQL|