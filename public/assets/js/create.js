   
document.addEventListener("DOMContentLoaded", function() {
        
    // Función para actualizar la imagen y los datos del perfil según las selecciones
    function actualizarPerfil() {

        // Obtenemos los radio seleccionados
        const exposicion = document.querySelector('input[name="exposicion"]:checked').value;
        const perfil     = document.querySelector('input[name="perfil"]:checked').value;
        let forma      = document.querySelector('input[name="forma"]:checked').value;
        
        const etiquetas = document.querySelectorAll('#forma_perfil .form-check'); 
        const datos = document.querySelectorAll('#form_datos .form-group'); 

        // procesado de datos
        for (const dato of datos) {
            dato.style.display = 'none';
        }
        const forma_HSR    = document.getElementById('forma_HSR');   
        const forma_HCR    = document.getElementById('forma_HCR');        
        const forma_C      = document.getElementById('forma_C');        
        const forma_IC     = document.getElementById('forma_IC');        
        const forma_CA     = document.getElementById('forma_CA');        
        const forma_ICA    = document.getElementById('forma_ICA');        
        const forma_L      = document.getElementById('forma_L');        
        const forma_Z      = document.getElementById('forma_Z');      
        const r_forma_HSR  = document.getElementById('r_forma_HSR');        
        const r_forma_HCR  = document.getElementById('r_forma_HCR');        
        const r_forma_C    = document.getElementById('r_forma_C');        
        const r_forma_IC   = document.getElementById('r_forma_IC');        
        const r_forma_CA   = document.getElementById('r_forma_CA');        
        const r_forma_ICA  = document.getElementById('r_forma_ICA');        
        const r_forma_L    = document.getElementById('r_forma_L');        
        const r_forma_Z    = document.getElementById('r_forma_Z'); 
        const d_H       = document.getElementById("d_H"      );
        const d_B1      = document.getElementById("d_B1"     );
        const d_B2      = document.getElementById("d_B2"     );
        const d_C       = document.getElementById("d_C"      );
        const d_e1      = document.getElementById("d_e1"     );
        const d_e2      = document.getElementById("d_e2"     );
        const d_t       = document.getElementById("d_t"      );
        const d_r       = document.getElementById("d_r"      );
        const d_D       = document.getElementById("d_D"      );
        
        // Actualizamos la imagen según las selecciones
        const imgPerfil = document.getElementById('imgPerfil');

        switch ( perfil ) {
            case "Perfil Abierto":
                
                //apagamos las etiquetas                
                for (const etiqueta of etiquetas) {
                    etiqueta.style.display = 'none';
                }
                 // procesado de datos
                for (const dato of datos) {
                    dato.style.display = 'none';
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
                    && !r_forma_ICA.checked && !r_forma_L.checked && !r_forma_Z.checked ) ? (
                        d_H .style.display = "block",
                        d_B1.style.display = "block",
                        d_B2.style.display = "block",
                        d_e1.style.display = "block",
                        d_e2.style.display = "block",
                        d_t .style.display = "block",
                        forma = 'HSR',
                        r_forma_HSR.checked = true 
                    ) : "";
                
                switch (forma) {
                    case "HSR":
                        d_H .style.display = "block";
                        d_B1.style.display = "block";
                        d_B2.style.display = "block";
                        d_e1.style.display = "block";
                        d_e2.style.display = "block";
                        d_t .style.display = "block";
                        break;
                    case "HCR":
                        d_H .style.display = "block";
                        d_B1.style.display = "block";
                        d_B2.style.display = "block";
                        d_e1.style.display = "block";
                        d_e2.style.display = "block";
                        d_t .style.display = "block";
                        d_r .style.display = "block";
                        break;
                    case "C":
                        d_H .style.display = "block";
                        d_B1.style.display = "block";
                        d_e1.style.display = "block";
                        d_r .style.display = "block";
                        break;
                    case "IC":
                        d_H .style.display = "block";
                        d_B1.style.display = "block";
                        d_e1.style.display = "block";
                        d_r .style.display = "block";
                        break;
                    case "CA":
                        d_H .style.display = "block";
                        d_B1.style.display = "block";
                        d_C .style.display = "block";
                        d_e1.style.display = "block";
                        d_r .style.display = "block";
                        break;
                    case "ICA":
                        d_H .style.display = "block";
                        d_B1.style.display = "block";
                        d_C .style.display = "block";
                        d_e1.style.display = "block";
                        d_r .style.display = "block";
                        break;
                    case "L":
                        d_H .style.display = "block";
                        d_B1.style.display = "block";
                        d_e1.style.display = "block";
                        d_r .style.display = "block";
                        break;
                    case "Z":
                        d_H .style.display = "block";
                        d_B1.style.display = "block";
                        d_B2.style.display = "block";
                        d_C .style.display = "block";
                        d_e1.style.display = "block";
                        d_r .style.display = "block";
                        break;
                
                }
                
                exposicion=="Viga 3 Caras" ?
                    imgPerfil.src = `/../assets/img/Cortes/3_caras/${forma}.png`:
                    imgPerfil.src = `/../assets/img/Cortes/4_caras/${forma}.png`;
                break;
            case "Perfil Cerrado Rectangular":
                //apagamos las etiquetas
                for (const etiqueta of etiquetas) {
                    etiqueta.style.display = 'none';
                }
                const forma_R       = document.getElementById('forma_R');
                const forma_OCA     = document.getElementById('forma_OCA');
                const r_forma_R     = document.getElementById('r_forma_R');
                const r_forma_OCA   = document.getElementById('r_forma_OCA');

                forma_R.style.display = 'block';
                forma_OCA.style.display = 'block';

                (!r_forma_R.checked && !r_forma_OCA.checked )?
                r_forma_R.checked = true : "";

                exposicion=="Viga 3 Caras" ? (
                    r_forma_R.checked == true ? (
                        imgPerfil.src = `/../assets/img/Cortes/3_caras/R.png`,
                        d_H .style.display = "block",
                        d_B1.style.display = "block",
                        d_e1.style.display = "block",
                        d_r .style.display = "block") : (
                        imgPerfil.src = `/../assets/img/Cortes/3_caras/OCA.png`,
                        d_H .style.display = "block",
                        d_B1.style.display = "block",
                        d_C .style.display = "block",
                        d_e1.style.display = "block",
                        d_r .style.display = "block") 
                    ) : (
                    r_forma_R.checked == true ? (
                        imgPerfil.src = `/../assets/img/Cortes/4_caras/R.png`,
                        d_H .style.display = "block",
                        d_B1.style.display = "block",
                        d_e1.style.display = "block",
                        d_r .style.display = "block") : (
                        imgPerfil.src = `/../assets/img/Cortes/4_caras/OCA.png`,
                        d_H .style.display = "block",
                        d_B1.style.display = "block",
                        d_C .style.display = "block",
                        d_e1.style.display = "block",
                        d_r .style.display = "block") 
                    );

                break;
            case "Perfil Cerrado Circular":
                //apagamos las etiquetas
                for (const etiqueta of etiquetas) {
                    etiqueta.style.display = 'none';
                }
                const forma_Circular   = document.getElementById('forma_Circular');
                const r_forma_Circular = document.getElementById('r_forma_Circular');   
                
                forma_Circular.style.display = 'block'
                r_forma_Circular.checked = true;
                
                imgPerfil.src = `/../assets/img/Cortes/4_caras/Circular.png`;

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

