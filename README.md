# pagarme-marketplace
Marketplace for Pagarme devel test


### Install

1. Fork this repository.
2. Run `composer install`.
3. Set database and Pagarme parameters after composer install.
4. Create schema with `php bin/console doctrine:schema:create` command.
5. Run `php bin/console app:seed-data` to create sample data.
6. Run server `php bin/console server:run -vvv`
7. Open `http://127.0.0.1:8000` in your browser.