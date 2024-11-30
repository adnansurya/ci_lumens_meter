<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Controlling Lamp</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    

</head>

<body>



<div id='content'>

    <div class='container'>

        <h1>Controlling Lamp</h1>



        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">



            <div class="col">

                <div class="card h-100 text-white bg-dark mb-3 shadow-sm d-flex flex-column justify-content-center" id="card-contrast">

                    <div class="row g-0">

                        <div id="contrast-canvas" class="col-12">

                            <img src="Logo/contasrt.jpeg" class="img-fluid rounded-start" alt="...">

                        </div>

                        <div class="col-8">

                            <div class="card-body">

                                <p class="card-title">Setting Contrast</p>

                                <div class="slide-container">

                                    <input type="range" min="0" max="100" class="slider" id="mySlider">
                                    <!-- <input type="range" id="mySlider" min="0" max="100" style="transform: rotate(-90deg);"> -->


                                    <h1 class="value" id="sliderValue">0%</h1>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <div class="col">

                <div class="card h-100 text-white bg-dark mb-3 shadow-sm" id="card-lux">

                    <div class="row g-0">

                        <div id="lux-canvas" style="width:100%" class="col-md-12">

                            <img src="Logo/pngegg.png" class="img-fluid rounded-start" alt="...">

                        </div>

                        <div class="col-md-12">

                            <div class="card-body">

                                <p class="card-title">Lux level</p>

                                <h1 class="card-text" id='pressure_102'>0 Lumen</h1>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <div class="col">

                <div class="card h-100 text-white bg-dark mb-3 shadow-sm" id="card-watt">

                    <div class="row g-0">

                        <div id="watt-canvas" style="width:100%" class="col-md-12">

                            <img src="Logo/icon-listrik.png" class="img-fluid rounded-start" alt="...">

                        </div>

                        <div class="col-md-12">

                            <div class="card-body">

                                <p class="card-title">Watt of Lamp</p>

                                <h1 class="card-text" id='pressure_103'>0 Watt</h1>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



        </div>

    </div>

</div>