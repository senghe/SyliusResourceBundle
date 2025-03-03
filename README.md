SyliusResourceBundle
====================

Easy CRUD and persistence for Symfony apps.

During our work on Sylius, we noticed a lot of duplicated code across all controllers. We started looking for good solution of the problem.
We're not big fans of administration generators (they're cool, but not for our usecase!) - we wanted something simpler and more flexible.

Another idea was to not limit ourselves to one persistence backend. Initial implementation included custom manager classes, which was quite of overhead, so we decided to simply 
stick with Doctrine Common Persistence interfaces. If you are using Doctrine ORM or any of the ODM's, you're already familiar with those concepts.
Resource bundle relies mainly on `ObjectManager` and `ObjectRepository` interfaces.

The last annoying problem this bundle is trying to solve, is having separate "backend" and "frontend" controllers, or any other duplication for displaying the same resource,
with different presentation (view). We also wanted an easy way to filter some resources from list, sort them or display by id, slug or any other criteria - without having to defining
another super simple action for that purpose.

If these are issues you're struggling with, this bundle may be helpful!

Please note that this bundle **is not an admin generator**. It won't create forms, filters and grids for you. 
It only provides format agnostic controllers as a foundation to build on, with some basic sorting and filter mechanisms.

### Supported branches

- `1.9` (`v1.9.*` versions) - bug fixes and improvements of existing features
- `1.10` (next version - `v1.10.0`) - new features and bigger changes

Beware! There is no `main` or `master` branch on the repository. You should always open a Pull Request to the branch
named as the minor version on which your changes should be applied.

Sylius
------

![Sylius](https://demo.sylius.com/assets/shop/img/logo.png)

Sylius is an Open Source eCommerce solution built from decoupled components with powerful API and the highest quality code. [Read more on sylius.com](http://sylius.com).

Development
-----------

#### Build: 

```bash
docker compose up -d --build
```

#### Test:

```bash
make test
```

Documentation
-------------

[Documentation is available in the *docs* folder.](docs/index.md)

Contributing
------------

[This page](http://docs.sylius.com/en/latest/contributing/index.html) contains all the information about contributing to Sylius.

Follow Sylius' Development
--------------------------

If you want to keep up with the updates and latest features, follow us on the following channels:

* [Official Blog](https://sylius.com/blog)
* [Sylius on Twitter](https://twitter.com/Sylius)
* [Sylius on Facebook](https://facebook.com/SyliusEcommerce)

Bug tracking
------------

Sylius uses [GitHub issues](https://github.com/Sylius/SyliusResourceBundle/issues).
If you have found bug, please create an issue.

MIT License
-----------

License can be found [here](https://github.com/Sylius/SyliusResourceBundle/blob/1.10/LICENSE).

Authors
-------

The bundle was originally created by [Paweł Jędrzejewski](http://pjedrzejewski.com).
See the list of [contributors](https://github.com/Sylius/SyliusResourceBundle/graphs/contributors).
