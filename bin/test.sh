#!/usr/bin/env bash

PHP_VERSION="8.2"

if ! docker info > /dev/null 2>&1; then
  echo "Please start docker first"
  exit 0
fi

echo "Running pint..."
if ! docker run -it --rm -v "$PWD":/app -w /app php:"$PHP_VERSION"-cli php vendor/bin/pint; then
  exit 1
fi

echo "Running phpstan..."
if ! docker run -it --rm -v "$PWD":/app -w /app php:"$PHP_VERSION"-cli php vendor/bin/phpstan analyse; then
  exit 1
fi

echo "Running phpunit..."
if ! docker run -it --rm -v "$PWD":/app -w /app php:"$PHP_VERSION"-cli php vendor/bin/phpunit; then
  exit 1
fi
