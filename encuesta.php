<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Encuesta</title>
    <link rel="stylesheet" href="style/sty_en.css">
</head>
<body>
    <div class="container">
        <h1>Formulario de Encuesta</h1>
        <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'Parte1')">Parte 1</button>
            <button class="tablinks" onclick="openTab(event, 'Parte2')">Parte 2</button>
            <button class="tablinks" onclick="openTab(event, 'Parte3')">Parte 3</button>
        </div>

        <form id="surveyForm" action="controlador/guardar_encuesta.php" method="post">
            <div id="Parte1" class="tabcontent">
                <div class="content-flex">
                    <img src="imagenes/sex.jpg" alt="Imagen referente al tema" class="tema-imagen">
                    
                    <div class="form-section">
                        <label for="sexo">Sexo:</label>
                        <input type="radio" id="sexo_femenino" name="sexo" value="Femenino" required> Femenino
                        <input type="radio" id="sexo_masculino" name="sexo" value="Masculino" required> Masculino<br>

                        <label for="edad">Edad:</label>
                        <input type="text" id="edad" name="edad" required><br>

                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" required><br>

                        <button type="button" onclick="validateAndNextTab('Parte2')">Siguiente</button>
                    </div>
                </div>
            </div>

            <div id="Parte2" class="tabcontent">
                <label for="campo1">1.- ¿Tiene conocimiento sobre qué es la salud sexual y reproductiva?:</label><br>
                <input type="radio" id="campo1_si" name="campo1" value="Sí" required> Sí
                <input type="radio" id="campo1_no" name="campo1" value="No" required> No<br><br>

                <label for="campo2">2.- ¿Cree usted que es importante saber de salud sexual y reproductiva?:</label><br>
                <input type="radio" id="campo2_si" name="campo2" value="Sí" required> Sí
                <input type="radio" id="campo2_no" name="campo2" value="No" required> No<br><br>

                <label for="campo3">3.- ¿Quién le brindó mayor información sobre la salud sexual y reproductiva?:</label><br>
                <input type="radio" id="campo3_padres" name="campo3" value="Padres" required> Padres
                <input type="radio" id="campo3_amigos" name="campo3" value="Amigos" required> Amigos
                <input type="radio" id="campo3_cuenta" name="campo3" value="Por su cuenta" required> Por su cuenta
                <input type="radio" id="campo3_colegio" name="campo3" value="Colegio" required> Colegio
                <input type="radio" id="campo3_salud" name="campo3" value="Centro de salud" required> Centro de salud<br><br>

                <label for="campo4">4.- ¿Conoce usted sobre identidad sexual?:</label><br>
                <input type="radio" id="campo4_si" name="campo4" value="Sí" required> Sí
                <input type="radio" id="campo4_no" name="campo4" value="No" required> No<br><br>

                <label for="campo5">5.- ¿Conoce usted acerca de conducta sexual?:</label><br>
                <input type="radio" id="campo5_si" name="campo5" value="Sí" required> Sí
                <input type="radio" id="campo5_no" name="campo5" value="No" required> No<br><br>

                <button type="button" onclick="validateAndNextTab('Parte3')">Siguiente</button>
            </div>

            <div id="Parte3" class="tabcontent">
                <label for="campo6">6.- ¿Conoce cuáles son los derechos sexuales y reproductivos?:</label><br>
                <input type="radio" id="campo6_si" name="campo6" value="Sí" required> Sí
                <input type="radio" id="campo6_no" name="campo6" value="No" required> No<br><br>

                <label for="campo7">7.- ¿Conoce usted sobre las infecciones de transmisión sexual?:</label><br>
                <input type="radio" id="campo7_si" name="campo7" value="Sí" required> Sí
                <input type="radio" id="campo7_no" name="campo7" value="No" required> No<br><br>

                <label for="campo8">8.- ¿Tiene conocimientos acerca de los métodos anticonceptivos?:</label><br>
                <input type="radio" id="campo8_si" name="campo8" value="Sí" required> Sí
                <input type="radio" id="campo8_no" name="campo8" value="No" required> No<br><br>

                <label for="campo9">9.- ¿Conoce usted sobre el uso correcto del preservativo?:</label><br>
                <input type="radio" id="campo9_si" name="campo9" value="Sí" required> Sí
                <input type="radio" id="campo9_no" name="campo9" value="No" required> No<br><br>

                <label for="campo10">10.- ¿Sabe usted a dónde acudir en caso de necesitar atención en salud sexual y reproductiva?:</label><br>
                <input type="radio" id="campo10_si" name="campo10" value="Sí" required> Sí
                <input type="radio" id="campo10_no" name="campo10" value="No" required> No<br><br>

                <button type="submit">Enviar</button>
            </div>
        </form>
    </div>

    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        function validateAndNextTab(tabName) {
            var valid = true;
            var tabContent = document.querySelector('.tabcontent:not([style*="display: none"])');
            var inputs = tabContent.querySelectorAll('input[required]');
            inputs.forEach(function(input) {
                if (!input.checkValidity()) {
                    valid = false;
                    input.reportValidity();
                }
            });
            if (valid) {
                nextTab(tabName);
            }
        }

        function nextTab(tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            document.querySelector(`button[onclick="openTab(event, '${tabName}')"]`).className += " active";
        }

        // Mostrar la primera pestaña por defecto
        document.getElementById("Parte1").style.display = "block";
        document.getElementsByClassName("tablinks")[0].className += " active";
    </script>
</body>
</html>
