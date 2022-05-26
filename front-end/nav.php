<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="./">
        <img class="brand-size" src="/front-end/images/Title.png" alt="Hoops">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/front-end">Home</a>
            </li>
            <?php
                if(isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"]) {
                    echo "<li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"/front-end/allCategories.php\">All Categories</a>
                    </li>";
                }
            ?>
        </ul>
        <a class="btn btn-<?php echo (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"]) ? "danger" : "success"; ?> my-2 my-sm-0" href="<?php echo (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"]) ? "/front-end/logOut.php\">Log out" : "/front-end/adminLogin.php\">Login"; ?></a>
    </div>
</nav>