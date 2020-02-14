# Simple PHP lib for Validation

## Composer Installation

1. Get [Composer](http://getcomposer.org/)
2. Require Raisins Validation with `composer require raisins/validation`
3. Add the following to your application's main PHP file: `require 'vendor/autoload.php';`

## Usage

```php
$email = 'example@email.com';
$username = 'admin';
$password = 'test';
$age = 29;
    
$val = new \Rainsins\Validation();

$val->name('email')->value($email)->pattern('email')->required();
$val->name('username')->value($username)->pattern('alpha')->required();
$val->name('password')->value($password)->customPattern('[A-Za-z0-9-.;_!#@]{5,15}')->required();
$val->name('age')->value($age)->min(18)->max(40);

if(!$val->isSuccess()){
    var_dump($val->getErrors());
}

```

## Add errors message in your language

```php

$val = new \Rainsins\Validation();

$this->val->setErrMsg([
    "pattern" => "Поле {name} інвалід.",
    "required" => "Схоже ти забув що поле {name} є обов'язковим."
]);

$val->name('age')->value(23)->min(18)->max(40);

if(!$val->isSuccess()){
    var_dump($val->getErrors());
}

```

### Origilal errors message array

```php
$errorMsgs = [
    "pattern" => "Invalid {name} field format",
    "required" => "Field {name} is required.",
    "min" => "{name} field value less than the minimum value",
    "max" => "{name} field value greater than the maximum value",
    "equal" => "Field value {name} does not match",
    "maxSize" => "The {name} file exceeds the maximum size of {filesize} MB.",
    "ext" => "The {name} file is not a {extension}."
];
```

## Methods

| Method        | Parameter | Description                                                                 | Example                          |
| ------------- | --------- | --------------------------------------------------------------------------- | -------------------------------- |
| name          | $name     | Return field name                                                           | name('name')                     |
| value         | $value    | Return value field                                                          | value($_POST['name])             |
| file          | $value    | Return $_FILES array                                                        | file($_FILES['name'])            |
| pattern       | $pattern  | Return an error if the input has a different format than the pattern        | pattern('text')                  |
| customPattern | $pattern  | Return an error if the input has a different format than the custom pattern | customPattern('[A-Za-z]')        |
| required      |           | Returns an error if the input is empty                                      | required()                       |
| min           | $length   | Return an error if the input is shorter than the parameter                  | min(10)                          |
| max           | $length   | Return an error if the input is longer than the parameter                   | max(10)                          |
| equal         | $value    | Return an error if the input is not same as the parameter                   | equal($value)                    |
| maxSize       | $value    | Return an error if the file size exceeds the maximum allowable size         | maxSize(3145728)                 |
| ext           | $value    | Return an error if the file extension is not same the parameter             | ext('pdf')                       |
| isSuccess     |           | Return true if there are no errors                                          | isSuccess()                      |
| getErrors     |           | Return an array with validation errors                                      | getErrors()                      |
| displayErrors |           | Return Html errors                                                          | displayErrors()                  |
| result        |           | Return true if there are no errors or html errors                           | result()                         |
| is_int        | $value    | Return true if the value is an integer number                               | is_int(1)                        |
| is_float      | $value    | Return true if the value is an float number                                 | is_float(1.1)                    |
| is_alpha      | $value    | Return true if the value is an alphabetic characters                        | is_alpha('test')                 |
| is_alphanum   | $value    | Return true if the value is an alphanumeric characters                      | is_alphanum('test1')             |
| is_url        | $value    | Return true if the value is an url (protocol is required)                   | is_url('http://www.example.com') |
| is_uri        | $value    | Return true if the value is an uri (protocol is not required)               | is_uri('www.example.com')        |
| is_bool       | $value    | Return true if the value is an boolean                                      | is_bool(true)                    |
| is_email      | $value    | Return true if the value is an e-mail                                       | is_email('email@email.com')      |

## Patterns

| Name     | Description                                                  | Example                           |
| -------- | ------------------------------------------------------------ | --------------------------------- |
| uri      | Url without file extension                                   | folder-1/folder-2                 |
| url      | Uri with file extension                                      | http://www.example.com/myfile.gif |
| alpha    | Only alphabetic characters                                   | World                             |
| words    | Alphabetic characters and spaces                             | Hello World                       |
| alphanum | Alpha-numeric characters                                     | test2016                          |
| int      | Integer number                                               | 154                               |
| float    | Float number                                                 | 1,234.56                          |
| tel      | Telephone number                                             | (+39) 081-777-77-77               |
| text     | Alpha-numeric characters, spaces and some special characters | Test1 ,.():;!@&%?                 |
| file     | File name format                                             | myfile.png                        |
| folder   | Folder name format                                           | my_folde                          |
| address  | Address format                                               | Street Name, 99                   |
| date_dmy | Date in format dd-MM-YYYY                                    | 01-01-2016                        |
| date_ymd | Date in format YYYY-MM-dd                                    | 2016-01-01                        |
| email    | E-Mail format                                                | exampe@email.com                  |
