<html>
    <?php include("top2.inc.php")?>
    <div style="width: 800px; padding:20px;">
        <h1>Seguretat</h1>
        <div class='return'><b>Upload simple:</b><br>
            <form enctype="multipart/form-data" action="upload2.php" method="POST">
                <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
                <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
                Enviar este fichero: <input name="fichero_usuario" type="file" />
                <input type="submit" value="Enviar fichero" />
            </form>
        </div>

        <div class='return'><b>Upload multiple:</b><br>
            <form action="upload3.php" method="post" enctype="multipart/form-data">
                <p>Imágenes:<br>
                <input type="file" name="imágenes[]" /><br>
                <input type="file" name="imágenes[]" /><br>
                <input type="file" name="imágenes[]" /><br>
                <input type="submit" value="Enviar" />
                </p>
            </form>
        </div>
        

        <div class='return'><b>Read file:</b><br>
        <?php
        function read(){
            if (!$fichero = fopen (".gitignore", "r")){
                throw new Exception('no file');
            }
            while (!feof ($fichero)) {
                $línea = fgets ($fichero, 1024);
                echo $línea."<br>";
            }
            fclose($fichero);

        }

        try {
            read();
        } catch (Exception $e){
            echo "<p>Imposible abrir el fichero remoto.\n";
            exit;
        }
        ?>
        </div>

    </div>
</html>