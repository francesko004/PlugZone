# Disaster Recovery & Backup Protocol

> [!CAUTION]
> **The Rule of 3**: 3 Copies, 2 Different Media, 1 Off-site.

## 0x00: The Threat Model
- **Server Seizure**: Host taken down by adversaries.
- **Data Corruption**: `rm -rf /` by accident.
- **Compromise**: Hacker gains root.

## 0x01: Automated Database Backup
We do not store plain text backups on the disk. We encrypt them immediately.

### The Script (`/usr/local/bin/secure_backup.sh`)
```bash
#!/bin/bash

TIMESTAMP=$(date +%F_%T)
BACKUP_DIR="/var/backups/plugzone"
DB_USER="your_user"
DB_PASS="your_password"
DB_NAME="your_database"
# Public Key of the Admin (Import this into the server's GPG keyring)
GPG_RECIPIENT="admin@plugzone.onion"

# Dump -> GZip -> GPG Encrypt
mysqldump -u $DB_USER -p$DB_PASS $DB_NAME | \
gzip | \
gpg --encrypt --recipient $GPG_RECIPIENT --trust-model always \
> $BACKUP_DIR/db_$TIMESTAMP.sql.gz.gpg

# Delete backups older than 7 days
find $BACKUP_DIR -type f -mtime +7 -delete
```

### Automation
Add to crontab (`crontab -e`):
```bash
0 */6 * * * /usr/local/bin/secure_backup.sh
```

## 0x02: Off-site Exfiltration
Backups on the server die with the server. Use `rsync` over Tor to pull them to a secure location (or push them to a backup VPS).

```bash
# Pulling from a secure local machine over Tor
torify rsync -avz -e "ssh -p 2222" user@your_onion_address:/var/backups/plugzone/ .
```

## 0x03: Monero Wallet Recovery
The `wallet-file` is convenient, but the **Seed Phrase** is eternal.

1.  **Etch it in steel**: Paper burns. Ink fades. Steel endures.
2.  **Split it**: Shamir's Secret Sharing or simply split the 25 words into 2 locations (1-15 in location A, 10-25 in location B with overlap).

## 0x04: Restoration Procedure (Scorched Earth)
If the server is nuked:

1.  **Spin up new VPS**.
2.  **Secure it** (See [HARDENING.md](HARDENING.md)).
3.  **Install App** (See [INSTALLATION.md](INSTALLATION.md)).
4.  **Import Database**:
    ```bash
    # Decrypt locally first!
    gpg -d db_backup.sql.gz.gpg > db_backup.sql.gz
    gunzip db_backup.sql.gz
    # Upload and Import
    mysql -u user -p database < db_backup.sql
    ```
5.  **Restore Wallet**:
    ```bash
    monero-wallet-cli --restore-deterministic-wallet
    # Enter seed phrase
    ```
6.  **Rescan Blockchain**: This puts the "time" in "recovery time". It will take hours/days.

> [!IMPORTANT]
> **Drills**: Test your backups every month. A backup you haven't tested is a hope, not a strategy.
