# PlugZone Installation Protocol

> [!WARNING]
> **OPSEC NOTICE**: This guide assumes you are operating on a secure, non-compromised host. If your base OS is compromised, no amount of application hardening will save you. Proceed with caution.

## 0x00: System Requirements
- **OS**: Ubuntu 22.04 LTS (Debian Stable is also acceptable).
- **Architecture**: x64 preferred.
- **Root Access**: Required for initial setup; heavily restricted afterwards.

## 0x01: Base System Prep
Updates are not just about features; they are about patching zero-days. Do not skip this.

```bash
sudo apt update && sudo apt upgrade -y
```

## 0x02: Dependency Injection
We are building a fortress, but we need bricks.

### PHP 8.3 & Friends
Standard repository packages are often outdated. We use the PPA to get the bleeding edge because we need the latest security patches.

```bash
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
sudo apt install -y php8.3-fpm php8.3-mysql php8.3-curl php8.3-gd php8.3-mbstring \
php8.3-xml php8.3-zip php8.3-bcmath php8.3-gnupg php8.3-intl php8.3-readline \
php8.3-common php8.3-cli php8.3-gmp unzip git mysql-server nginx tor
```

### Composer (The Supply Chain)
Verify the hash. Supply chain attacks are real.

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
# ALWAYS verify the signature yourself from https://composer.github.io/installer.sig
php composer-setup.php --install-dir=/usr/local/bin --filename=composer
php -r "unlink('composer-setup.php');"
```

## 0x03: Application Deployment

### Clone & Secure
Move to `/var/www`. This is standard territory.

```bash
cd /var/www
sudo git clone https://github.com/sukunetsiz/plugzone.git
sudo chown -R www-data:www-data plugzone
cd plugzone
```

### Configuration & Encryption
The `.env` file is the heart of your secrets. Guard it.

```bash
cp .env.example .env
sudo nano .env
# Set DB_DATABASE, DB_USERNAME, DB_PASSWORD
# Generate the key - this encrypts your sessions and cookies.
php artisan key:generate
```

### Build
Install dependencies and migrate the schema.

```bash
composer install --no-dev --optimize-autoloader
php artisan migrate --force
# Optional: Seed dummy data for testing (DO NOT DO THIS IN PROD)
# php artisan db:seed
```

### Perms Lockdown
Loose permissions sink ships.

```bash
sudo find . -type f -exec chmod 644 {} \;
sudo find . -type d -exec chmod 755 {} \;
sudo chmod -R 775 storage bootstrap/cache
sudo chmod 640 .env
```

## 0x04: Service Configuration

### Nginx (Reverse Proxy)
We expose nothing directly. Nginx sits in front.

File: `/etc/nginx/sites-available/plugzone`

```nginx
server {
    listen 127.0.0.1:80; # Listen ONLY on localhost. Tor will talk to this.
    server_name _;
    root /var/www/plugzone/public;
    index index.php;

    # Headers for parallax hardening
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    add_header Referrer-Policy "strict-origin-when-cross-origin";

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }

    # Deny access to hidden files (git, env, etc)
    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Enable it:
```bash
sudo ln -s /etc/nginx/sites-available/plugzone /etc/nginx/sites-enabled/
sudo rm /etc/nginx/sites-enabled/default
sudo systemctl restart nginx
```

### Tor (The Hidden Service)
This is where the magic happens. We vanish from the clear web.

File: `/etc/tor/torrc`

```bash
# SOCKS5 for the app to make outbound anon calls (e.g. price fetching)
SocksPort 9050

# The Hidden Service
HiddenServiceDir /var/lib/tor/plugzone_hs/
HiddenServicePort 80 127.0.0.1:80
```

Restart Tor unleash the onion:
```bash
sudo systemctl restart tor
```

Get your coordinates:
```bash
sudo cat /var/lib/tor/plugzone_hs/hostname
```

## 0x05: Final Verification
1.  Check `netstat -tlnp` to ensure Nginx is ONLY listening on 127.0.0.1:80.
2.  Check Tor is listening on 9050.
3.  Visit your onion address.

> [!TIP]
> **Next Step**: Proceed to [HARDENING.md](HARDENING.md) to lock this down properly. Default configs are for tourists.
