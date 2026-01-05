# Vendor PGP Operations Standard

> [!NOTE]
> **Philosophy**: PGP is not just for encryption; it is for identity. If you lose your key, you lose your reputation. If your key is compromised, you burn your reputation.

## 0x00: Key Generation (The Right Way)
Do NOT generate keys on a Windows machine connected to the internet.

1.  **Environment**: Tails OS (booted from USB) or a dedicated air-gapped machine.
2.  **Algorithm**: RSA 4096 or Ed25519 (Modern, faster, smaller).
3.  **Expiration**: Set an expiration date (e.g., 2 years). You can extend it later if you still control the master key.

```bash
gpg --full-generate-key
# Select (9) ECC and ECC -> (1) Curve 25519
# OR Select (1) RSA and RSA -> 4096 bits
```

## 0x01: Subkeys (The Pro Move)
Master keys are for signing other keys. Subkeys are for signing messages and decrypting files.

1.  Create a master key (C).
2.  Create subkeys for Signing (S) and Encryption (E).
3.  **Remove the master key** from your daily-driver laptop. Keep it on a cold-storage USB.
4.  Use the subkeys for daily operations. If your laptop is seized, you revoke the subkeys using the master key, and your reputation survives.

## 0x02: Verification
Web-based PGP tools are convenient honey-pots. Use the CLI.

### Import a Customer Key
```bash
gpg --import customer_key.asc
```

### Verify a Message
```bash
gpg --verify message.txt.asc
# Look for "Good signature from..."
```

### Sign a Message
Clear-signing allows the text to be read without PGP, but proves you wrote it.
```bash
gpg --clearsign --armor message.txt
```

## 0x03: 2FA & Login
PlugZone enforces PGP 2FA.
1.  Login produces a challenge message.
2.  Decrypt the message: `gpg -d challenge.asc`
3.  Paste the decrypted code.

> [!TIP]
> **Clipboard Hygiene**: Don't leave your decrypted private messages in your clipboard. Clear it immediately.
