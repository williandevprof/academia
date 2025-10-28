
    function pegaCodigoTecla(event)
    {
        if (event.keyCode)
            return event.keyCode;
        else if (event.which)
            return event.which;
        else
        return event.charCode;
    }

    function proximoCampo(campo)
    {
        for (var i = 0; i < campo.form.elements.length; i++)
            if (campo == campo.form.elements[i])
                break;
            if (i < campo.form.elements.length)
                i++;
            return campo.form.elements[i];
    }

    function mudaCampoComEnter (campo, event)
    {
        var codigoTecla = pegaCodigoTecla(event);
        if (codigoTecla == 13)
        {
            proximo = proximoCampo(campo);
            proximo.focus();
        }
    }

    function somenteNumero (event)
    {
        var codigoTecla = pegaCodigoTecla(event);
        var tecla = String.fromCharCode(codigoTecla);
        if (codigoTecla == 0 ) return false;
        if (codigoTecla == 8 ) return false; //backspace
        if (codigoTecla == 9 ) return false; //tab
        if ("0123456789".indexOf(tecla) == -1)
        if (document.all)
            event.returnValue = false
        else
            event.preventDefault()
    }

    function mascaraRG(campo, event){
        var tamanho = campo.value.length;
        if (somenteNumero(event) == false)
            return false;

        if (tamanho == 1)
            campo.value += ".";
        
        if (tamanho == 5)
            campo.value += ".";
        
        if (tamanho == 9)
            campo.value += " ";

    }

    function mascaraCPF(campo, event){
        var tamanho = campo.value.length;
        if (somenteNumero(event) == false)
            return false;

        if (tamanho == 3)
            campo.value += ".";
        
        if (tamanho == 7)
            campo.value += ".";
        
        if (tamanho == 11)
            campo.value += "-";

    }

    function mascaraTelefone(campo, event){
        var tamanho = campo.value.length;
        if (somenteNumero(event) == false)
            return false;

        if (tamanho == 0)
            campo.value += "(";
        
        if (tamanho == 3)
            campo.value += ")";
        
        if (tamanho == 8)
            campo.value += "-";

    }

    function mascaraCEP (campo, event)
    {
        var tamanho = campo.value.length;
        if (somenteNumero(event) == false)
            return false;
        if (tamanho == 5)
            campo.value += "-";
    }

    function mascaraCNPJ (campo, event)
    {
        var tamanho = campo.value.length;
        if (somenteNumero(event) == false)
            return false;

        if (tamanho == 2 || tamanho == 6)
            campo.value += ".";
        
        if (tamanho == 10)
            campo.value += "/";
        
        if (tamanho == 14)
            campo.value += "-";
    }

     function mascaraData(campo, event)
     {
        var tamanho = campo.value.length;
        
        if (somenteNumero(event) == false)
            return false;

        if (tamanho == 2)
            campo.value += "/";
        
        if (tamanho == 5)
            campo.value += "/";
             
    }