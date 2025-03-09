<div class="errores">
    <ul>
        <?php
            if(isset($data['errores'])){
                foreach($data['errores'] as $e){
                    echo "<li>$e</li>";
                }
            }
        ?>
    </ul>
</div>