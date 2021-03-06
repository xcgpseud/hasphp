# HasPHP

#### Type-strict iterable lists with functional functionality provided to them.

There are 2 primary ideas behind this library.

1. To provide a way of specifying a type to elements of an array within PHP and forcing adherence to this.

2. To provide a series of functional implementations to an iterable type within PHP.

With HasPHP, these have been combined.

#### Installation
With composer installed, in your project type:

`composer require xcgpseud/hasphp`

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

Signature is in order of the array within the List -> params -> returns as opposed to Haskell's.

i.e. Haskell's filter is `(a -> bool) -> [a] -> [a]` because it's called like so: `filter (even) [5, 1, 2, 7]`
whereas Hasphp's is `[a] -> (a -> bool) -> [a]` because we define the list prior to the function.

| Function      | Signature                          | Strings | Ints | Objects | Description |
| ------------- | ---------------------------------- | :-----: | :--: | :-----: | :---------: |
| `Abs`         | `[a] -> [a] `                      | No      | Yes  | No      | Return an IterList containing absolute values. |
| `All`         | `[a] -> (a -> bool) -> bool`       | Yes     | Yes  | Yes     | Returns true if the predicate applies to every element. |
| `Any`         | `[a] -> (a -> bool) -> bool`       | Yes     | Yes  | Yes     | Returns true if the predicate applies to any of the elements. |
| `Average`     | `[a] -> a`                         | No      | Yes  | No      | Returns the average of all values. |
| `Break_`      | `[a] -> (a -> bool) -> ([a], [a])` | Yes     | Yes  | Yes     | Returns a tuple of all elements until the first one that matches the predicate, followed by the remaining elements. |
| `Delete`      | `[a] -> a -> [a]`                  | Yes     | Yes  | Yes     | Returns an IterList with the first occurrence of the passed value removed. |
| `Drop`        | `[a] -> Int -> [a]`                | Yes     | Yes  | Yes     | Returns the suffix of xs after the first n elements. |
| `DropWhile`   | `[a] -> (a -> bool) -> [a]`        | Yes     | Yes  | Yes     | Returns the suffix of xs after the predicate's first failure. |
| `Elem`        | `[a] -> a -> bool`                 | Yes     | Yes  | Yes     | Returns true if the IterList contains the element; else false. |
| `Filter`      | `[a] -> (a -> bool) -> [a]`        | Yes     | Yes  | Yes     | Returns and IterList with all of the elements that match the predicate. |
| `Foldl`       | `[b] -> (a -> b -> a) -> a -> a`   | Yes     | Yes  | Yes     | Left fold over the IterList to reduce it to one element with a starting value. |
| `Foldr`       | `[a] -> (a -> b -> b) -> b -> b`   | Yes     | Yes  | Yes     | Right fold over the IterList to reduce it to one element with a starting value. |
| `Foldl1`      | `[a] -> (a -> a -> a) -> a`        | Yes     | Yes  | Yes     | Left fold over the IterList to reduce it to one element. |
| `Foldr1`      | `[a] -> (a -> a -> a) -> a`        | Yes     | Yes  | Yes     | Right fold over the IterList to reduce it to one element. |
| `Group`       | `[a] -> [[a]]`                     | Yes     | Yes  | Yes     | Split the IterList into a Many List of IterLists of equal, adjacent elements. |
| `GroupBy`     | `[a] -> (a -> a -> bool) -> [[a]]` | Yes     | Yes  | Yes     | Split the IterList into a Many List of IterLists of equal, adjacent elements, with a provided equality predicate. |
| `Head`        | `[a] -> a`                         | Yes     | Yes  | Yes     | Returns the first element of the IterList. |
| `Init`        | `[a] -> [a]`                       | Yes     | Yes  | Yes     | Returns the IterList without its last element. |
| `Inits`       | `[a] -> [[a]]`                     | Yes     | Yes  | Yes     | Returns a Many List of initial segments of its argument IterList, shortest first. |
| `Intercalate` | `[a] -> [[a]] -> [a]`              | Yes     | Yes  | Yes     | Returns a Many List with the method receiver List inserted into the IterList at each step. |
| `Intersperse` | `[a] -> a -> [a]`                  | Yes     | Yes  | Yes     | Returns the IterList with the provided element between each element. |
| `Last`        | `[a] -> a`                         | Yes     | Yes  | Yes     | Returns the last element of the IterList. |
| `Length`      | `[a] -> int`                       | Yes     | Yes  | Yes     | Returns the number of elements in the IterList. |
| `Map`         | `[a] -> (a -> bool) -> [a]`        | Yes     | Yes  | Yes     | Returns an IterList with the passed function applied to every element. |
| `Maximum`     | `[a] -> a`                         | Yes     | Yes  | No      | Returns the maximum element from the IterList. |
| `MaximumBy`   | `[a] -> (a -> a -> a) -> a`        | Yes     | Yes  | Yes     | Returns the maximum element from the IterList according to the predicate. |
| `Minimum`     | `[a] -> a`                         | Yes     | Yes  | No      | Returns the minimum element from the IterList. |
| `MinimumBy`   | `[a] -> (a -> a -> a) -> a`        | Yes     | Yes  | Yes     | Returns the minimum element from the IterList according to the predicate. |
| `Nub`         | `[a] -> [a]`                       | Yes     | Yes  | Yes     | Returns the IterList with duplicates removed. |
| `Null`        | `[a] -> bool`                      | Yes     | Yes  | Yes     | Returns true if the IterList is empty; otherwise false. |
| `Sum`         | `[a] -> a`                         | No      | Yes  | No      | Returns the sum of all elements. |
| `Tail`        | `[a] -> [a]`                       | Yes     | Yes  | Yes     | Returns the IterList without its first element. |
| `Take`        | `[a] -> int -> [a]`                | Yes     | Yes  | Yes     | Returns an IterList with only the first n elements, where n is specified. |
| `TakeWhile`   | `[a] -> (a -> bool) -> [a]`        | Yes     | Yes  | Yes     | Returns an IterList with all elements until the predicate fails. |

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
