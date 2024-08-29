
document.addEventListener("DOMContentLoaded", function () {

    // Función para actualizar la imagen y los datos del perfil según las selecciones
    function actualizarPerfil() {

        // Obtenemos los radio seleccionados
        const exposicion = document.querySelector('input[name="exposicion"]:checked').value;
        const perfil = document.querySelector('input[name="perfil"]:checked').value;
        const forma = document.querySelector('input[name="forma"]:checked').value;

        const etiquetas = document.querySelectorAll('#forma_perfil .form-check');
        const datos = document.querySelectorAll('#form_datos .form-group');

        const imagenesPerfil = document.querySelectorAll('#forma_perfil img');

        // procesado de datos
        for (const dato of datos) {
            dato.style.display = 'none';
        }

        for (const img of imagenesPerfil) {
            img.style.display = 'none';
        }


        // Actualizamos la imagen según las selecciones
        const imgPerfil3Circular = document.getElementById('imgPerfil3Circular');
        const imgPerfil3C = document.getElementById('imgPerfil3C');
        const imgPerfil3CA = document.getElementById('imgPerfil3CA');
        const imgPerfil3HCR = document.getElementById('imgPerfil3HCR');
        const imgPerfil3HSR = document.getElementById('imgPerfil3HSR');
        const imgPerfil3IC = document.getElementById('imgPerfil3IC');
        const imgPerfil3ICA = document.getElementById('imgPerfil3ICA');
        const imgPerfil3L = document.getElementById('imgPerfil3L');
        const imgPerfil3OCA = document.getElementById('imgPerfil3OCA');
        const imgPerfil3R = document.getElementById('imgPerfil3R');
        const imgPerfil3Z = document.getElementById('imgPerfil3Z');
        const imgPerfil4C = document.getElementById('imgPerfil4C');
        const imgPerfil4CA = document.getElementById('imgPerfil4CA');
        const imgPerfil4HCR = document.getElementById('imgPerfil4HCR');
        const imgPerfil4HSR = document.getElementById('imgPerfil4HSR');
        const imgPerfil4IC = document.getElementById('imgPerfil4IC');
        const imgPerfil4ICA = document.getElementById('imgPerfil4ICA');
        const imgPerfil4L = document.getElementById('imgPerfil4L');
        const imgPerfil4OCA = document.getElementById('imgPerfil4OCA');
        const imgPerfil4R = document.getElementById('imgPerfil4R');
        const imgPerfil4Z = document.getElementById('imgPerfil4Z');

        switch (perfil) {
            case "Perfil Abierto":

                //apagamos las etiquetas                
                for (const etiqueta of etiquetas) {
                    etiqueta.style.display = 'none';
                }
                // procesado de datos
                for (const dato of datos) {
                    dato.style.display = 'none';
                }
                for (const img of imagenesPerfil) {
                    img.style.display = 'none';
                }

                //prendemos los  radios
                forma_HSR.style.display = "block";
                forma_HCR.style.display = "block";
                forma_C.style.display = "block";
                forma_IC.style.display = "block";
                forma_CA.style.display = "block";
                forma_ICA.style.display = "block";
                forma_L.style.display = "block";
                forma_Z.style.display = "block";

                //chequeamos un radio activo   
                (!r_forma_HSR.checked && !r_forma_HCR.checked && !r_forma_C.checked && !r_forma_IC.checked && !r_forma_CA.checked
                    && !r_forma_ICA.checked && !r_forma_L.checked && !r_forma_Z.checked) ? (
                    d_H.style.display = "block",
                    d_B1.style.display = "block",
                    d_B2.style.display = "block",
                    d_e1.style.display = "block",
                    d_e2.style.display = "block",
                    d_t.style.display = "block",
                    forma = 'HSR',
                    r_forma_HSR.checked = true
                ) : "";

                switch (forma) {
                    case "HSR":
                        d_H.style.display = "block";
                        d_B1.style.display = "block";
                        d_B2.style.display = "block";
                        d_e1.style.display = "block";
                        d_e2.style.display = "block";
                        d_t.style.display = "block";
                        exposicion == "Viga 3 Caras" ?
                            imgPerfil3HSR.style.display = 'block' :
                            imgPerfil4HSR.style.display = 'block';
                        break;
                    case "HCR":
                        d_H.style.display = "block";
                        d_B1.style.display = "block";
                        d_B2.style.display = "block";
                        d_e1.style.display = "block";
                        d_e2.style.display = "block";
                        d_t.style.display = "block";
                        d_r.style.display = "block";
                        exposicion == "Viga 3 Caras" ?
                            imgPerfil3HCR.style.display = 'block' :
                            imgPerfil4HCR.style.display = 'block';
                        break;
                    case "C":
                        d_H.style.display = "block";
                        d_B1.style.display = "block";
                        d_e1.style.display = "block";
                        exposicion == "Viga 3 Caras" ?
                            imgPerfil3C.style.display = 'block' :
                            imgPerfil4C.style.display = 'block';
                        break;
                    case "IC":
                        d_H.style.display = "block";
                        d_B1.style.display = "block";
                        d_e1.style.display = "block";
                        exposicion == "Viga 3 Caras" ?
                            imgPerfil3IC.style.display = 'block' :
                            imgPerfil4IC.style.display = 'block';
                        break;
                    case "CA":
                        d_H.style.display = "block";
                        d_B1.style.display = "block";
                        d_C.style.display = "block";
                        d_e1.style.display = "block";
                        exposicion == "Viga 3 Caras" ?
                            imgPerfil3CA.style.display = 'block' :
                            imgPerfil4CA.style.display = 'block';
                        break;
                    case "ICA":
                        d_H.style.display = "block";
                        d_B1.style.display = "block";
                        d_C.style.display = "block";
                        d_e1.style.display = "block";
                        exposicion == "Viga 3 Caras" ?
                            imgPerfil3ICA.style.display = 'block' :
                            imgPerfil4ICA.style.display = 'block';
                        break;
                    case "L":
                        d_H.style.display = "block";
                        d_B1.style.display = "block";
                        d_e1.style.display = "block";
                        exposicion == "Viga 3 Caras" ?
                            imgPerfil3L.style.display = 'block' :
                            imgPerfil4L.style.display = 'block';
                        break;
                    case "Z":
                        d_H.style.display = "block";
                        d_B1.style.display = "block";
                        d_B2.style.display = "block";
                        d_C.style.display = "block";
                        d_e1.style.display = "block";
                        exposicion == "Viga 3 Caras" ?
                            imgPerfil3Z.style.display = 'block' :
                            imgPerfil4Z.style.display = 'block';
                        break;

                }
                break;
            case "Perfil Cerrado Rectangular":
                //apagamos las etiquetas
                for (const etiqueta of etiquetas) {
                    etiqueta.style.display = 'none';
                }
                for (const img of imagenesPerfil) {
                    img.style.display = 'none';
                }
                const forma_R = document.getElementById('forma_R');
                const forma_OCA = document.getElementById('forma_OCA');
                const r_forma_R = document.getElementById('r_forma_R');
                const r_forma_OCA = document.getElementById('r_forma_OCA');

                forma_R.style.display = 'block';
                forma_OCA.style.display = 'block';

                (!r_forma_R.checked && !r_forma_OCA.checked) ?
                    r_forma_R.checked = true : "";

                exposicion == "Viga 3 Caras" ? (
                    r_forma_R.checked == true ? (
                        imgPerfil3R.style.display = 'block',
                        d_H.style.display = "block",
                        d_B1.style.display = "block",
                        d_e1.style.display = "block") : (
                        imgPerfil3OCA.style.display = 'block',
                        d_H.style.display = "block",
                        d_B1.style.display = "block",
                        d_C.style.display = "block",
                        d_e1.style.display = "block")
                ) : (
                    r_forma_R.checked == true ? (
                        imgPerfil4R.style.display = 'block',
                        d_H.style.display = "block",
                        d_B1.style.display = "block",
                        d_e1.style.display = "block") : (
                        imgPerfil4OCA.style.display = 'block',
                        d_H.style.display = "block",
                        d_B1.style.display = "block",
                        d_C.style.display = "block",
                        d_e1.style.display = "block")
                );

                break;
            case "Perfil Cerrado Circular":
                //apagamos las etiquetas
                for (const etiqueta of etiquetas) {
                    etiqueta.style.display = 'none';
                }
                for (const img of imagenesPerfil) {
                    img.style.display = 'none';
                }
                const forma_Circular = document.getElementById('forma_Circular');
                const r_forma_Circular = document.getElementById('r_forma_Circular');

                forma_Circular.style.display = 'block';
                r_forma_Circular.checked = true;

                imgPerfil3Circular.style.display = 'block';

                d_D.style.display = 'block';
                d_e1.style.display = 'block';

                break;
        }
    }

    // Agregamos el evento onclick a los checkboxes para llamar a la función actualizarPerfil
    const checkboxes = document.querySelectorAll('input[type="radio"]');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('click', actualizarPerfil);
    });

    // Función para mostrar u ocultar el formulario de "Si conozco la Masividad"
    function toggleFormMasividad() {
        const formMasividad = document.getElementById('form_masividad');
        const conozcoMasividad = document.getElementById('conozco_masividad');
        const formaPerfil = document.getElementById('forma_perfil');
        const masividad = document.getElementById('masividad');

        if (conozcoMasividad.checked) {
            formMasividad.style.display = 'block';
            formaPerfil.style.display = 'none';
            masividad.required = true;
        } else {
            formMasividad.style.display = 'none';
            formaPerfil.style.display = 'block';
            masividad.required = false;
            masividad.value = ''; // Limpiar el valor del campo "masividad"
        }
    }

    // Llama a la función para establecer el estado inicial del formulario
    toggleFormMasividad();

    // Agregamos el evento onclick a los radio buttons para llamar a la función toggleFormMasividad
    const radioButtonsConozcoMasividad = document.querySelectorAll('input[name="conozco_masividad"],input[name="conozco_masividad_no"]');
    radioButtonsConozcoMasividad.forEach(radio => {
        radio.addEventListener('click', toggleFormMasividad);
    });



});

