
# Terminal

AEForge Terminal component. AEForge terminal component. Providing a way to communicate with PHP application via a console.


## Installation

To install via composer:

```Composer
  composer require aeforge/terminal
```

To clone the project:

```Cloning
    https://github.com/aeforge/Terminal.git
```

## Usage/Examples

### Example
```php
//Message class is used to create an already defined styled text and blocks
use Aeforge\Terminal\Message;
//Terminal is the main class
use Aeforge\Terminal\Terminal;

// Creates a new item and added to the list.
// use {} to create a parameter.
Terminal::Item("myitem {unknown_parameter}", function($unknown_parameter) 
{ 
    echo "The unknown_parameter is : " . $unknown_parameter;
});

Terminal::Item("myitem {unknown_parameter} {another_parameter}", function($unknown_parameter, $another_parameter) 
{ 
    (new Message)::message($unknown_parameter) . (new Message)::message($another_parameter); 
});
// Calling a function
function myFunction($what_the_user_said) { echo $what_the_user_said; }

Terminal::Item("whattext {what_the_user_said}", "myFunction");

//Always call boot at the end to start parsing the terminal items list
Terminal::boot();
```