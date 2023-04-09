    //habilitar la casilla de masividad
    document.getElementById("conozco_masividad").addEventListener("change", function(){
        if(this.checked){
            document.getElementById("form_masividad"        ).style.display     ="block";
            document.getElementById("masividad"             ).required          = true;
            document.getElementById("form_masividad_no"     ).style.display     ="none";
            document.getElementById("conozco_masividad_no"  ).checked           = false;
            deshabilitarCM();
            deshabilitarSM();
            habilitar("perfil_A");
        }else{
            document.getElementById("form_masividad"        ).style.display     ="none";
            document.getElementById("masividad"             ).required          = false;
            document.getElementById("masividad"             ).value             = "";
            document.getElementById("form_masividad_no"     ).style.display     ="block";
            document.getElementById("conozco_masividad_no"  ).checked           = true;
            deshabilitarCM();
            deshabilitarSM();
            habilitar("perfil_3");
        }
    });
    document.getElementById("conozco_masividad_no").addEventListener("change", function(){
        if(this.checked){
            document.getElementById("form_masividad"        ).style.display     ="none";
            document.getElementById("masividad"             ).required          = false;
            document.getElementById("masividad"             ).value             = "";
            document.getElementById("form_masividad_no"     ).style.display     ="block";
            document.getElementById("conozco_masividad"     ).checked           =false;
            deshabilitarCM();
            deshabilitarSM();
            habilitar("perfil_3");
        }else{
            document.getElementById("form_masividad"        ).style.display     ="block";
            document.getElementById("masividad"             ).required          = true;
            document.getElementById("form_masividad_no"     ).style.display     ="none";
            document.getElementById("conozco_masividad"     ).checked           = true;
            deshabilitarCM();
            deshabilitarSM();
            habilitar("perfil_A");
        }
    });

    //elegir un tipo de perfil
    document.getElementById("perfil_A").addEventListener("change", function(){deshabilitarCM(); deshabilitarSM();   habilitar("perfil_A")});
    document.getElementById("perfil_B").addEventListener("change", function(){deshabilitarCM(); deshabilitarSM();   habilitar("perfil_B")});
    document.getElementById("perfil_3").addEventListener("change", function(){deshabilitarCM(); deshabilitarViga(); habilitar("perfil_3")});
    document.getElementById("perfil_4").addEventListener("change", function(){deshabilitarCM(); deshabilitarViga(); habilitar("perfil_4")});
    
    function habilitar(perfil_) {
        switch(perfil_) {
            case "perfil_A":  document.getElementById("perfil_A").checked = true;                           break;
            case "perfil_B":  document.getElementById("perfil_B").checked = true;                           break;
            case "perfil_3":  document.getElementById("perfil_3").checked = true;   perfil("perfil_HSR");   break;
            case "perfil_4":  document.getElementById("perfil_4").checked = true;   perfil("perfil_HSR");   break;
            default:                                                                                        break;
        }
    }

    function deshabilitarCM() {
        document.getElementById("perfil_A"  ).checked = false;
        document.getElementById("perfil_B"  ).checked = false;
    }
    
    function deshabilitarViga() {
        document.getElementById("perfil_3"  ).checked = false;
        document.getElementById("perfil_4"  ).checked = false;
    }

    function deshabilitarSM() {
        document.getElementById("perfil_3"  ).checked = false;
        document.getElementById("perfil_4"  ).checked = false;
        deshabilitarTipo();
        deshabilitarImg();
    }

    function deshabilitarTipo() {   
        document.getElementById("perfil_HSR").checked = false;
        document.getElementById("perfil_HCR").checked = false;
        document.getElementById("perfil_R"  ).checked = false;
        document.getElementById("perfil_O"  ).checked = false;
        document.getElementById("perfil_C"  ).checked = false;
        document.getElementById("perfil_IC" ).checked = false;
        document.getElementById("perfil_CA" ).checked = false;
        document.getElementById("perfil_ICA").checked = false;
        document.getElementById("perfil_OCA").checked = false;
        document.getElementById("perfil_L"  ).checked = false;
        document.getElementById("perfil_Z"  ).checked = false;
        document.getElementById("d_H"       ).style.display="none"; document.getElementById("dato_H" ).required=false;
        document.getElementById("d_B1"      ).style.display="none"; document.getElementById("dato_B1").required=false;
        document.getElementById("d_B2"      ).style.display="none"; document.getElementById("dato_B2").required=false;
        document.getElementById("d_C"       ).style.display="none"; document.getElementById("dato_C" ).required=false;
        document.getElementById("d_e1"      ).style.display="none"; document.getElementById("dato_e1").required=false;
        document.getElementById("d_e2"      ).style.display="none"; document.getElementById("dato_e2").required=false;
        document.getElementById("d_t"       ).style.display="none"; document.getElementById("dato_t" ).required=false;
        document.getElementById("d_C"       ).style.display="none"; document.getElementById("dato_C" ).required=false;
        document.getElementById("d_r"       ).style.display="none"; document.getElementById("dato_r" ).required=false;
        document.getElementById("d_D"       ).style.display="none"; document.getElementById("dato_D" ).required=false;
    }

    function deshabilitarImg() {
        document.getElementById("img").style.display="none"; 
    }

    function habilitarImg() {
        document.getElementById("img").style.display="block"; 
    }
    

    //selecionar solo un tipo de perfil
    document.getElementById("perfil_HSR"            ).addEventListener("change", function(){perfil("perfil_HSR");});
    document.getElementById("perfil_HCR"            ).addEventListener("change", function(){perfil("perfil_HCR");});
    document.getElementById("perfil_R"              ).addEventListener("change", function(){perfil("perfil_R"  );});
    document.getElementById("perfil_O"              ).addEventListener("change", function(){perfil("perfil_O"  );});
    document.getElementById("perfil_C"              ).addEventListener("change", function(){perfil("perfil_C"  );});
    document.getElementById("perfil_IC"             ).addEventListener("change", function(){perfil("perfil_IC" );});
    document.getElementById("perfil_CA"             ).addEventListener("change", function(){perfil("perfil_CA" );});
    document.getElementById("perfil_ICA"            ).addEventListener("change", function(){perfil("perfil_ICA");});
    document.getElementById("perfil_OCA"            ).addEventListener("change", function(){perfil("perfil_OCA");});
    document.getElementById("perfil_L"              ).addEventListener("change", function(){perfil("perfil_L"  );});
    document.getElementById("perfil_Z"              ).addEventListener("change", function(){perfil("perfil_Z"  );});

    function perfil(Perfil) {
        deshabilitarCM();
        deshabilitarTipo();
        habilitarImg();
        switch(Perfil) {
            case "perfil_HSR": 
                document.getElementById("perfil_HSR").checked=true;   
                document.getElementById("img"       ).src="/../assets/img/Cortes/H.png";      
                document.getElementById("d_H"       ).style.display="block"; document.getElementById("dato_H" ).required=true;
                document.getElementById("d_B1"      ).style.display="block"; document.getElementById("dato_B1").required=true;
                document.getElementById("d_B2"      ).style.display="block"; document.getElementById("dato_B2").required=true;
                document.getElementById("d_e1"      ).style.display="block"; document.getElementById("dato_e1").required=true;
                document.getElementById("d_e2"      ).style.display="block"; document.getElementById("dato_e2").required=true;
                document.getElementById("d_t"       ).style.display="block"; document.getElementById("dato_t" ).required=true;
                break;
            case "perfil_HCR": 
                document.getElementById("perfil_HCR").checked = true;   
                document.getElementById("img"       ).src="/../assets/img/Cortes/H.png";   
                document.getElementById("d_H"       ).style.display="block"; document.getElementById("dato_H" ).required=true;
                document.getElementById("d_B1"      ).style.display="block"; document.getElementById("dato_B1").required=true;
                document.getElementById("d_B2"      ).style.display="block"; document.getElementById("dato_B2").required=true;
                document.getElementById("d_e1"      ).style.display="block"; document.getElementById("dato_e1").required=true;
                document.getElementById("d_e2"      ).style.display="block"; document.getElementById("dato_e2").required=true;
                document.getElementById("d_t"       ).style.display="block"; document.getElementById("dato_t" ).required=true;
                document.getElementById("d_r"       ).style.display="block"; document.getElementById("dato_r" ).required=true;
                break;
            case "perfil_R":   
                document.getElementById("perfil_R"  ).checked = true;   
                document.getElementById("img"       ).src="/../assets/img/Cortes/R.png";  
                document.getElementById("d_H"       ).style.display="block"; document.getElementById("dato_H" ).required=true;
                document.getElementById("d_B1"      ).style.display="block"; document.getElementById("dato_B1").required=true;
                document.getElementById("d_e1"      ).style.display="block"; document.getElementById("dato_e1").required=true;
                break;
            case "perfil_O":   
                document.getElementById("perfil_O"  ).checked = true;   
                document.getElementById("img"       ).src="/../assets/img/Cortes/O.png";   
                document.getElementById("d_e1"      ).style.display="block"; document.getElementById("dato_e1").required=true;
                document.getElementById("d_D"       ).style.display="block"; document.getElementById("dato_D ").required=true;
                break;
            case "perfil_C":   
                document.getElementById("perfil_C"  ).checked = true;   
                document.getElementById("img"       ).src="/../assets/img/Cortes/C.png";   
                document.getElementById("d_H"       ).style.display="block"; document.getElementById("dato_H" ).required=true;
                document.getElementById("d_B1"      ).style.display="block"; document.getElementById("dato_B1").required=true;
                document.getElementById("d_e1"      ).style.display="block"; document.getElementById("dato_e1").required=true;
                break;
            case "perfil_IC":   
                document.getElementById("perfil_IC" ).checked = true;   
                document.getElementById("img"       ).src="/../assets/img/Cortes/IC.png";  
                document.getElementById("d_H"       ).style.display="block"; document.getElementById("dato_H" ).required=true;
                document.getElementById("d_B1"      ).style.display="block"; document.getElementById("dato_B1").required=true;
                document.getElementById("d_e1"      ).style.display="block"; document.getElementById("dato_e1").required=true;
                break;
            case "perfil_CA":  
                document.getElementById("perfil_CA" ).checked = true;   
                document.getElementById("img"       ).src="/../assets/img/Cortes/CA.png";  
                document.getElementById("d_H"       ).style.display="block"; document.getElementById("dato_H" ).required=true;
                document.getElementById("d_B1"      ).style.display="block"; document.getElementById("dato_B1").required=true;
                document.getElementById("d_C"       ).style.display="block"; document.getElementById("dato_C" ).required=true;
                document.getElementById("d_e1"      ).style.display="block"; document.getElementById("dato_e1").required=true;
                break;
            case "perfil_ICA": 
                document.getElementById("perfil_ICA").checked = true;   
                document.getElementById("img"       ).src="/../assets/img/Cortes/ICA.png"; 
                document.getElementById("d_H"       ).style.display="block"; document.getElementById("dato_H" ).required=true;
                document.getElementById("d_B1"      ).style.display="block"; document.getElementById("dato_B1").required=true;
                document.getElementById("d_C"       ).style.display="block"; document.getElementById("dato_C" ).required=true;
                document.getElementById("d_e1"      ).style.display="block"; document.getElementById("dato_e1").required=true;
                break;
            case "perfil_OCA": 
                document.getElementById("perfil_OCA").checked = true;   
                document.getElementById("img"       ).src="/../assets/img/Cortes/OCA.png"; 
                document.getElementById("d_H"       ).style.display="block"; document.getElementById("dato_H" ).required=true;
                document.getElementById("d_B1"      ).style.display="block"; document.getElementById("dato_B1").required=true;
                document.getElementById("d_C"       ).style.display="block"; document.getElementById("dato_C" ).required=true;
                document.getElementById("d_e1"      ).style.display="block"; document.getElementById("dato_e1").required=true;
                break;
            case "perfil_L":   
                document.getElementById("perfil_L"  ).checked = true;   
                document.getElementById("img"       ).src="/../assets/img/Cortes/L.png";   
                document.getElementById("d_H"       ).style.display="block"; document.getElementById("dato_H" ).required=true;
                document.getElementById("d_B1"      ).style.display="block"; document.getElementById("dato_B1").required=true;
                document.getElementById("d_e1"      ).style.display="block"; document.getElementById("dato_e1").required=true;
                break;
            case "perfil_Z":   
                document.getElementById("perfil_Z"  ).checked = true;   
                document.getElementById("img"       ).src="/../assets/img/Cortes/Z.png";   
                document.getElementById("d_H"       ).style.display="block"; document.getElementById("dato_H" ).required=true;
                document.getElementById("d_B1"      ).style.display="block"; document.getElementById("dato_B1").required=true;
                document.getElementById("d_B2"      ).style.display="block"; document.getElementById("dato_B2").required=true;
                document.getElementById("d_C"       ).style.display="block"; document.getElementById("dato_C" ).required=true;
                document.getElementById("d_e1"      ).style.display="block"; document.getElementById("dato_e1").required=true;
                break;
            default:   
                break;                                                                                              
            }
        }

    //selecionar solo un tipo de resistencia
    document.getElementById("resistencia_15").addEventListener("change", function(){resistencia("resistencia_15");});
    document.getElementById("resistencia_30").addEventListener("change", function(){resistencia("resistencia_30");});
    document.getElementById("resistencia_60").addEventListener("change", function(){resistencia("resistencia_60");});
    document.getElementById("resistencia_90").addEventListener("change", function(){resistencia("resistencia_90");});

    function resistencia(Resistencia) {
        document.getElementById("resistencia_15").checked = false;
        document.getElementById("resistencia_30").checked = false;
        document.getElementById("resistencia_60").checked = false;
        document.getElementById("resistencia_90").checked = false;
        switch(Resistencia) {
            case "resistencia_15":  document.getElementById("resistencia_15").checked = true;   break;
            case "resistencia_30":  document.getElementById("resistencia_30").checked = true;   break;
            case "resistencia_60":  document.getElementById("resistencia_60").checked = true;   break;
            case "resistencia_90":  document.getElementById("resistencia_90").checked = true;   break;
            default:                                                                            break;
        };
    }

