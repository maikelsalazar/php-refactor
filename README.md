# PHP Refactor

A collection of **PHP refactoring exercises** showcasing clean code practices, incremental improvement, and test-driven development.

Each exercise includes:
- The **original implementation** (`src/E0X...`)
- A **refactored solution** (`src/E0X.../Solution`)
- A **dedicated test suite** for both versions (`tests/E0X...`)

## 📁 Project Structure

```
src/
└── E01DiscountCalculator/
├──── DiscountCalculator.php # Exercise to be refactored
└──── Solution/
└──────── DiscountCalculator.php # Refactored version

tests/
└── E01DiscountCalculator/
├──── DiscountCalculatorDataProvider.php # Shared data provider
├──── DiscountCalculatorTest.php # Tests for original code
└──── Solution/
└──────── DiscountCalculatorTest.php # Tests for refactored code
```

## ⚙️ Setup
This project uses [Composer](https://getcomposer.org/) for dependency management.

```bash
# Install dependencies
composer install
```

## 🧪 Run Tests
Run [PHPUnit](https://phpunit.de/) manually:
```bash
./vendor/bin/phpunit tests
```
Or using the Composer script:
```bash
composer test
```

## 🧹 Run Linter
This project uses [PHP-CS-Fixer](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer) for code style formatting

Run manually:
```bash
vendor/bin/php-cs-fixer fix
```

Or using the Composer script:
```bash
composer fix
```

## 🧠 Goal

The goal of this repository is to practice **clean code** and **refactoring techniques** using small, focused examples.

Each exercise highlights:
- Improving readability and design.
- Removing duplication.
- Applying **SOLID principles**.
- Writing maintainable, testable code.
- Encouraging the use of **Domain-Driven Design (DDD)** concepts.

## 🤝 Contributing
Contributions are welcome!  
Feel free to open a pull request to:

- Suggest a new exercise, or  
- Propose an alternative solution for an existing exercise.

## 🪪 License
This project is open source under the MIT License.
