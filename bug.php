In PHP, a common yet often overlooked error involves improper handling of object references, particularly when dealing with objects passed as arguments to functions or methods.  Consider this example:

```php
class MyClass {
    public $value = 0;
}

function modifyObject(MyClass $obj) {
    $obj->value = 10;
}

$myObject = new MyClass();
modifyObject($myObject);
echo $myObject->value; // Outputs 10
```

This seems straightforward. However, if you change the function to:

```php
function modifyObject(MyClass $obj) {
    $obj = new MyClass(); // Creates a *new* object
    $obj->value = 10;
}

$myObject = new MyClass();
modifyObject($myObject);
echo $myObject->value; // Outputs 0
```

The output is now 0.  The problem is that within `modifyObject`, a new object is created.  The original object referenced by `$myObject` outside the function remains unchanged because the assignment `$obj = new MyClass()` creates a *new* local variable within the function's scope.  The original `$myObject` is untouched.

This subtlety can lead to unexpected behavior, especially in larger applications.  It highlights the importance of understanding PHP's pass-by-reference semantics for objects.  Modifying an object's properties within a function directly modifies the object's state.  However,reassigning the object variable within a function creates a new local object, leaving the original untouched.