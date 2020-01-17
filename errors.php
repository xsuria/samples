<html>
    <?php include("top2.inc.php")?>
    <div style="width: 800px; padding:20px;">
    <h1>Errors</h1>
    <?php
    echo "<p class='return'><b>Llançar errors throw</b> (comentat)<br>";

    $miLado = -3;
    function areaCuadrado($lado){
        if ($lado < 0){
            // Lanzamos una excepción
            throw new Exception ('Debes insertar un número positivo');
        } else {
            return $lado * $lado;
        }
    }
    ////////////////areaCuadrado($miLado);
    
    echo "</p>";

    echo "<p class='return'><b>Capturem errors i seguim amb scriipt throw / try-catch</b><br>";
        $misLados = array(2, -6, 4);
        foreach ($misLados as $lado){
            try {
                echo "El área del cuadrado es: " . areaCuadrado($lado) . "<br>";
            } catch (Exception $e) {
                echo 'Ha habido una excepción: ' . $e->getMessage() . "<br>";
            }
        }
    echo "</p>";


    echo "<p class='return'><b>El error es mostra a la funcio que el crida, encara que sigui a un altre lloc</b><br>";
    function unaFuncion(){
        throw new Exception('Mensaje desde unaFuncion().');
    }
    function otraFuncion(){
        unaFuncion();
    }
    try {
        otraFuncion();
    } catch (Exception $e){
        echo 'Excepción capturada: '.$e->getMessage()."<br>";
    }
    echo "</p>";
    

    echo "<p class='return'><b>Errors personalitzats amb la clase extesa error</b><br>";
    
    class customException extends Exception {
        public function errorMessage() {
            // Mensaje de error
            $errorMsg = 'Error en la línea '
            .$this->getLine().' en el archivo '
            .$this->getFile() .': <b>'
            .$this->getMessage().
            '</b> no es una dirección de email válida';
            return $errorMsg;
        }
    }

    $email = "ejemplo@ejemplo/.com";
    // Iniciamos el bloque try
    try {
        // Comprobar si el email es válido
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
            // Lanza una excepción si el email no es válido
            throw new customException($email);
        }
    }
    // Iniciamos el bloque catch
    catch (customException $e) {
        // Muestra el mensaje que hemos customizado en customException:
        echo $e->errorMessage();
    }

    echo "<br><br>Multiples error</br><br>";

    $email = "ejemplo@ejemplo/.com";
    try {
        // Comprobar si el email es válido
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
            // Lanza una excepción si el email no es válido
            throw new customException($email);
        }
        // Comprueba la palabra ejemplo en la dirección email
        if(strpos($email, "ejemplo") !== FALSE) {
            throw new Exception("$email es un email de ejemplo");
        }
    }
    catch (customException $e) {
        echo $e->errorMessage();
    }
    catch(Exception $e) {
        echo $e->getMessage();
    }
    
    echo "</p>";


    echo "<p class='return'><b>Errors no capturats fora detry (comentat)</b><br>";
        set_exception_handler('exceptionHandler');
        
        function exceptionHandler($e){
            // Mensaje público
            echo "Ha habido un error";
            // Mensaje semi-escondido
            echo "<!--Excepción sin capturar: " . $e->getMessage() . "--><br>";
        }
        /////////throw new Exception('Hola');
        /////////throw new Exception('Que tal');
    echo "</p>";

    echo "<p class='return'><b>Finally, llenca missatge tan error com no al final</b><br>";
    function inverse($x) {
        if (!$x) {
            throw new Exception('División por cero.');
        }
        return 1/$x;
    }
    
    try {
        echo inverse(5) . "\n";
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    } finally {
        echo "Primer finally.\n";
    }
    
    try {
        echo inverse(0) . "\n";
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    } finally {
        echo "Segundo finally.\n";
    }
    
    // Continuar ejecución
    echo 'Hola Mundo\n';
    echo "</p>";

    @strpos();
echo $php_errormsg;

    ?>
    

    </div>
</html>