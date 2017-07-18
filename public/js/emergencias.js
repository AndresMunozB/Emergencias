function formatRUT() {
    var rut_input = document.getElementById('rut');
    var rut = rut_input.value.replace(/[^0-9]/g, '');
    var rut_format = '';
    var ultimo = rut.length - 1;
    for(var i = ultimo; i >= 0; i--) {
        rut_format = rut[i] + rut_format;
        if(i == ultimo)
            rut_format = '-' + rut_format;
        else if((ultimo - i) % 3 == 0)
            rut_format = '.' + rut_format;
    }

    rut_input.value = rut_format;
}