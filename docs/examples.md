# Examples

Here are some examples of what you can do with Seperax PHP :)

## contains()
```
// Only PHP:
str_contains('Hello World', 'World'); // String
in_array('World', ['Hello', 'World']); // Array

// PHP with Seperax PHP:
contains('Hello World', 'World'); // String
contains(['Hello', 'World'], 'World'); // Array
// -> The same function
```

## starts_with()
```
// Only PHP:
$startsWith = substr("abcdefg", 0, 3) === "abc";

// PHP with Seperax PHP:
$startsWith = starts_with("abcdefg", "abc");
```

## ends_with()
```
// Only PHP:
$endsWith = substr("abcdefg", -3) === "efg";

// PHP with Seperax PHP:
$endsWith = ends_with("abcdefg", "efg");
```

That are simple examples.  
There is much more that Seperax PHP simplifies for you, like PDO Connections or sanitizing and validating user input.