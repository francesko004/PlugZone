# Hidden Service Hardening Protocol

> [!IMPORTANT]
> **SCOPE**: This document outlines advanced hardening techniques. This is ensuring your service resists de-anonymization attacks and server compromise.

## 0x00: Principles of Hardening
1.  **Minimize Attack Surface**: If it doesn't need to run, kill it.
2.  **Information Control**: Leak nothing. Not a version number, not a timestamp.
3.  **Isolation**: Contain breaches.

## 0x01: Nginx Hardening
The default Nginx config screams "I am a default Nginx config". Silence it.

### Hide Version
In `nginx.conf`:
```nginx
http {
    server_tokens off;
    ...
}
```

### Buffer Overflow Protection
Limit buffer sizes to prevent memory exhaustion attacks.
```nginx
client_body_buffer_size 10K;
client_header_buffer_size 1k;
client_max_body_size 8m;
large_client_header_buffers 2 1k;
```

### Timeouts
Slowloris attacks are boring but effective. Drop dead connections fast.
```nginx
client_body_timeout 10;
client_header_timeout 10;
keepalive_timeout 5 5;
send_timeout 10;
```

## 0x02: Tor Configuration (Stealth)
Standard V3 onions are discoverable if they are in the directory (which they aren't by default, but let's be safe).

### V3 Onion Security
Ensure you are strictly using V3.
```bash
HiddenServiceVersion 3
```

### Client Authorization (Optional - "Invite Only")
If this is a private market, use client authorization. Only people with the key can even route to you.
```bash
HiddenServiceAuthorizeClient stealth client_name
```

## 0x03: Firewall (UFW)
A hidden service should be a black hole to the outside world, accepting ONLY SSH (key only) and localized loopback traffic.

```bash
# Deny by default
sudo ufw default deny incoming
sudo ufw default allow outgoing

# Allow SSH (Ideally, change your SSH port first!)
sudo ufw allow ssh

# Allow Loopback (Vital for Nginx <-> Tor)
sudo ufw allow in on lo

# Enable
sudo ufw enable
```

**CRITICAL**: Do NOT allow port 80/443 on public interfaces. Nginx should `listen 127.0.0.1:80`. If `0.0.0.0:80` is open, shodan.io will find you.

## 0x04: SSH Hardening
Password auth is for reckless people.

Edit `/etc/ssh/sshd_config`:
```ssh
PermitRootLogin no
PasswordAuthentication no
PubkeyAuthentication yes
# Move port to reduce log noise
Port 2222 
```

## 0x05: Application Hardening (Laravel)

### Disable Debug Mode
In `.env`:
```
APP_DEBUG=false
APP_ENV=production
```
**NEVER** leave debug true in production. It prints stack traces with environment variables.

### Permission Lockdown
Ensure `www-data` cannot modify code files.
```bash
# Owner is user, group is www-data
sudo chown -R user:www-data /var/www/plugzone
# Files restricted
sudo find /var/www/plugzone -type f -exec chmod 640 {} \;
# Directories searchable
sudo find /var/www/plugzone -type d -exec chmod 750 {} \;
# Storage needs write
sudo chmod -R 770 /var/www/plugzone/storage
```

## 0x06: Maintenance & Monitoring
- **Log Rotation**: Don't let logs fill the disk.
- **Fail2Ban**: Install it. Ban repeat offenders on SSH. `sudo apt install fail2ban`.
- **Warrant Canary**: Update your `CANARY.txt` regularly.

> [!CAUTION]
> **Final Check**: After applying these, visit your onion link. If it works, verify you cannot access the IP directly on port 80. If you can, you failed the UFW step.
