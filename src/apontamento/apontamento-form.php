<?php
    include('../template/template-barra.php');
?>
<link href="mdtimepicker.css" rel="stylesheet">

<main role="main" class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                <h1>Lançamento de Horas</h1>
                </div>
                <div class="col-8">
                <div role="alert" id="res"></div>
                </div>
            </div>
            
            <hr>
            <form id="apontamento">
                <div class="row">
                    <!-- Começa: Data -->
                    <div class="col-md-4 mb-3">
                        <label for="adddte">Data</label>
                        <div class="input-group">
                            <input type="date" class="form-control data-mascara" id="adddte">
                        </div>
                    </div>
                    <!-- Termina: Data -->

                    <!-- Começa: Hora Inicio -->
                    <div class="col-md-4 mb-3">
                    <label for="fr_tim">Hora Início</label>
                        <div class="input-group clockpicker">
                            <input id="fr_tim" type="time" class="form-control hora-mascara" >
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                    </div>
                    <!-- Termina: Hora Inicio -->

                    <!-- Começa: Hora Fim -->
                    <div class="col-md-4 mb-3">
                    <label for="to_tim">Hora Fim</label>
                        <div class="input-group clockpicker">
                            <input id="to_tim" type="time" class="form-control hora-mascara" >
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                    </div>
                    <!-- Termina: Hora Fim -->

                    

                    <!-- Começa: Produto -->
                    <div class="col-md-6 mb-3">
                        <label for="prd_id">Produto</label>
                            <select class="custom-select d-block w-100" id="prd_id" >
                                <option value="">Selecione...</option>
                                <?php
                                    $db = new SQLite3('../sqlite/apontamentos.db');

                                    $s_tblprd = "
                                            SELECT prd_id, prdnme FROM usrprd GROUP BY prd_id, prdnme
                                        ";
                                        $resultado = $db->query($s_tblprd);
                                        while($row = $resultado->fetchArray(SQLITE3_ASSOC)){
                                            print '
                                            <option value="'.$row["prd_id"].'">'.$row["prdnme"].'</option>
                                            ';
                                        }
                                ?>
                            </select>
                    </div>
                    <!-- Termina: Produto -->

                    <!-- Começa: Operação -->
                    <div class="col-md-6 mb-3">
                        <label for="opr_id">Operações</label>
                        <select class="custom-select d-block w-100" id="opr_id" >
                            <option value="">Selecione...</option>
                            <?php
                                $db = new SQLite3('../sqlite/apontamentos.db');

                                $s_tblprd = "
                                    SELECT 
                                    uo.opr_id, 
                                    uo.oprnme,
                                    uc.ctysgl
                                        FROM usropr uo
                                            inner join usrcty uc 
                                            on(uo.cty_id = uc.cty_id)
                                        GROUP BY 
                                            uo.opr_id, 
                                            uo.oprnme,
                                            uc.ctysgl
                                    ";
                                    $resultado = $db->query($s_tblprd);
                                    while($row = $resultado->fetchArray(SQLITE3_ASSOC)){
                                        print '
                                        <option value="'.$row["opr_id"].'">'.$row["oprnme"].' - '.$row["ctysgl"].'</option>
                                        ';
                                    }
                            ?>
                        </select>
                    </div>
                    <!-- Termina: Operação -->
                    <!-- Começa: Solicitante -->
                    <div class="col-md-5 mb-3">
                        <label for="usrask">Solicitante</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="usrask" placeholder="Nome" >
                        </div>
                    </div>
                    <!-- Termina: Solicitante -->

                    <!-- Começa: Observação -->
                    <div class="col-md-7 mb-3">
                        <label for="usrobs">Observação</label>
                        <textarea  rows="3" class="form-control" id="usrobs" placeholder="Observações."></textarea>
                    </div>
                    <!-- Termina: Observação -->

                     <!-- Começa: Usuário -->
                    <input type="text" class="form-control" id="logged_usr_id" placeholder=""  value="<?php print $_SESSION["usr_id"];?>" hidden>
                    <!-- Termina: Usuário -->
                </div>
                
                <button type="submit" class="btn btn-primary" id="salvar" style="width: 33%; float: right;">Salvar</button>
            </form>
            
        </div>              
        
    </div>
    <br>
    <br>
    <br>
    
</main>

<?php
    include('../template/template-rodape.php');
?>

<script src="./apontamento-form.js"></script>
<script src="./apontamento-timepicker-from-btn.js"></script> 
<script src="./apontamento-timepicker-to-btn.js"></script>
<script src="./apontamento-mask.js"></script>
</body>



