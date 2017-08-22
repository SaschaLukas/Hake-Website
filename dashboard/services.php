<?php
require('assets/php/requirements.php');

/*--------------Login--------------*/
$login = new login(false, false, true);
$login->setMYSQL('riverspoon.one.mysql', 'riverspoon_one', 'sascha', 'riverspoon_one');
$login->getData();
$login->login_check('index.php');

/*--------------PAGE--------------*/

$stats_mysql = new mysqli('riverspoon.one.mysql', 'riverspoon_one', 'sascha', 'riverspoon_one');

$stats = $stats_mysql->query("SELECT * FROM services")->fetch_row();


if($_POST['title']){
    $new_title = $stats_mysql->real_escape_string($_POST['title']);
    $new_urlaubscheck = $stats_mysql->real_escape_string($_POST['urlaubscheck']);
    $new_reperaturen = $stats_mysql->real_escape_string($_POST['reperaturen']);
    $new_motorkontrolle = $stats_mysql->real_escape_string($_POST['motorkontrolle']);
    $new_radwechsel = $stats_mysql->real_escape_string($_POST['räderwechsel']);
    $new_achsvermessung = $stats_mysql->real_escape_string($_POST['achsvermessung']);
    $new_huau = $stats_mysql->real_escape_string($_POST['huau']);
    
    $new_service1 = $stats_mysql->real_escape_string($_POST['service1']);
    $new_service2 = $stats_mysql->real_escape_string($_POST['service2']);
    $new_service3 = $stats_mysql->real_escape_string($_POST['service3']);
    $new_service4 = $stats_mysql->real_escape_string($_POST['service4']);
    $new_service5 = $stats_mysql->real_escape_string($_POST['service5']);
    $new_service6 = $stats_mysql->real_escape_string($_POST['service6']);

    $stats_mysql->query("UPDATE contact SET title = '".$new_title."', urlaubscheck = '".$new_urlaubscheck."', reperaturen='".$new_reperaturen."', motorkontrolle='".$new_motorkontrolle. "', räderwechsel='".$new_radwechsel."', achsvermessung='" .§new_achsvermessung. "', huau='" .§new_huau. "', service1= '" .$new_service1. "', service2='" .$new_service2. "', service3='" .$new_service3. "', service4='" .$new_service4. "', service5='" .$new_service5."', service6='" .$new_service6. "' WHERE title = '".$stats[4]."' LIMIT 1 ;");
    header("Location: services.php");
}

require('assets/templates/top.php');

breadcrumb('Services', 'Pages');
title('Services');

