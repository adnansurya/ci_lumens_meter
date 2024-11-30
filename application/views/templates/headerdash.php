<!doctype html>

<html lang="id">



<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard ICS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- <link rel="stylesheet" href="stylesheet.css"> -->

    <script src="https://unpkg.com/chart.js@2.8.0/dist/Chart.bundle.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <style>

        @import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";

        



body {

    font-family: 'Poppins', sans-serif;

    background: #fafafa;

    

    

}



p {

    font-family: 'Poppins', sans-serif;

    font-size: 1.1em;

    font-weight: 300;

    line-height: 1.7em;

    color: #999;

    

}



a,

a:hover,

a:focus {

    color: inherit;

    text-decoration: none;

    transition: all 0.3s;

}



.slider{

    width: 150%;

}



.navbar {

    padding: 15px 10px;

    background: #fff;

    border: none;

    border-radius: 0;

    margin-bottom: 40px;

    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);

}



.navbar-btn {

    box-shadow: none;

    outline: none !important;

    border: none;

}





/* ---------------------------------------------------

    SIDEBAR STYLE

----------------------------------------------------- */



.wrapper {

    display: flex;

    width: 100%;

    

}



.wrapper:hover #slide {

    transition: 1s;

    left: 0;

}





#sidebar {

    min-width: 200px;

    max-width: 200px;

    background-image: linear-gradient(120deg, #0e0e0e 0%, #3b3b3b 100%);

    color: #fff;

    animation: slideIn2 0.75s;

    

    

}



#card{

    background-image:linear-gradient(to right, #0f0c29, #302b63, #24243e);

    

}



#sidebar.active {

    margin-left: -250px;

}



#sidebar .sidebar-header {

    padding: 20px;

    background-image:linear-gradient(to right, #0f0c29, #302b63, #24243e)

    

}



#sidebar ul.components {

    padding: 30px 0;

    }



#sidebar ul p {

    color: #fff;

    padding: 10px;

}



#sidebar ul li a {

    padding: 10px;

    font-size: 1.1em;

    display: block;

}



#sidebar ul li a:hover {

    color: #2d3237;

    background: #fff;

}





ul ul a {

    font-size: 0.9em !important;

    padding-left: 30px !important;

    background: #6d7fcc;

}







/* ---------------------------------------------------

    CONTENT STYLE

----------------------------------------------------- */



#content {

    width: 100%;

    padding: 20px;

    min-height: 100vh;

    animation: slideIn 0.75s;

}



/* ---------------------------------------------------

    MEDIAQUERIES

----------------------------------------------------- */



@media (max-width: 768px) {

    #sidebar {

        margin-left: -250px;

    }

    #sidebar.active {

        margin-left: 0;

    }

    #sidebarCollapse span {

        display: none;

    }

}



@keyframes slideIn {

    from {

      opacity: 0;

      transform: translateY(-10px);

    }

    to {

      opacity: 1;

      transform: translateY(0px);

    }

  }



  @keyframes slideIn2 {

    from {

      opacity: 0;

      transform: translateX(-10px);

    }

    to {

      opacity: 1;

      transform: translatex(0px);

    }

  }

    </style>





</head>

<body>