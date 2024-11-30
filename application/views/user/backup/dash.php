<div id='content'>
    <div class='container'>
      <h1> Controlling Lamp</h1>

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">

        <div class="col">
          <div class="card h-100 text-white bg-dark mb-3 shadow-sm d-flex flex-column justify-content-center" id="card">
            <div class="row g-0">
              <div id="canvas" class="col-12">
                <img src="Logo/contasrt.jpeg" class="img-fluid rounded-start" alt="...">
              </div>
              <div class="col-8">
                <div class="card-body">
                  <p class="card-title">Setting Contrast</p>
                  <div class="slide-container">
                    <input type="range" min="0" max="100" class="slider" id="mySlider">
                    <h1 class="value" id="sliderValue">0</h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100 text-white bg-dark mb-3 shadow-sm" id="card">
            <div class="row g-0">
              <div id="canvas" style="width:100%" class="col-md-12">
                <img src="Logo/pngegg.png" class="img-fluid rounded-start" alt="...">
              </div>
              <div class="col-md-12">
                <div class="card-body">
                  <p class="card-title">Lux level</p>
                  <h1 class="card-text" id='pressure_102'>0</h1>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="card h-100 text-white bg-dark mb-3 shadow-sm" id="card">
            <div class="row g-0">
              <div id="canvas" style="width:100%" class="col-md-12">
                <img src="Logo/icon-listrik.png" class="img-fluid rounded-start" alt="...">
              </div>
              <div class="col-md-12">
                <div class="card-body">
                  <p class="card-title">Watt of Lamp</p>
                  <h1 class="card-text" id='pressure_103'>0</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
