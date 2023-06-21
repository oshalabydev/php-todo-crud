# Todo CRUD App

## Running

> Note: An XAMPP installation is expected.

Put the app files in `<xampp_dir>/htdocs/`, run all the servers using the XAMPP manager app.

Go to `http://localhost` (The port and the path are system dependant, we expect that you know your way around).

## Database Configuration

To run the app, you need a database. The app is using MySQL. Run phpMyAdmin, create a new database with a new table (For this app, use a table of name: `tasks`, you can choose another name, but make sure you modify the source code to support this new name).

Here is the table configuration used:

| Property | Type                          | Maximum | Extra                          |
| -------- | ----------------------------- | ------- | ------------------------------ |
| id       | INT                           | 11      | Primary, Auto Increment        |
| body     | VARCHAR                       | 25      | --                             |
| isdone   | BOOLEAN (Technically TINYINT) | --      | --                             |
| date     | DATETIME                      | --      | Default: `current_timestamp()` |

After initializing the database with phpMyAdmin, create a file called `db/config.php`:

```php
<?php

define("DB_HOST", "<db_host>"); // optional, default is localhost
define("DB_USER", "<db_user>"); // optional, default is root
define("DB_PASS", "<db_pass>");
define("DB_NAME", "<db_name>");
```

> Note that DB_HOST and DB_USER are optional.