?>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                   Urlaubscheck <i class="fa fa-car" aria-hidden="true"></i>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="services.php" method="post">
                        <fieldset>

                            <div class="form-group">
                                <div class="col-md-9">
                                  <textarea id="urlaubscheck" name="urlaubscheck" type="text" class="form-control"><?php echo $stats[1]; ?></textarea>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 widget-right">
                                    <button type="Ändern" class="btn btn-default btn-md pull-right">Ã„ndern</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Reperaturen <i class="fa fa-desktop" aria-hidden="true"></i>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="services.php" method="post">
                        <fieldset>

                            <div class="form-group">
                                <div class="col-md-9">
                                  <textarea id="reperaturen" name="reperaturen" type="text" class="form-control"><?php echo $stats[2]; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 widget-right">
                                    <button type="Ändern" class="btn btn-default btn-md pull-right">Ändern</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Motor Kontrolle <i class="fa fa-check" aria-hidden="true"></i>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="services.php" method="post">
                        <fieldset>

                            <div class="form-group">
                                <div class="col-md-9">
                                  <textarea id="motorkontrolle" name="motorkontrolle" type="text" class="form-control"><?php echo $stats[3]; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 widget-right">
                                    <button type="Ändern" class="btn btn-default btn-md pull-right">Ändern</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
         
              <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                   RÃ¤derwechsel <i class="fa fa-dot-circle-o" aria-hidden="true"></i>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="services.php" method="post">
                        <fieldset>

                            <div class="form-group">
                                <div class="col-md-9">
                                  <textarea id="räderwechsel" name="räderwechsel" type="text" class="form-control"><?php echo $stats[4]; ?></textarea>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 widget-right">
                                    <button type="Ändern" class="btn btn-default btn-md pull-right">Ã„ndern</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Achsvermessung <i class="fa fa-wrench" aria-hidden="true"></i>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="services.php" method="post">
                        <fieldset>

                            <div class="form-group">
                                <div class="col-md-9">
                                  <textarea id="achsvermessung" name="achsvermessung" type="text" class="form-control"><?php echo $stats[5]; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 widget-right">
                                    <button type="Ändern" class="btn btn-default btn-md pull-right">Ändern</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    HU/AU <i class="fa fa-list" aria-hidden="true"></i>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="services.php" method="post">
                        <fieldset>

                            <div class="form-group">
                                <div class="col-md-9">
                                  <textarea id="huau" name="huau" type="text" class="form-control"><?php echo $stats[6]; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 widget-right">
                                    <button type="Ändern" class="btn btn-default btn-md pull-right">Ändern</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
                  
     <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Title <i class="fa fa-check" aria-hidden="true"></i>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="services.php" method="post">
                        <fieldset>

                            <div class="form-group">
                                <div class="col-md-9">
                                  <textarea id="title" name="title" type="text" class="form-control"><?php echo $stats[0]; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 widget-right">
                                    <button type="Ändern" class="btn btn-default btn-md pull-right">Ändern</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>

                  
 
                  
                  
                  
                  
                       <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                   Services #1 <i class="fa fa-car" aria-hidden="true"></i>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="services.php" method="post">
                        <fieldset>

                            <div class="form-group">
                                <div class="col-md-9">
                                  <textarea id="service1" name="service1" type="text" class="form-control"><?php echo $stats[7]; ?></textarea>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 widget-right">
                                    <button type="Ändern" class="btn btn-default btn-md pull-right">Ã„ndern</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
                           
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                   Services #2 <i class="fa fa-car" aria-hidden="true"></i>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="services.php" method="post">
                        <fieldset>

                            <div class="form-group">
                                <div class="col-md-9">
                                  <textarea id="service2" name="service2" type="text" class="form-control"><?php echo $stats[8]; ?></textarea>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 widget-right">
                                    <button type="Ändern" class="btn btn-default btn-md pull-right">Ã„ndern</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
                           
   <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                   Services #3 <i class="fa fa-car" aria-hidden="true"></i>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="services.php" method="post">
                        <fieldset>

                            <div class="form-group">
                                <div class="col-md-9">
                                  <textarea id="service3" name="service3" type="text" class="form-control"><?php echo $stats[9]; ?></textarea>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 widget-right">
                                    <button type="Ändern" class="btn btn-default btn-md pull-right">Ã„ndern</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
                 
                           
   <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                   Services #4 <i class="fa fa-car" aria-hidden="true"></i>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="services.php" method="post">
                        <fieldset>

                            <div class="form-group">
                                <div class="col-md-9">
                                  <textarea id="service4" name="service4" type="text" class="form-control"><?php echo $stats[10]; ?></textarea>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 widget-right">
                                    <button type="Ändern" class="btn btn-default btn-md pull-right">Ã„ndern</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
                  
                           
                              <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                   Services #5 <i class="fa fa-car" aria-hidden="true"></i>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="services.php" method="post">
                        <fieldset>

                            <div class="form-group">
                                <div class="col-md-9">
                                  <textarea id="service5" name="service5" type="text" class="form-control"><?php echo $stats[11]; ?></textarea>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 widget-right">
                                    <button type="Ändern" class="btn btn-default btn-md pull-right">Ã„ndern</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
                           
                           
                 <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                   Services #6 <i class="fa fa-car" aria-hidden="true"></i>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="services.php" method="post">
                        <fieldset>

                            <div class="form-group">
                                <div class="col-md-9">
                                  <textarea id="service6" name="service6" type="text" class="form-control"><?php echo $stats[12]; ?></textarea>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 widget-right">
                                    <button type="Ändern" class="btn btn-default btn-md pull-right">Ã„ndern</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
                  
                 
                  
    
                  </div>
         </div>
    </div>
    
    <div class="row">
        <div class="col-sm-12">
				<p class="back-link">created by Sascha W. & Timo J.</p>
        </div>
    </div><!--/.row-->
</div>	<!--/.main-->

<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/chart.min.js"></script>
<script src="assets/js/chart-data.js"></script>
<script src="assets/js/easypiechart.js"></script>
<script src="assets/js/easypiechart-data.js"></script>
<script src="assets/js/bootstrap-datepicker.js"></script>
<script src="assets/js/custom.js"></script>
<script>
    window.onload = function () {
        var chart1 = document.getElementById("line-chart").getContext("2d");
        window.myLine = new Chart(chart1).Line(lineChartData, {
            responsive: true,
            scaleLineColor: "rgba(0,0,0,.2)",
            scaleGridLineColor: "rgba(0,0,0,.05)",
            scaleFontColor: "#c5c7cc"
        });
    };
</script>

</body>
</html>