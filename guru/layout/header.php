<!--Summernote-->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="search_bar dropdown">
                        <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                            <i class="mdi mdi-magnify"></i>
                        </span>
                        <div class="dropdown-menu p-0 m-0">
                            <form>
                                <input class="form-control" type="search" placeholder="Mau Mengajar Apa?" aria-label="Search">
                            </form>
                        </div>
                    </div>
                </div>

                <ul class="navbar-nav header-right">
                    <div class="JamDigital">
                        <div id="date">Senin, 11 November 2024</div>

                        <ul>
                            <li id="jam">14</li>
                            <li id="point">:</li>
                            <li id="menit">17</li>
                            <li id="point">:</li>
                            <li id="detik">29</li>
                        </ul>
                    </div>
                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                            <i class="mdi mdi-account"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="./ProfileUser.html" class="dropdown-item">
                                <i class="icon-user"></i>
                                <span class="ml-2">Profile </span>
                            </a>
                            <a href="./email-inbox.html" class="dropdown-item">
                                <i class="icon-envelope-open"></i>
                                <span class="ml-2">Inbox </span>
                            </a>
                            <a href="/sabiwebsite/logout.php" class="dropdown-item">
                                <i class="icon-key"></i>
                                <span class="ml-2">Logout </span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>

<style>
    .JamDigital{
        color: #585858;
        padding: 20px;
        font: bold 12px Arial, Helvetica, sans-serif;
    }
    #date{
        margin-left: 10px;
        font-size: 12px !important;
        text-align: center;
    }
    .JamDigital ul{
        margin-left: 72px;
        list-style: none;
        display: flex;
        font-size: 20px;
        gap: 2px;
        text-align: center;
    }
</style>