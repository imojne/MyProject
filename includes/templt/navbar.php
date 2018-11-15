<nav class="navbar navbar-default">
    <div class="container">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-collp" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Home &nbsp;<span class="fa fa-home fa-s15x"></span></a>
        </div>

        <div class="collapse navbar-collapse" id="nav-collp">
            <ul class="nav navbar-nav">

            </ul>

            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings &nbsp;<i class="fa fa-cog fa-fw"></i> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="mambers.php?action=Edit&userid=<?php echo $_SESSION['ID']?>"><i class="fa fa-home fa-s15x"></i>&nbsp; <?php echo lang('PROFILE_EDIT')?></a></li>
                        <li><a href="#"><i class="fa fa-hacker-news fa-s15x"></i> &nbsp; <?php echo lang('VIEW_PAGES')?></a></li>
                        <li><a href="logout.php"> <i class="fa fa-sign-out fa-s15x"></i>&nbsp; <?php echo lang('LOGOUT')?></a></li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

