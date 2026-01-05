# Feature Roadmap & Future Operations

This document outlines the strategic trajectory for PlugZone. We are not just building a shop; we are building an ecosystem resistant to censorship and surveillance.

## Phase 1: Heavy Armor (Current Priority)
Focus: Resilience against active attacks and phishing.

- [ ] **Endgame Integration**
    - **Objective**: Implement robust DDoS protection specific to Tor hidden services.
    - **Mechanism**: Challenge-response captcha front-ends (e.g., PoW integration) before requests hit the main application stack.
    
- [ ] **Anti-Phishing Phalanx**
    - **Login Phrases**: Users set a secret phrase displayed upon login to verify they are on the real site.
    - **Verified Mirrors**: Cryptographically signed list of mirrors available at a static endpoint.
    - **Ties Verification**: Automated PGP verification of social proof (e.g., Dread link integration).

- [ ] **Strict PGP Enforcement**
    - **Mandatory 2FA**: Remove option for password-only login for vendors.
    - **Message Encryption**: Auto-encrypt all PMS messages if the recipient has a PGP key. No plain text storage of communications.

## Phase 2: Operational Security (OpSec)
Focus: Protecting the user from themselves.

- [ ] **Metadata Stripper**
    - **Image Sanitization**: Server-side stripping of EXIF data (GPS, Camera Model) from all uploaded product images. (Already partial, need full strict enforcement).
    - **Time-Jitter**: Randomize cron job execution times to prevent traffic fingerprinting.

- [ ] **Auto-Burn protocols**
    - **Message Destruction**: Auto-delete read messages after N days.
    - **Order Purge**: Hard delete of order details 48h after finalization or dispute resolution.

- [ ] **Canary Automation**
    - **Script**: Automated tool to update `CANARY.txt` with latest Bitcoin block hash, alerting users if the admin goes silent.

## Phase 3: Monero & Financial Privacy
Focus: Breaking the chain.

- [ ] **Subaddress Rotation**
    - Generate unique integrated addresses for EVERY order to prevent wallet clustering.
    - "Churn" recommendations/guides for vendors.

- [ ] **Walletless 2.0**
    - Optimizations for the RPC bridge to reduce latency while maintaining zero-knowledge of private keys on the web server.

## Phase 4: Decentralization (Long Term)
- [ ] **I2P Support**: Native support for I2P network for redundancy.
- [ ] **Federation Protocol**: Theoretically allow cross-market listings without centralized databases (Research Phase).

---
*The roadmap is a living document. Adaptation is survival.*
