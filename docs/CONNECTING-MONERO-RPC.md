# Monero Integration Protocol

> [!IMPORTANT]
> **PRIVACY CHECK**: Relying on remote nodes leaks your IP and transaction timing. **Run your own node.**

## 0x00: The Architecture
We do not hold private keys on the web server. The architecture is:
`Web App` -> `Wallet RPC (View Only / Spend Restricted)` -> `Monero Daemon (Ideally Local)`

## 0x01: Daemon Setup (monerod)
Don't use `screen`. Use `systemd`. It restarts if it crashes.

### Install
```bash
# Verify the hashes!
wget https://downloads.getmonero.org/cli/linux64
tar xvf linux64
cd monero-*
sudo cp monerod /usr/local/bin/
sudo cp monero-wallet-rpc /usr/local/bin/
```

### Systemd Service
File: `/etc/systemd/system/monerod.service`

```ini
[Unit]
Description=Monero Full Node
After=network.target

[Service]
User=monero
Group=monero
Type=simple
ExecStart=/usr/local/bin/monerod --detach --data-dir /var/lib/monero \
    --rpc-bind-ip 127.0.0.1 --rpc-bind-port 18081 \
    --non-interactive --confirm-external-bind
Restart=always

[Install]
WantedBy=multi-user.target
```

Enable and start:
```bash
sudo useradd -m -s /bin/bash monero
sudo mkdir /var/lib/monero
sudo chown -R monero:monero /var/lib/monero
sudo systemctl enable --now monerod
```

## 0x02: Wallet RPC Setup
We need a wallet that the webapp can talk to.

### Generate Wallet
```bash
# Generate on a secure machine first if possible, then move to server
monero-wallet-cli --generate-new-wallet /var/www/wallets/plugzone
# RECORD THE SEED. THIS IS YOUR ONLY BACKUP.
```

### RPC Service
File: `/etc/systemd/system/monero-wallet-rpc.service`

```ini
[Unit]
Description=Monero Wallet RPC
After=monerod.service

[Service]
User=www-data
Group=www-data
Type=simple
ExecStart=/usr/local/bin/monero-wallet-rpc \
    --rpc-bind-port 18082 \
    --daemon-address 127.0.0.1:18081 \
    --wallet-file /var/www/wallets/plugzone \
    --password-file /var/www/wallets/password.txt \
    --disable-rpc-login \
    --log-file /var/log/monero-rpc.log
Restart=always

[Install]
WantedBy=multi-user.target
```

## 0x03: Remote Nodes (The "I don't have 100GB" Fallback)
If you MUST use a remote node, use Tor.

1.  Configure Tor SOCKS at 9050.
2.  Add `--proxy 127.0.0.1:9050` to your `monerod` or `wallet-rpc` command.
3.  Use a `.onion` remote node.

Example Remote Node List (Verify PGP signatures of list maintainers!):
*   `xmr.ditatompel.com` (Clear)
*   `xmrag4hf5xlabmob.onion` (Dark)

> [!WARNING]
> **Remote Node Risk**: They know which block you are syncing. They know your IP (if not using Tor). They can lie about payment status (though wallet scan usually catches this).
