# What's the purpose of this package? 🤔

This package helps you to categorize messages into four types as follows: `danger`, `warning`, `success` and `normal`.

You can set ***Flash Messages*** and retrieve them along with automatic deletion.

# How to install 😃

**Initially, you need to have the *[composer](https://composer.org)* installed.**

To install this package, follow the command:

```
composer require am-mokhtari/alert-manager
```

# How to use 😵

## The functions in use, follow as below:

- Alert::addNormal(string $message, bool $isFlash)
- Alert::addSuccess(string $message, bool $isFlash)
- Alert::addWarning(string $message, bool $isFlash)
- Alert::addDanger(string $message, bool $isFlash)

This kind of functions is applicable to both regular `alerts` and `flash messages`.

This is to **add** a message to the group of alerts.

**If your message is considered as a flash message, you can assign a `true` value to `$isflash`.**

### Regular *alerts* functions

- Alert::getNormal()
- Alert::getSuccess()
- Alert::getWarning()
- Alert::getDanger()

This kind applies to receive all messages known as the mentioned type.
The output would be of type **array**.

----

- Alert::all()

This function retrieves all messages as a **multidimensional array**.

----

- Alert::pullNormal()
- Alert::pullWarning()
- Alert::pullDanger()
- Alert::pullSuccess()

These functions retrieve messages as the mentioned type and remove them automatically.

The output would be of type **array**.

----

- Alert::pullAll()

This function retrieves all messages and removes them automatically.

The output would be **multidimensional array**.

----

- Alert::forgetNormalOne(int $key)
- Alert::forgetWarningOne(int $key)
- Alert::forgetDangerOne(int $key)
- Alert::forgetSuccessOne(int $key)

These functions remove the mentioned type message belonging to the `$key`.

The output would be **true**.

----

- Alert::forgetNormal()
- Alert::forgetSuccess()
- Alert::forgetWarning()
- Alert::forgetDanger()

These functions remove the mentioned type messages.

The output would be **true**.

----

- Alert::forgetAll()

This function removes all messages.

The output would be **true**.

### The following functions are used for *flash messages*:

- Alert::pullNormalFlashes()
- Alert::pullSuccessFlashes()
- Alert::pullWarningFlashes()
- Alert::pullDangerFlashes()

These functions retrieve Flash Messages as the mentioned type and delete them automatically.

The output would be of type **array**.

----

- Alert::pullAllFlashes()

This function retrieves all Flash Messages and removes them automatically.

The output would be **multidimensional array**.

# Contributing 🤝

To contribute this project, `fork` the project and share it with me after the changes in a `pull request`.

**Thankful** ✨
