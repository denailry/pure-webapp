<?php
    global $SESSION;
    if ($SESSION == null) {
        setvar('username', 'guest');
    } else {
        $user = $SESSION->get_user();
        setvar('username', $user->username);
    }
?>
<div id="bar">
    <div id="top-bar">
        <div id="main-title" class="top-bar-item">
            <span style="color: #f1d801;">Pro</span>-Book
        </div>
        <div class="top-bar-item top-bar-info">
            <img id="logout" style="height: 100%; cursor: pointer;" src="statics/img/logout.jpg" 
                onmouseover="hover(true)"
                onmouseout="hover(false)"
                onclick="window.location.href='logout';">
        </div class="top-bar-item top-bar-info">
        <div id="menu-hi" class="top-bar-item top-bar-info">
            Hi, <?php getvar('username') ?>
        </div>
    </div>
    <div id="menu-bar">
        <div id="menu-browse" style="border-right: 2px solid #000000;" onclick="window.location.href = '/'">
            <div>
                <p>Browse</p>
            </div>
        </div>
        <div id="menu-history" style="border-right: 2px solid #000000;" onclick="window.location.href = 'history'">
            <div>
                <p>History</p>
            </div>
        </div>
        <div id="menu-profile" onclick="window.location.href = 'profile'">
            <div>
                <p>Profile</p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function hover(status) {
        if (status) {
            document.getElementById("logout").src = "statics/img/logout-hover.png";
        } else {
            document.getElementById("logout").src = "statics/img/logout.jpg";
        }
    }

    let page = <?php getvar('page', true) ?>;
    if (page == 'browse' || page == 'history' || page == 'profile') {
        document.getElementById('menu-' + page).setAttribute("data-menu-selected", "");
    }
</script>