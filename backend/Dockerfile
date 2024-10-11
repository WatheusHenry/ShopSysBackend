# Use a imagem oficial do PHP com suporte a FPM
FROM php:8.3-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
  build-essential \
  libpng-dev \
  libjpeg-dev \
  libfreetype6-dev \
  libonig-dev \
  libzip-dev \
  zip \
  unzip \
  git \
  curl \
  libpq-dev \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Instalar o Composer
COPY --from=composer:2.1 /usr/bin/composer /usr/bin/composer

# Criar diretório de trabalho
WORKDIR /var/www

# Copiar todos os arquivos para o container
COPY . .

# Instalar dependências do Composer
RUN composer install --no-dev --optimize-autoloader

# Definir permissões
RUN chown -R www-data:www-data /var/www

# Expor a porta 9000 para o PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]
