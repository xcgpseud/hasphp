# HasPHP

#### Type-strict iterable lists with functional functionality provided to them.

There are 2 primary ideas behind this library.

1. To provide a way of specifying a type to elements of an array within PHP and forcing adherence to this.

2. To provide a series of functional implementations to an iterable type within PHP.

With HasPHP, these have been combined.

##### Installation
> To come in the future; this will be a composer package when it's in a usable state.

##### Contributing
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
