function gramas() {
    var peso = document.getElementById('peso');
    var grama = peso.value.replace(/[^\d,]/g, '');
    
    if (grama) {
        peso.value = `${grama} g`;
    } else {
        peso.value = '';
    }
}
