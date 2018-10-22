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
                <div>
                    <input id="input-search" type="text" placeholder="Input search terms...">
                </div>
                <button id="btn-search" class="btn-primary">Search</button>
            </div>
        </div>
    </body>
</html>