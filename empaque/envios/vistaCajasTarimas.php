


  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#cajas" aria-controls="home" role="tab" data-toggle="tab">Cajas</a></li>
    <li role="presentation"><a href="#tarimas" aria-controls="profile" role="tab" data-toggle="tab">Tarimas</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="cajas">
        <div style="color:#000000;">
        <div id="paginacion-resultados-epc">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th class="centro">#</th>
                  <th class="centro">epc_caja</th>
                  <th class="centro">Enviado</th>
                  <th class="centro">Recibido</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                    $idenvio = $_POST['idenvio'];
                    include("../../mod/conexion.php");

                    $consulta = "select epc_caja, enviado_dce, recibido_dce from distribuidor_cajas_envio where id_envio_fk = $idenvio";

                    $result   = mysql_query($consulta);
                    $i=0;
                    if(mysql_num_rows($result) > 0){
                      
                      while($row = mysql_fetch_array($result)){
                        $i++;
                        ?>
                          <tr>
                            <td class="centro"><?php echo $i; ?></td>
                            <td class="centro"><?php echo "<a href='index.php?epc_caja=".$row['epc_caja']."&op=caja_traza' class='btn btn-link'>".$row['epc_caja']."</a>"; ?> </td>
                            
                              <?php if($row['enviado_dce'] == 1){ ?>
                              <td class="centro">
                                <span class="glyphicon glyphicon-ok"></span>
                                </td>
                              <?php }else{ ?>
                              <td class="centro">
                                <span class="glyphicon glyphicon-remove"></span>
                                </td>
                              <?php } ?>
                            
                            
                              <?php if($row['recibido_dce'] == 1){ ?>
                              <td class="centro">
                                 <span class="glyphicon glyphicon-ok"></span>
                              </td>
                              <?php }else{ ?>
                              <td style="  background: rgb(255, 242, 245);" class="centro">
                                <span class="glyphicon glyphicon-remove"></span>
                              </td>
                              <?php } ?>
                            
                          </tr>
                        <?php

                      }
                    }

                 ?>
              </tbody>
            </table>
            <?php if($i > 1){ ?>
              <div class="my-navigation" style="margin: 0px auto;">
              <div class="simple-pagination-page-numbers"></div>
              <br><br><br>
              </div>
            <?php } ?>
          </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="tarimas">
         <div style="color:#000000;">
          <div id="paginacion-resultados-epc-tarima">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th class="centro">#</th>
                  <th class="centro">EPC de tarima</th>
                  <th class="centro">Número de cajas</th>
                  <th class="centro">EPC de las cajas</th>
                </tr>
              </thead>
              <tbody>
                <?php 

                    include("../../mod/conexion.php");

                    $consulta = "select epc_tarima, COUNT(epc_caja) AS cajas from distribuidor_cajas_envio where id_envio_fk = $idenvio GROUP BY epc_tarima";
                $result   = mysql_query($consulta);
                $i=0;
                    if(mysql_num_rows($result) > 0){
                      
                      while($row = mysql_fetch_array($result)){
                        $i++;
                          $consultaCT = "select epc_caja from distribuidor_cajas_envio where epc_tarima = ".$row['epc_tarima'];
                          $resultCT = mysql_query($consultaCT);
                        ?>
                          <tr>
                            <td class="centro"><?php echo $i; ?></td>
                            <td class="centro"><?php echo $row['epc_tarima']; ?> </td>
                            <td class="centro"><?php echo $row['cajas']; ?></td>
                            <td class="centro"><?php 
                              while($rowCT = mysql_fetch_array($resultCT)){ ?>
                                <?php echo "<a href='index.php?epc_caja=".$rowCT['epc_caja']."&op=caja_traza' class='btn btn-link'>".$rowCT['epc_caja']."</a>"; ?><br>
                              <?php }
                             ?></td>
                          </tr>
                        <?php

                      }
                    }

                 ?>
              </tbody>
            </table>
            <?php if($i > 1){ ?>
              <div class="my-navigation" style="margin: 0px auto;">
              <div class="simple-pagination-page-numbers"></div>
              <br><br><br>
              </div>
            <?php } ?>
          </div>
        </div>
    </div>
  </div>
<script type="text/javascript" src="../lib/pagination/jquery-simple-pagination-plugin.js"></script>

  <script type="text/javascript">
    $('#paginacion-resultados-epc').simplePagination();
    $('#paginacion-resultados-epc-tarima').simplePagination({
      items_per_page: 1
    });
  </script>