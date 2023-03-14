<?php
    include_once("cabec.php")
?>
    <div id="titulo-dados">
        <h2>Dados Utilizados no Projeto</h2>
        <hr>

    </div>
    <div id="banco-de-dados">
        <table border="1px">
            <tr>
                <th>Umidade</th>
                <th>Temperatura</th>
                <th>Dióxido de Carbono</th>
                <th>Data/Horário</th>

            </tr>
            

            <?php
                $url_feed = "https://www.ticdemestre.com.br/estacao/consulta_dados?data_est=291&data_senha=Fatec@291&data_ini=2021-01-01&data_fim=2021-12-31";

                $ch = curl_init();
            
                curl_setopt($ch, CURLOPT_URL, $url_feed);
            
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
                $data = curl_exec($ch);
            
                curl_close($ch);
            
                $jsonData = json_decode($data);       
            ?>

            
                <?php 
		            foreach($jsonData as $dados):
		            	$umidade = $dados->medUmidade;
		            	$temp = $dados->medTemp;
		            	$co = $dados->medCO;
		            	$data = $dados->medData;
		            	
		            	
		            	echo "<tr align='center'><th>$umidade</th>
                            <th>$temp</th>
                            <th>$co</th>
                            <th>$data</th></tr>";
		            endforeach;
            
		        ?>
            
        </table>
    </div>