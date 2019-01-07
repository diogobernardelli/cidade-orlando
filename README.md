# Cidade Orlando

**Cidade Orlando** is a web project for sale and rent of real estate and properties in Orlando and surrounding cities.

## Details:

>URL Production: http://www.cidadeorlando.com.br


## Project Setup
------------------------

### Dependences

- PHP Server (follow <a href="https://secure.php.net/manual/pt_BR/features.commandline.webserver.php" target="_blank">this instructions</a> or <a href="https://stackoverflow.com/questions/1678010/php-server-on-local-machine" target="_blank">this discussions</a>)
 - Git and Git Flow

**Download**

Access via the terminal the location of your projects and download the repository
```bash
$ git clone git@github.com:diogobernardelli/cidade-orlando.git
```

To use the development environment configure Git Flow.
```bash
$ sudo apt-get install git-flow
$ git flow init
```
* Be sure to be in the 'MASTER' branch before running the `git flow init` command, which will automatically take you to the branch 'DEVELOP'

Press Enter for all the options that will be displayed. After that you will already be in the development branch.

**Starting the PHP Server**

To start the PHP server, run this command from the default directory of this project:

```bash
$ php -S localhost:8080
```

## Versioning

> This project follows the [semantic versioning](http://semver.org/lang/pt-BR/)

Given a MAJOR.MINOR.PATCH version number, increment a:

1. MAJOR version: When you make incompatible changes in the API,
2. Minor version: when adding features while maintaining compatibility, and
3. Patch (PATCH) version: when to fix failures while maintaining compatibility.

ex: 2.4.0

Additional labels for pre-release and build metadata
are available as an extension to the MAJOR.MINOR.PATCH format.

ex: 1.0.0-rc1

## Changelog

This project has release / feature / hotfix changelog available in CHANGELOG.md
