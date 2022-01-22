{{-- Bootstap --}}
<link rel="stylesheet" href="{{ asset('asset/css/bootstrap.min.css') }}">

{{-- Icon Bootstrap --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

{{-- datatables --}}
<link rel="stylesheet" href="{{ asset('asset/css/dataTables.bootstrap5.min.css') }}">

{{-- sidebar --}}
<link href='https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css' rel='stylesheet'>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");

    :root {
        --header-height: 3rem;
        --nav-width: 68px;
        --first-color: #4723D9;
        --first-color-light: #AFA5D9;
        --white-color: #F7F6FB;
        --body-font: 'Nunito', sans-serif;
        --normal-font-size: 1rem;
        --z-fixed: 100
    }
    
    *,
    ::before,
    ::after {
        box-sizing: border-box
    }
    
    body {
        position: relative;
        margin: var(--header-height) 0 0 0;
        padding: 0 1rem;
        font-family: var(--body-font);
        font-size: var(--normal-font-size);
        transition: .5s;
        background-color: #f6f6f6;
    }
    
    a {
        text-decoration: none
    }
    
    .header {
        width: 100%;
        height: var(--header-height);
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 1rem;
        background-color: var(--white-color);
        z-index: var(--z-fixed);
        transition: .5s
    }
    
    .header_toggle {
        color: var(--first-color);
        font-size: 1.5rem;
        cursor: pointer
    }
    
    .header_img {
        width: 35px;
        height: 35px;
        display: flex;
        justify-content: center;
        border-radius: 50%;
        overflow: hidden
    }
    
    .header_img img {
        width: 40px
    }
    
    .l-navbar {
        position: fixed;
        top: 0;
        left: -30%;
        width: var(--nav-width);
        height: 100vh;
        background-color: var(--first-color);
        padding: .5rem 1rem 0 0;
        transition: .5s;
        z-index: var(--z-fixed)
    }
    
    #nav-bar .nav {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow: hidden
    }
    
    #nav-bar .nav_logo,
    #nav-bar .nav_link {
        display: grid;
        grid-template-columns: max-content max-content;
        align-items: center;
        column-gap: 1rem;
        padding: .5rem 0 .5rem 1.5rem
    }
    
    .nav_logo {
        margin-bottom: 2rem
    }
    
    .nav_logo-icon {
        font-size: 1.25rem;
        color: var(--white-color)
    }
    
    .nav_logo-name {
        color: var(--white-color);
        font-weight: 700
    }
    
    .nav_link {
        position: relative;
        color: var(--first-color-light);
        margin-bottom: 1.5rem;
        transition: .3s
    }
    
    .nav_link:hover {
        color: var(--white-color)
    }
    
    .nav_icon {
        font-size: 1.25rem
    }
    
    #nav-bar.show {
        left: 0
    }
    
    .body-pd {
        padding-left: calc(var(--nav-width) + 1rem)
    }
    
    #nav-bar .active {
        color: var(--white-color)
    }
    
    #nav-bar .active::before {
        content: '';
        position: absolute;
        left: 0;
        width: 2px;
        height: 32px;
        background-color: var(--white-color)
    }
    
    .height-100 {
        height: 100vh
    }
    
    @media screen and (min-width: 768px) {
        body {
            margin: calc(var(--header-height) + 1rem) 0 0 0;
            padding-left: calc(var(--nav-width) + 2rem)
        }
    
        .header {
            height: calc(var(--header-height) + 1rem);
            padding: 0 2rem 0 calc(var(--nav-width) + 2rem)
        }
    
        .header_img {
            width: 40px;
            height: 40px
        }
    
        .header_img img {
            width: 45px
        }
    
        .l-navbar {
            left: 0;
            padding: 1rem 1rem 0 0
        }
    
        #nav-bar.show {
            width: calc(var(--nav-width) + 156px)
        }
    
        .body-pd {
            padding-left: calc(var(--nav-width) + 188px)
        }
    }
</style>