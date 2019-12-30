# HasPHP

#### Type-strict iterable lists with functional functionality provided to them.

There are 2 primary ideas behind this library.

1. To provide a way of specifying a type to elements of an array within PHP and forcing adherence to this.

2. To provide a series of functional implementations to an iterable type within PHP.

With HasPHP, these have been combined.

#### Installation
> To come in the future; this will be a composer package when it's in a usable state.

---

#### Usage
HasPhp will ensure that any items in the initial array are the same type as the one
specified. When using Objects - it will ensure that they are all the same type
as the first in the array.

Here are a few usage examples:

> To get all odd numbers between 0 and 200, multiply them by 2 and
> retrieve the sum of said numbers

```php
\HasPhp\Types\Ints::with(range(0, 200))
    ->filter(fn (int $i): bool => $i % 2 != 0)
    ->map(fn (int $i): int => $i * 2)
    ->sum();
```

> To get all people above the age of 18
```php
\HasPhp\Types\Objects::with($peopleArray)
    ->filter(fn (Person $x): bool => $x->getAge() > 18);
```

Functions such as `map` and `filter` return an IterList so you can chain more
functions on to the end. In order to retrieve the array, use `->get()`

**All functions**

| Function | Signature                      | Strings | Ints | Objects | Description |
| -------- | -------------                  | :-----: | :--: | :-----: | :---------: |
| `Abs`    | `[a] -> [a] `                  | No      | Yes  |   No    | Return an IterList containing absolute values of the initial list. |
| `All`    | `[a] -> (a -> bool) -> bool`   | Yes     | Yes  |   Yes   | Returns true if the predicate applies to every element in the initial list. |

---

#### Contributing
- Fork the Repository
- Clone your repository
- Run `composer install` to install the composer packages required
- Add functions as a Trait in the `src/Functions` folder
- Be sure to add the `@mixin` PHPDoc comment, hinting that it is a mixin for IterList
- `use` the Trait on each of the Types it is valid for, see `src/Types/Ints.php` and copy if unsure.
- Add tests in `tests/Functions` - copy the layout of an existing one using the TestBuilder if possible.
- Adhere to PHP7.4 (arrow functions etc.) as I'd like to force myself to use the latest version wherever possible!
- Push your branch up to your forked repository and create a Pull Request into mine.
- Once tests pass, it'll be reviewed :)

**There is currently no documentation for HasPHP but keep an eye open as I plan to add this soon.**
**This will change the contributing guidelines.**
