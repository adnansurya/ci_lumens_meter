   <div class="container" data-aos="fade-right">
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card border-left-success shadow mb-4">
                <div class="card-header py-3">
                    <center><h4 class="m-0 font-weight-bold text-success"><?= $title; ?></h4></center>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('update.php');?>" method="post">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <center><label for="floatingInputValue">TDS Minimum</label></center>
                                <input type="number" class="form-control" name="ppmA" id="ppmA" value="<?= $tds['nilai1']; ?>" required style="text-align: center;" >
                            </div>
                            <div class="col-sm-6">
                                <center><label for="floatingInputValue">TDS Maksimal</label></center>
                                <input type="number" class="form-control" name="ppmB" id="ppmB" value="<?= $tds['nilai2']; ?>" required style="text-align: center;">
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0"><br>
                                <center><label for="floatingInputValue">PH Minimum</label></center>
                                <input type="text" class="form-control" name="phsetA" id="phsetA" value="<?= $tds['nilai3']; ?>" required style="text-align: center;">
                            </div>
                            <div class="col-sm-6"><br>
                                <center><label for="floatingInputValue">PH Maksimal</label></center>
                                <input type="text" class="form-control" name="phsetB" id="phsetB" value="<?= $tds['nilai4']; ?>" required style="text-align: center;">
                            </div>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6"><br><br>
                                <button type="submit" class="btn btn-success btn-block">Send</button> 
                            </div>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-12"><br><br>                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>