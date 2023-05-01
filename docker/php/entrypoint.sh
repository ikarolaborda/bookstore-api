#!/bin/sh

# Create symbolic link for docs
#if [ ! -L "/var/www/book-api/public/docs" ]; then
#  ln -s /var/www/book-api/docs /var/www/book-api/public/docs
#fi

# Start the existing entrypoint script
exec docker-php-entrypoint php-fpm
