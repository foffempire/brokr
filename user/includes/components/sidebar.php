<?php require_once("includes/init.php") ?>
    <div class="side-nav">
    <div class="side-wallet-box default-wallet mb-0">
        <div class="user-balance-card">
            <div class="wallet-name">
                <div class="name">Account Balance</div>
                <div class="default">Wallet</div>
            </div>
            <div class="wallet-info">
                <div class="wallet-id"><i icon-name="wallet"></i>Main Wallet</div>
                <div class="balance">$<?= number_format($user->bal(),2) ?></div>
            </div>
            <div class="wallet-info">
                <div class="wallet-id"><i icon-name="landmark"></i>Profit Wallet</div>
                <div class="balance">$<?= number_format($user->profit(),2) ?></div>
            </div>
        </div>
        <div class="actions">
            <a href="./deposit" class="user-sidebar-btn"><i
                    class="anticon anticon-file-add"></i>Deposit</a>
            <a href="./schemas" class="user-sidebar-btn red-btn"><i
                    class="anticon anticon-export"></i>Invest Now</a>
        </div>
    </div>
    <div class="side-nav-inside">
        <ul class="side-nav-menu">
            <li class="side-nav-item <?= PAGE=="dashboard"?"active":"" ?> ">
                <a href="./dashboard"><i
                        class="anticon anticon-appstore"></i><span>Dashboard</span></a>
            </li>

            <li class="side-nav-item <?= PAGE=="plans"?"active":"" ?> ">
                <a href="./schemas"><i
                        class="anticon anticon-check-square"></i><span>Investment Plans</span></a>
            </li>
            <li class="side-nav-item <?= PAGE=="logs"?"active":"" ?> ">
                <a href="./invest-logs"><i
                        class="anticon anticon-copy"></i><span>Investment Logs</span></a>
            </li>

            <li class="side-nav-item <?= PAGE=="transactions"?"active":"" ?> ">
                <a href="./transactions"><i
                        class="anticon anticon-inbox"></i><span>All Transactions</span></a>
            </li>


            <li class="side-nav-item <?= PAGE=="deposit"?"active":"" ?>   ">
                <a href="./deposit"><i
                        class="anticon anticon-file-add"></i><span>Fund Wallet</span></a>
            </li>
            <li class="side-nav-item <?= PAGE=="depositlog"?"active":"" ?> ">
                <a href="./deposit-log"><i
                        class="anticon anticon-folder-add"></i><span>Funding History</span></a>
            </li>

            <li class="side-nav-item <?= PAGE=="exchange"?"active":"" ?> ">
                <a href="./wallet-exchange"><i
                        class="anticon anticon-transaction"></i><span>Wallet Exchange</span></a>
            </li>

            <li class="side-nav-item <?= PAGE=="send"?"active":"" ?>   ">
                <a href="./send-money"><i
                        class="anticon anticon-export"></i><span>Send Money</span></a>
            </li>
            <li class="side-nav-item <?= PAGE=="sendlog"?"active":"" ?> ">
                <a href="./send-money-log"><i
                        class="anticon anticon-cloud"></i><span>Send Money Log</span></a>
            </li>

            <li class="side-nav-item <?= PAGE=="withdraw"?"active":"" ?>   ">
                <a href="./withdraw"><i
                        class="anticon anticon-bank"></i><span>Withdraw Funds</span></a>
            </li>
            <li class="side-nav-item <?= PAGE=="withdrawlog"?"active":"" ?> ">
                <a href="./withdraw-log"><i
                        class="anticon anticon-credit-card"></i><span>Withdrawal Log</span></a>
            </li>

            <li class="side-nav-item <?= PAGE=="rank"?"active":"" ?> ">
                <a href="./ranking-badge"><i
                        class="anticon anticon-star"></i><span>Ranking Badge</span></a>
            </li>

                            <li class="side-nav-item <?= PAGE=="referral"?"active":"" ?> ">
                    <a href="./referral"><i
                            class="anticon anticon-usergroup-add"></i><span>Referral</span></a>
                </li>
            
            <li class="side-nav-item <?= PAGE=="settings"?"active":"" ?> ">
                <a href="./settings"><i
                        class="anticon anticon-setting"></i><span>Settings</span></a>
            </li>
            <li class="side-nav-item <?= PAGE=="support"?"active":"" ?> ">
                <a href="./support-ticket"
                ><i class="anticon anticon-tool"></i><span>Support Tickets</span></a
                >
            </li>
            <li class="side-nav-item">
                <a href="./logout" class="site-btn grad-btn w-100">
                    <i class="anticon anticon-logout"></i><span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>