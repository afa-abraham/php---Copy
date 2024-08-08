<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MatchMakeme</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.12.2/dist/sweetalert2.min.css
" rel="stylesheet">
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.12.2/dist/sweetalert2.all.min.js
"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        ::after,
        ::before {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .main-wrapper .main .row>* {
            max-width: 30% !important;
        }

        a {
            text-decoration: none;
        }

        li {
            list-style: none;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        .wrapper {
            display: flex;
        }

        .main {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
            overflow: hidden;
            transition: all 0.35s ease-in-out;
            background-color: #fff;
            min-width: 0;
        }

        #sidebar {
            width: 70px;
            min-width: 70px;
            z-index: 1000;
            transition: all .25s ease-in-out;
            background-color: #0e2238;
            display: flex;
            flex-direction: column;
        }

        #sidebar.expand {
            width: 260px;
            min-width: 260px;
        }

        .toggle-btn {
            background-color: transparent;
            cursor: pointer;
            border: 0;
            padding: 1rem 1.5rem;
        }

        .toggle-btn i {
            font-size: 1.5rem;
            color: #FFF;
        }

        .sidebar-logo {
            margin: auto 0;
        }

        .sidebar-logo a {
            color: #FFF;
            font-size: 1.15rem;
            font-weight: 600;
        }

        #sidebar:not(.expand) .sidebar-logo,
        #sidebar:not(.expand) a.sidebar-link span {
            display: none;
        }

        #sidebar.expand .sidebar-logo,
        #sidebar.expand a.sidebar-link span {
            animation: fadeIn .25s ease;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .sidebar-nav {
            padding: 2rem 0;
            flex: 1 1 auto;
        }

        a.sidebar-link {
            padding: .625rem 1.625rem;
            color: #FFF;
            display: block;
            font-size: 0.9rem;
            white-space: nowrap;
            border-left: 3px solid transparent;
        }

        .sidebar-link i,
        .dropdown-item i {
            font-size: 1.1rem;
            margin-right: .75rem;
        }

        a.sidebar-link:hover {
            background-color: rgba(255, 255, 255, .075);
            border-left: 3px solid #3b7ddd;
        }

        .sidebar-item {
            position: relative;
        }

        #sidebar:not(.expand) .sidebar-item .sidebar-dropdown {
            position: absolute;
            top: 0;
            left: 70px;
            background-color: #0e2238;
            padding: 0;
            min-width: 15rem;
            display: none;
        }

        #sidebar:not(.expand) .sidebar-item:hover .has-dropdown+.sidebar-dropdown {
            display: block;
            max-height: 15em;
            width: 100%;
            opacity: 1;
        }

        #sidebar.expand .sidebar-link[data-bs-toggle="collapse"]::after {
            border: solid;
            border-width: 0 .075rem .075rem 0;
            content: "";
            display: inline-block;
            padding: 2px;
            position: absolute;
            right: 1.5rem;
            top: 1.4rem;
            transform: rotate(-135deg);
            transition: all .2s ease-out;
        }

        #sidebar.expand .sidebar-link[data-bs-toggle="collapse"].collapsed::after {
            transform: rotate(45deg);
            transition: all .2s ease-out;
        }

        .navbar {
            background-color: #f5f5f5;
            box-shadow: 0 0 2rem 0 rgba(33, 37, 41, .1);
        }

        .navbar-expand .navbar-collapse {
            min-width: 200px;
        }

        .avatar {
            height: 40px;
            width: 40px;
        }



        @media (min-width: 768px) {}

        .discussions {
            width: 25%;
            height: 700px;
            box-shadow: 0px 8px 10px rgba(0, 0, 0, 0.20);
            overflow: hidden;
            background-color: #87a3ec;
            display: inline-block;
        }

        .discussions .discussion {
            width: 100%;
            height: 90px;
            background-color: #FAFAFA;
            border-bottom: solid 1px #E0E0E0;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .discussions .search {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #E0E0E0;
        }

        .discussions .search .searchbar {
            height: 40px;
            background-color: #FFF;
            width: 70%;
            padding: 0 20px;
            border-radius: 50px;
            border: 1px solid #EEEEEE;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .discussions .search .searchbar input {
            margin-left: 15px;
            height: 38px;
            width: 100%;
            border: none;
            font-family: 'Montserrat', sans-serif;
            ;
        }

        .discussions .search .searchbar *::-webkit-input-placeholder {
            color: #E0E0E0;
        }

        .discussions .search .searchbar input *:-moz-placeholder {
            color: #E0E0E0;
        }

        .discussions .search .searchbar input *::-moz-placeholder {
            color: #E0E0E0;
        }

        .discussions .search .searchbar input *:-ms-input-placeholder {
            color: #E0E0E0;
        }

        .discussions .message-active {
            width: 100%;
            height: 90px;
            background-color: #FFF;
            border-bottom: solid 1px #E0E0E0;
        }

        .discussions .discussion .photo {
            margin-left: 20px;
            display: block;
            width: 45px;
            height: 45px;
            background: #E6E7ED;
            -moz-border-radius: 50px;
            -webkit-border-radius: 50px;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .online {
            position: relative;
            top: 30px;
            left: 35px;
            width: 13px;
            height: 13px;
            background-color: #8BC34A;
            border-radius: 13px;
            border: 3px solid #FAFAFA;
        }

        .desc-contact {
            height: 43px;
            width: 50%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .discussions .discussion .name {
            margin: 0 0 0 20px;
            font-family: 'Montserrat', sans-serif;
            font-size: 11pt;
            color: #515151;
        }

        .discussions .discussion .message {
            margin: 6px 0 0 20px;
            font-family: 'Montserrat', sans-serif;
            font-size: 9pt;
            color: #515151;
        }

        .timer {
            margin-left: 15%;
            font-family: 'Open Sans', sans-serif;
            font-size: 11px;
            padding: 3px 8px;
            color: #BBB;
            background-color: #FFF;
            border: 1px solid #E5E5E5;
            border-radius: 15px;
        }


        .chat {
            width: calc(40% - 85px);
        }

        .client_profile {
            width: calc(40% - 85px);
        }

        .header-chat {
            background-color: #FFF;
            height: 90px;
            box-shadow: 0px 3px 2px rgba(0, 0, 0, 0.100);
            display: flex;
            align-items: center;
        }

        .chat .header-chat .icon {
            margin-left: 30px;
            color: #515151;
            font-size: 14pt;
        }

        .chat .header-chat .name {
            margin: 0 0 0 20px;
            text-transform: uppercase;
            font-family: 'Montserrat', sans-serif;
            font-size: 13pt;
            color: #515151;
        }

        .chat .header-chat .right {
            position: absolute;
            right: 40px;
        }

        .chat .messages-chat {
            padding: 25px 35px;
        }

        .chat .messages-chat .message {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .chat .messages-chat .message .photo {
            display: block;
            width: 45px;
            height: 45px;
            background: #E6E7ED;
            -moz-border-radius: 50px;
            -webkit-border-radius: 50px;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .chat .messages-chat .text {
            margin: 0 35px;
            background-color: #f6f6f6;
            padding: 15px;
            border-radius: 12px;
        }

        .text-only {
            margin-left: 45px;
        }

        .time {
            font-size: 10px;
            color: lightgrey;
            margin-bottom: 10px;
            margin-left: 85px;
        }

        .response-time {
            float: right;
            margin-right: 40px !important;
        }

        .response {
            float: right;
            margin-right: 0px !important;
            margin-left: auto;
            /* flexbox alignment rule */
        }

        .response .text {
            background-color: #e3effd !important;
        }

        .footer-chat {
            width: calc(40% - 120px);
            height: 80px;
            display: flex;
            align-items: center;
            position: absolute;
            bottom: 0;
            background-color: transparent;
            border-top: 2px solid #EEE;

        }

        .chat .footer-chat .icon {
            margin-left: 30px;
            color: #C0C0C0;
            font-size: 14pt;
        }

        .chat .footer-chat .send {
            color: #fff;
            background-color: #4f6ebd;
            position: absolute;
            right: 50px;
            padding: 12px 12px 12px 12px;
            border-radius: 50px;
            font-size: 14pt;
            top: 20px;
        }

        .chat .footer-chat .name {
            margin: 0 0 0 20px;
            text-transform: uppercase;
            font-family: 'Montserrat', sans-serif;
            font-size: 13pt;
            color: #515151;
        }

        .chat .footer-chat .right {
            position: absolute;
            right: 40px;
        }

        .write-message {
            border: none !important;
            width: 60%;
            height: 50px;
            margin-left: 20px;
            padding: 10px;
        }

        .footer-chat *::-webkit-input-placeholder {
            color: #C0C0C0;
            font-size: 13pt;
        }

        .footer-chat input *:-moz-placeholder {
            color: #C0C0C0;
            font-size: 13pt;
        }

        .footer-chat input *::-moz-placeholder {
            color: #C0C0C0;
            font-size: 13pt;
            margin-left: 5px;
        }

        .footer-chat input *:-ms-input-placeholder {
            color: #C0C0C0;
            font-size: 13pt;
        }

        .clickable {
            cursor: pointer;
        }
    </style>
    
</head>