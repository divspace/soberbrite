FROM php:7.4-apache-buster

# Disable interaction
ARG DEBIAN_FRONTEND=noninteractive

# Update
RUN apt-get update && \
    apt-get -y upgrade && \
    pecl channel-update pecl.php.net

# Install tools and essential libraries
RUN apt-get -mqy install \
    apt-utils \
    build-essential \
    curl \
    default-mysql-client \
    dialog \
    git \
    libicu-dev \
    libpng-dev \
    libzip-dev \
    openssl \
    unzip \
    vim \
    wget \
    zip \
    zsh

# Install PHP extensions
RUN docker-php-ext-install bcmath && \
    docker-php-ext-install exif && \
    docker-php-ext-install gd && \
    docker-php-ext-install intl && \
    docker-php-ext-install pcntl && \
    docker-php-ext-install pdo_mysql && \
    docker-php-ext-install tokenizer && \
    docker-php-ext-install zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Igbinary
RUN docker-php-source extract && \
    mkdir -p /usr/src/php/ext/igbinary && \
    curl -fsSL https://github.com/igbinary/igbinary/archive/3.1.2.tar.gz | \
        tar xvz -C /usr/src/php/ext/igbinary --strip 1 && \
    docker-php-ext-install igbinary && \
    docker-php-source delete

# Install Redis
RUN docker-php-source extract && \
    mkdir -p /usr/src/php/ext/redis && \
    curl -fsSL https://github.com/phpredis/phpredis/archive/5.3.1.tar.gz | \
        tar xvz -C /usr/src/php/ext/redis --strip 1 && \
    docker-php-ext-configure redis --enable-redis-igbinary && \
    docker-php-ext-install redis && \
    docker-php-source delete

# Install Xdebug
RUN pecl -q install xdebug && \
    docker-php-ext-enable xdebug

# Enable Apache modules
RUN a2enmod rewrite headers

# Cleanup
RUN apt-get clean && \
    apt-get -y autoremove && \
    rm -rf /tmp/* /usr/src/* /var/lib/apt/lists/* /var/tmp/*

# Add Xdebug configuration
SHELL ["/bin/zsh", "-c"]

RUN echo $'xdebug.cli_color=1\n\
xdebug.idekey=PHPSTORM\n\
xdebug.profiler_output_dir="~/xdebug/phpstorm/tmp/profiling"\n\
xdebug.remote_autostart=1\n\
xdebug.remote_enable=1\n\
xdebug.remote_host="host.docker.internal"\n\
xdebug.var_display_max_children=-1\n\
xdebug.var_display_max_data=-1\n\
xdebug.var_display_max_depth=-1' > /usr/local/etc/php/conf.d/xdebug.ini
