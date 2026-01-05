

@section('content')
<div class="main-content">
    <div class="breadcrumb" style="font-size: 14px; color: var(--dm-text-secondary); margin-bottom: 20px;">
        <a href="{{ route('guides.index') }}" style="color: var(--link-color); text-decoration: none;">Help Guides</a>
        <span style="margin: 0 8px;">›</span>
        <span>Monero User Guide</span>
    </div>

    <div class="card" style="padding: 40px; line-height: 1.6; background-color: var(--dm-card-bg); border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <h1 style="font-size: 32px; font-weight: 700; margin-bottom: 25px; border-bottom: 1px solid var(--dm-border-color); padding-bottom: 15px; color: var(--dm-text-main);">Monero User Guide</h1>
        
        <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 30px;">
            Monero is a cryptocurrency designed for private and censorship-resistant transactions. While many other cryptocurrencies like Bitcoin and Ethereum have transparent blockchains where transactions can be tracked, Monero prioritizes user privacy. This means that the identities of senders and receivers, as well as transaction amounts, remain confidential.
        </p>

        <section style="margin-bottom: 40px;">
            <h2 style="font-size: 22px; font-weight: 700; color: #ff9900; margin-bottom: 20px;">1. Core Features of Monero</h2>
            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">Monero uses several different technologies to ensure user anonymity:</p>
            <ul style="display: flex; flex-direction: column; gap: 12px; padding-left: 20px; color: var(--dm-text-secondary); list-style-type: disc;">
                <li><strong>Stealth Addresses:</strong> These provide one-time addresses for each transaction, preventing transactions from being linked to users.</li>
                <li><strong>Ring Signatures:</strong> This technology mixes the sender's address with others, making it difficult to identify the real sender.</li>
                <li><strong>Ring Confidential Transactions:</strong> This feature adds an extra layer of privacy by hiding transaction amounts.</li>
            </ul>

            <div style="background: rgba(0, 102, 192, 0.05); border: 1px solid #0066c0; border-radius: 8px; padding: 20px; margin-top: 25px; color: var(--dm-text-main);">
                As a result, Monero transactions are private and nearly untraceable, making it a truly fungible currency. Merchants and users don't need to worry about accepting "tainted" coins because all Monero coins are treated equally and are indistinguishable from each other.
            </div>
        </section>

        <section style="margin-bottom: 40px;">
            <h2 style="font-size: 22px; font-weight: 700; color: #ff9900; margin-bottom: 20px;">2. Downloading and Installing Feather Wallet</h2>

            <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 15px; color: var(--dm-text-main);">For Windows</h3>
            <ol style="display: flex; flex-direction: column; gap: 15px; padding-left: 20px; color: var(--dm-text-secondary); list-style-type: decimal;">
                <li>Go to the Feather Wallet website.</li>
                <li>Click the Download button at the top of the page.</li>
                <li>Scroll down on the new page to find the Windows installation file and click the Installer button.</li>
                <div style="margin: 15px 0; max-width: 600px; border: 1px solid var(--dm-border-color); border-radius: 8px; overflow: hidden;">
                    <img src="{{ asset('images/guides/monero/1.png') }}" alt="Windows Download Screen" style="width: 100%; height: auto;">
                </div>
                <li>After the download completes, go to the Downloads folder.</li>
                <li>Right-click on the Feather Wallet file and click Open.</li>
                <li>If Microsoft Defender shows a warning, continue by clicking Run.</li>
                <li>Select Yes when asked to install Feather Wallet.</li>
                <li>Leave the installation folder at default settings and click Next.</li>
                <li>Click Install and wait for the process to complete.</li>
                <li>Finally, click Next and then Finish. Make sure Run Feather Wallet is active.</li>
            </ol>

            <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 15px; margin-top: 30px; color: var(--dm-text-main);">For Linux</h3>
            <ol style="display: flex; flex-direction: column; gap: 15px; padding-left: 20px; color: var(--dm-text-secondary); list-style-type: decimal;">
                <li>Go to the Feather Wallet website.</li>
                <li>Click the Download button at the top of the page.</li>
                <li>Find Linux options on the opened page. Look for the x64 version and click AppImage.</li>
                <div style="margin: 15px 0; max-width: 600px; border: 1px solid var(--dm-border-color); border-radius: 8px; overflow: hidden;">
                    <img src="{{ asset('images/guides/monero/2.png') }}" alt="Linux Download Screen" style="width: 100%; height: auto;">
                </div>
                <li>After downloading, go to the folder containing the file.</li>
                <li>Right-click on the AppImage file and go to Properties > Permissions tab. Enable the Executable option.</li>
                <li>Double-click the AppImage file to open the program.</li>
            </ol>
        </section>

        <section style="margin-bottom: 40px;">
            <h2 style="font-size: 22px; font-weight: 700; color: #ff9900; margin-bottom: 20px;">3. Creating a New Monero Wallet</h2>
            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">When Feather Wallet opens, click Create new wallet.</p>

            <div style="margin: 15px 0; max-width: 600px; border: 1px solid var(--dm-border-color); border-radius: 8px; overflow: hidden;">
                <img src="{{ asset('images/guides/monero/3.png') }}" alt="Create New Wallet Screen" style="width: 100%; height: auto;">
            </div>

            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">Continue by clicking Next.</p>

            <div style="background: rgba(177, 39, 4, 0.05); border: 1px solid #b12704; border-radius: 8px; padding: 20px; margin-top: 25px; color: var(--dm-text-main);">
                <h4 style="margin-top: 0; color: #b12704; font-size: 16px; font-weight: 700; margin-bottom: 10px;">CRITICAL: Seed Words</h4>
                <p style="margin-bottom: 10px; font-size: 14px;">Feather Wallet will show "seed words" for your new Monero wallet. Write these words down in a secure place and don't store them digitally; write them by hand on paper in the correct order and keep them safe. These seed words:</p>
                <ul style="display: flex; flex-direction: column; gap: 8px; padding-left: 20px; color: var(--dm-text-secondary); list-style-type: disc;">
                    <li>Don't share with anyone.</li>
                    <li>Don't enter on any website.</li>
                    <li>Store securely.</li>
                    <li>Never lose them.</li>
                </ul>
            </div>

            <p style="font-size: 16px; color: var(--dm-text-main); margin-top: 25px; margin-bottom: 15px;">On the next screen, give your wallet a name. You don't need to change the default folder; click Next.</p>

            <div style="margin: 15px 0; max-width: 600px; border: 1px solid var(--dm-border-color); border-radius: 8px; overflow: hidden;">
                <img src="{{ asset('images/guides/monero/4.png') }}" alt="Wallet Name Screen" style="width: 100%; height: auto;">
            </div>

            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">Choose whether you want to add a password to your wallet. You can add a password or leave it blank and click Next. Finally, click Create/Open wallet to complete the process.</p>
        </section>

        <section style="margin-bottom: 40px;">
            <h2 style="font-size: 22px; font-weight: 700; color: #ff9900; margin-bottom: 20px;">4. Using Feather Wallet</h2>
            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">Now, I'll show you how to use your Monero wallet with Feather Wallet on your computer. With this wallet software, you can send, receive, and store Monero.</p>

            <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 15px; margin-top: 30px; color: var(--dm-text-main);">Basic Settings</h3>
            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">Launch Feather Wallet. You'll see a screen with "Open wallet file" option active. Click Next.</p>

            <div style="margin: 15px 0; max-width: 600px; border: 1px solid var(--dm-border-color); border-radius: 8px; overflow: hidden;">
                <img src="{{ asset('images/guides/monero/5.png') }}" alt="Open Wallet Screen" style="width: 100%; height: auto;">
            </div>

            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">Select your Monero wallet file. You can have multiple wallet files on your computer. If you want this wallet to load automatically every time you open (not mandatory), enable the "Open on startup" option and click Open wallet.</p>

            <div style="margin: 15px 0; max-width: 600px; border: 1px solid var(--dm-border-color); border-radius: 8px; overflow: hidden;">
                <img src="{{ asset('images/guides/monero/6.png') }}" alt="Select Wallet Screen" style="width: 100%; height: auto;">
            </div>

            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">Enter your password. Enter the password you set when setting up the wallet and click OK.</p>

            <div style="margin: 15px 0; max-width: 600px; border: 1px solid var(--dm-border-color); border-radius: 8px; overflow: hidden;">
                <img src="{{ asset('images/guides/monero/7.png') }}" alt="Enter Password Screen" style="width: 100%; height: auto;">
            </div>

            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">Check the main window. When Feather Wallet's main window opens, make sure two indicators are present to confirm your wallet is ready for use:</p>

            <ul style="display: flex; flex-direction: column; gap: 8px; padding-left: 20px; color: var(--dm-text-secondary); list-style-type: disc;">
                <li>"Synchronized" text in the bottom left corner,</li>
                <li>A green circle symbol in the bottom right corner.</li>
            </ul>

            <p style="font-size: 16px; color: var(--dm-text-main); margin-top: 15px; margin-bottom: 15px;">To configure settings: Click the File button in the top left corner and select Settings from the menu. In this screen, you can open a new wallet, restore an existing wallet, lock or close the wallet. For beginners, it might be better not to change the settings section.</p>

            <div style="margin: 15px 0; max-width: 600px; border: 1px solid var(--dm-border-color); border-radius: 8px; overflow: hidden;">
                <img src="{{ asset('images/guides/monero/8.png') }}" alt="Settings Screen" style="width: 100%; height: auto;">
            </div>
        </section>

        <section style="margin-bottom: 40px;">
            <h2 style="font-size: 22px; font-weight: 700; color: #ff9900; margin-bottom: 20px;">5. Receiving Monero</h2>

            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">Switch to the "Receive" tab in the main screen. Feather Wallet presents your wallet addresses in this screen. Each of these addresses is linked to your Monero wallet, and payments made to these addresses go directly to your wallet.</p>

            <div style="margin: 15px 0; max-width: 600px; border: 1px solid var(--dm-border-color); border-radius: 8px; overflow: hidden;">
               <img src="{{ asset('images/guides/monero/9.png') }}" alt="Receive Screen" style="width: 100%; height: auto;">
            </div>

            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">Label your addresses. You can assign labels to your addresses to note which address you use for what purpose. You can copy these addresses by right-clicking and paste them somewhere.</p>

            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">View payments in the "History" tab. Details about incoming payments are as follows:</p>

            <ul style="display: flex; flex-direction: column; gap: 8px; padding-left: 20px; color: var(--dm-text-secondary); list-style-type: disc;">
               <li>Date: Payment date</li>
               <li>Description: Description you set in your wallet</li>
               <li>Amount: Amount of Monero</li>
            </ul>

            <div style="margin: 15px 0; max-width: 600px; border: 1px solid var(--dm-border-color); border-radius: 8px; overflow: hidden;">
               <img src="{{ asset('images/guides/monero/10.png') }}" alt="History Screen" style="width: 100%; height: auto;">
            </div>

            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">Wait for transactions to confirm. Incoming Monero transactions remain "unconfirmed" until confirmed by the Monero network. According to the Monero protocol, transactions need 10 confirmations. This process can take 20-30 minutes on average, during which you cannot use the coins that are waiting as "unconfirmed".</p>

            <div style="margin: 15px 0; max-width: 600px; border: 1px solid var(--dm-border-color); border-radius: 8px; overflow: hidden;">
               <img src="{{ asset('images/guides/monero/11.png') }}" alt="Unconfirmed Transaction" style="width: 100%; height: auto;">
            </div>

            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">Check transaction status. In the "History" tab, you can track the confirmation status of your incoming transaction. The clock symbol on the left gradually changes from red to green and becomes completely green when the transaction is confirmed.</p>

            <div style="margin: 15px 0; max-width: 600px; border: 1px solid var(--dm-border-color); border-radius: 8px; overflow: hidden;">
               <img src="{{ asset('images/guides/monero/12.png') }}" alt="Transaction Status 1" style="width: 100%; height: auto;">
            </div>
            <div style="margin: 15px 0; max-width: 600px; border: 1px solid var(--dm-border-color); border-radius: 8px; overflow: hidden;">
               <img src="{{ asset('images/guides/monero/13.png') }}" alt="Transaction Status 2" style="width: 100%; height: auto;">
            </div>
            <div style="margin: 15px 0; max-width: 600px; border: 1px solid var(--dm-border-color); border-radius: 8px; overflow: hidden;">
               <img src="{{ asset('images/guides/monero/14.png') }}" alt="Transaction Status 3" style="width: 100%; height: auto;">
            </div>

            <div style="background: rgba(0, 102, 192, 0.05); border: 1px solid #0066c0; border-radius: 8px; padding: 20px; margin-top: 25px; color: var(--dm-text-main);">
               When the transaction is fully confirmed, the Monero appears in your wallet irreversibly. The green checkmark indicates the transaction is complete.
            </div>
        </section>

        <section style="margin-bottom: 40px;">
            <h2 style="font-size: 22px; font-weight: 700; color: #ff9900; margin-bottom: 20px;">6. Sending Monero</h2>

            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">Switch to the "Send" tab in the main screen. Fill in the following fields to send Monero:</p>

            <ul style="display: flex; flex-direction: column; gap: 8px; padding-left: 20px; color: var(--dm-text-secondary); list-style-type: disc;">
               <li><strong>Pay to:</strong> Recipient's Monero address</li>
               <li><strong>Description:</strong> A note summarizing the purpose of the transaction (stored in your wallet)</li>
               <li><strong>Amount:</strong> Amount of Monero you want to send</li>
            </ul>

            <div style="margin: 15px 0; max-width: 600px; border: 1px solid var(--dm-border-color); border-radius: 8px; overflow: hidden;">
               <img src="{{ asset('images/guides/monero/15.png') }}" alt="Send Screen" style="width: 100%; height: auto;">
            </div>

            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">Enter the recipient's Monero address. You can copy this from the internet or paste it using a QR code. Two different methods can be used for the address, the first method is the most common:</p>

            <ol style="display: flex; flex-direction: column; gap: 15px; padding-left: 20px; color: var(--dm-text-secondary); list-style-type: decimal;">
               <li>You can manually paste it by copying from the internet or a website</li>
               <li>If there's a QR code photo, you can scan it automatically using the computer's camera</li>
            </ol>

            <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 15px; margin-top: 30px; color: var(--dm-text-main);">Example Donation Sending</h3>

            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">To donate to the Feather Wallet developer, click Help > Donate to Feather in the top menu. Feather Wallet automatically fills in the recipient address and description fields. All that's left is to enter the amount you want to donate. You don't have to make a donation in this example; it's just provided as an example of sending Monero.</p>

            <div style="margin: 15px 0; max-width: 600px; border: 1px solid var(--dm-border-color); border-radius: 8px; overflow: hidden;">
               <img src="{{ asset('images/guides/monero/16.png') }}" alt="Donation Screen" style="width: 100%; height: auto;">
            </div>

            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">Get send confirmation. Check the address and send amount in the transaction summary screen. You can verify by comparing the first and last 5 characters of the address you want to send to. After reviewing the transaction fee, click Send.</p>

            <div style="margin: 15px 0; max-width: 600px; border: 1px solid var(--dm-border-color); border-radius: 8px; overflow: hidden;">
                <img src="{{ asset('images/guides/monero/17.png') }}" alt="Confirmation Screen 1" style="width: 100%; height: auto;">
            </div>

            <div style="margin: 15px 0; max-width: 600px; border: 1px solid var(--dm-border-color); border-radius: 8px; overflow: hidden;">
                <img src="{{ asset('images/guides/monero/18.png') }}" alt="Confirmation Screen 2" style="width: 100%; height: auto;">
            </div>

            <div style="background: rgba(0, 102, 192, 0.05); border: 1px solid #0066c0; border-radius: 8px; padding: 20px; margin-top: 25px; color: var(--dm-text-main);">
                Wait for the transaction to complete. When Feather Wallet shows "Successfully sent 1 transaction(s)", the transaction has been sent to the Monero network. You can see this transaction in the History tab.
            </div>

            <div style="background: rgba(255, 153, 0, 0.05); border: 1px solid #ff9900; border-radius: 8px; padding: 20px; margin-top: 25px; color: var(--dm-text-main);">
                Just like incoming payments, your sent transaction also needs 10 confirmations. On average, you get one confirmation every 2 minutes on the Monero network.
            </div>

            <p style="font-size: 16px; color: var(--dm-text-main); margin-top: 25px; margin-bottom: 15px;">When the clock symbol in the History tab turns into a green checkmark, the Monero you sent has irreversibly reached the recipient's wallet. This checkmark indicates the transaction is complete.</p>
        </section>

        <section style="margin-bottom: 40px;">
            <h2 style="font-size: 22px; font-weight: 700; color: #ff9900; margin-bottom: 20px;">7. How to Buy Monero</h2>
            
            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">Monero (XMR) is the main currency used in the PlugZone Marketplace and is used for all transactions. In this guide, I'll show you three methods to buy Monero.</p>

            <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 15px; margin-top: 30px; color: var(--dm-text-main);">Buying Through Centralized Exchanges (CEX)</h3>
            
            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">Our first method is buying Monero through CEX (centralized exchanges) with KYC verification. This method isn't highly recommended for privacy since these exchanges require identity verification, though buying is quite simple and straightforward for beginners or users who aren't very tech-savvy. Download the mobile apps of the CEXs I'll list below, create an account, and complete identity verification. Send your local currency (USD, GBP, EUR etc.) to your crypto exchange account and buy Monero directly from your phone. Now you can withdraw your Monero to any Monero address.</p>

            <div style="background: rgba(0, 102, 192, 0.05); border: 1px solid #0066c0; border-radius: 8px; padding: 20px; margin-top: 25px; color: var(--dm-text-main);">
                As of January 2025, here are the KYC centralized exchanges that still allow Monero trading:
            </div>

            <ul style="display: flex; flex-direction: column; gap: 12px; padding-left: 20px; color: var(--dm-text-secondary); list-style-type: disc; margin-top: 15px;">
                <li>Kraken (<a href="https://www.kraken.com/" style="color: var(--link-color);">https://www.kraken.com/</a>) (Region-specific; delisted in the EEA in 2024) (Kraken is the most reliable among KYC centralized exchanges, make this your first choice)</li>
                <li>KuCoin (<a href="https://www.kucoin.com/" style="color: var(--link-color);">https://www.kucoin.com/</a>)</li>
                <li>Bybit (<a href="https://www.bybit.com/" style="color: var(--link-color);">https://www.bybit.com/</a>)</li>
                <li>CoinEx (<a href="https://www.coinex.com/" style="color: var(--link-color);">https://www.coinex.com/</a>)</li>
                <li>MEXC (<a href="https://www.mexc.com/" style="color: var(--link-color);">https://www.mexc.com/</a>)</li>
            </ul>

            <p style="font-size: 16px; color: var(--dm-text-main); margin-top: 15px; margin-bottom: 15px;">This is the easiest, most beginner-friendly, yet least privacy-respecting method. While your Monero transfers can't be tracked due to Monero's structure, the fact that you bought Monero may or may not be tracked by the government or the exchanges. Use them according to your threat model.</p>

            <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 15px; margin-top: 30px; color: var(--dm-text-main);">Buying Through Decentralized Exchanges (DEX)</h3>

            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">Our second method is buying Monero through DEX (decentralized exchanges) without KYC. Unlike the first method, we won't be sending fiat currency directly to an exchange. Instead, we'll trade cryptocurrency you already have (how you obtained it is up to you) through the trusted websites I'll list below. Common cryptocurrencies traded for Monero include Litecoin, Bitcoin, and USDT. Among these, we recommend Litecoin (LTC). Its low transfer fees, popularity, and slight privacy features make it the most attractive option. I'll first list the most popular options and then show you how to make a simple transaction using one of them.</p>

            <div style="background: rgba(0, 102, 192, 0.05); border: 1px solid #0066c0; border-radius: 8px; padding: 20px; margin-top: 25px; color: var(--dm-text-main);">
                Here are the KYC-free decentralized exchanges:
            </div>

            <ul style="display: flex; flex-direction: column; gap: 12px; padding-left: 20px; color: var(--dm-text-secondary); list-style-type: disc; margin-top: 15px;">
                <li>Trocador (<a href="https://trocador.app/" style="color: var(--link-color);">https://trocador.app/</a>)</li>
                <li>eXch (<a href="https://exch.cx/" style="color: var(--link-color);">https://exch.cx/</a>)</li>
                <li>BitcoinVN (<a href="https://bitcoinvn.io/" style="color: var(--link-color);">https://bitcoinvn.io/</a>)</li>
                <li>Majestic Bank (<a href="https://majesticbank.is/" style="color: var(--link-color);">https://majesticbank.is/</a>)</li>
                <li>Exolix (<a href="https://exolix.com/" style="color: var(--link-color);">https://exolix.com/</a>) (Trusted but may require KYC for some suspicious transactions, be careful)</li>
            </ul>

            <p style="font-size: 16px; color: var(--dm-text-main); margin-top: 15px; margin-bottom: 15px;">You can find the list of all KYC and non-KYC exchanges here: <a href="https://kycnot.me/" style="color: var(--link-color);">https://kycnot.me/</a></p>

            <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 15px; margin-top: 30px; color: var(--dm-text-main);">Using Trocador with Litecoin</h3>

            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">Now, I will show you how to trade Monero using Litecoin on Trocador. I bought my Litecoin from a KYC CEX, but you may use other methods too.</p>

            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">First, use the link above to go to Trocador and enter the amount you want to exchange; for example, I want to exchange 0.4 Litecoin.</p>

            <div style="margin: 15px 0; max-width: 600px; border: 1px solid var(--dm-border-color); border-radius: 8px; overflow: hidden;">
                <img src="{{ asset('images/guides/monero/19.png') }}" alt="Trocador Exchange Screen" style="width: 100%; height: auto;">
            </div>

            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">Then, Trocador will request 3 things from you:</p>

            <ul style="display: flex; flex-direction: column; gap: 8px; padding-left: 20px; color: var(--dm-text-secondary); list-style-type: disc;">
                <li><strong>Your Monero address (marked in red rectangle in the image):</strong> You must provide a valid Monero subaddress to receive your XMR. This is the wallet where you'll receive your coins.</li>
                <li><strong>Return address (marked in green rectangle):</strong> This is optional. You can provide a Litecoin address in case something goes wrong with your transaction. The exchange provider will return your coins to this address if needed.</li>
                <li><strong>Exchange provider selection (marked in blue rectangle):</strong> You'll need to choose an exchange provider. Remember, Trocador itself is just an organizer that sorts prices from trusted exchanges - you DO NOT directly trade with Trocador. Choose from the providers listed on the right side of the page. FixedFloat is our default choice as it typically offers the best prices for this trade. You can also choose other reliable providers like Alfacash or eXch depending on your needs.</li>
            </ul>

            <div style="margin: 15px 0; max-width: 600px; border: 1px solid var(--dm-border-color); border-radius: 8px; overflow: hidden;">
                <img src="{{ asset('images/guides/monero/20.png') }}" alt="Trocador Requirements Screen" style="width: 100%; height: auto;">
            </div>

            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">Click "Confirm Exchange" to create an order.</p>

            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">Now you have created an order. You need to open your wallet software (or a custodial exchange's wallet) and send the required Litecoin amount to the shown address.</p>

            <div style="margin: 15px 0; max-width: 600px; border: 1px solid var(--dm-border-color); border-radius: 8px; overflow: hidden;">
                <img src="{{ asset('images/guides/monero/21.png') }}" alt="Trocador Confirmation Screen" style="width: 100%; height: auto;">
            </div>

            <div style="background: rgba(255, 153, 0, 0.05); border: 1px solid #ff9900; border-radius: 8px; padding: 20px; margin-top: 25px; color: var(--dm-text-main);">
                Now, all you have to do is wait until your Litecoin transaction is confirmed. This may take up to 10 minutes in total. Your Monero will be sent to your wallet address approximately in half an hour.
            </div>

            <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 15px; margin-top: 30px; color: var(--dm-text-main);">Using Haveno (P2P Exchange)</h3>

            <p style="font-size: 16px; color: var(--dm-text-main); margin-bottom: 15px;">Our third method is the most privacy-friendly option, though it's not beginner-friendly. We'll use Haveno, a peer-to-peer decentralized exchange, where you can buy Monero from others using cash by mail. While I won't go into full detail in this guide, here's what you need to know:</p>

            <ul style="display: flex; flex-direction: column; gap: 12px; padding-left: 20px; color: var(--dm-text-secondary); list-style-type: disc;">
                <li>First, download and install RetoSwap, which is based on Haveno. RetoSwap isn't a website or centralized service - it's a peer-to-peer trading network that everyone uses. You'll run this software on your own hardware, connecting directly to other RetoSwap users to make trades. Simply visit <a href="https://retoswap.com/" style="color: var(--link-color);">https://retoswap.com/</a> to download it.</li>
                <li>For detailed instructions, you can follow a comprehensive guide written by a respected member of the Monero community known as "Nihilist". He has shared step-by-step instructions on his blog (.onion link): <a href="http://blog.nowherejezfoltodf4jiyl6r56jnzintap5vyjlia7fkirfsnfizflqd.onion/opsec/haveno-cashbymail/index.html" style="color: var(--link-color);">http://blog.nowherejezfoltodf4jiyl6r56jnzintap5vyjlia7fkirfsnfizflqd.onion/opsec/haveno-cashbymail/index.html</a></li>
                <li>Since Nihilist has already created detailed explanations for each step, I won't duplicate that information here. His guide will walk you through the entire process.</li>
            </ul>
        </section>

        <div style="margin-top: 50px; padding-top: 25px; border-top: 1px solid var(--dm-border-color); text-align: center;">
            <a href="{{ route('guides.index') }}" class="btn btn-secondary" style="display: inline-block; padding: 10px 20px; background-color: var(--dm-secondary-btn-bg); color: var(--dm-secondary-btn-text); border: 1px solid var(--dm-secondary-btn-border); border-radius: 5px; text-decoration: none; font-size: 16px;">Back to All Guides</a>
        </div>
    </div>
</div>
@endsection
