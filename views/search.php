<!DOCTYPE html>
<html>
    <head>
        <title>Search</title>
        <link rel="stylesheet" type="text/css" href="statics/css/home.css">
    </head>
    <body>
        <?php embed("main-bar"); ?>
        <div id="main">
            <div id="box-search">
                <h1>Search Book</h1>
                <form action="/tugasbesar1_2018/search_result.php" method="GET" autocomplete="off">
                    <input id="input-search" type="text" name="input-search" placeholder="Input search terms...">
                    <button id="btn-search" class="btn-primary" type="submit">Search</button>
                </form>
            </div>
        </div>
    </body>
</html>