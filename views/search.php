<!DOCTYPE html>
<html>
    <head>
        <title>Search</title>
        <link rel="stylesheet" type="text/css" href="statics/css/home.css">
    </head>
    <body>
        <?php setvar('page', 'browse'); embed("main-bar"); ?>
        <div id="main">
            <div id="box-search">
                <h1>Search Book</h1>
                <form id="search-form" action="/tugasbesar1_2018/search_result.php" method="GET" autocomplete="off">
                    <input id="input-search" type="text" name="input-search" placeholder="Input search terms...">
                    <button id="btn-search" class="btn-primary" type="button" onclick="checkInputSearch()" >Search</button>
                </form>
                <div id="failure-notif" class="box-center"></div>
            </div>
        </div>
    </body>
    <script src="statics/js/failure-notif.js"></script>
    <script type="text/javascript">
        function checkInputSearch() {
            var input = document.getElementById('input-search').value;
            if (input.trim() === "") {
                showFailureNotif("input search is empty");
            } else {
                document.getElementById('search-form').submit();
            }   
        }
    </script>
</html>