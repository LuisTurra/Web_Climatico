<?php
    include_once("cabec.php")
?>

<?php
    
    $url_feed = "https://www.ticdemestre.com.br/estacao/consulta_dados?data_est=291&data_senha=Fatec@291&data_ini=2021-01-01&data_fim=2021-12-31";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url_feed);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $data = curl_exec($ch);

    curl_close($ch);

    $jsonData = json_decode($data);  
    
    $lista_temp = [];
    $lista_umid = [];
    $lista_co = [];

    foreach($jsonData as $dados):
        $umidade = $dados->medUmidade;
        $temp = $dados->medTemp;
        $co = $dados->medCO;
        $data = $dados->medData;
        
        $lista_temp[] = $temp;
        $lista_umid[] = $umidade;
        $lista_co[] = $co;
        
    endforeach;

    function media($lista){
        $soma = array_sum($lista);
        return ($soma / count($lista));
    }
    
?>



<div class="container">
    <div id="temperatura">
        <div id="temp-titulo">
            <h1>Temperatura</h1>
        </div>
        
        <div id="temp-box">
            <h1><?php echo max($lista_temp);?>°</h1>
            <h2>Máxima</h2>
        </div>
        <div id="temp-box">
            <h1><?php echo number_format(media($lista_temp), 1);?>°</h1>
            <h2>Média</h2>
        </div>
        <div id="temp-box">
            <h1><?php echo min($lista_temp);?>°</h1>
            <h2>Mínima</h2>
        </div>      
    </div>
    <div id="umidade">
        <div id="umid-titulo">
            <h1>Umidade</h1>
        </div>
        
        <div id="umid-box">
            <h1><?php echo max($lista_umid);?>%</h1>
            <h2>Máxima</h2>
        </div>
        <div id="umid-box">
            <h1><?php echo number_format(media($lista_umid), 1);?>%</h1>
            <h2>Média</h2>
        </div>
        <div id="umid-box">
            <h1><?php echo min($lista_umid);?>%</h1>
            <h2>Mínima</h2>
        </div>
    </div>
    <div id="co">
        <div id="co-titulo">
            <h1>Dióxido de Carbono</h1>
        </div>
        
        <div id="co-box">
            <h1><?php echo max($lista_co);?></h1>
            <h2>Máximo</h2>
        </div>
        <div id="co-box">
            <h1><?php echo number_format(media($lista_co), 1);?></h1>
            <h2>Médio</h2>
        </div>
        <div id="co-box">
            <h1><?php echo min($lista_co);?></h1>
            <h2>Mínimo</h2>
        </div>
    </div>
</div>
