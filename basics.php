<?php error_reporting(E_ALL ^ E_NOTICE); ?>

<html>
    <?php include("top2.inc.php")?>
    <div style="width: 800px; padding:20px;">
        <h1>Basics</h1>

        <?php //<?= acceptat a partir de php 5.4 ?>
        <?="<div class='return'><b>Alternatives a scripts:</b><br>";?>
        <ul>
        <?php 
            if (1 == 2):

            elseif (2==3):
            
            else:
                echo "<li>If amb : else: elseif: endif</li>";
            endif; 
        ?>
        <li> <\?= permes a partir de php 5.4</li> 

        <?php
        $resultat = empty($hola) ? "adeu" : "hola";

        echo "<li>Comparador : ? resultat: ".$resultat."</li>";

        echo "<li>Comparador <=>: si a> torna 1, si b> torna -1, si iguals torna 0</li>";

        @file('invnetat') or
            $res = "No existeix";

        echo "<li>@ no torna error i fa de comprarador, res: $res</li>";

        $a=1;
        $b=2;

        if ($a==1 xor $b==2):
            $r1='true';
        else:
            $r1='false';
        endif;

        if ($a==1 xor $b==3):
            $r2='true';
        else:
            $r2='false';
        endif;

        echo "<li>Compara amb xor si un desl dos compleix pero no els dos: $r1 , $r2</li>";



        ?>
        

        <?php #comentaris ?>
        <li> Comentaris amb #</li>
        </ul>
        </div>
        <?php
        $foo="hola";
        $array = array("v1" =>"coco","v2"=>"kenia");
       /* $var = <<<EOT 
            hola 
            EOT;*/
        ?>

        <div class='return'><b>Variables:</b><br>
            <ul>
                <li>(bool) tot true menys 0,false o "": <?php var_dump((bool) 'hola')?></li>
                <li>(int) sempre cap abaix, txt+num suma igual retorna notice:<?php $foo2 = "10.0 cerdos " + 1; echo $foo2?></li>
                <li>(float) <?=(float)2.2?></li>
                <li>(String) ' texte literal " caracters scape <?="hola\n\rAdeu"?> <?php echo (string)$foo?>
                <li>EOT o 'EOT'</li>
                <li>Concatenacio amn {} <?php echo "${foo}s"?></li>
                <li>[ només ente { < php5 <?php echo "hola {$array[0]};"?>
            </ul>
        </div>

        <div class='return'><b>Array:</b><br>
            <li> key sempre num 1,"1",1.5, true --> sempre 1 </li>
            <li> uns poden tenir key i altres no</li>
            <?php
            function tornaArray(){
                return array("coco","kenia","tana");
            }
            ?>
            <li>A partir de 5.4 es posible fer funcions: <?php echo tornaArray()[1]?></li>
            <li> Eliminar un array sencer o un valor amb unset</li>
            <li> array_values -> torna els valors del array reindexar</li>
            <li> No cal ent cometes</li>
            <?php
            $arr2 = array_values($array);
            print_r($arr2);
            ?>
            <li>Amb dos punts al final i tipus forca resposta si no coincideix torna error</li>
            
            <?php function torna() : int{
                return "1";
            }

            echo torna();
            ?>

            <li>Es poden retornar arravalors  amb iterable / yield</li>
            <?php

            function bar(): iterable {
                return [1, 2, 3];
            }

            $res = bar();
            print_r($res);

            function gen(): iterable {
                yield 1;
                yield 2;
                yield 3;
            }
            
            $res = bar();
            print_r($res);
            ?>
            <li>Amb get_type es pot saber el tious d'una variable</li>
            <li>un string es pot tractar com arra i fa referencia a la lletra en la posicio</li>
            <?php
                echo "<li>Unio i compraració arrays + (si keys iguals mana primera)</li>";

                $a = array("a" => "apple", "b" => "banana");
                $b = array("a" => "pear", "b" => "strawberry", "c" => "cherry");
                    $c = $a + $b; // Unión de $a y $b
                    echo "Unión de \$a y \$b: \n";
                    print_r($c);
            ?>

        </div>

        <div class='return'><b>Funcions:</b><br>
        <ul>
        <li>Es poden cridar funcions soles o dins d'una classe amb call_user_func</li>

        <?php      
            function mi_función_de_llamada_de_retorno() {
                echo '¡hola mundo!<br>';
            }

            class MiClase {
                static function miMétodoDeLlamadaDeRetorno() {
                    echo '¡Hola Mundo!<br>';
                }
            }

            call_user_func('mi_función_de_llamada_de_retorno');
            call_user_func(array('MiClase', 'miMétodoDeLlamadaDeRetorno'));
            $obj = new MiClase();
            call_user_func(array($obj, 'miMétodoDeLlamadaDeRetorno'));
            call_user_func('MiClase::miMétodoDeLlamadaDeRetorno');

            class A {
                public static function quién() {
                    echo "A\n";
                }
            }

            class B extends A {
                public static function quién() {
                    echo "B\n";
                }
            }

            call_user_func(array('B', 'parent::quién')); 

?>
        <li>Retrollamadas</li>
        <?php
                class C {
            public function __invoke($nombre) {
                echo 'Hola ', $nombre, "\n";
            }
        }

        $c = new C();
        call_user_func($c, 'PHP!');
        ?>
    </div>
</html>