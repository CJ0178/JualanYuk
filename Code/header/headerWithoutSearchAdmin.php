<div class="container">
    <!-- logo -->
    <a href="../home/home.php">
        <div class="logo" style="background-image: url(../image/logo.svg) ;"></div>
    </a>

    <!-- akun -->
    <div class="namaAkun"><?= $currentUsername ?></div>

    <!-- kotak logo -->
    <div class="kotakLogo">
        <div class="logOut">
            <a href="../logout.php">
                <svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.66667 23.3333H11.6667C12.1086 23.3329 12.5322 23.1572 12.8447 22.8447C13.1572 22.5322 13.3329 22.1086 13.3333 21.6667V19.1667H11.6667V21.6667H1.66667V1.66667H11.6667V4.16667H13.3333V1.66667C13.3329 1.22477 13.1572 0.801108 12.8447 0.488643C12.5322 0.176178 12.1086 0.000441231 11.6667 0H1.66667C1.22477 0.000441231 0.801108 0.176178 0.488643 0.488643C0.176178 0.801108 0.000441231 1.22477 0 1.66667V21.6667C0.000441231 22.1086 0.176178 22.5322 0.488643 22.8447C0.801108 23.1572 1.22477 23.3329 1.66667 23.3333Z" fill="white"/>
                    <path d="M13.8217 15.4884L16.81 12.5001H5V10.8334H16.81L13.8217 7.84508L15 6.66675L20 11.6667L15 16.6667L13.8217 15.4884Z" fill="white"/>
                </svg>                                     
            </a>                             
        </div>
    </div>

    <!-- Hamburger -->
    <div class="hamburger" id="hamburger">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
    </div>
</div>

<div class="dropdownMenu displayNone">
    <a href="../addStok/addStok.php"><div class="menu">Tambah Barang</div></a>
    <a href="../logout.php"><div class="menu logout">Logout</div></a>
</div>