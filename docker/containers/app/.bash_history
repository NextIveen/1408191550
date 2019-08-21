composer dump-autoload
composer install
php artisan migrate
php artisan db:seed
php artisan cache:clear
php artisan view:clear
php artisan cache:clear; php artisan view:clear
php artisan admin:user:create
export PATH=$PATH:/opt/node/bin
npm install
node_modules/yarn/bin/yarn install
node_modules/gulp/bin/gulp.js
node_modules/yarn/bin/yarn install && npm install && node_modules/gulp/bin/gulp.js
